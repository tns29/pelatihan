@extends('admin-page.layouts.main_layout')

<style>
    #image-preview {
        display: flex;
        flex-wrap: wrap;
        max-height: 300px; /* Set a maximum height for vertical scrolling */
        overflow-x: auto; /* Enable vertical scrollbar if content exceeds the height */
    }
    .preview-image {
        width: auto;
        max-height: 250px;
        margin: 8px 15px;
    }
</style>

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
            <form action="/posts" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mx-2">
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                        <label for="title">Judul </label>
                        <input type="text" class="form-control @error('title')is-invalid @enderror" name="title" id="title" value="{{ old('title') }}">
                        @error('title')
                        <small class="invalid-feedback">
                            Judul {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                        <label for="body">Konten Berita</label>
                        {{-- <textarea name="body" id="body" class="form-control" cols="30" rows="5"></textarea> --}}
                        <textarea name="body" id="body"></textarea>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                        <label for="image">Gambar</label>
                        <input type="file" name="image[]" id="image" class="form-control @error('image')is-invalid @enderror" multiple accept="image/*" onchange="previewImages()">
                        
                        @error('image')
                        <small class="invalid-feedback">
                            File {{ $message }}
                        </small>
                        @enderror
                    </div>

                    {{-- <div class="col-lg-6 col-md-6 col-sm-6 mt-2">
                        <label for="image">&nbsp;</label> 
                        <div class="card img-bordered ml-5 p-2">
                            <img id="blah" src="{{ asset('/img/no_preview.jpg') }}" alt="preview" style="height: 250px;"/>
                        </div>
                    </div> --}}
                    
                </div>

                <div class="row">
                    <br>
                    <div id="image-preview"></div>
                </div>

                <hr style="margin: 0 22px 20px;">
                <div class="row justify-content-end mx-3">
                    <section class="col-lg-4">
                        <section style="float: right;">
                            <a href="/posts" class="btn btn-outline-secondary mr-2"><i class="fas fa-backspace"></i> Batal</a>
                            <button class="btn my-button-save"><i class="far fa-save"></i> Simpan</button>
                        </section>
                    </section>
                </div>
                
            </form>
        </div>
    </div>
</section> 
    
@endsection