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

<?php
$candidatePage = $candidate == "Y" ? "Y"  : '';
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row mx-2">
          <div class="row justify-content-end mb-2 w-100">
            <form id="submitForm" action="/registrant-data" method="GET" class="w-100">
                @csrf

                <div class="row justify-content-evenly">
                  <div class="col-lg-7">
                    <input type="text" name="fullname" id="fullname" class="form-control ml-2" placeholder="Cari Nama" value="{{ $search_name }}">
                  </div>
                  <div class="col-lg-1">
                    <button type="button" id="search" class="btn px-2 btn-outline-warning"><i class="fas fa-search"></i></button>
                    <button type="button" id="reset" class="btn px-2 btn-outline-danger"><i class="fas fa-eraser"></i></button>
                  </div>
                  <div class="col-lg-4">
                  </div>
                </div>

              </form>

            </div>
            {{-- <a href="/add-data-admin" class="btn float-right btn-add "><i class="fas fa-plus-square"></i> &nbsp; Data</a> --}}
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
                      <th style="width: 12.5%">Nomor</th>
                      <th>Nama Lengkap</th>
                      <th style="width: 11%">Jenis Kelamin</th>
                      <th>Email</th>
                      @if ($candidatePage == 'Y')
                        <th style="width: 10%; text-align: left;">No. WA</th>
                      @else
                        <th style="width: 10%; text-align: left;">Pendidikan</th>
                        {{-- <th style="width: 8%; text-align: center;">Status</th> --}}
                      @endif
                      <th style="width: 15%; text-align: left;">Kecamatan</th>
                      <th style="width: 7%; text-align: center;">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($dataParticipants as $row)
                  <tr>
                      <td>{{ $row->number }}</td>
                      <td>{{ $row->fullname }}</td>
                      <td>{{ $row->gender == 'M' ? 'Laki-laki' : 'Perempuan' }}</td>
                      <td>{{ $row->email }}</td>
                      @if ($candidatePage == 'Y')
                        <td>{{ $row->no_wa }}</td>
                      @else
                        <td>{{ isset($row->last_education) ? $row->last_education : '---' }}</td>
                      @endif
                      <td>{{ isset($row->sub_districts->name) ? $row->sub_districts->name : ''}}</td>
                      <td style=" text-align: center;">
                        @if ($candidatePage == 'Y')
                          <a href="/detail-participant/{{ $row->number }}/{{$candidatePage}}" class="text-info">Detail <i class="fas fa-info-circle"></i></a>
                        @else
                          <a href="/detail-participant/{{ $row->number }}/{{$candidatePage}}" class="text-info"> <i class="fas fa-info-circle"></i></a>
                          &nbsp;
                          <a href="#" onclick="delete_data(`{{ $row->number }}`, `{{ $row->fullname }}`)" class="text-danger"> <i class="fas fa-trash"></i></a>
                        @endif
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
