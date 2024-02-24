@extends('admin-page.layouts.main_layout')

@section('content-pages')

<div class="content-header">
  <div class="container-fluid">
    <div class="row my-2">
      <div class="col-sm-6">
        <h3 class="m-0 ml-2">{{ $title }} </h3>
      </div><!-- /.col --> 
      <div class="col">
        <a href="/export_participant_already_work" style="float: right;" class="text-decoration-none text-success">
          Export Data <img src="{{ asset('img/excel.png') }}" alt="excel" style="height: 40px;">
          <br>
        </a>
      </div>
    </div><!-- /.row -->
    <hr style="margin-bottom: 0">
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row mx-1">
          <div class="row justify-content-end mb-2 w-100">
            <form id="submitForm" action="/participant-already-working" method="GET" class="w-100">
              @csrf
              <div class="row justify-content-evenly">
                <div class="col-lg-6">
                  <input type="text" name="fullname" id="fullname" class="form-control ml-2" placeholder="Cari Nama" value="{{ $search_name }}">
                </div>
                <div class="col-lg-1">
                  <button type="button" id="search" class="btn px-2 btn-outline-warning"><i class="fas fa-search"></i></button>
                  <button type="button" id="reset" class="btn px-2 btn-outline-danger"><i class="fas fa-eraser"></i></button>
                </div>
                <div class="col-lg-4">
                  <div class="d-flex w-75" style="float: left; left:0 !important;">
                    <span class="pr-3 pt-2">Kecamatan </span>
                    <select name="sub_district" id="sub_district" class="form-select form-control" style="display: inline">
                      <option value="">Semua</option>
                      @foreach ($sub_district_data as $item)
                        <option value="{{ $item->id }}" {{ $filter == $item->id  ? 'selected' : '' }}> »&nbsp; {{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-1">
                  <a href="/add-participant-work" class="btn float-right btn-add "><i class="fas fa-plus-square"></i> &nbsp; Data</a>
                </div>
              </div>

            </form>
            
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