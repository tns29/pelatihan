
@extends('user-page.layouts.user_main')

<style>
  #wmark {
  }
</style>

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
                        <span class="alert alert-danger py-0">Durasi {{$item->duration}}</span>
                        <p class="mt-2">{{$item->description}}</p>
                        <p>
                          <span class="alert alert-warning px-2 py-0"> {{$item->gelombang}}</span>
                        </p>
                        
                        {{-- <br> --}}
                        @if ($item->passed == NULL)
                          @if ($item->approve == 'Y')
                            <small class="alert alert-success py-1">Pelatihan telah disetujui</small>
                          @elseif ($item->approve == 'N')
                            <small class="alert alert-danger py-1">Pelatihan ditolak</small>
                          @else
                            <small class="alert alert-warning py-1">Menunggu Persetujuan</small>
                          @endif
                          <br>
                          <div class="text-success ms-1 mt-3">{{ $item->approve == 'Y' ? 'Pelatihan Sedang Berlangsung' : ''}}</div>
                        @else
                          <div class="text-primary ms-1 mt-3">{{ $item->approve == 'Y' ? 'Telah Selesai' : ''}}</div>
                        @endif
                        <br>
                        <button class="btn btn-success btn-sm mt-3" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Kartu Pelatihan" onclick="printCard(`{{$item->gelombang}}`, `{{$item->trainingsTitle}}`, `{{ date('d-m-Y', strtotime($item->date)) }}`, `{{$item->passed}}`, `{{ $item->approve }}`)">
                            <i class="far fa-address-card mr-1"></i> Lihat Kartu
                        </button>
                    </div>
                    <div class="col-lg-4">
                      @if ($item->image)
                        <img src="{{asset('/storage/'.$item->image)}}" class="w-75" alt="serviceImg">
                      @else
                        <img src="/img/logo.png" class="w-75" alt="serviceImg">
                      @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

<div class="modal fade" id="printCard" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><b>Kartu Pelatihan</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="content">
            <div class="row" id="wmark" style="
            background-image: url('<?= asset('/img/wmark.jpg') ?>');"> 
          </div>
          <div class="content-body">
            <div class="col-md-4 col-lg-4">
              <img src="{{ asset('/storage').'/'.auth()->guard('participant')->user()->image }}" class="img-fluid" style="height: 200px; padding: 14px !important;" alt="logo">
            </div>
            <div class="col">
              <table class="table">
                <tr>
                  <th style="text-align: left !important;">Nomor Peserta</th>
                  <td> : </td>
                  <td id="number">{{auth()->guard('participant')->user()->number}}</td>
                </tr>
                <tr>
                  <th style="text-align: left !important;">Nama Lengkap</th>
                  <td> : </td>
                  <td id="name">{{ auth()->guard('participant')->user()->fullname }}</td>
                </tr>
                <tr>
                  <th style="text-align: left !important;">Nama Pelatihan</th>
                  <td> : </td>
                  <td id="training_name"></td>
                </tr>
                <tr>
                  <th style="text-align: left !important;">Gelombang</th>
                  <td> : </td>
                  <td id="periode"></td>
                </tr>
                <tr>
                  <th style="text-align: left !important;">Tanggal Pendaftaran</th>
                  <td> : </td>
                  <td id="date"></td>
                </tr>
                <tr id="tr_approve">
                  <th style="text-align: left !important;">Status</th>
                  <td> : </td>
                  <td id="passed"></td>
                </tr>
              </table>
            </div>
          </div>  

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Kartu Pelatihan" onclick="printDiv()">
            <i class="fas fa-print me-1"></i> Cetak
        </button>
        </div>
      </div>
    </div>
</div>

@endsection

