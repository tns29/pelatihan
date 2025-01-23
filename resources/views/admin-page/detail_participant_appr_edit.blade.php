@extends('admin-page.layouts.main_layout')

@section('content-pages')

<div class="content-header">
  <div class="container-fluid">
    <div class="row my-2">
      <div class="col-sm-6">
        <h3 class="m-0 ml-2">Edit Detail Peserta Pelatihan</h3>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <hr style="margin-bottom: 0">
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row mx-2">
            <div class="col-lg-12">
                <form action="/update-participant-data/{{ $resultData->participants->number }}/{{$training_id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="number">Nomor Peserta</label>
                        <input type="text" class="form-control" id="number" name="number" value="{{ $resultData->participants->number }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="fullname">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $resultData->participants->fullname }}" readonly>
                    </div>
                    {{-- <div class="form-group">
                        <label for="category_id">Kategori Pelatihan</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $resultData->service->category->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="training_id">Pelatihan Yang Dipilih</label>
                        <select name="training_id" id="training_id" class="form-control">
                            <option value="">Pilih Pelatihan</option>
                            @foreach ($trainings as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $training_id ? 'selected' : '' }}>{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-info">Simpan Data</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
