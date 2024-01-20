<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\AdminLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    function dataStaff() {
        $filename = 'data_staff';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $dataStaff = Admin::with('admin_level')->where('level_id', 2)->get();  
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Data Staff',
            'auth_user' => $data,
            'dataStaff' => $dataStaff
        ]);
    }

    function addFormStaff() {
        $filename = 'add_new_staff';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();  
        $admin = Admin::with('admin_level')->get();  
        $admin_level = AdminLevel::get();  
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Tambah Data Staff',
            'auth_user' => $data,
            'level_id' => $admin_level
        ]);
    }

    function storeStaff(Request $request) {
        dd($request);
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
        
        $validatedData['number'] = getLasNumberStaff();
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
            return redirect('/data-staff');
        } else {
            $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
            return redirect('/form-add-staff');
        }
        
    }

    function editFormStaff($number) {
        $filename = 'edit_new_staff';
        $filename_script = getContentScript(true, $filename);

        $data = Auth::guard('admin')->user();
        $data_staff = Admin::find($number);
        $admin_level = AdminLevel::get();  
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Edit Data Staff',
            'auth_user' => $data,
            'data_staff' => $data_staff,
            'level' => $admin_level
        ]);
    }

    function updateStaff(Request $request) {
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
                return redirect('/data-staff');
            } else {
                $request->session()->flash('failed', 'Proses gagal, Hubungi administrator');
                return redirect('/form-edit-staff/'.$validatedData['number']);
            }
        } else {
            $request->session()->flash('failed', 'Username sudah ada');
            return redirect('/form-edit-staff/'.$validatedData['number']);
        }

    }

    function deleteStaff(Request $request, string $number) {

        if(auth()->guard('admin')->user()->number == $number) {
            $request->session()->flash('failed', 'Proses gagal, Anda tidak dapat menghapus akun anda sendiri');
            return redirect('/data-staff');
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
        return redirect('/data-staff');
    }
}
