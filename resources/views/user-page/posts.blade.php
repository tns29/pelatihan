
@extends('user-page.layouts.user_main')

@section('content-pages')

<div class="explain-product my-5 mx-3">
  <div class="heading text-center ">
    <div class="mt-3">
      <span style="font-size: 26px; font-weight: 600">{{$title}}</span>
    </div>
  </div>

  @if (count($posts) > 0)
    @foreach ($posts as $item)
      <div class="row shadow bg-white rounded-3 p-3 mt-3">
        <div class="col" style="border-right: 1px solid #acacac !important;">
          <h3 class="h3">{{ $item->title }}</h3>
          <div class="col-lg-12 col-md-12 col-sm-12 pe-3">
            <?= Str::substr($item->body, 0, 200) ?>
          </div>
          <small>
            @if ($item->updated_at)
              <i>updated at </i>{{ date('d M Y', strtotime($item->updated_at)) }}
            @else
              <i>posted at </i> {{ date('d M Y', strtotime($item->created_at)) }}
            @endif
          </small>
        </div>
        <div class="col-md-4">
          
          <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">

              <?php $key = 0; ?>
              @foreach ($item->picturePost as $row)
              <?php $key++ ?>
              <div class="carousel-item {{ $key == 1 ? 'active' : ''}} " style="background: #f1f1f16b">
                  <img src="{{ asset('/storage').'/'.$row->image }}" class="d-block p-2 img-fluid" alt="img-news"
                  style="min-width: 350px; margin:auto">
                  <div class="mt-2 ms-2 text-center">
                    <a href="{{ asset('/storage').'/'.$row->image }}" class="text-decoration-none" download>Download gambar</a>
                  </div>
                </div>
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              {{-- <span class="carousel-control-prev-icon" aria-hidden="true" style="color: black !important; box-shadow: 5px 5px 10px #888888;"></span> --}}
              <span style="font-size: 50px; color:black"> «</span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              {{-- <span class="carousel-control-next-icon" aria-hidden="true" style="color: black !important; box-shadow: 5px 5px 10px #888888;"></span> --}}
              <span style="font-size: 50px; color:black"> »</span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
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