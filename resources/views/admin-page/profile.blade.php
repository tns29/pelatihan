@extends('admin-page.layouts.main_layout')

@section('content-pages')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h2 class="m-0 ml-2">{{ $title}}</h2>
      </div><!-- /.col -->  
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
      <div class="row">
        
        <div class="col-lg-7">
            <div class="p-3 elevation-2 rounded-2">
                <div class="row">
                    <div class="col-lg-3">
                        @if(!$auth_user->images)
                            <img src="{{ asset('img/userDefault.png') }}" class="img-circle elevation-0" style="height: 150px;" alt="User Image">
                        @else
                            <img src="{{ asset('/storage').'/'.$auth_user->images }}" class="img-circle elevation-0" style="height: 150px; width: 155px;" alt="User Image">
                        @endif
                    </div>
                    <div class="col-lg-8">
                        <h4 class="font-weight-bold">{{ $auth_user->number }}</h4>
                        <h4>{{ $auth_user->fullname }}</h4>
                        <hr>
                        Pengelola Unit Pelaksana Teknis ( UPT ) yang secara  operasional merupakan penunjang sebagian tugas Disnaker Kabupaten Tangerang
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="p-3 elevation-2 rounded-2">
                <table class="table mt-2">
                    <tr>
                        <td>Telp / Hp</td>
                        <td> {{ $auth_user->no_telp }} </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> {{ $auth_user->email }} </td>
                    </tr>
                    <tr>
                        <td>Status Akun</td>
                        <td> {{ $auth_user->is_active == "Y" ? "Aktif" : "Tidak Aktif" }} </td>
                    </tr>
                </table>
            </div>
        </div>
        
      </div>
      
      <div class="row justify-content-end p-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn my-bg-primary text-white" data-toggle="modal" data-target="#exampleModal">
          Logout <i class="fa fa-sign-out-alt"></i> 
        </button>
      </div>

    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title fs-5" id="exampleModalLabel">Anda ingin keluar dari aplikasi ?</h4>
      </div>
      <form action="/logout-admin" method="post">
        @csrf
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"> Tidak </button> 
          <button type="submit" class="btn my-bg-primary text-white">Ya, Keluar</button>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection