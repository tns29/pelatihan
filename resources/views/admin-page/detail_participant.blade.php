@extends('admin-page.layouts.main_layout')

@section('content-pages')

<div class="content-header">
  <div class="container-fluid">
    <div class="row my-2">
      <div class="col-sm-6">
        @if ($candidate == 'Y')
            <h3 class="m-0 ml-2">Detail Calon Peserta</h3>
        @else
            <h3 class="m-0 ml-2">Detail Pendaftar Akun Baru</h3>
        @endif
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
                        <th>NIK</th>
                        <td>{{ $detailParticipant->nik }} </td>
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
                        <th style="width: 30%;">KTP</th>
                        @if ($detailParticipant->id_card)
                            <td><b> : &nbsp; <a href="{{asset('/storage/'.$detailParticipant->id_card)}}" target="_blank">Lihat file</a> </b></td>
                        @else
                            <td> : &nbsp; - </td>
                        @endif
                    </tr>
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
                    @if ($candidate != 'Y') 
                    <form action="/acc-participant/{{ $detailParticipant->number }}" method="POST">
                        @csrf
                        @method('PUT')
                        <tr>
                            <th>Terima Calon Peserta</th>
                            <td>
                                <select name="acc" id="acc" class="form-control form-select">
                                    <option value="">Pilih status</option>
                                    <option value="Y" {{ $detailParticipant->participant == 'Y' ? 'selected':'' }}>Terima</option>
                                    <option value="N" {{ $detailParticipant->participant == 'N' ? 'selected':'' }}>Tolak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="#" onclick="popUpResetPassword()">Reset Password</a></td>
                            <td colspan="2"><button class="btn btn-outline-info py-1 float-right w-full">Simpan dan keluar &nbsp; <i class="fas fa-share-square"></i> </button></td>
                        </tr>
                        <tr class="bg-success">
                            @if (session()->has('success'))
                                <td colspan="3">
                                    <span class="alert alert-success py-1" id="success">
                                        <?= session()->get('success') ?>
                                    </span>
                                </td>
                            @endif
                        </tr>
                        
                    </form>
                    @elseif($candidate == 'Y')
                    <tr>
                        <th>Status Calon Peserta</th>
                        <td>
                            Telah diterima
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><a href="/candidate-data" class="btn btn-outline-info py-1 float-right w-full">Keluar <i class="fas fa-share-square"></i> </a></td>
                    </tr>
                    @endif
                    

                </table>
            </div>

        </div>
    </div>
</section> 

<div class="modal fade" id="modal-reset-password" tabindex="-1">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title ml-2 font-weight-bold">Reset Password</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="/reset-password/{{ $detailParticipant->number }}">
          @csrf
          @method('PUT')
          <div class="modal-body mx-3 px-3">
            <div class="row">
              <label for="label">Kata Sandi Baru</label>
              <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi baru" required>
            </div>
          </div> 
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
