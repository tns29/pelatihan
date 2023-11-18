<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    function index() {
        $filename = 'settings';
        $filename_script = getContentScript(true, $filename);

        $admin = Auth::guard('admin')->user();
        $data = Setting::get();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Pengaturan',
            'auth_user' => $admin,
            'dataSetting' => $data
        ]);
    }

    function update(Request $request) {
        $data = Setting::get();
        $countData = count($data);
        
        for ($i=1; $i <= $countData; $i++) { 
            $id = 'id'.$i;
            $sd = 'start_date'.$i;
            $ed = 'end_date'.$i;

            $updateData['start_date'] = $request->$sd;
            $updateData['end_date'] = $request->$ed;
            $updateData['updated_at'] = date('Y-m-d H:i:s');
            $updateData['updated_by'] = Auth::guard('admin')->user()->username;

            $result = Setting::where(['id' => $request->$id])->update($updateData);
            
        }
        
        return redirect('/settings');
    }
}
