<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pelatihan - UPTD </title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
  </head>
  <?php 
  $brand_name = 'My-Skills';
  ?>
  <body class="header-babble">
    
    <main class="container-fluid layout-box">
      
      <div class="wrapper">
        {{-- NAVBAR --}}
        <nav class="navbar navbar-expand-lg sticky-top" id="navigasi">
          <div class="container-fluid mx-0">
            <a class="navbar-brand" href="#">{{ $brand_name }}</a>
            <div class="d-flex">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item mx-2">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Features</a>
                  </li>
                  <li class="nav-item mx-2">
                    <a class="nav-link" href="#">Pricing</a>
                  </li>
                  
                  <li class="nav-item mx-2 dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown link
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
  
                  <li class="nav-item mx-2">
                    <a href="/login" class="btn primary-color button-login py-1 mt-1">Masuk</a>
                  </li>
                  <li class="nav-item mx-2">
                    <a href="/register" class="btn bg-primary-color text-white button-register py-1 mt-1">Daftar</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
  
        {{-- HEADER --}}
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
      </div>

      <div class="service-panel my-4">
        <div class="heading text-center">
          <div class="mt-3">
            <span style="font-size: 26px; font-weight: 600">Rintis Karis Bersama {{$brand_name}}</span>
          </div>
        </div>
        <div class="row mt-3">
          <?php for ($i=0; $i < 4; $i++) { ?>
            <div class="col-lg-3 col-md-3 col-sm-6">
              <div class="box-service">
              </div>
            </div>
          <?php } ?>
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
    
    </main>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
      function doSomething(scrollPos) {
        if(scrollPos >= 99) {
          document.getElementById('navigasi').classList.remove('bg-transparent')
          document.getElementById('navigasi').style.background = 'rgba(177, 215, 235, 0.509)'
        } else {
          document.getElementById('navigasi').classList.add('bg-transparent')
        }
      }
      document.addEventListener("scroll", (event) => {
        lastKnownScrollPosition = window.scrollY;
        let ticking = false;
        if (!ticking) {
          window.requestAnimationFrame(() => {
            doSomething(lastKnownScrollPosition);
            ticking = false;
          });

          ticking = true;
        }
      });

    </script>
  </body>
</html>