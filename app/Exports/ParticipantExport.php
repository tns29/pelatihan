<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ParticipantExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public function __construct($request) {
        $this->session = $request->session();
    }

    public function headings(): array
    {
        return [
            'Nomor',
            'NIK',
            'Nama Lengkap',
            'Jenis Kelamin',
            'Tempat Tanggal Lahir',
            'No. Whatsapp',
            'Kecamatan',
            'Desa / Kelurahan',
            'Judul Pelatihan',
            'Email',
            'Agama',
            'Pendidikan Terakhir',
            'Tahun Lulus',
            'Tanggal Pendaftaran',
            'Gelombang',
            'Status',
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
            'N' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                    // 'wrapText' => true,
                ],
            ],
            'K' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                ],
            ]

            // // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],
        ];
    }

    public function collection()
    {
        $fullname = $this->session->get('fullname') ? $this->session->get('fullname')[0] : false;
        $category_id = $this->session->get('category_id') ? $this->session->get('category_id')[0] : false;
        $training_id = $this->session->get('training_id') ? $this->session->get('training_id')[0] : false;
        $gender = $this->session->get('gender') ? $this->session->get('gender')[0] : false;
        $sub_district = $this->session->get('sub_district') ? $this->session->get('sub_district')[0] : false;
        $village = $this->session->get('village') ? $this->session->get('village')[0] : false;
        $material_status = $this->session->get('material_status') ? $this->session->get('material_status')[0] : false;
        $religion = $this->session->get('religion') ? $this->session->get('religion')[0] : false;
        $period = $this->session->get('period') ? $this->session->get('period')[0] : false;
        $year = $this->session->get('year') ? $this->session->get('year')[0] : false;

        $where = ['participants.is_active' => 'Y'];
        
        if($fullname) {
            $where = ['participants.number' => $fullname];
        }
        if($category_id) {
            $where = ['trainings.category_id' => $category_id];
        }
        if($training_id) {
            $where = ['registrants.training_id' => $training_id];
        }
        if($gender) {
            $where = ['participants.gender' => $gender];
        }
        if($sub_district) {
            $where = ['participants.sub_district' => $sub_district];
        }
        if($village) {
            $where = ['participants.village' => $village];
        }
        
        if($material_status) {
            $where = ['participants.material_status' => $material_status];
        }
        if($religion) {
            $where = ['participants.religion' => $religion];
        }
        if($period) {
            $where = ['registrants.period_id' => $period];
        }
        if($year) {
            $where['registrants.year'] = $year;
        }

        $data = DB::table('registrants')
        ->select('participants.number',
        DB::raw("CONCAT(\"'\", participants.nik) AS nik"),
        'participants.fullname',
        DB::raw('(CASE WHEN participants.gender = "M" THEN "Laki-laki" ELSE "Perempuan" END) AS gender'),
        DB::raw("CONCAT(participants.place_of_birth, \" - \", DATE_FORMAT(participants.date_of_birth, '%d/%m/%Y')) AS ttl"),
        DB::raw("CONCAT(\"'\", participants.no_wa) AS no_wa"),
        'sub_districts.name as sub_district_name', 'villages.name as village_name',
        'trainings.title', 'participants.email', 'participants.religion', 'participants.last_education', 'participants.graduation_year', 
        'registrants.date',  'periods.name as gelombang',
        DB::raw('(CASE WHEN registrants.approve = "Y" THEN "Peliatihan Sedang Berlangsung" ELSE "Menunggu Persetujuan" END) AS approve') )
        ->leftJoin('trainings', 'trainings.id', '=', 'registrants.training_id')
        ->leftJoin('periods', 'periods.id', '=', 'registrants.period_id')
        ->leftJoin('participants', 'participants.number', '=', 'registrants.participant_number')
        ->leftJoin('sub_districts', 'participants.sub_district', '=', 'sub_districts.id')
        ->leftJoin('villages', 'participants.village', '=', 'villages.id')
        ->where($where)
        ->get();
        
        return $data;
    }
}