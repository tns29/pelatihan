
@extends('user-page.layouts.user_main')

<style>
    img.image-post {
        width: 100%;
        margin:auto;
    }
    @media (max-width: 768px) {
        img.image-post {
            /* width: 65%; */
        }
    }
</style>

@section('content-pages')

<div class="explain-product my-4 mx-3">

  <div class="heading text-center ">
    <div class="mt-3">
      <span style="font-size: 26px; font-weight: 600">{{$title}}</span>
    </div>
  </div>

  @if ($resultPost)
    <div class="row shadow bg-white rounded-3 p-3 mt-3">

    <div class="col-md-12">
        <small>
        @if ($resultPost->updated_at)
            <i>updated at </i>{{ date('d M Y', strtotime($resultPost->updated_at)) }}
        @else
            <i>posted at </i> {{ date('d M Y', strtotime($resultPost->created_at)) }}
        @endif
        </small>
        &nbsp; | &nbsp;
        <small> Pembaca  {{ $resultPost->seen }} </small>
    </div>

    <div class="col-md-8" style="border-right: 1px solid #acacac !important;">
        <h3 class="h3 mt-3">{{ $resultPost->title }}</h3>

        <div class="">
            <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <?php $key = 0; ?>
                @foreach ($resultPost->picturePost as $row)
                <?php $key++ ?>
                <div class="carousel-item {{ $key == 1 ? 'active' : ''}} " style="background: #f1f1f16b">
                    <img src="{{ asset('/storage').'/'.$row->image }}" class="d-block p-2 img-fluid image-post" alt="img-news">
                    <div class="mt-2 ms-2 text-center">
                    {{-- <a href="{{ asset('/storage').'/'.$row->image }}" class="text-decoration-none" download >Download gambar</a> --}}
                    <div onclick="downloadImg(`{{ asset('/storage').'/'.$row->image }}`, `image-post-{{$row->id}}`, this)">Download gambar</div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span style="font-size: 50px; color:black"> «</span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span style="font-size: 50px; color:black"> »</span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 pe-3 mt-3">
        <?= $resultPost->body ?>
        </div>
    </div>

    <div class="col-md-4">
        <h4 class="mt-3">Berita Lainnya</h4>
        @foreach ($post as $key => $item)
            @if ($item->id != $resultPost->id)
                <hr>
                <small>
                    @if ($item->updated_at)
                    <i>updated at </i>{{ date('d M Y', strtotime($item->updated_at)) }}
                    @else
                    <i>posted at </i> {{ date('d M Y', strtotime($item->created_at)) }}
                    @endif
                </small>
            &nbsp; | &nbsp;
            <small> {{ $item->seen }} Pembaca </small>
            <div class="row">
                <h3 class="h3 mt-3">{{ $item->title }}</h3>
                <div class="col-lg-12 col-md-12 col-sm-12 pe-3 mt-3">
                <?= Str::substr($item->body, 0, 300) ?>
                </div>
                <a href="/detail-berita/{{ $item->id }}" class="text-decoration-none">
                <small>Lihat Selengkapnya ...</small>
                </a>

            </div>
            @endif
        @endforeach
    </div>

    </div>
  @else
    <div class="row">
    <span class="alert alert-danger text-center h4 my-5">
        Belum ada berita saat ini.
    </span>
    </div>
  @endif

</div>

@endsection

<script>
  function downloadImg(url, filename, element) {
    fetch(url)
      .then(response => response.blob())
      .then(blob => {
          // Create a download link
          const downloadLink = document.createElement('a');
          downloadLink.href = URL.createObjectURL(blob);
          downloadLink.download = filename;

          // Append the link to the document and trigger a click on the link to start the download
          document.body.appendChild(downloadLink);
          downloadLink.click();

          // Remove the link from the document
          document.body.removeChild(downloadLink);

      })
      .catch(error => console.error('Error downloading file:', error));
  }
</script>
