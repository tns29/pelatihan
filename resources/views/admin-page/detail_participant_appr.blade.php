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
            <div class="col-lg-7">
                <table class="table">
                    <tr>
                        <th>Nomor Peserta</th>
                        <td> : &nbsp; {{ $resultData->participants->number }} </td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td> : &nbsp; {{ $resultData->participants->fullname }} </td>
                    </tr>
                    <tr>
                        <th>Nama Pelatihan</th>
                        <td> : &nbsp; {{ $resultData->service->title }} </td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td> : &nbsp; {{ $resultData->service->category->name }} </td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td> : &nbsp; {{ $resultData->service->description }} lorem </td>
                    </tr>
                    <tr>
                        <th>Gelombang</th>
                        <td> : &nbsp; {{ $resultData->service->periods->name }} </td>
                    </tr>
                    <tr>
                        <th>Tanggal Daftar</th>
                        <td> : &nbsp; {{ date('d-m-Y', strtotime($resultData->date)) }} </td>
                    </tr>
                </table>
            </div>

            <div class="col-lg-5">
                <table class="table table-bordered table-sm">
                    <tr>
                        @if(!$resultData->participants->image)
                            <img src="{{ asset('img/userDefault.png') }}" class="shadow mb-2" style="width : 100%;" alt="User Image">
                        @else
                            <img src="{{ asset('/storage').'/'.$resultData->participants->image }}" class="shadow mb-2" style="width : 100%;" alt="User Image">
                        @endif
                    </tr>
                    <form action="/passed-participant/{{ $resultData->participants->number }}" method="POST">
                        @csrf
                        @method('PUT')
                        <tr>
                            <th>Update Status Kelulusan</th>
                            <td>
                                <input type="hidden" name="training_id" id="training_id" value="{{ $resultData->training_id }}">
                                <select name="passed" id="passed" class="form-control form-select">
                                    <option value="">Pilih status</option>
                                    <option value="Y" {{ $resultData->passed == 'Y' ? 'selected':'' }}>Lulus</option>
                                    <option value="N" {{ $resultData->passed == 'N' ? 'selected':'' }}>Tidak Lulus</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><button class="btn btn-outline-info py-1 float-right w-full">Simpan dan keluar &nbsp; <i class="fas fa-share-square"></i> </button></td>
                        </tr>
                        
                    </form>

                </table>
            </div>

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