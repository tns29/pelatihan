
@extends('user-page.layouts.user_main')

@section('header-pages')
<div class="banner">
  <div id="carouselExampleIndicators" class="carousel slide">
      {{-- <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      </div> --}}
      <div class="carousel carousel-inner">
        <div class="carousel-item item active" style="height: 360px;">
            <img src="{{ asset('img/uptdlk.jpg') }}" class="d-block w-100 px-5 bg-white" alt="header1">
        </div>
        {{-- <div class="carousel-item item">
            <img src="{{ asset('img/header2.png') }}" class="d-block w-100" alt="header2">
        </div>  --}}
      </div>
      {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button> --}}
  </div>
</div>
@endsection

@section('content-pages')

<div class="row service-panel my-4 mx-1 rounded-4 bg-white shadow-sm" >
  <div class="col">
    <div class="text-left ms-3">
      <div class="mt-3">
        <span style="font-size: 26px;"><b>PROFILE {{$brand_name}}</b></span>
        <br>
        <span class="ms-1">LATAR BELAKANG PEMBENTUKAN BLK DISNAKER KABUPATEN TANGERANG</span>
      </div>
  
      <div class="mt-2" style="text-align: left; margin-left: -10px">
        <ul>
          <li>
            BLK  Kab. Tangerang merupakan Unit Pelaksana Teknis ( UPT ) yang secara  operasional merupakan penunjang sebagian tugas Disnaker Kabupaten  Tangerang;
          </li>
          <li>
            BLK Kab. Tangerang sebagai salah satu Program Unggulan Pemerintah Kabupaten Tangerang dalam Peningkatan Kualitas dan Produktivitas Tenaga Kerja  sehingga diharapkan dapat mencetak  tenaga kerja kerja yang handal siap pakai;
          </li>
          <li>
            BLK Kab. Tangerang terbentuk berdasarkan Peraturan Bupati Tangerang Nomor  : 47  Tahun 2015  tentang Tugas Pokok, Rincian Tugas Dan Tata Kerja UPT  BLK Disnaker Kab.Tangerang.
          </li>
        </ul>
      </div>
    </div>
    
    <div class="text-left ms-3">
      <div class="mt-1">
        <span class="ms-1">DASAR HUKUM PEMBENTUKAN BLK DISNAKER KABUPATEN TANGERANG</span>
      </div>
  
      <div class="mt-2" style="text-align: left; margin-left: -10px">
        <ul>
          <li> UU No. 13 Tahun 2003 tentang Ketenagakerjaan</li>
          <li> PP No.31 Thn 2006 ttg Sistem Pelatihan Kerja Nasional</li>
          <li>Peraturan Daerah No.11 tahun 2016 tentang Stuktur Organisasi </li>
          <li> Peraturan Bupati No 139 Tahun 2016 tentang Tugas Pokok dan Fungsi Tahun 2016</li>
        </ul>
      </div>
    </div>
    <hr>
    
    <div class="ms-3">
      <span class="ms-1">PROGRAM UNGGULAN</span><br>
      <span class="ms-1">Peningkatan Kualitas dan Produktivitas Tenaga Kerja</span>
    </div>

    <div class="ms-3 mt-2">
      <span class="ms-1">SLOGAN</span><br>
      <span class="ms-1"><i>"Bersama Kami Raih Masa Depan Gemilang"</i></span>
    </div>

    <div class="ms-3 mt-2">
      <span class="ms-1 font-weight-bold">VISI</span><br>
      <span class="ms-1">Terwujudnya Tenaga Kerja yang Kompeten dan Berdaya Saing.</span>
    </div>
    <div class="ms-3 mt-2">
      <span class="ms-1 font-weight-bold">MISI</span><br>
      <ul>
        <li>Meningkatkan kompetensi tenaga kerja</li>
        <li>Mengembangkan jejaring, kerjasama dan kemitraan pelatihan dengan perusahaan dan Stakeholders</li>
        <li>Menyelaraskan program pelatihan dan penyelenggaraan pelatihan dengan institusi terkait dan dunia usaha.</li>
      </ul>
    </div>
    
  </div>

  <div class="col" style="border-left: 1px solid #477991">
    <img src="{{ asset('/img/struktur-organisasi.jpg') }}" class="pb-3" alt="struktur-organisasi" style="height: 600px; width:600px;">
  </div>

</div>


@endsection