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
        <div class="card mx-2 elevation-1 p-3 w-75">
            <form action="/service-detail" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mx-2">
                    <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                        <label for="training_id">Pelatihan</label>
                        <select class="form-control @error('training_id')is-invalid @enderror" name="training_id" id="training_id">
                            <option value="">Pilih Pelatihan</option>
                            @foreach ($dataTraining as $item)
                                <option value="{{ $item->id }}" {{old('training_id') == $item->id ? 'selected':''}}> » &nbsp; {{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('training_id')
                        <small class="invalid-feedback">
                            Pelatihan {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 mt-2">
                        <div class="form-check mt-1">
                            <label for="is_active">Aktif ?</label>
                            <input class="form-check-input mt-5" type="checkbox" checked value="Y" name="is_active" id="is_active" style="width: 1.3rem; height: 1.3rem; top:-1rem; left: 2.5rem;">
                            <div class="form-check-label" style="margin-left: 30px">Ya</div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                        <label for="title">Sub Judul Pelatihan</label>
                        <input type="text" class="form-control @error('title')is-invalid @enderror" name="title" id="title" value="{{ old('title') }}">
                        @error('title')
                        <small class="invalid-feedback">
                            Judul {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                        <label for="image">Gambar</label>
                        <input type="file" name="image" id="image" class="form-control @error('image')is-invalid @enderror">
                        
                        @error('image')
                        <small class="invalid-feedback">
                            File {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                        <label for="image">&nbsp;</label> 
                        <div class="card img-bordered ml-5 p-2">
                            <img id="blah" src="{{ asset('/img/no_preview.jpg') }}" alt="preview" style="height: 250px;"/>
                        </div>
                    </div>
                    
                    {{-- <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                        <label for="date">Tanggal</label>
                        <input type="date" class="form-control @error('date')is-invalid @enderror" name="date" id="date" value="{{ old('date') }}">
                        @error('date')
                        <small class="invalid-feedback">
                            Tanggal {{ $message }}
                        </small>
                        @enderror
                    </div> --}}

                </div>

                <hr style="margin: 0 22px 20px;">
                <div class="row justify-content-end mx-3">
                    <section class="col-lg-4">
                        <section style="float: right;">
                            <a href="/service" class="btn btn-outline-secondary mr-2"><i class="fas fa-backspace"></i> Batal</a>
                            <button class="btn my-button-save"><i class="far fa-save"></i> Simpan</button>
                        </section>
                    </section>
                </div>
                
            </form>
        </div>
    </div>
</section> 
    
@endsection