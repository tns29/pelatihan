<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminLevel;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    function index() {
        $code = Auth::guard('admin')->user()->code;
        $data = Admin::with('admin_level')->find($code)->first();  
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

    function getDetailAdmin (Request $request) {
        $code = $request->code;
        $data = Admin::with('admin_level')->find($code)->first();

        $data->address = $data->address ? $data->address : " - ";
        $data->place_of_birth = $data->place_of_birth ? $data->place_of_birth : " - ";
        $data->date_of_birth = $data->date_of_birth ? date('d-m-Y', strtotime($data->date_of_birth)) : " - - -";
        $data->created_on = date('d-m-Y', strtotime($data->created_on));
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
        
        $validatedData['code'] = getLasCodeAdmin();
        $validatedData['created_on'] = date('Y-m-d H:i:s');
        $validatedData['created_by'] = Auth::guard('admin')->user()->username;
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['level_id'] = 1;
        // dd($validatedData);
        $result = Admin::create($validatedData);
        if($result) {
            $request->session()->flash('success', 'Akun berhasil dibuat');
            return redirect('/data-admin');
        } else {
            $request->session()->flash('success', 'Proses gagal, Hubungi administrator');
            return redirect('/form-add-admin');
        }
        
    }

    function editFormAdmin($code) {
        $filename = 'edit_new_admin';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();
        $data_admin = Admin::find($code);
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
        
        $validatedData['code'] = $request['code'];
        $validatedData['updated_on'] = date('Y-m-d H:i:s');
        $validatedData['updated_by'] = Auth::guard('admin')->user()->username;
        if($request['password']) {
            $request['password'] = Hash::make($request['password']);
        }
        $validatedData['level_id'] = $validatedData['level_id'];
        
        if($username_exist === false) {
            $result = Admin::where(['code' => $validatedData['code']])->update($validatedData);
            
            if($result) {
                $request->session()->flash('success', 'Akun berhasil dibuat');
                return redirect('/data-admin');
            } else {
                $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
                return redirect('/form-edit-admin/'.$validatedData['code']);
            }
        } else {
            $request->session()->flash('failed', 'Username sudah ada');
            return redirect('/form-edit-admin/'.$validatedData['code']);
        }

    }

    function dataParticipant() {
        $filename = 'data_participant';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $admin = Participant::with('grade')->get();  
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Data Peserta',
            'auth_user' => $data,
            'dataAdmin' => $admin
        ]);
    }
    
    function registrant() {
        $data = Auth::guard('admin')->user();  
        $participant = Participant::all();  
        return view('admin-page.registrant', [
            'title' => 'Data Pendaftar',
            'auth_user' => $data,
            'participant' => $participant
        ]);
    }
    
}
