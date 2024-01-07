<?php

namespace App\Http\Controllers\FE;

use DateTime;
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
        $search_name = $request->search_name;

        $services = Training::with('category')
                            ->where($filter)
                            ->where('title', 'like', '%' . $search_name . '%')
                            ->get();
        

        $start_date = $active_period->start_date ? date('Y-m-d', strtotime($active_period->start_date)) : null;
        $end_date = $active_period->end_date ? date('Y-m-d', strtotime($active_period->end_date)) : null;
        $curent_date = date('Y-m-d');
        
        // $now = new DateTime($curent_date);
        $now = date_create();
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        // $jarak_mulai = $now->diff($start);
        // $jarak_selesai = $end->diff($now);
        
        $jarak_mulai  = date_diff($now, $start);
        $jarak_selesai  = date_diff($now, $end);
        if($jarak_mulai->days > 0 && $jarak_mulai->invert > 0) {
            $telah_dimulai = true;
        } else {
            $telah_dimulai = false;
        }
        if($jarak_selesai->days > 0 && $jarak_selesai->invert > 0) {
            $telah_selesai = true;
        } else {
            $telah_selesai = false;
        }
        // dd($jarak_mulai);

        if($start_date != null) {

            // if($curent_date >= $start_date) {
            if($telah_dimulai == true && $telah_selesai == false) {
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
