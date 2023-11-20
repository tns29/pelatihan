
<nav class="navbar navbar-expand-lg bg-body-tertiary rounded-2">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><b>UPTD Latihan Kerja Dinas Tenaga Kerja Kab. Tangerang</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="d-flex">
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">WhatsApp</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Instagram</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Facebook</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg sticky-top" id="navigasi">
    <div class="container-fluid mx-0">
      <a class="navbar-brand" href="/"><b></b></a>
      <div class="d-flex">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item mx-2">
              <a class="nav-link {{ Request::segment(1) == '' ? 'active-link' : '' }}" aria-current="page" href="/">Profile</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link {{ Request::segment(1) == 'berita' ? 'active-link' : '' }}" aria-current="page" href="/berita">Berita</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link {{ Request::segment(1) == 'pelatihan' ? 'active-link' : '' }}" href="/pelatihan">Pelatihan</a>
            </li>
            
            <li class="nav-item mx-2">
              <a class="nav-link {{ Request::segment(1) == '#' ? 'active-link' : '' }}" href="https://tangerangkab.go.id/" target="_blank">Website Kab. Tangerang</a>
            </li>
            
            {{-- <li class="nav-item mx-2 dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Kategori Pelatihan
              </a>
              <ul class="dropdown-menu">
                @foreach ($category as $item)
                  <li><a class="dropdown-item" href="/category_/{{$item->id}}">» {{$item->name}}</a></li>
                @endforeach
              </ul>
            </li> --}}
            @if (auth('participant')->user())
              <li class="nav-item mx-2">
                <a href="/_profile" class="btn btn-outline-danger register py-1 mt-1">
                 Hi, {{ auth('participant')->user()->fullname }}
                </a>
              </li>
            @else
              <div class="mt-1">&nbsp; &nbsp; </div>
              <li class="nav-item mx-2">
                <a href="/login" class="btn primary-color button-login py-1 mt-1">Masuk</a>
              </li>
              <li class="nav-item mx-2">
                <a href="/register" class="btn bg-primary-color text-white button-register py-1 mt-1">Daftar</a>
              </li>
            @endif
          </ul>
        </div>
      </div>
    </div>
  </nav>