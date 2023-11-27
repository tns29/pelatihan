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
<?php 
$date_of_birth = $detailParticipant->date_of_birth ? date('d, M Y', strtotime($detailParticipant->date_of_birth)) : '-- / -- / ----';
?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row mx-2">
          
            <div class="col-lg-7">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th>Nomor Peserta</th>
                        <td>{{ $detailParticipant->number }} </td>
                    </tr>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $detailParticipant->fullname }} </td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $detailParticipant->gender == 'M' ? 'Laki-laki' : 'Perempuan' }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">No. Telp</th>
                        <td> {{ $detailParticipant->no_telp }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">No. Whatsapp</th>
                        <td> {{ $detailParticipant->no_telp }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Tempat Tanggal Lahir</th>
                        <td> {{ $detailParticipant->place_of_birth.', '. $date_of_birth }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Alamat</th>
                        <td> {{ $detailParticipant->address }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Email</th>
                        <td> {{ $detailParticipant->email }} </td>
                    </tr>

                    {{-- lainnya --}}
                    
                    <tr>
                        <th style="width: 30%;">Alamat</th>
                        <td> {{ $detailParticipant->address }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Agama</th>
                        <td> {{ $detailParticipant->religion }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Status Pernikahan</th>
                        <td> {{ $detailParticipant->material_status }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Tinggi Badan</th>
                        <td> {{ $detailParticipant->height ? $detailParticipant->height.'cm' : '' }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Pendidikan Terakhir</th>
                        <td> {{ $detailParticipant->last_education }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Kecamatan</th>
                        <td> {{ $detailParticipant->sub_district_name }} </td>
                    </tr>
                    <tr>
                        <th style="width: 30%;">Kelurahan</th>
                        <td> {{ $detailParticipant->village_name }} </td>
                    </tr>
                    {{-- dokument --}}
                    
                    <tr>
                        <th style="width: 30%;">Ak 1 / kartu kuning</th>
                        @if ($detailParticipant->ak1)
                            <td><b> : &nbsp; <a href="{{asset('/storage/'.$detailParticipant->ak1)}}" target="_blank">Lihat file</a> </b></td>
                        @else
                            <td> : &nbsp; - </td>
                        @endif
                    </tr>
                    <tr>
                        <th style="width: 30%;">Ijazah</th>
                        @if ($detailParticipant->ijazah)
                            <td><b> : &nbsp; <a href="{{asset('/storage/'.$detailParticipant->ijazah)}}" target="_blank">Lihat file</a> </b></td>
                        @else
                            <td> : &nbsp; - </td>
                        @endif
                    </tr>
                </table>
            </div>

            <div class="col-lg-5">
                <table class="table table-bordered table-sm">
                    <tr>
                        @if(!$detailParticipant->image)
                            <img src="{{ asset('img/userDefault.png') }}" class="shadow mb-2" style="width : 100%;" alt="User Image">
                        @else
                            <img src="{{ asset('/storage').'/'.$detailParticipant->image }}" class="shadow mb-2" style="width : 100%;" alt="User Image">
                        @endif
                        <div class="text-left"><small class="pt-2">Bergabung sejak, {{ date('d, M Y', strtotime($detailParticipant->created_at)) }}</small></div>
                    </tr>
                    <form action="/acc-participant/{{ $detailParticipant->number }}" method="POST">
                        @csrf
                        @method('PUT')
                        <tr>
                            <th>Terima Peserta</th>
                            <td>
                                <select name="acc" id="acc" class="form-control form-select">
                                    <option value="">Pilih status</option>
                                    <option value="Y" {{ $detailParticipant->participant == 'Y' ? 'selected':'' }}>Terima</option>
                                    <option value="N" {{ $detailParticipant->participant == 'N' ? 'selected':'' }}>Tolak</option>
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