<!doctype html>
<html lang="en" data-bs-theme="auto">
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="UPTD Latihan Kerja Dinas, Tenaga Kerja Kabupaten Tangerang">
        <meta name="author" content="Yusuf Aryadilla and Bootstrap contributors">
        <meta name="generator" content="UPTD">
        <title>Register - Page · UPTD</title>
      
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
     
    </head>
    <body class="d-flex align-items-center py-4 bg-white">

        <main class="row m-auto">
            
            <input type="hidden" id="valid" value="<?= session()->has('success') ?>">
            <input type="hidden" id="invalid" value="<?= session()->has('failed') ?>">
            <section class="form-login">
                <form class="mt-3" action="/login-admin" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <h1 class="h1 mb-2 pt-2 fw-bold my-color-primary">Masuk</h1>  
                            <small class="ms-1 my-color-secondary"><b> Administrator </b></small>
                        </div>
                        <div class="col">
                            <img src="{{ asset('img/logo.png') }}" style="height: 100px" class="float-end p-2" alt="logo">
                        </div>
                    </div>
    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-floating">
                                <input type="email" autocomplete="off" autofocus class="form-control @error('email')is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                                <label for="floatingInput">Email</label>
                                @error('email')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="form-floating">
                                <input type="password" class="form-control @error('password')is-invalid @enderror" name="password" id="password" placeholder="Password" >
                                <label for="floatingPassword">Password</label>
                                @error('password')
                                <small class="invalid-feedback">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
    
                    {{-- <div class="form-check text-start my-3"></div> --}}
                    <button class="btn my-bg-primary auth-button w-100 py-2 mt-3" type="submit">Masuk</button>
                    {{-- <p class="mt-2 ms-1 text-sm">Belum punya akun <a href="/register-admin"> Daftar disini.</a></p> --}}
                    <p class="mt-5 mb-3 text-body-secondary">Pelatihan &copy; {{date('Y')}}</p>
                </form>
            </section>
        </main>

        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="notif-success" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header my-bg-primary"> 
                    <strong class="me-auto text-white">Berhasil</strong>
                    {{-- <small>11 mins ago</small> --}}
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
       
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="notif-failed" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger"> 
                    <strong class="me-auto text-white">Proses Gagal</strong> 
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ session('failed') }}
                </div>
            </div>
        </div>

        <script src="{{ asset('js/bootstrap.bundle.min.js') }}" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
        <script> 
            
            var invalid =document.getElementById('invalid').value
            var valid =document.getElementById('valid').value
            if(valid) {
                const toastLiveExample = document.getElementById('notif-success')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample) 
                toastBootstrap.show() 
            } else if(invalid) {
                const toastLiveExample = document.getElementById('notif-failed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample) 
                toastBootstrap.show() 
            }

        </script>

    </body>
</html>
