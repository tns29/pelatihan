<?php

namespace App\Http\Controllers;

use App\Models\Village;
use App\Models\Registrant;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller {

    function getVillages(Request $request) {
        $data = Village::where(['sub_district_id' => $request->sub_district_id])->get();
        echo json_encode($data);
    }

    function accParticipant(Request $request, string $number) {
        
        $dataUpdate = ['participant' => $request->acc];

        $result = Participant::where(['number' => $number])->update($dataUpdate);
        return redirect('/data-participant');
    }

    function checkDataUser(Request $request,int $serviceId) {
        $user = Auth::guard('participant')->user();
        
        if($user->place_of_birth == null OR
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
            $request->session()->flash('message', 'Anda belum bisa mendaftar, lengkapi data untuk mendaftar pelatihan');
            return redirect('/pelatihan/'.$serviceId);
        } else {
            if($user->participant == 'N') {
                $request->session()->flash('message', 'Anda belum bisa mendaftar, akun anda masih dalam pengecekan oleh admin');
                return redirect('/pelatihan/'.$serviceId);
            }
            
            $checkRegistrantId = Registrant::where(['training_id' => $serviceId, 'participant_number' => $user->number])->get();
            
            if($checkRegistrantId) {
                $request->session()->flash('message', 'Anda telah mendaftar untuk pelatihan ini.');
                return redirect('/pelatihan/'.$serviceId);
            }

            $registrant = new Registrant;

            $registrant->participant_number = $user->number;
            $registrant->training_id = $serviceId;
            $registrant->date = date('Y-m-d H:i:s');
            $registrant->status = 1;
            $registrant->is_active = 'Y';

            $registrant->save();
            
            $request->session()->flash('message', 'Anda telah mendaftar untuk pelatihan ini.');
            return redirect('/pelatihan/'.$serviceId);
        }
        
    }

}
