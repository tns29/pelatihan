<?php

namespace App\Http\Controllers;

use App\Models\Period;
use App\Models\Village;
use App\Models\Category;
use App\Models\Training;
use App\Models\Registrant;
use App\Models\Participant;
use App\Models\SubDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller {

    function getVillages(Request $request) {
        $data = Village::where(['sub_district_id' => $request->sub_district_id])->get();
        echo json_encode($data);
    }
    
    function getRegistrant(Request $request) {
        $result = Registrant::where(['training_id' => $request->training_id])->get();
        echo json_encode($result);
    }

    function accParticipant(Request $request, string $number) {
        
        $dataUpdate = ['participant' => $request->acc];

        $result = Participant::where(['number' => $number])->update($dataUpdate);
        return redirect('/registrant-data');
    }

    function checkDataUser(Request $request,int $serviceId) {
        $user = Auth::guard('participant')->user();
        // dd($user->number);
        if($user->nik == null OR
            $user->place_of_birth == null OR
            $user->date_of_birth == null OR 
            $user->no_telp == null OR 
            $user->no_wa == null OR 
            $user->address == null OR 
            $user->height == null OR 
            $user->religion == null OR 
            $user->material_status == null OR 
            $user->last_education == null OR 
            $user->graduation_year == null OR 
            $user->sub_district == null OR 
            $user->village == null OR 
            $user->ak1 == null OR 
            $user->ijazah == null OR 
            $user->image == null 
        ) {
            $request->session()->flash('failed2', 'Anda belum bisa mendaftar, lengkapi data untuk mendaftar pelatihan.');
            return redirect('/pelatihan/'.$serviceId);
        } else {
            if($user->participant == 'N') {
                $request->session()->flash('failed3', 'Anda belum bisa mendaftar, akun anda masih dalam pengecekan oleh admin');
                return redirect('/pelatihan/'.$serviceId);
            }

            $usia = hitung_umur($user->date_of_birth);
            
            $getService = Training::find($serviceId);
            $min_age = (int)$getService->min_age;
            $max_age = (int)$getService->max_age;
            if ($usia < $min_age) {
                $request->session()->flash('failed3', 'Anda belum bisa mendaftar, usia anda belum mencukupi untuk mengikuti pelatihan ini.');
                return redirect('/pelatihan/'.$serviceId);
            }
            
            if ($usia > $max_age) {
                $request->session()->flash('failed3', 'Anda belum bisa mendaftar, usia anda melebihi batas untuk mengikuti pelatihan ini.');
                return redirect('/pelatihan/'.$serviceId);
            }

            $checkRegistrantId = Registrant::where(['training_id' => $serviceId, 'participant_number' => $user->number])->first();
            
            if($checkRegistrantId) {
                $request->session()->flash('failed1', 'Anda telah mendaftar untuk pelatihan ini.');
                return redirect('/pelatihan/'.$serviceId);
            }

            $registrant = new Registrant;

            $registrant->participant_number = $user->number;
            $registrant->training_id = $serviceId;
            $registrant->date = date('Y-m-d H:i:s');
            $registrant->is_active = 'Y';

            $registrant->save();
            
            $request->session()->flash('success', 'Anda berhasil mendaftar pelatihan.');
            return redirect('/pelatihan/'.$serviceId);
        }
        
    }

    function registrantReport() {
        $filename = 'report_registrant';
        $filename_script = getContentScript(true, $filename);

        $admin = Auth::guard('admin')->user();
        $registrant = Participant::get();
        $subDistrict = SubDistrict::get();
        $villages = Village::get();
        
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Laporan Pendaftar Akun',
            'auth_user' => $admin,
            'registrant' => $registrant,
            'subDistrict' => $subDistrict,
            'villages' => $villages
        ]);
    }

    // PENDAFTAR (REPORT REGISTRANT)
    function registrantRpt(Request $request) {
        // dd($request->fullname);
        if($request->fullname) {
            if($request->session()->get('fullname') != $request->fullname) {
                session()->forget('fullname');
            }
            $request->session()->push('fullname', $request->fullname);
        } else {
            session()->forget('fullname');
        }
        
        if($request->gender) {
            if($request->session()->get('gender') != $request->gender) {
                session()->forget('gender');
            }
            $request->session()->push('gender', $request->gender);
        } else {
            session()->forget('gender');
        }
        
        if($request->sub_district) {
            if($request->session()->get('sub_district') != $request->sub_district) {
                session()->forget('sub_district');
            }
            $request->session()->push('sub_district', $request->sub_district);
        } else {
            session()->forget('sub_district');
        }
        
        if($request->village) {
            if($request->session()->get('village') != $request->village) {
                session()->forget('village');
            }
            $request->session()->push('village', $request->village);
        } else {
            session()->forget('village');
        }

        echo json_encode('{}');
    }

    function openRegistrantRpt(Request $request) {
        $where = ['participants.is_active' => 'Y'];
        
        if($request->session()->get('fullname')) {
            $where['participants.number'] = $request->session()->get('fullname')[0];
        }
        if($request->session()->get('gender')) {
            $where['participants.gender'] = $request->session()->get('gender')[0];
        }
        if($request->session()->get('sub_district')) {
            $where['participants.sub_district'] = $request->session()->get('sub_district')[0];
        }
        if($request->session()->get('village')) {
            $where['participants.village'] = $request->session()->get('village')[0];
        }

        // dd($where);
        
        $data = DB::table('participants')
            ->select('participants.*','sub_districts.name as sub_district_name', 'villages.name as village_name')
            ->leftJoin('sub_districts', 'participants.sub_district', '=', 'sub_districts.id')
            ->leftJoin('villages', 'participants.village', '=', 'villages.id')
            ->where($where)
            ->get();
            
        return view('admin-page.report.registrant_rpt', [
            'title' => 'Laporan Pendaftar Akun',
            'data' => $data,
        ]);
    }

    // PESERTA (REPORT PARTICIPANTS) //
    function participantReport() {
        $filename = 'report_participant';
        $filename_script = getContentScript(true, $filename);

        $admin = Auth::guard('admin')->user();
        $categories = Category::get();
        $trainings = Training::get();
        $participant = Participant::get();
        $subDistrict = SubDistrict::get();
        $villages = Village::get();
        $period = Period::get();
        
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Laporan Pelatihan Peserta',
            'auth_user' => $admin,
            'categories' => $categories,
            'trainings' => $trainings,
            'participant' => $participant,
            'subDistrict' => $subDistrict,
            'villages' => $villages,
            'periods' => $period
        ]);
    }

    function participantRpt(Request $request) {
        
        if($request->fullname) {
            if($request->session()->get('fullname') != $request->fullname) {
                session()->forget('fullname');
            }
            $request->session()->push('fullname', $request->fullname);
        } else {
            session()->forget('fullname');
        }
        
        if($request->category_id) {
            if($request->session()->get('category_id') != $request->category_id) {
                session()->forget('category_id');
            }
            $request->session()->push('category_id', $request->category_id);
        } else {
            session()->forget('category_id');
        }
        
        if($request->training_id) {
            if($request->session()->get('training_id') != $request->training_id) {
                session()->forget('training_id');
            }
            $request->session()->push('training_id', $request->training_id);
        } else {
            session()->forget('training_id');
        }
        
        if($request->gender) {
            if($request->session()->get('gender') != $request->gender) {
                session()->forget('gender');
            }
            $request->session()->push('gender', $request->gender);
        } else {
            session()->forget('gender');
        }
        
        if($request->sub_district) {
            if($request->session()->get('sub_district') != $request->sub_district) {
                session()->forget('sub_district');
            }
            $request->session()->push('sub_district', $request->sub_district);
        } else {
            session()->forget('sub_district');
        }
        
        if($request->village) {
            if($request->session()->get('village') != $request->village) {
                session()->forget('village');
            }
            $request->session()->push('village', $request->village);
        } else {
            session()->forget('village');
        }
        if($request->material_status) {
            if($request->session()->get('material_status') != $request->material_status) {
                session()->forget('material_status');
            }
            $request->session()->push('material_status', $request->material_status);
        } else {
            session()->forget('material_status');
        }
        if($request->religion) {
            if($request->session()->get('religion') != $request->religion) {
                session()->forget('religion');
            }
            $request->session()->push('religion', $request->religion);
        } else {
            session()->forget('religion');
        }
        
        if($request->period) {
            if($request->session()->get('period') != $request->period) {
                session()->forget('period');
            }
            $request->session()->push('period', $request->period);
        } else {
            session()->forget('period');
        }

        echo json_encode('{}');
    }

    function openParticipantRpt(Request $request) {
        $where = ['registrants.is_active' => 'Y'];

        if($request->session()->get('fullname')) {
            $where['participants.number'] = $request->session()->get('fullname')[0];
        }
        if($request->session()->get('category_id')) {
            $where['trainings.category_id'] = $request->session()->get('category_id')[0];
        }
        if($request->session()->get('training_id')) {
            $where['registrants.training_id'] = $request->session()->get('training_id')[0];
        }
        if($request->session()->get('gender')) {
            $where['participants.gender'] = $request->session()->get('gender')[0];
        }
        if($request->session()->get('sub_district')) {
            $where['participants.sub_district'] = $request->session()->get('sub_district')[0];
        }
        if($request->session()->get('village')) {
            $where['participants.village'] = $request->session()->get('village')[0];
        }
        if($request->session()->get('material_status')) {
            $where['participants.material_status'] = $request->session()->get('material_status')[0];
        }
        if($request->session()->get('religion')) {
            $where['participants.religion'] = $request->session()->get('religion')[0];
        }
        if($request->session()->get('period')) {
            $where['trainings.period_id'] = $request->session()->get('period')[0];
        }

        // dd($where);
        
        $data = DB::table('registrants')
            ->select('registrants.*','participants.*','sub_districts.name as sub_district_name', 'villages.name as village_name', 'periods.name as gelombang', 'trainings.title AS training_name')
            ->leftJoin('trainings', 'trainings.id', '=', 'registrants.training_id')
            ->leftJoin('periods', 'periods.id', '=', 'trainings.period_id')
            ->leftJoin('participants', 'participants.number', '=', 'registrants.participant_number')
            ->leftJoin('sub_districts', 'participants.sub_district', '=', 'sub_districts.id')
            ->leftJoin('villages', 'participants.village', '=', 'villages.id')
            ->where($where)
            ->get();
            
        return view('admin-page.report.participant_rpt', [
            'title' => 'Laporan Peserta Pelatihan',
            'data' => $data,
        ]);
    }
}
