@extends('admin-page.layouts.main_layout')

@section('content-pages')

<div class="content-header">
  <div class="container-fluid">
    <div class="row my-2">
      <div class="col-sm-6">
        <h3 class="m-0 ml-3">{{ $title}}</h3>
      </div><!-- /.col --> 
    </div><!-- /.row -->
    <hr style="margin-bottom: 0; margin:0 22px;">
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card w-75 mx-3 elevation-1 p-3">
            <form action="/store-participant-work" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row my-4 mx-3">
                    <div class="col-lg-12 col-md-12 col-sm-12" >
                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                <label for="code">Peserta</label>
                                <select name="participant_number" id="participant_number" class="form-control form-select @error('participant_number')is-invalid @enderror">
                                    <option value="">Pilih Peserta</option>
                                    @foreach ($participantData as $item)
                                        <option value="{{ $item->number }}">
                                            {{ $item->nik ? $item->nik : "XXXXXXXXXXXXXXXX" }} - {{ $item->fullname }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('participant_number')
                                <small class="invalid-feedback">
                                    Peserta {{ $message }}
                                </small>
                                @enderror
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="nik">NIK</label>
                                <input type="text" class="form-control" name="nik" id="nik" value="" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="no_telp">No. Telp</label>
                                <input type="text" class="form-control" name="no_telp" id="no_telp" value="" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="training">Pelatihan Terakhir</label>
                                <input type="text" class="form-control" name="training" id="training" value="" readonly>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="sub_district">Kecamatan</label>
                                <input type="text" class="form-control" name="sub_district" id="sub_district" value="" readonly>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="date_year">Bulan - Tahun</label>
                                <input type="month" class="form-control @error('date_year')is-invalid @enderror" name="date_year" id="date_year" value="{{ old('date_year') }}" pattern="[0-9]{4}-[0-9]{2}">
                                @error('date_year')
                                <small class="invalid-feedback">
                                    Bulan - Tahun {{ $message }}
                                </small>
                                @enderror
                            </div>
    
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="company_name">Nama Perusahaan</label>
                                <input type="text" class="form-control @error('company_name')is-invalid @enderror" name="company_name" id="company_name" value="{{ old('company_name') }}">
                                @error('company_name')
                                <small class="invalid-feedback">
                                    Nama Perusahaan {{ $message }}
                                </small>
                                @enderror
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 mt-2">
                                <label for="position">Posisi / Jabatan</label>
                                <input type="position" class="form-control @error('position')is-invalid @enderror" name="position" id="position" value="{{ old('position') }}">
                                @error('position')
                                <small class="invalid-feedback">
                                    Posisi / Jabatan {{ $message }}
                                </small>
                                @enderror
                            </div>
    
                        </div>
                    </div>
                    
                </div>
    
                <hr style="margin: 0 22px 20px;">
                <div class="row justify-content-end mx-3">
                    <section class="col-lg-4">
                        <section style="float: right;">
                            <a href="/participant-already-working" class="btn btn-outline-secondary mr-2"><i class="fas fa-backspace"></i> Batal</a>
                            <button class="btn my-button-save"><i class="far fa-save"></i> Simpan</button>
    
                        </section>
                    </section>
                </div>
            </form>
            
        </div>
        
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header my-bg-primary"> 
                    <strong class="me-auto text-white">Berhasil</strong>
                    {{-- <small>11 mins ago</small> --}}
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>

        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="notif-failed" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger"> 
                    <strong class="me-auto text-white">Proses Gagal</strong> 
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('failed') }}
                </div>
            </div>
        </div>

    </div>
</section>

@endsection