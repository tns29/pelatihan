
@extends('user-page.layouts.user_main')

@section('content-pages')

<?php 
// dd(session());
?>

<div class="explain-product my-5 rounded">

  <div class="row my-3 p-3">
    @if (session()->has('success'))
        <div class="alert alert-success py-1 text-center">
            <a href="#" class="text-decoration-none text-dark font-weight-bolder"> {{ session()->get('success') }}</a>
        </div>
    @endif
    @if (session()->has('failed1'))
        <div class="alert alert-danger py-1 text-center">
            <a href="#" class="text-decoration-none text-dark font-weight-bolder"> {{ session()->get('failed1') }}</a>
        </div>
    @endif
    @if (session()->has('failed2'))
        <div class="alert alert-danger py-1 text-center">
            {{ session()->get('failed2') }}
            <a href="/update-profile" class="text-decoration-none text-primary font-weight-bolder"> Klik disini untuk melengkapi data </a>
        </div>
    @endif
    @if (session()->has('failed3'))
        <div class="alert alert-danger py-1 text-center">
            {{ session()->get('failed3') }}
        </div>
    @endif
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
        <p>
            <small class="card-text"> 
                {{-- <i class="fas fa-calendar-minus me-2"></i>   --}}
                Min Usia : &nbsp; {{ $service->min_age }} Tahun
            </small> 
            <br>
            <small class="card-text"> 
                {{-- <i class="fas fa-calendar-minus me-2"></i>   --}}
                Max Usia : &nbsp; {{ $service->max_age }} Tahun
            </small>
        </p>
        <p class="text-black " style="font-size: 16.5px; line-height: 1.6; text-align: justify"><?= $service->description ?></p>
        <a href="/checkDataUser/{{$service->id}}" class="btn bg-secondary-color text-white"><i class="fab fa-get-pocket"></i> Daftar Sekarang</a>

    </div>
    <hr class="mx-3 mt-3">
    
    <div class="card mx-3 mt-3">
    @foreach ($services_detail as $item)
        <div class="row pt-2 justify-content-start">
            <div class="col-md-3">
                <div id="simple-list-example" class="d-flex flex-column gap-2 simple-list-example-scrollspy">
                    <a class="p-1 rounded text-left text-decoration-none primary-color" href="#simple-list-item-{{$item->id}}"> » &nbsp; {{ $item->title }}</a>
                </div>
            </div>
            <div class="col-md-6">
                <div data-bs-spy="scroll" data-bs-target="#simple-list-example" data-bs-offset="0" data-bs-smooth-scroll="true" class="scrollspy-example" tabindex="0">
                    <h6 id="simple-list-item-{{$item->id}}" class="font-weight-bolder"> <b>Kontent {{ $item->title }}</b> </h6>
                    <p class="text-justify"><?= $item->description ?></p>
                </div>
            </div>
            <div class="col-md-3">
                @if ($item->image)
                    <img src="{{ asset('/storage/'.$item->image) }}" alt="conntent-img" style="height: 170px; width:auto;">
                @else
                    
                @endif
            </div>
        </div>
    @endforeach
    </div>

  </div>

  <div class="row">
    
  </div>

</div>

@endsection