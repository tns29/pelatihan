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
                <form action="/set-period" method="POST">
                    @csrf
    
                    <div class="mb-4">
                        <label for="name">Gelombang</label>
                        <select name="id" id="id" class="form-select form-control">
                            {{-- <option value="">Pilih Gelombang</option> --}}
                            @foreach ($dataPeriod as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $active_period->id ? 'selected' : '' }}>
                                    » &nbsp; {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="row mt-2">
                            <div class="col-lg-6 col-md-6">
                                <label class="font-weight-normal ml-1">Mulai</label> 
                                <input type="date" class="form-control @error('start_date')is-invalid @enderror" name="start_date" value="{{ old('start_date', $active_period->start_date != NULL ? $active_period->start_date : date('Y-m-d') ) }}">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label class="font-weight-normal ml-1">Selesai</label>
                                <input type="date" class="form-control @error('end_date')is-invalid @enderror" name="end_date" value="{{ old('end_date', $active_period->end_date) }}">
                            </div>
                        </div>
                    </div>
                
                    <button class="btn my-button-save ml-3" id="save" style="float: right;"> 
                        <i class="far fa-save mr-2"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>

</section> 
    
@endsection