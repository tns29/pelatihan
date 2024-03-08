<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <style>
        * {
            box-sizing: border-box;
        }
        @font-face {
            font-family: Nutino;
            src: url(../font/Nunito/Nunito-VariableFont_wght.ttf);
        }
        h1 {
            font-family: "Nutino";
            padding: 0;
            margin: 0;
        }
        table, td, th {
            border: 1px solid black;
            padding: 0 5px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11.7px;
        }

        .table {
            border-collapse: collapse;
        }

        h1 {
            padding: 0;
        }
        .wrapper {
            padding: 0 10px;
        }

        .icon-export {
            float: right; 
            padding: 0px;
        }

        .row-export::after {
            content: "";
            clear: both;
            display: table;
        }

    </style>
</head>

<body>

    <div class="wrapper">
        <h1> {{ $title }} </h1>
        <div class="row-export">
            <div class="icon-export">
                <a href="/export_participant">
                    <img src="{{ asset('img/excel.png') }}" alt="excel" style="height: 40px;">
                    <label for="print" style="display : block; font-size: 12px; margin-left: 4px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">export</label>
                    <br>
                </a>
            </div> 
        </div>
        <div style=" background: black; width:100% height:100px;">
            <div style="float: right; right:0;font-family: 'Nutino';">
                <small><b>Total Peserta Pelatihan : {{$count}}</b></small>
            </div>
        </div>
        
        <div style="display: flex; width: 100%;">
            <table class="table" style="width: 100%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                <tr>
                    <th style="text-align: left;">Nomor</th>
                    <th style="text-align: left;">Nik</th>
                    <th style="text-align: left;">Nama Lengkap</th>
                    <th style="text-align: left; max-width: 65px;">Jenis Kelamin</th>
                    <th style="text-align: left;">Tempat Tanggal Lahir</th>
                    <th style="text-align: left;">No. WA</th>
                    <th style="text-align: left;">Kecamatan</th>
                    <th style="text-align: left;">Desa / Kelurahan</th>
                    <th style="text-align: left;">Judul Pelatihan</th>
                    {{-- <th style="text-align: left;">Alamat Lengkap</th> --}}
                    <th style="text-align: left;">Email</th>
                    <th style="text-align: left;">Agama</th>
                    <th style="text-align: left; width: 52px;">Pendidikan Terakhir</th>
                    <th style="text-align: left; width: 42px;">Tahun Lulus</th>
                    <th style="text-align: left;">Tanggal</th>
                    <th style="text-align: left;">Gelombang</th>
                    <th style="text-align: left;">Tahun</th>
                    <th style="text-align: center;">Status</th>
                </tr>
                @foreach ($data as $item)
                {{-- {{ dd($item) }} --}}
                    <tr>
                        <td>{{$item->number}}</td>
                        <td>{{$item->nik}}</td>
                        <td>{{$item->fullname}}</td>
                        <td>{{$item->gender == 'M' ? 'Laki-laki' : 'Perempuan'}}</td>
                        <td>{{$item->place_of_birth . ' - ' . date('d/m/Y', strtotime($item->date_of_birth))}}</td>
                        <td>{{$item->no_wa}}</td>
                        <td>{{$item->sub_district_name}}</td>
                        <td>{{$item->village_name}}</td>
                        <td>{{$item->training_name}}</td>
                        {{-- <td>{{$item->address}}</td> --}}
                        <td>{{$item->email}}</td>
                        <td>{{$item->religion}}</td>
                        <td>{{$item->last_education}}</td>
                        <td>{{$item->graduation_year}}</td>
                        <td>{{ date('d/m/Y', strtotime($item->date)) }}</td>
                        <td>{{$item->gelombang}}</td>
                        <td>{{$item->year}}</td>
                        <td style="text-align: center">
                            @switch($item->passed)
                                @case("Y")
                                        <span style="color: rgb(0, 189, 0)"><b>Telah Lulus</b></span>
                                    @break
                                @case("N")
                                        <span style="color: red"><b>X </b> Tidak Lulus</span>
                                    @break
                                @default
                                    {{$item->approve == 'Y' ? '' : ''}}
                                    @if ($item->approve == 'Y')
                                        <span style="color: rgb(0, 189, 0)"><b>Pendaftar</b></span>
                                    @elseif($item->approve == 'N')
                                        <span style="color: red"><b>X </b> Ditolak</span>
                                    @else
                                        Menunggu Persetujuan
                                    @endif
                            @endswitch
                            
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
  
    </div>
</body>
</html>