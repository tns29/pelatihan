<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ParticipantAlreadyWorkExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    
    use Exportable;
    
    public function __construct($request) {
        $this->session = $request->session();
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama Lengkap',
            'Judul Pelatihan',
            'No. WA',
            'Kecamatan',
            'Nama Perusahaan',
            'Jabatan',
            'Periode',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => [
                'font' => [
                    'bold' => true, 
                    'size' => 12,
                ],
            ],

            // // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],
        ];
    }

    public function collection()
    {
        $fullname = $this->session->get('fullname') ? $this->session->get('fullname')[0] : false;
        $sub_district = $this->session->get('sub_district') ? $this->session->get('sub_district')[0] : false;
        
        if($sub_district) {
            $where['p.sub_district'] = $sub_district;
            $data = DB::table('participant_works as pw')
                        ->select('p.nik', 'p.fullname',
                        DB::raw('(SELECT t.title FROM registrants as r left join trainings as t on t.id = r.training_id left join participants p1 on p1.number = r. participant_number order by r.id desc limit 1) as training_name'),
                        'p.no_wa', 'sd.name as sub_districts_name', 'pw.company_name', 'pw.position', 'pw.date_year'
                        )
                        ->leftJoin('participants as p', 'p.number', '=', 'pw.participant_number')
                        ->leftJoin('sub_districts as sd', 'sd.id', '=', 'p.sub_district')
                        ->where($where)
                        ->where('p.fullname', 'like', '%' . $fullname . '%')
                        ->get();
        } else {
            $data = DB::table('participant_works as pw')
                        ->select('p.nik', 'p.fullname',
                        DB::raw('(SELECT t.title FROM registrants as r left join trainings as t on t.id = r.training_id left join participants p1 on p1.number = r. participant_number order by r.id desc limit 1) as training_name'),
                        'p.no_wa', 'sd.name as sub_districts_name', 'pw.company_name', 'pw.position', 'pw.date_year'
                        )
                        ->leftJoin('participants as p', 'p.number', '=', 'pw.participant_number')
                        ->leftJoin('sub_districts as sd', 'sd.id', '=', 'p.sub_district')
                        ->where('p.fullname', 'like', '%' . $fullname . '%')
                        ->get();
        }
        // die($data);
        return $data;
    }
}

?>