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
            <form action="/service" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mx-2">
                    <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                        <label for="category_id">Kategori</label>
                        <select class="form-control @error('category_id')is-invalid @enderror" name="category_id" id="category_id">
                            <option value="">Pilih Kategori</option>
                            @foreach ($dataCategory as $item)
                                <option value="{{ $item->id }}" {{old('category_id') == $item->id ? 'selected':''}}> »  {{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <small class="invalid-feedback">
                            Kategori {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2 mt-2">
                        <div class="form-check mt-1">
                            <label for="duration">Durasi</label>
                            <input type="text" name="duration" id="duration" class="form-control @error('duration')is-invalid @enderror" value="{{ old('duration') }}">
                            @error('duration')
                            <small class="invalid-feedback">
                                Durasi {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2 mt-2">
                        <div class="form-check mt-1">
                            <label for="min_age">Usia Min</label>
                            <input type="text" name="min_age" id="min_age" class="form-control @error('min_age')is-invalid @enderror" value="{{ old('min_age') }}">
                            @error('min_age')
                            <small class="invalid-feedback">
                                Usia {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 mt-2">
                        <div class="form-check mt-1">
                            <label for="max_age">Usia Max</label>
                            <input type="text" name="max_age" id="max_age" class="form-control @error('max_age')is-invalid @enderror" value="{{ old('max_age') }}">
                            @error('max_age')
                            <small class="invalid-feedback">
                                Usia {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 mt-2">
                        <div class="form-check mt-1">
                            <label for="is_active">Aktif ?</label>
                            <input class="form-check-input mt-5" type="checkbox" checked value="Y" name="is_active" id="is_active" style="width: 1.3rem; height: 1.3rem; top:-1rem; left: 2.5rem;">
                            <div class="form-check-label" style="margin-left: 30px">Ya</div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                        <label for="title">Judul Pelatihan</label>
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
