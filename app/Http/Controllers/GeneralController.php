<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    function getVillages(Request $request) 
    {
        $data = Village::where(['sub_district_id' => $request->sub_district_id])->get();
        echo json_encode($data);
    }
}
