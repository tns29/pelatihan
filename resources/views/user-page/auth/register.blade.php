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

    <style>
        body {
            padding: 1.5rem 0;
        }
        @media (max-width: 768px) {
            body {
                padding: 1.5rem 0;
                margin-top: 100px;
            }
            .form-register {
                max-width: 100%;
                padding: 1rem;
                margin: 0px;
            }
            .box-input label {
                font-size: 12px;
                /* width: 35%; */
                margin-left: 0.2rem !important;
                margin-right: 0.8rem !important;
            }
            .box-input input {
                font-size: 12px;
            }
            .box-input select {
                font-size: 10px;
            }
        }
    </style>

    <body class="d-flex align-items-center bg-white">

        <main class="row">
            <div class="col-lg-7 col-md-6 col-sm-6">
                <img class="hero-img" src="{{asset('img/hero.png')}}" alt="" style="width: 97%; height:auto">
            </div>
            <div class="col-lg-5 col-md-6 col-sm-6">
                <section class="form-register">
                    <input type="hidden" id="valid" value="<?= session()->has('success') ?>">
                    <input type="hidden" id="invalid" value="<?= session()->has('failed') ?>">
                    <form class="mt-5" action="/register" method="POST">
                        @csrf
                        <h1 class="h3 mb-3 fw-bold my-color-primary">Buat Akun Untuk Menjadi Peserta</h1>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-floating box-input">
                                    <input type="text" autocomplete="off" class="form-control @error('fullname')is-invalid @enderror" name="fullname" id="fullname" maxlength="50" placeholder="Nama lengkap" onkeyup="generateUsername()" value="{{ old('fullname') }}">
                                    <label for="floatingInput">Nama Lengkap</label>
                                    @error('fullname')
                                    <small class="invalid-feedback">
                                        Nama Lengkap {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-floating box-input">
                                    <input type="text" autocomplete="off" class="form-control @error('username')is-invalid @enderror" name="username" id="username" maxlength="20" placeholder="name@example.com" onkeyup="changeUsername()" value="{{ old('username') }}">
                                    <label for="floatingInput">Username</label>
                                    @error('username')
                                    <small class="invalid-feedback">
                                        Username {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating box-input">
                                    <select class="form-control @error('gender')is-invalid @enderror" name="gender" id="gender">
                                        <option value="">Pilih</option>
                                        <option value="M" {{ old('gender') == "M" ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="F" {{ old('gender') == "F" ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <label for="floatingInput">Jenis kelamin</label>
                                    @error('gender')
                                    <small class="invalid-feedback">
                                        Jenis Kelamin {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating box-input">
                                    <input type="text" autocomplete="off" class="form-control @error('no_telp')is-invalid @enderror" name="no_telp" id="no_telp" maxlength="20" placeholder="08XXXXXXXX" value="{{ old('no_telp') }}" onkeyup="onlyNumbers(this)">
                                    <label for="floatingInput">No. Telp</label>
                                    @error('no_telp')
                                    <small class="invalid-feedback">
                                        No. Telp {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-floating box-input">
                                    <input type="email" autocomplete="off" class="form-control @error('email')is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{ old('email') }}">
                                    <label for="floatingInput">Email</label>
                                    @error('email')
                                    <small class="invalid-feedback">
                                        Email {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating box-input">
                                    <input type="password" autocomplete="off" class="form-control @error('password')is-invalid @enderror" name="password" id="password" placeholder="Password">
                                    <label for="floatingPassword">Password</label>
                                    @error('password')
                                    <small class="invalid-feedback">
                                        Password {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating box-input">
                                    <input type="password" autocomplete="off" class="form-control @error('password_confirmation')is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Password">
                                    <label for="floatingPassword">Konfirmasi Password</label>@error('password')
                                    <small class="invalid-feedback">
                                        Konfirmasi Password {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <button class="btn my-bg-primary auth-button w-100 py-2 mt-2" type="submit">Register</button>
                        <p class="mt-2 ml-2 text-sm">Sudah punya akun ? <a href="/login"> Masuk disini.</a></p>
                        <p class="mt-5 mb-3 text-body-secondary">UPTD | Kab. Tangerang &copy; {{date('Y')}}</p>
                    </form>
                </section>
            </div>
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
            function onlyNumbers(input) {
                // Remove non-numeric characters using a regular expression
                input.value = input.value.replace(/[^0-9]/g, "");
            }

            function changeUsername() {
                const username = document.getElementById('username').value
                const usnm = username.replaceAll(' ', '_')
                console.log(usnm)
                document.getElementById('username').value = usnm.toLowerCase()
            }

            function generateUsername() {
                const fullname = document.getElementById('fullname').value
                const username = document.getElementById('username')
                const usnm = fullname.replace(' ', '_')

                username.value = usnm.substring(0,10).toLowerCase()
            }

            var invalid =document.getElementById('invalid').value
            var valid =document.getElementById('valid').value
            if(valid) {
                const toastLiveExample = document.getElementById('notif-success')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastBootstrap.show()
            } else if(invalid) {
                const toastLiveExample = document.getElebuatmentById('notif-failed')
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastBootstrap.show()
            }

        </script>

    </body>
</html>
