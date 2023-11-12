@extends('admin-page.layouts.main_layout')

@section('content-pages')

<div class="content-header">
  <div class="container-fluid">
    <div class="row my-2">
      <div class="col-sm-6">
        <h3 class="m-0 ml-2">{{ $title}}</h3>
      </div><!-- /.col --> 
    </div><!-- /.row -->
    <hr style="margin-bottom: 0">
  </div><!-- /.container-fluid -->
</div>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row mx-2"> 
            <table class="table table-bordered">
                <thead>
                    <tr class="my-bg-primary text-white">
                        <th>Nomor</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                        <th style="width: 10%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nomor</td>
                        <td>Nama</td>
                        <td>Jenis Kelamin</td>
                        <td>Email</td>
                        <td style=" text-align: center;">Edit Delete</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section> 


@endsection