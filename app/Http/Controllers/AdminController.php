<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminLevel;
use App\Models\Registrant;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    function index() {
        $number = Auth::guard('admin')->user()->number;
        $data = Admin::with('admin_level')->find($number)->first();  
        return view('admin-page.profile', [
            'title' => 'Profile',
            'auth_user' => $data
        ]);
    }
    
    function dataAdmin() {
        $filename = 'data_admin';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $admin = Admin::with('admin_level')->get();  
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Data Admin',
            'auth_user' => $data,
            'dataAdmin' => $admin
        ]);
    }

    function getDetailAdmin(Request $request) {
        $number = $request->number;
        $data = Admin::with('admin_level')->find($number)->first();

        $data->address = $data->address ? $data->address : " - ";
        $data->place_of_birth = $data->place_of_birth ? $data->place_of_birth : " - ";
        $data->date_of_birth = $data->date_of_birth ? date('d-m-Y', strtotime($data->date_of_birth)) : " - - -";
        $data->created_at = date('d-m-Y', strtotime($data->created_at));
        $data->gender = $data->gender == "M" ? "Laki-laki" : "Perempuan";
        $data->level = $data->admin_level->name;
        echo json_encode($data);
    }

    function addFormAdmin() {
        $filename = 'add_new_admin';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $admin = Admin::with('admin_level')->get();  
        $admin_level = AdminLevel::get();  
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Tambah Data Admin',
            'auth_user' => $data,
            'level_id' => $admin_level
        ]);
    }

    function storeAdmin(Request $request) {
        // dd($request);
        $validatedData = $request->validate([
            'fullname'      => 'required|max:50',
            'username'      => 'required|max:30|unique:admins',
            'gender'        => 'required',
            'level_id'        => 'required',
            'place_of_birth'    => 'required|max:40',
            'date_of_birth'     => 'required',
            'no_telp'       => 'required|max:15',
            'email'         => 'required|max:100|email|unique:admins',
            'password'      => 'required|min:6|max:255',
            'images'     => 'image|file|max:1024',
        ]);

        if($request->file('images')) {
            $validatedData['images'] = $request->file('images')->store('profile-images');
        }
        
        $validatedData['number'] = getLasNumberAdmin();
        $validatedData['address'] = $request['address'];
        $validatedData['created_at'] = date('Y-m-d H:i:s');
        $validatedData['created_by'] = Auth::guard('admin')->user()->username;
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['level_id'] = $validatedData['level_id'];
        $validatedData['is_active'] = $request['is_active'] ? "Y" : "N";
        // dd($validatedData);
        $result = Admin::create($validatedData);
        if($result) {
            $request->session()->flash('success', 'Akun berhasil dibuat');
            return redirect('/data-admin');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
            return redirect('/form-add-admin');
        }
        
    }

    function editFormAdmin($number) {
        $filename = 'edit_new_admin';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();
        $data_admin = Admin::find($number);
        $admin_level = AdminLevel::get();  
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Edit Data Admin',
            'auth_user' => $data,
            'data_admin' => $data_admin,
            'level' => $admin_level
        ]);
    }

    function updateAdmin(Request $request) {
        // dd($request);
        $validatedData = $request->validate([
            'fullname'      => 'required|max:50',
            'username'      => 'required|max:30',
            'gender'        => 'required',
            'level_id'        => 'required',
            'place_of_birth'    => 'required|max:40',
            'date_of_birth'     => 'required',
            'no_telp'       => 'required|max:15',
            'images'     => 'image|file|max:1024',
        ]);
        
        $username_exist = false;
        if($request['username1'] != $request['username']) {
            $username_exist = Admin::where('username', $request['username'])->first();
        }
        
        if($request->file('images')) {
            $validatedData['images'] = $request->file('images')->store('profile-images');
        }

        $validatedData['number'] = $request['number'];
        $validatedData['address'] = $request['address'];
        $validatedData['updated_at'] = date('Y-m-d H:i:s');
        $validatedData['updated_by'] = Auth::guard('admin')->user()->username;
        if($request['password']) {
            $validatedData['password'] = Hash::make($request['password']);
        }
        $validatedData['level_id'] = $validatedData['level_id'];
        $validatedData['is_active'] = $request['is_active'] ? "Y" : "N";
        
        if($username_exist === false) {
            $result = Admin::where(['number' => $validatedData['number']])->update($validatedData);
            
            if($result) {
                $request->session()->flash('success', 'Akun berhasil dibuat');
                return redirect('/data-admin');
            } else {
                $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
                return redirect('/form-edit-admin/'.$validatedData['number']);
            }
        } else {
            $request->session()->flash('failed', 'Username sudah ada');
            return redirect('/form-edit-admin/'.$validatedData['number']);
        }

    }

    function deleteAdmin(Request $request, string $number) {

        if(auth()->guard('admin')->user()->number == $number) {
            $request->session()->flash('failed', 'Proses gagal, Anda tidak dapat menghapus akun anda sendiri');
            return redirect('/data-admin');
        }
        $data = Admin::find($number);

        if($data->image) {
            Storage::delete($data->image);
        }

        $result = $data->delete();
        if($result) {
            $request->session()->flash('success', 'Data berhasil dihapus');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/data-admin');
    }

    function registrantData() {
        $filename = 'data_participant';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $dataParticipants = Participant::get();
        return view('admin-page.'.$filename, [
            'candidate' => '',
            'script' => $filename_script,
            'title' => 'Data Pendaftar Akun',
            'auth_user' => $data,
            'dataParticipants' => $dataParticipants
        ]);
    }

    function deleteRegistrant(Request $request, string $number) {
        $checkDataExist = Registrant::where("participant_number", $number)->count();
        if($checkDataExist > 0) {
            $request->session()->flash('message', 'Akun tidak dapat dihapus, karna telah mengikuti pelatihan');
            return redirect('/registrant-data');
        }
        $data = Participant::find($number);
        // dd($data);
        if($data->id_card) {
            Storage::delete($data->id_card);
        }
        if($data->ak1) {
            Storage::delete($data->ak1);
        }
        if($data->ijazah) {
            Storage::delete($data->ijazah);
        }
        if($data->image) {
            Storage::delete($data->image);
        }
        $result = $data->delete();
        if($result) {
            $request->session()->flash('success', 'Data berhasil dihapus');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/registrant-data');
    }

    function candidateData() {
        $filename = 'data_participant';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $dataParticipants = Participant::with('sub_districts')->where('participant', 'Y')->get();
        return view('admin-page.'.$filename, [
            'candidate' => 'Y',
            'script' => $filename_script,
            'title' => 'Data Calon Peserta',
            'auth_user' => $data,
            'dataParticipants' => $dataParticipants
        ]);
    }

    // DETAIL CALON PESERTA 
    function detailParticipant(string $number, $pageCandidate = '') {
        $filename = 'detail_participant';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $participant = new Participant;
        $data_part = $participant->getUserProfileByNumber($number);
        // dd($participant);
        return view('admin-page.'.$filename, [
            'candidate' => $pageCandidate,
            'script' => $filename_script,
            'title' => 'Detail Peserta',
            'auth_user' => $data,
            'detailParticipant' => $data_part
        ]);
    }
    
    function resetPassword(Request $request, string $number) {
        
        $password = Hash::make($request->password);

        $result = Participant::where('number', $number)->update(['password'=>$password]);
        
        if($result) {
            $request->session()->flash('success', 'Password baru berhasil disimpan');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
        }
        return redirect('/detail-participant/'.$number);
    }

    function registrant(Request $request) {
        $filename = 'registrant';
        $filename_script = getContentScript(true, $filename);
        
        $status_approve = $request->status ? $request->status : NULL;

        $data = Auth::guard('admin')->user();  
        $registrant = new Registrant;
        $result = $registrant->getRegistrants($status_approve,$request->fullname);
        // dd($result);
        return view('admin-page.'.$filename, [
            'status' => $status_approve,
            'search_name' => $request->fullname,
            'script' => $filename_script,
            'title' => 'Data Pendaftar Pelatihan',
            'auth_user' => $data,
            'participant' => $result
        ]);
    }
    
    function participantPassed(Request $request) {
        $filename = 'participant_passed';
        $filename_script = getContentScript(true, $filename);
        
        $status_passed = $request->passed ? $request->passed : NULL;

        $data = Auth::guard('admin')->user();  
        $registrant = new Registrant;
        $result = $registrant->getParticipantPassed($status_passed, $request->fullname);
        // dd($result);
        return view('admin-page.'.$filename, [
            'passed' => $status_passed,
            'search_name' => $request->fullname,
            'script' => $filename_script,
            'title' => 'Data Kelulusan Pelatihan',
            'auth_user' => $data,
            'participant' => $result
        ]);
    }

    function approveParticipant(Request $request, $number) {

        $data = Auth::guard('admin')->user();

        $dataUpdate = [
            'approval_on' => date('Y-m-d H:i:s'),
            'approval_by' => $data->username,
            'approve' => 'Y',
        ];

        Registrant::where(['participant_number'=> $number, 'training_id' => $request->training_id])->update($dataUpdate);
        
        return redirect('registrant');
    }
    
    function declineParticipant(Request $request, $number) {
        // dd($request);
        $dataUpdate = [
            'approve' => 'N',
        ];
        Registrant::where(['participant_number'=> $number, 'training_id' => $request->training_id])->update($dataUpdate);
        return redirect('registrant');
    }


    // DETAIL PESERTA PELATIHAN YANG TELAH DI APPROVE
    function detailParticipantAppr(string $number, int $training_id) {
        // dd($training_id);
        $filename = 'detail_participant_appr';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $participant = new Participant;
        // $data_part = $participant->getUserProfileByNumber($number);
        $resultData = Registrant::with('participants', 'service.service_detail', 'service.periods')
                                ->where(['participant_number'=> $number, 'training_id' => $training_id])->first();
        // dd($resultData);
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Detail Peserta Pelatihan',
            'auth_user' => $data,
            // 'detailParticipant' => $data_part,
            'resultData' => $resultData
        ]);
    }

    function passedParticipant(Request $request, $number) {

        $data = Auth::guard('admin')->user();
        // dd($request->training_id);
        $dataUpdate = [
            'passed_on' => date('Y-m-d H:i:s'),
            'passed' => $request->passed,
        ];

        Registrant::where(['participant_number'=> $number, 'training_id' => $request->training_id])->update($dataUpdate);
        
        return redirect('registrant');
    }
    
}
