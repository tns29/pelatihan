
@extends('user-page.layouts.user_main')

@section('header-pages')
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
@endsection

@section('content-pages')

<div class="service-panel my-4">
  <div class="heading text-center">
    <div class="mt-3">
      <span style="font-size: 26px; font-weight: 600">PROFILE {{$brand_name}}</span>
    </div>

    <div class="mt-3">
      Lorem ipsum dolor sit amet consectetur, adipisicing elit. Alias magni fugiat distinctio aliquid et doloremque, blanditiis rem dignissimos excepturi rerum inventore dicta ratione debitis earum illum corporis, dolor reprehenderit necessitatibus?
    </div>
  </div>
  <div class="parent-category-panel mt-3">
    
    {{-- @foreach ($category as $item)
        
      <div class="category-panel">
        <a href="{{$item->id}}" class="text-decoration-none text-dark-emphasis">
          <div class="box-category">
            <div class="text-center">
              <b class="text-center">{{ $item->name }} </b>
            </div>
          </div>
        </a>
      </div>

    @endforeach --}}

  </div>
</div>
<br>
<br>

<div class="explain-product my-5">
  <div class="heading text-center ">
    <div class="mt-3">
      <span style="font-size: 26px; font-weight: 600">Berbagai Program  {{$brand_name}}</span>
    </div>
  </div>

  <div class="row mt-3">
    <div class="col-lg-12 col-md-12 col-sm-12">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt aliquid velit at maxime quod enim, vitae, officiis accusamus corporis numquam voluptates laudantium fuga laborum sapiente nisi mollitia soluta eius. Suscipit?
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt aliquid velit at maxime quod enim, vitae, officiis accusamus corporis numquam voluptates laudantium fuga laborum sapiente nisi mollitia soluta eius. Suscipit?
    </div>
  </div>
</div>

@endsection