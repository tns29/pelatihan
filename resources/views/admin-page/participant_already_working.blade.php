@extends('admin-page.layouts.main_layout')

@section('content-pages')

<div class="content-header">
  <div class="container-fluid">
    <div class="row my-2">
      <div class="col-sm-6">
        <h3 class="m-0 ml-2">{{ $title }} </h3>
      </div><!-- /.col --> 
    </div><!-- /.row -->
    <hr style="margin-bottom: 0">
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row mx-1">
          <div class="row justify-content-end mb-2 w-100">
            <a href="/add-participant-work" class="btn float-right btn-add "><i class="fas fa-plus-square"></i> &nbsp; Data</a>
            @if (session()->has('success'))
              <div class="alert alert-success py-1" id="success">
                <?= session()->get('success') ?>
              </div>
            @endif
            @if (session()->has('message'))
              <div class="alert alert-warning py-1" id="message">
                <?= session()->get('message') ?>
              </div>
            @endif
          </div>
          <table class="table table-bordered table-sm">
              <thead>
                  <tr class="my-bg-primary text-white">
                      <th style="width: 11%">Nik</th>
                      <th>Nama Lengkap</th>
                      <th style="width: 16%; text-align: left;">Pelatihan</th>
                      <th style="width: 9%; text-align: left;">No. WA</th>
                      <th style="width: 9%; text-align: left;">Kecamatan</th>
                      <th style="width: 17%; text-align: left;">Nama Perusahaan</th>
                      <th style="width: 8%; text-align: left;">Jabatan</th>
                      <th style="width: 8%; text-align: left;">Periode</th>
                      <th style="width: 6%; text-align: center;">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($resultData as $row)
                  <tr>
                      <td>{{ $row->nik }}</td>
                      <td>{{ $row->fullname }}</td>
                      <td>{{ $row->training_name }}</td>
                      <td>{{ $row->no_wa }}</td>
                      <td>{{ isset($row->sub_districts_name) ? $row->sub_districts_name : ''}}</td>
                      <td>{{ $row->company_name }}</td>
                      <td>{{ $row->position }}</td>
                      <td>{{ $row->date_year }}</td>
                      <td style=" text-align: center;">
                        <a href="/edit-participant-work/{{ $row->participant_number }}" class="text-warning"> <i class="fas fa-edit"></i></a>
                        &nbsp;
                        <a href="#" onclick="delete_data(`{{ $row->participant_number }}`, `{{ $row->fullname }}`)" class="text-danger"> <i class="fas fa-trash"></i></a>
                      </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>
    </div>
</section> 

<div class="modal fade" id="modal-delete" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title ml-2 font-weight-bold">Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-body p-3">
          <div class="row" id="content-delete">
            
          </div>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection