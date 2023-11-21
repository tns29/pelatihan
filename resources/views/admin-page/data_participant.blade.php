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
          <div class="row justify-content-end mb-2 w-100">
            {{-- <a href="/add-data-admin" class="btn float-right btn-add "><i class="fas fa-plus-square"></i> &nbsp; Data</a> --}}
          </div>
          <table class="table table-bordered table-sm">
              <thead>
                  <tr class="my-bg-primary text-white">
                      <th style="width: 11%">Nomor</th>
                      <th>Nama</th>
                      <th style="width: 11%">Jenis Kelamin</th>
                      <th>Email</th>
                      {{-- <th style="width: 10%">Tingkat</th> --}}
                      <th style="width: 10%; text-align: center;">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($dataParticipants as $row)
                  <tr>
                      <td onclick="getDetailUser(`{{$row->number}}`)" style="cursor: pointer" class="text-info">{{ $row->number }}</td>
                      <td>{{ $row->fullname }}</td>
                      <td>{{ $row->gender == 'M' ? 'Laki-laki' : 'Perempuan' }}</td>
                      <td>{{ $row->email }}</td>
                      {{-- <td>{{ $row->admin_level->name }}</td> --}}
                      <td style=" text-align: center;">
                        <a href="/edit-data-admin" class="text-warning"><i class="fas fa-edit"></i></a>
                        &nbsp;
                        <a href="/edit-data-admin" class="text-danger"><i class="fas fa-trash-alt"></i></a>
                      </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>
    </div>
</section> 

<div class="modal fade" id="modal-detail" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ml-3 font-weight-bold">Detail Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-3">
        <div class="row">
          <div class="col-lg-3 px-1" style="max-width: 28%;">
            <img src="" class="imgProfile" alt="imgProfile" style="height: 210px;">
            <div id="since" class="text-center text-sm w-100"></div>
          </div>
          <div class="col-lg-8">
            <table class="table table-striped" id="tb-detail"></table>
          </div> 
        </div>
      </div> 
    </div>
  </div>
</div>

@endsection