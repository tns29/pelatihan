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
            
            <form id="submitForm" action="/participant-passed" method="GET" class="w-100">
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
                  <div class="d-flex w-100" style="float: right; right:0 !important;">
                    <span class="pr-3 pt-2"> &nbsp; Status</span>
                    <select name="passed" id="passed" class="form-select form-control" style="width:70%; position:absolute; float: right; right: 0.5% !important;" >
                      <option value="ALL" {{ $passed == 'ALL' ? 'selected' : '' }}> Semua</option>
                      @if ($passed)
                        <option value="X" {{ $passed == 'X' ? 'selected' : '' }}> Belum Diproses</option>
                        <option value="Y" {{ $passed == 'Y' ? 'selected' : '' }}> Lulus</option>
                        <option value="N" {{ $passed == 'N' ? 'selected' : '' }}> Tidak Lulus</option>
                        <option value="C" {{ $passed == 'C' ? 'selected' : '' }}> Cadangan</option>
                      @else
                        <option value="X" selected> Belum Diproses</option>
                        <option value="Y"> Lulus</option>
                        <option value="N"> Tidak Lulus</option>
                        <option value="C"> Cadangan</option>
                      @endif
                    </select>
                  </div>
                </div>
              </div>

            </form>
          </div>
          <div class="row justify-content-start mb-2 w-100" id="update-status-passed">
            <input type="hidden" name="selectedId" id="selectedId">
            <div class="col-lg-4">
              <button type="button" onclick="passedUpdate('Y')" class="mr-1 btn btn-sm btn-outline-primary">Lulus</button>
              <button type="button" onclick="passedUpdate('N')" class="mr-1 btn btn-sm btn-outline-danger">Tidak Lulus</button>
              <button type="button" onclick="passedUpdate('C')" class="mr-1 btn btn-sm btn-outline-warning">Cadangan</button>
            </div>
          </div>
          <table class="table table-bordered table-sm">
              <thead>
                  <tr class="my-bg-primary text-white">
                      <th style="width: 4%">Pilih</th>
                      <th style="width: 11%">Nomor</th>
                      <th>Nama</th>
                      <th style="width: 11%">Jenis Kelamin</th>
                      <th>Pelatihan</th>
                      <th style="width: 11%;">Tanggal Daftar</th>
                      <th>Periode </th>
                      <th style="text-align: center; width: 10%;">Status</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($participant as $row)
                  <tr>
                      <td>
                        <input class="text-center" type="checkbox" value="{{ $row->id }}" id="items" onclick="selectItem(`{{ $row->id }}`, `{{ $row->participant_number }}`)" style="height: 20px; width: 20px;">
                      </td>
                      <td>{{ $row->participant_number }}</td>
                      <td>{{ $row->fullname }}</td>
                      <td>{{ $row->gender == 'M' ? 'Laki-laki' : 'Perempuan' }}</td>
                      <td>{{ $row->trainingsTitle }}</td>
                      <td>{{ date('d M Y', strtotime($row->date)) }}</td>
                      <td>{{ $row->gelombang }}</td>
                      <td style=" text-align: center;">
                        @if ($row->is_active == "Y")
                          @if ($row->passed == 'Y')
                            <span class="text-success"><i class="fas fa-check-square text-success"> </i> Lulus</span>
                          @elseif($row->passed == "N")
                            <span class="text-red"><i class="fas fa-window-close text-danger"> </i> Tidak Lulus</span>
                          @elseif($row->passed == "C")
                            <span class="text-warning"><i class="fas fa-exclamation-triangle text-warning"></i> Cadangan</span>
                          @else
                            <span class="text-secondary"><i class="far fa-question-circle text-secondary"> </i> Menunggu</span>
                          @endif
                        @else
                          TELAH SELESAI
                        @endif
                      </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>
    </div>
</section> 

<div class="modal fade" id="modal-edit" tabindex="-1">
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
        <div class="modal-body p-3">
          <div class="row" id="content-edit">
            
          </div>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-success">Ya</button>
        </div>
      </form>
    </div>
  </div>
</div>

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