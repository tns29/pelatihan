<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <style>
        @font-face {
            font-family: Nutino;
            src: url(../font/Nunito/Nunito-VariableFont_wght.ttf);
        }
        h1 {
            font-family: "Nutino";
        }
        table, td, th {
            border: 1px solid black;
            padding: 0 5px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13.5px;
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

    </style>
</head>

<body>

    <div class="wrapper">
        <div style="float: right;">
            <a href="/export_participant">
                <img src="{{ asset('img/excel.png') }}" alt="excel" style="height: 40px;">
                <label for="print" style="display : block; font-size: 12px; margin-left: 4px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">export</label>
                <br>
            </a>
        </div>
        <h1> {{ $title }} </h1>
        <div style="display: flex; width: 100%;">
            <table class="table" style="width: 100%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                <tr>
                    <th style="text-align: left;">Nomor</th>
                    <th style="text-align: left;">Nik</th>
                    <th style="text-align: left;">Nama Lengkap</th>
                    <th style="text-align: left;">Jenis Kelamin</th>
                    {{-- <th style="text-align: left;">No. Telp</th> --}}
                    <th style="text-align: left;">No. WA</th>
                    <th style="text-align: left;">Kecamatan</th>
                    <th style="text-align: left;">Desa / Kelurahan</th>
                    <th style="text-align: left;">Alamat Lengkap</th>
                    <th style="text-align: left;">Email</th>
                    <th style="text-align: left;">Agama</th>
                    <th style="text-align: left;">Pendidikan Terakhir</th>
                    <th style="text-align: left;">Tahun Lulus</th>
                    <th style="text-align: left;">Tanggal</th>
                    <th style="text-align: left;">Gelombang</th>
                    <th style="text-align: center;">Status</th>
                </tr>
                @foreach ($data as $item)
                {{-- {{ dd($item) }} --}}
                    <tr>
                        <td>{{$item->number}}</td>
                        <td>{{$item->nik}}</td>
                        <td>{{$item->fullname}}</td>
                        <td>{{$item->gender == 'M' ? 'Laki-laki' : 'Perempuan'}}</td>
                        {{-- <td>{{$item->no_telp}}</td> --}}
                        <td>{{$item->no_wa}}</td>
                        <td>{{$item->sub_district_name}}</td>
                        <td>{{$item->village_name}}</td>
                        <td>{{$item->address}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->religion}}</td>
                        <td>{{$item->last_education}}</td>
                        <td>{{$item->graduation_year}}</td>
                        <td>{{ date('d/m/Y', strtotime($item->date)) }}</td>
                        <td>{{$item->gelombang}}</td>
                        <td style="text-align: center">
                            {{$item->approve == 'Y' ? '' : ''}}
                            @if ($item->approve == 'Y')
                                <span style="color: rgb(0, 189, 0)"><b>Sedang Berlangsung</b></span>
                            @elseif($item->approve == 'N')
                                <span style="color: red"><b>X </b> Ditolak</span>
                            @else
                                Menunggu Persetujuan
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
  
    </div>
</body>
</html>