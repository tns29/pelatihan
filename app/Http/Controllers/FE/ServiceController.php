<?php

namespace App\Http\Controllers\FE;

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
        $categorySelected = $request->categoryId;
        if($categorySelected) {
            $filter = ['is_active' => 'Y', 'category_id' => $categorySelected];
        } else {
            $filter = ['is_active' => 'Y'];
        }
        $services = Training::where($filter)->get();
        echo json_encode($services);
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
