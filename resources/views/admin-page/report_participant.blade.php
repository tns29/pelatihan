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
            <div class="col-lg-8 elevation-1 p-4">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 mt-2">
                                <label for="fullname" class="ml-1">Nama Pendaftar</label>
                                <select class="select-fullname" name="fullname" id="fullname">
                                    <option value="">Semua Peserta</option>
                                    @foreach ($participant as $item)
                                        <option value="{{ $item->number }}"> » &nbsp; {{ $item->nik .' - '. $item->fullname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="col-lg-6 col-md-6 mt-2">
                                <label for="fullname" class="ml-1">Nama Pendaftar</label>
                                <select name="fullname" id="fullname" class="form-control form-select">
                                    <option value="">Semua Pendaftar</option>
                                    @foreach ($participant as $item)
                                        <option value="{{ $item->number }}"> » &nbsp; {{ $item->fullname }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="col-lg-6 col-md-6 mt-2">
                                <label for="category_id" class="ml-1">Kategori</label>
                                <select name="category_id" id="category_id" class="form-control form-select">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" >
                                            » &nbsp; {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-2">
                                <label for="training_id" class="ml-1">Pelatihan</label>
                                <select name="training_id" id="training_id" class="form-control form-select">
                                    <option value="">Pilih Pelatihan</option>
                                    @foreach ($trainings as $item)
                                        <option value="{{ $item->id }}" >
                                            » &nbsp; {{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-2">
                                <label for="gender" class="ml-1">Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-control form-select">
                                    <option value="">Semua Jenis Kelamin</option>
                                    <option value="M">Laki-laki</option>
                                    <option value="F">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-2">
                                <label for="rematerial_statusligion" class="ml-1">Status Pernikahan</label>
                                <select name="material_status" id="material_status" class="form-control form-select">
                                    <option value="">Pilih status</option>
                                    <option value="Kawin" > » &nbsp; Kawin</option>
                                    <option value="Belum Kawin"> » &nbsp; Belum Kawin</option>
                                    <option value="Janda" > » &nbsp; Janda</option>
                                    <option value="Duda" > » &nbsp; Duda</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-2">
                                <label for="sub_district" class="ml-1">Kecamatan</label>
                                <select name="sub_district" id="sub_district" class="form-control form-select">
                                    <option value="">Pilih kecamatan</option>
                                    @foreach ($subDistrict as $item)
                                        <option value="{{ $item->id }}" >
                                            » &nbsp; {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 mt-2">
                                <input type="hidden" id="village_">
                                <label for="village" class="ml-1">Desa / Kelurahan</label>
                                <select name="village" id="village" class="form-control form-select">
                                    <option value="">Pilih </option>
                                    {{-- @foreach ($villages as $item)
                                        <option value="{{ $item->id }}" >
                                            » &nbsp; {{ $item->name }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                            {{-- <div class="col-lg-6 col-md-6 mt-2">
                                <label for="religion" class="ml-1">Agama</label>
                                <select name="religion" id="religion" class="form-control form-select">
                                    <option value="">Pilih agama</option>
                                    <option value="Islam"> » &nbsp; Islam</option>
                                    <option value="Kristen"> » &nbsp; Kristen</option>
                                    <option value="Hindu"> » &nbsp; Hindu</option>
                                    <option value="Budha"> » &nbsp; Budha</option>
                                    <option value="Konghucu"> » &nbsp; Konghucu</option>
                                </select>
                            </div> --}}

                            <div class="col-lg-6 col-md-6 mt-2">
                                <label for="religion" class="ml-1">Pendidikan Terakhir</label>
                                {{-- <input type="text" name="last_education" id="last_education" class="form-control" style="text-transform: uppercase" maxlength="10"> --}}
                                <select name="last_education" id="last_education" class="form-control form-select @error('last_education')is-invalid @enderror">
                                    <option value="">Pilih Pendidikan Terakhir</option>
                                    <option value="SD"> » &nbsp; SD</option>
                                    <option value="SLTP"> » &nbsp; SLTP</option>
                                    <option value="SLTA-Sederajat"> » &nbsp; SLTA/Sederajat</option>
                                    <option value="DIPLOMA"> » &nbsp; DIPLOMA</option>
                                    <option value="S1"> » &nbsp; S1</option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-md-6 mt-2">
                                <label for="period" class="ml-1">Gelombang</label>
                                <select name="period" id="period" class="form-control form-select">
                                    <option value="">Pilih Gelombang</option>
                                    @foreach ($periods as $item)
                                        <option value="{{ $item->id }}" >
                                            » &nbsp; {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6 col-md-6 mt-2">
                                <label for="year" class="ml-1">Tahun</label>
                                <select name="year" id="year" class="form-control form-select"></select>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="btn btn-warning ml-3" id="submitRpt" style="float: right;"> 
                        <i class="fas fa-search mr-1"></i> Submit
                    </button> 
                </form>
            </div>
        </div>
    </div>

</section> 
    
@endsection


