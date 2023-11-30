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
            font-family: Arial, Helvetica, sans-serif
            font-size: 14px;
        }

        .table {
            border-collapse: collapse;
        }
    </style>
</head>

<body>

    <h1> {{ $title }} </h1>
    <table class="table">
        <tr>
            <th style="text-align: left;">Nomor</th>
            <th style="text-align: left;">Nama Lengkap</th>
            <th style="text-align: left;">Jenis Kelamin</th>
            <th style="text-align: left;">No. Telp</th>
            <th style="text-align: left;">No. WA</th>
            <th style="text-align: left;">Alamat Lengkap</th>
            <th style="text-align: left;">Email</th>
            <th style="text-align: left;">Agama</th>
            <th style="text-align: left;">Pendidikan Terakhir</th>
            <th style="text-align: left;">Tahun Lulus</th>
        </tr>
        @foreach ($data as $item)
            <tr>
                <td>{{$item->number}}</td>
                <td>{{$item->fullname}}</td>
                <td>{{$item->gender == 'M' ? 'Laki-laki' : 'Perempuan'}}</td>
                <td>{{$item->no_telp}}</td>
                <td>{{$item->no_wa}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->religion}}</td>
                <td>{{$item->last_education}}</td>
                <td>{{$item->graduation_year}}</td>
            </tr>
        @endforeach
    </table>
        
</body>
</html>