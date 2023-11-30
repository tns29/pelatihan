
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
          <img src="{{ asset('img/p2.png') }}" class="d-block w-100" alt="p2">
        </div>
        <div class="carousel-item item">
          <img src="{{ asset('img/p1.png') }}" class="d-block w-100" alt="p1">
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

<div class="explain-product my-4">
  <div class="heading text-center ">
    <div class="pt-3">
      <h3 style="font-size: 26px; font-weight: 600"> Pilih Program Impian </h3>
    </div>
  </div>

  <div class="row mt-3">
    <section class="mb-1 row">
      <div class="col-lg-10" style="width: 92%; padding-right: 0 !important;">
        <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Apa yg ingin anda pelajari ?">
      </div>
      <div class="col" style="width: 8%; padding: 0 !important;">
        <button class="btn btn-info float-end">
          <i class="fas fa-search pe-2"></i> Cari
        </button>
      </div>
    </section>
    <section class="pt-1">
      <div class="justify-content-center">
        <button class="alert alert-light py-0 mx-1 btn-category-all" data-id="all" onclick="getCategory('all')">Semua Kategori</button>
        @foreach ($category as $item)
          <button class="alert alert-light py-0 mx-1 btn-category-{{$item->id}}" data-id="{{$item->id}}" onclick="getCategory({{$item->id}})">{{$item->name}}</button>
          @endforeach
      </div>
      <input type="hidden" name="count-id-category" id="count-id-category" value="{{ count($category) }}">
      <input type="hidden" name="category" id="category" value="">
      
    </section>

    <div class="row" id="services-list">
      <div class="text-center mt-3">Sedang memuat...</div>
      {{-- load in javascript --}}
    </div>

  </div>
</div>

@endsection
