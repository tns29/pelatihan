
@extends('user-page.layouts.user_main')

@section('content-pages')

<div class="explain-product my-5 rounded">

  <div class="row my-3 p-3">

    <div class="col-lg-3 col-md-3 col-sm-6 mb-3">
    
        <div class="card shadow-sm p-2" style="width: 100%;">
            @if ($service->image)
                <img src="{{ asset('/storage').'/'.$service->image }}" class="card-img-top" alt="{{$service->id}}">
            @else
                <img src="{{ asset('/img/logo.png') }}" class="card-img-top p-3" alt="{{$service->id}}">
            @endif
        </div>

    </div>

    <div class="col mx-3">
        <h4 style="font-size: 28px; font-weight: 700; text-transform: uppercase;"> {{ $service->title }} </h4>
        <div class="mb-2">
            <small class="alert alert-warning py-0">{{ $service->category->name }}</small>
        </div>
        <p>
            <small class="card-text"> 
                <i class="fas fa-calendar-minus me-2"></i>  
                Periode
                {{ date('d M Y', strtotime($setting->start_date)) }} s/d
                {{ date('d M Y', strtotime($setting->end_date)) }}
            </small>
        </p>
        <p class="text-black " style="font-size: 16.5px; line-height: 1.6; text-align: justify">{{$service->description}}</p>
        <a href="" class="btn bg-secondary-color text-white"><i class="fab fa-get-pocket"></i> Daftar Sekarang</a>
    </div>

  </div>

  <div class="row">
    
  </div>

</div>

@endsection