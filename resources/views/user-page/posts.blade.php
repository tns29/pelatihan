
@extends('user-page.layouts.user_main')

{{-- @section('header-pages')
<div class="banner">
  <div id="carouselExampleIndicators" class="carousel slide">
      <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      </div>
      <div class="carousel carousel-inner">
      <div class="carousel-item item active">
          <img src="{{ asset('img/header1.png') }}" class="d-block w-100" alt="header1">
      </div>
      <div class="carousel-item item">
          <img src="{{ asset('img/header2.png') }}" class="d-block w-100" alt="header2">
      </div> 
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
      </button>
  </div>
</div>
@endsection --}}

@section('content-pages')

<div class="explain-product my-5">
  <div class="heading text-center ">
    <div class="mt-3">
      <span style="font-size: 26px; font-weight: 600">{{$title}}</span>
    </div>
  </div>

  @if (count($posts) > 0)
    @foreach ($posts as $item)
      <div class="row shadow rounded-3 p-3 mt-3">
        <h3 class="h3">{{ $item->title }}</h3>
        <div class="col-lg-12 col-md-12 col-sm-12">
          <?= $item->body ?>
        </div>
        <small>
          @if ($item->updated_at)
            <i>updated at </i>{{ date('d M Y', strtotime($item->updated_at)) }}
          @else
            <i>posted at </i> {{ date('d M Y', strtotime($item->created_at)) }}
          @endif
        </small>
      </div>
    @endforeach
  @else
      <div class="row">
        <span class="alert alert-danger text-center h4 my-5">
          Belum ada berita saat ini.
        </span>
      </div>
  @endif

  
</div>

@endsection