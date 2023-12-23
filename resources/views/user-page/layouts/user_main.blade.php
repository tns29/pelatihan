<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pelatihan - UPTD </title>
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/mystyle.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
    
  </head>
    
  <body class="header-babble">
    
    <main class="container-fluid layout-box">
      
      <div class="wrapper">
        {{-- NAVBAR --}}
        @include('user-page.layouts.navbar')
  
        {{-- HEADER --}}
        @yield('header-pages')
        
      </div>

      @yield('content-pages')
      
      <footer style="bottom:0 !important;">
        <br>
        <hr>
        <div> &copy; UPTD KAB. TANGERANG {{ date('Y') }} by 
            <a href="https://yusufarya.my.id" target="_blank" class="text-decoration-none">29tech.id</a>
            All rights reserved.</div>
      </footer>
    </main>
    <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- jQuery -->
    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('public/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    
    @if (isset($script))
      <script src="{{ asset('public/'.$script) }}.js"></script>
    @endif
    
    <script src="{{ asset('public/js/custom.js') }}"></script>

    <script>

      
      $('#logout').on('click', () => {
        $('#logout-modal').modal('show')
      })
      const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
      const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
      
      function doSomething(scrollPos) {
        if(scrollPos >= 99) {
          document.getElementById('navigasi').classList.remove('bg-transparent')
          document.getElementById('navigasi').style.background = 'rgba(255, 255, 255, 0.79)'
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
