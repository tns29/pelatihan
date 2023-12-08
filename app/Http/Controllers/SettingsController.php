<?php

namespace App\Http\Controllers;

use App\Models\Period;
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
        $data = Setting::whereBetween('id',[1,2])->get();
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

    function setPeriod() {
        $filename = 'set_period';
        $filename_script = getContentScript(true, $filename);

        $admin = Auth::guard('admin')->user();
        $data = Period::get();
        $active_period = Period::where('is_active', 'Y')->first();
        return view('admin-page.'.$filename, [
            'script' => $filename_script,
            'title' => 'Gelombang',
            'auth_user' => $admin,
            'dataPeriod' => $data,
            'active_period' => $active_period
        ]);
    }

    function savePeriodActive(Request $request) {
        
        $data = Period::get();
        $countData = count($data);
        
        $validatedData = $request->validate([
            'id' => 'required',
            'start_date' => 'required', 
            'end_date' => 'required'
        ]);
        
        for ($i=1; $i <= $countData; $i++) { 
            $id = $i;
            
            // $updateData = ['is_active' => 'N', 'start_date' => NULL, 'end_date' => NULL];
            $updateData = ['is_active' => 'N'];
            Period::where(['id' => $id])->update($updateData);
            
        }

        $id = $validatedData['id'];
        $validatedData['is_active'] = 'Y';
        $result = Period::where(['id' => $id])->update($validatedData);

        return redirect('/set-period');
    }
}
