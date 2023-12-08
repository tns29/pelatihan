<?php

use App\Models\Admin;
use App\Models\Training;
use Illuminate\Support\Facades\DB;

function testHelper() {
    die('Helper is ready');
}

function last_query($result = '') {
    DB::enableQueryLog();

    // and then you can get query log

    dd(DB::getQueryLog());
}

function hitung_umur($tanggal_lahir){
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) { 
	    exit("0 tahun 0 bulan 0 hari");
	}
	$y = $today->diff($birthDate)->y;
	// $m = $today->diff($birthDate)->m;
	// $d = $today->diff($birthDate)->d;
	// return $y." tahun ".$m." bulan ".$d." hari";
    return $y;
}

function getNotif() {
    $data = DB::table('participants')
            ->select('participants.*','sub_districts.name as sub_district_name', 'villages.name as village_name')
            ->leftJoin('sub_districts', 'participants.sub_district', '=', 'sub_districts.id')
            ->leftJoin('villages', 'participants.village', '=', 'villages.id')
            ->where('participant', 'N')
            ->get();
    return $data;
}

function rupiah($angka) {
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    echo $hasil_rupiah;
}

if (!function_exists('getMonthName')) {
    function getMonthName($bln) {
        switch ($bln) {
            case '1':
                $bulan = 'Januari';
                break;
            case '2':
                $bulan = 'Februari';
                break;
            case '3':
                $bulan = 'Maret';
                break;
            case '4':
                $bulan = 'April';
                break;
            case '5':
                $bulan = 'Mei';
                break;
            case '6':
                $bulan = 'Juni';
                break;
            case '7':
                $bulan = 'Juli';
                break;
            case '8':
                $bulan = 'Agustus';
                break;
            case '9':
                $bulan = 'September';
                break;
            case '10':
                $bulan = 'Oktober';
                break;
            case '11':
                $bulan = 'November';
                break;
            case '12':
                $bulan = 'Desember';
                break;
            default:
                break;
        }
        return $bulan;
    }
}

// Mendapatkan file script
function getContentScript($isAdmin, $filename) {
    if($isAdmin === true) {
        $filename_script = base_path() . '/public/js/admin-page/' . $filename . '.js';
        if (file_exists($filename_script)) {
            $filename_script = 'js/admin-page/'. $filename;
        } else {
            $filename_script = 'js/admin-page/default_script';
        }
    } else {
        $filename_script = base_path() . '/public/js/user-page/' . $filename . '.js';
        if (file_exists($filename_script)) {
            $filename_script = 'js/user-page/'. $filename;
        } else {
            $filename_script = 'js/admin-page/default_script';
        }
    }
    
    return $filename_script;
}

function getLasNumberAdmin() {
        
    $lastCode = Admin::max('number');

    if($lastCode) {
        $lastCode = substr($lastCode, -4);
        $code_ = sprintf('%04d', $lastCode+1);
        $numberFix = "ADM".date('Ymd').$code_;
    } else {
        $numberFix = "ADM".date('Ymd')."0001";
    }

    return $code;
}

function getLasIdTraining() {
        
    $lastId = Training::max('id');

    if($lastId) {
        $lastId = $lastId;
        $code_ = sprintf('%03d', $lastId+1);
        $code = $code_;
    } else {
        $code = 001;
    }

    return $code;
}

?>