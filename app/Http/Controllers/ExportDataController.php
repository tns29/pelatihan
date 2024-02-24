<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RegistrantExport;
use App\Exports\ParticipantExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParticipantAlreadyWorkExport;

class ExportDataController extends Controller 
{
    public function registrant(Request $request) 
    {
        return Excel::download(new RegistrantExport($request), 'pendaftar_report'.date('_Ymd_His').'.xlsx');
    }

    public function participant(Request $request) 
    {
        return Excel::download(new ParticipantExport($request), 'participant_report'.date('_Ymd_His').'.xlsx');
    }
    
    public function participantAlreadyWorkExcel(Request $request) 
    {
        return Excel::download(new ParticipantAlreadyWorkExport($request), 'participant_already_working_report'.date('_Ymd_His').'.xlsx');
    }
}
