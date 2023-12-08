<?php

namespace App\Http\Controllers\FE;

use App\Models\Period;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Models\TrainingDetail;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    function index() {
        $filename = 'services';
        $filename_script = getContentScript(false, $filename);
        // dd($filename_script);
        $category = Category::get();
        $services = Training::where(['is_active' => 'Y'])->get();
        return view('user-page.'.$filename, [
            'script' => $filename_script,
            'brand_name' => 'UPTD',
            'title' => 'Home',
            'category' => $category,
            'services' => $services,
            'setting' => Setting::find(2)
        ]);
    }

    function getDataServices(Request $request) {
        $active_period = Period::where('is_active', 'Y')->first();
        
        $categorySelected = $request->categoryId;
        if($categorySelected) {
            $filter = ['period_id'  => $active_period->id, 'is_active' => 'Y', 'category_id' => $categorySelected];
        } else {
            $filter = ['period_id'  => $active_period->id, 'is_active' => 'Y'];
        }

        $services = Training::with('category')->where($filter)->get();
        

        $start_date = $active_period->start_date ? date('Y-m-d', strtotime($active_period->start_date)) : null;
        if($start_date != null) {
            $curent_date = date('Y-m-d');

            if($curent_date >= $start_date) {
                $result = array('status' => 'success', 'services' => $services, 'active_period'=>$active_period);
            } else {
                $result = array('status' => 'failed', 'messsage' => 'Mohon maaf, Pendaftaran pelatihan '.$active_period->name.' telah ditutup');
            }
            
        } else {
            $result = array('status' => 'failed', 'messsage' => 'Mohon maaf, Pendaftaran pelatihan belum dibuka kembali.');
        }
        
        echo json_encode($result);

    }

    function detail(int $id) {
        $category = Category::get();
        $services = Training::with('category')->find($id);
        $services_detail = TrainingDetail::where('training_id', $id)->get();
        
        if(!$services) {
            return redirect('/pelatihan');
        }
        
        return view('user-page/services_detail', [
            'brand_name' => 'UPTD',
            'title' => 'Home',
            'category' => $category,
            'service' => $services,
            'services_detail' => $services_detail,
            'setting' => Setting::find(2)
        ]);
    }
}
