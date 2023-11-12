<?php

use App\Models\Admin;

function testHelper() {
    die('Helper is ready');
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
                # code...
                break;
        }
        return $bulan;
    }
}

// Mendapatkan file script
function getContentScript($isAdmin, $filename) {
    if($isAdmin === true) {
        $filename_script = base_path() . '/public/js/admin-page/' . $filename . '.js';
    }

    if (file_exists($filename_script)) {
        $filename_script = 'js/admin-page/'. $filename;
    } else {
        $filename_script = 'js/admin-page/default_script';
    }
    return $filename_script;
}

function getLasCodeAdmin() {
        
    $lastCode = Admin::max('code');

    if($lastCode) {
        $lastCode = substr($lastCode, -4);
        $code_ = sprintf('%04d', $lastCode+1);
        $code = "ADM".date('Ymd').$code_;
    } else {
        $code = "ADM".date('Ymd')."0001";
    }

    return $code;
}

?>