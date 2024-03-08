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

class RegistrantExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
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
            'Alamat Lengkap',
            'Email',
            'Agama',
            'Pendidikan Terakhir',
            'Tahun Lulus',
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
            'L' => [
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
        $gender = $this->session->get('gender') ? $this->session->get('gender')[0] : false;
        $sub_district = $this->session->get('sub_district') ? $this->session->get('sub_district')[0] : false;
        $village = $this->session->get('village') ? $this->session->get('village')[0] : false;
        $year = $this->session->get('year') ? $this->session->get('year')[0] : '';

        $where = ['participants.is_active' => 'Y'];
        
        if($fullname) {
            $where = ['participants.number' => $fullname];
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

        $data = DB::table('participants')
        ->select('participants.number',
        DB::raw("CONCAT(\"'\", participants.nik) AS nik"),
        'participants.fullname',
        DB::raw('(CASE WHEN participants.gender = "M" THEN "Laki-laki" ELSE "Perempuan" END) AS gender'),
        DB::raw("CONCAT(participants.place_of_birth, \" - \", DATE_FORMAT(participants.date_of_birth, '%d/%m/%Y')) AS ttl"),
        DB::raw("CONCAT(\"'\", participants.no_wa) AS no_wa"),
        'sub_districts.name as sub_district_name', 'villages.name as village_name',
        'participants.address', 'participants.email', 'participants.religion', 'participants.last_education', 'participants.graduation_year', 
        DB::raw('(CASE WHEN participants.participant = "Y" THEN "✅" ELSE "❌" END) AS participant')
        )
        ->leftJoin('sub_districts', 'participants.sub_district', '=', 'sub_districts.id')
        ->leftJoin('villages', 'participants.village', '=', 'villages.id')
        ->where($where)
        ->where('participants.created_at', 'LIKE', '%' . $year . '%')
        ->get();

        return $data;
    }
}