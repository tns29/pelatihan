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
                <form action="/settings" method="POST">
                    @csrf
    
                    @foreach ($dataSetting as $item)
                        <div class="mb-4">
                            <label for="name">{{ ucWords($item->name) }}</label>
                            <input type="hidden" name="id{{$item->id}}" value="{{$item->id}}">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <label class="font-weight-normal ml-1">Mulai</label>
                                    <input type="date" class="form-control" name="start_date{{$item->id}}" value="{{ $item->start_date }}" readonly>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <label class="font-weight-normal ml-1">Selesai</label>
                                    <input type="date" class="form-control" name="end_date{{$item->id}}" value="{{ $item->end_date }}" readonly>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    <button class="btn my-button-save ml-3" id="save" style="float: right;"> 
                        <i class="far fa-save mr-2"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-warning ml-3" id="edit" style="float: right;"> 
                        <i class="fa fa-edit mr-2"></i> Edit
                    </button> 
                    <button type="button" class="btn btn-outline-secondary ml-3" id="cancel" style="float: right;"> 
                        <i class="fas fa-ban mr-2"></i> Batal
                    </button> 
                </form>
            </div>
        </div>
    </div>

</section> 
    
@endsection