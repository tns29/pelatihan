<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Registrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class Dashboard extends Controller
{
    
    public function __construct(protected Admin $admin) {
        $user = Auth::guard('admin')->user();
    }
    
    function index() {
    
        $registrant_group = DB::table('registrants')
                                ->select('sub_districts.name AS sub_district_name', DB::raw('count(participants.sub_district) as count'))
                                ->join('participants', 'registrants.participant_number', '=', 'participants.number')
                                ->join('sub_districts', 'sub_districts.id', '=', 'participants.sub_district')
                                ->groupBy('sub_districts.name')
                                ->get();

        $countRegistrant = Registrant::count();

        $cur_route = Route::current()->uri();
        $data = Auth::guard('admin')->user();
        return view('admin-page.dashboard', [
            'title' => 'Dashboard',
            'cur_page' => $cur_route,
            'auth_user' => $data,
            'pendaftarBaru' => DB::table('participants')->where('participant', '=', 'N')->count(),
            'calonPeserta' => DB::table('participants')->where('participant', '=', 'Y')->count(),
            'pesertaApprove' => DB::table('registrants')->where('approve', '=', 'Y')->count(),
            'pesertaDecline' => DB::table('registrants')->where('approve', '=', 'N')->count(),
            'registrant_group' => $registrant_group,
            'countRegistrant' => $countRegistrant,
        ]);
    }
}
