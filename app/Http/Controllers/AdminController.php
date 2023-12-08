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
            'level' => $admin_level
        ]);
    }

    function storeAdmin(Request $request) {

        $validatedData = $request->validate([
            'fullname'      => 'required|max:50',
            'username'      => 'required|max:30|unique:admins',
            'gender'        => 'required',
            'level'        => 'required',
            'place_of_birth'    => 'required|max:40',
            'date_of_birth'     => 'required',
            'no_telp'       => 'required|max:15',
            'email'         => 'required|max:100|email|unique:admins',
            'password'      => 'required|min:6|max:255',
        ]);
        
        $validatedData['number'] = getLasNumberAdmin();
        $validatedData['created_at'] = date('Y-m-d H:i:s');
        $validatedData['created_by'] = Auth::guard('admin')->user()->username;
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['level_id'] = 1;
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
        $validatedData = $request->validate([
            'fullname'      => 'required|max:50',
            'username'      => 'required|max:30',
            'gender'        => 'required',
            'level_id'        => 'required',
            'place_of_birth'    => 'required|max:40',
            'date_of_birth'     => 'required',
            'no_telp'       => 'required|max:15',
        ]);
        
        $username_exist = false;
        if($request['username1'] != $request['username']) {
            $username_exist = Admin::where('username', $request['username'])->first();
        }
        
        $validatedData['number'] = $request['number'];
        $validatedData['updated_at'] = date('Y-m-d H:i:s');
        $validatedData['updated_by'] = Auth::guard('admin')->user()->username;
        if($request['password']) {
            $request['password'] = Hash::make($request['password']);
        }
        $validatedData['level_id'] = $validatedData['level_id'];
        
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

    function dataParticipant() {
        $filename = 'data_participant';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $dataParticipants = Participant::get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Data Peserta',
            'auth_user' => $data,
            'dataParticipants' => $dataParticipants
        ]);
    }

    function detailParticipant(string $number) {
        $filename = 'detail_participant';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $participant = new Participant;
        $data_part = $participant->getUserProfileByNumber($number);
        // dd($participant);
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Detail Peserta',
            'auth_user' => $data,
            'detailParticipant' => $data_part
        ]);
    }
    
    function registrant(Request $request) {
        $filename = 'registrant';
        $filename_script = getContentScript(true, $filename);
        
        $status = $request->status ? $request->status : 'Y';

        $data = Auth::guard('admin')->user();  
        $registrant = new Registrant;
        $result = $registrant->getRegistrants($status);
        // dd($result);
        return view('admin-page.'.$filename, [
            'status' => $status,
            'script' => $filename_script,
            'title' => 'Data Pendaftar',
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
            'is_active' => 'N',
        ];
        Registrant::where(['participant_number'=> $number, 'training_id' => $request->training_id])->update($dataUpdate);
        return redirect('registrant');
    }
    
}
