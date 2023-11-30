
@extends('user-page.layouts.user_main')

@section('content-pages')

<div class="explain-product my-4">
    <div class="heading text-center ">
        <div class="pt-3">
        <h3 style="font-size: 26px; font-weight: 600"> {{$title}} </h3>
        </div>
    </div>

    <div class="row mt-3">
        @foreach ($wishlist as $item)
            <div class="mt-3 p-3 card shadow-lg">
                <div class="row">
                    <div class="col-lg-8">
                        <h2>{{$item->trainingsTitle}}</h2>
                        <span class="alert alert-info py-0"> {{$item->category}}</span>
                        <p class="mt-2">{{$item->description}}</p>
                        <span class="alert alert-warning px-2 py-0"> {{$item->gelombang}}</span>
                        <br>
                        <button class="btn btn-success btn-sm mt-3" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Kartu Pelatihan" onclick="printCard({{$item->id}})">
                            <i class="far fa-address-card mr-1"></i> Lihat Kartu
                        </button>
                    </div>
                    <div class="col-lg-4">
                        <img src="{{asset('/storage/'.$item->image)}}" class="w-75" alt="serviceImg">
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

@endsection

<div class="modal fade" id="printCard" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><b>Kartu Pelatihan</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Kartu Pelatihan" onclick="printCard({{$item->id}})">
            <i class="fas fa-print me-1"></i> Cetak
        </button>
        </div>
      </div>
    </div>
  </div>
