
<nav class="navbar navbar-expand-lg bg-body-tertiary rounded-2" style="background-image: linear-gradient(to left, #c2f9ff, #ffffff)">
  <div class="container-fluid">
    <a class="navbar-brand" href="/" aria-label="Brand Name"><b>UPTD Latihan Kerja Dinas Tenaga Kerja Kab. Tangerang</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="d-flex">
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="https://wa.me/+6285179626211" target="_blank" aria-label="whatsapp">
              <i class="fab fa-whatsapp" style="font-size: 18px;"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.instagram.com/uptdlkdisnakerkab.tangerang?igshid=NGVhN2U2NjQ0Yg%3D%3D" target="_blank" aria-label="instagram">
              <i class="fab fa-instagram" style="font-size: 18px;"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://web.facebook.com/rezaandhika27?mibextid=LQQJ4d&_rdc=1&_rdr" target="_blank" aria-label="facebook">
              <i class="fab fa-facebook" style="font-size: 18px;"></i>
            </a>
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
              <a class="nav-link {{ Request::segment(1) == '#' ? 'active-link' : '' }}" href="https://disnaker.tangerangkab.go.id/" target="_blank">Website Dinas Tenaga Kerja</a>
            </li>
            
            <li class="nav-item mx-2">
              <a class="nav-link {{ Request::segment(1) == '#' ? 'active-link' : '' }}" href="https://siapkerja.tangerangkab.go.id/home" target="_blank">Siap kerja</a>
            </li>
            
            @if (auth()->guard('participant')->user())
              <li class="nav-item mx-2">
                <a href="/wishlist" class="btn {{ Request::segment(1) == 'wishlist' ? 'btn-success' : 'btn-outline-success' }} register py-1 mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Pelatihan saya">
                  <i class="fas fa-chart-bar"></i>
                </a>
              </li>
              <li class="nav-item mx-2">
                <a href="/_profile" class="btn btn-outline-danger register py-1 mt-1" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Profile">
                 Hi, {{ auth()->guard('participant')->user()->fullname }}
                </a>
              </li>
              <li class="nav-item mx-2">
                <button type="button" class="btn btn-danger" id="logout" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Logout">
                  <i class="fas fa-sign-out-alt"></i>
                </button>
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

  <div class="modal fade" id="logout-modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><b>Logout</b></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin keluar dari sistem ?</p>
        </div>
        <form action="/logout" method="post">
          @csrf
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn text-white bg-primary-color">Ya</button>
          </div>
        </form>
      </div>
    </div>
  </div>