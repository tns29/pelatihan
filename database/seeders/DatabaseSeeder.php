<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Setting;
use App\Models\Village;
use App\Models\AdminLevel;
use App\Models\SubDistrict;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        AdminLevel::create([
            'id' => '1',
            'name' => 'Administrator',
        ]);
        
        AdminLevel::create([
            'id' => '2',
            'name' => 'Staff',
        ]);

        Admin::create([
            'number' => 'ADM202311050001',
            'fullname' => 'Admin Utama',
            'username' => 'admin_123',
            'gender' => 'M',
            'no_telp' => '08986564321',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('111111'),
            'level_id' => 1,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 'admin_123',
        ]);

        Setting::create([
            'id'=> 1,
            'name' => 'Tanggal Pendaftaran'
        ]);
        
        Setting::create([
            'id'=> 2,
            'name' => 'Tanggal Pelatihan'
        ]);

        $sub_districs = [
            'Balaraja', 'Cikupa', 'Cisauk', 'Curug', 'Gunung Kaler', 'Jambe', 'Jayanti', 'Kelapa Dua', 'Kemiri', 'Kosambi', 'Kresek', 'Kronjo', 'Legok', 'Mauk', 'Mekar Baru', 'Pengadegan', 'Pakuhaji', 'Panongan', 'Pasar Kamis', 'Rajeg', 'Sepatan', 'Sepatan Timur', 'Sindang Jaya', 'Solear', 'Sukadiri', 'Sukamulya', 'Teluknaga', 'Tigaraksa'
        ];
        foreach ($sub_districs as $val) {
            SubDistrict::create(['name' => $val]);
        }
        
        $villages = [
            1 => [
                'Cangkudu','Gembong','Saga','Sentul','Sentul','Jaya','Sukamurni','Talagasari','Tobat','Balaraja'
            ],
            2 => [
                'Bitung Jaya','Bojong','Budi Mulya','Cibadak','Cikupa','Dukuh','Pasir Gadung','Pasir Jaya','Sukadamai','Sukanagara','Talaga','Talagasari','Bunder','Sukamulya'
            ],
            3 => [
                'Cibogo', 'Dangdang', 'Mekar Wangi', 'Sampora', 'Suradita', 'Cisauk'
            ],
            3 => [
                'Cibogo', 'Dangdang', 'Mekar Wangi', 'Sampora', 'Suradita', 'Cisauk'
            ],
            4 => [
                'Bojong Loa','Carenang','Caringin','Cempaka','Cibugel','Cisoka','Jeungjing','Karangharja','Selapajang','Sukatani'
            ],
            5 => [
                'Cukanggalih','Curug Wetan','Kadu','Kadu Jaya','Binong','Curug Kulon','Sukabakti'
            ],
            6 => [
                'Cibetok','Cipaeh','Gunung Kaler','Kandawati','Kedung','Onyam','Rancagede','Sidoko','Tamiang'
            ],
            7 => [
                'Ancol Pasir','Daru','Jambe','Kutruk','Mekarsari','Pasir Barat','Ranca Buaya','Sukamanah','Taban','Tipar Raya'
            ],
            8 => [
                'Cikande','Dangdeur','Jayanti','Pabuaran','Pangkat','Pasir Gintung','Pasir Muncang','Sumurbandung'
            ],
            9 => [
                'Curug Sangereng','Bencongan','Bencongan Indah','Bojong Nangka','Kelapa Dua','Pakulonan Barat'
            ],
            10 => [
                'Karang Anyar','Kemiri','Klebet','Legok Suka Maju','Lontar','Patramanggala','Ranca Labuh'
            ],
            11 => [
                'Belimbing','Cengklong','Jati Mulya','Kosambi Timur','Rawa Burung','Rawa Rengas','Salembaran Jati','Dadap','Kosambi Barat','Salembaran Jaya'
            ],
            12 => [
                'Jengkol','Kemuning','Koper','Kresek','Pasir Ampo','Patrasana','Rancailat','Renged','Talok'
            ],
            13 => [
                'Bakung','Blukbuk','Cirumpak','Kronjo','Muncung','Pagedangan Ilir','Pagedangan Udik','Pagenjahan','Pasilian','Pasir'
            ],
            14 => [
                'Babat','Bojongkamal','Caringin','Ciangir','Cirarab','Kemuning','Legok','Palasari','Rancagong','Serdang Wetan','Babakan'
            ],
            15 => [
                'Banyu Asih','Gunung Sari','Jatiwaringin','Kedung Dalem','Ketapang','Marga Mulya','Mauk Barat','Sasak','Tanjung Anom','Tegal Kunir Kidul','Tegal Kunir Lor','Mauk Timur'
            ],
            16 => [
                'Cijeruk','Gandaria','Jenggot','Kedaung','Klutuk','Kosambi Dalam','Mekarbaru','Waliwis'
            ],
            17 => [
                'Cicalengka','Cihuni','Cijantra','Jatake','Kadu Sirung','Karang Tengah','Lengkong Kulon','Malang Nengah','Pagedangan','Situ Gadung','Medang',
            ],
        ];
        $x = 0;
        foreach ($villages as $row) {
            $x++;
            // echo ' == ';
            // print_r($x++);
            // echo ' == ';
            // print_r($row);
            $i = 1;
            foreach ($row as $val) {
                // echo ' == ';
                // print_r($i++);
                // echo ' == ';
                // print_r($val);
                Village::create(['sub_district_id' => $x, 'name' => $val]);
            }
        }

    }
}
