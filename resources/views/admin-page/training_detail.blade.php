@extends('admin-page.layouts.main_layout')

@section('content-pages')

<div class="content-header">
    <div class="container-fluid">
      <div class="row my-2">
        <div class="col-sm-6">
          <h3 class="m-0 ml-2">{{ $title}}</h3>
        </div><!-- /.col --> 
      </div><!-- /.row -->
      <hr style="margin-bottom: 0">
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row mx-2">
          <div class="row justify-content-end mb-2 w-100">
            <a href="/service-detail/create"  class="btn float-right btn-add "><i class="fas fa-plus-square"></i> &nbsp; Data</a>
          </div>
          <table class="table table-bordered table-sm">
              <thead>
                  <tr class="my-bg-primary text-white">
                      <th style="width: 5%">No.</th>
                      <th style="width: 14%">Pelatihan</th>
                      <th style="width: 14%">Konten Pelatihan</th>
                      <th>Deskripsi Konten</th>
                      <th style="width: 7%; text-align: center;">Status</th>
                      <th style="width: 8%; text-align: center;">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($dataTrainingDetail as $row)
                  <tr>
                      <td>{{ $row->id }}</td>
                      <td>{{ $row->training->title }}</td>
                      <td>{{ $row->title }}</td>
                      <td>{{ Str::length($row->description) > 90 ? Str::substr($row->description, 0, 90).'...' : Str::substr($row->description, 0, 90) }}</td>
                      <td style=" text-align: center;">{{ $row->is_active == 'Y' ? 'Aktif' : 'Tidak Aktif' }}</td>
                      <td style=" text-align: center;">
                        <a href="/service-detail/{{$row->id}}/edit" class="text-warning"><i class="fas fa-edit"></i></a>
                        &nbsp; 
                        <a href="/service-detail/delete/{{$row->id}}" class="text-danger"><i class="fas fa-trash-alt"></i></i></a> 
                      </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
        </div>
    </div>

</section> 
    
@endsection