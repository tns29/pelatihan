@extends('admin-page.layouts.main_layout')

@section('content-pages')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 ml-2"> {{ $title }}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard </li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$calonPeserta}}</h3>

            <p>Calon Peserta</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/data-participant" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$peserta}}</h3>

            <p>Peserta</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="/data-participant" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <form id="approveTraining" action="registrant" method="GET" hidden>
          @csrf
          <input type="text" name="status" id="status" value="Y">
        </form>
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$pesertaApprove}}</h3>

            <p>Pendaftar Pelatihan</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" onclick="approveTraining()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <form id="declineTraining" action="registrant" method="GET" hidden>
          @csrf
          <input type="text" name="status" id="status" value="N">
        </form>
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$pesertaDecline}}</h3>

            <p>Pendaftar Pelatihan Ditolak</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" onclick="declineTraining()" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Monthly Recap Report</h5>

              {{-- <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-wrench"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a href="#" class="dropdown-item">Action</a>
                    <a href="#" class="dropdown-item">Another action</a>
                    <a href="#" class="dropdown-item">Something else here</a>
                    <a class="dropdown-divider"></a>
                    <a href="#" class="dropdown-item">Separated link</a>
                  </div>
                </div>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                {{-- <div class="col-md-8">
                  <p class="text-center">
                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div> --}}
                <!-- /.col -->
                <div class="col-md-12">
                  <p class="text-center">
                    <strong>Rekap Pendaftaran Berdasarkan Kecamatan</strong>
                  </p>
                  @foreach ($registrant_group as $item)
                    <div class="progress-group">
                      <p>
                        
                      </p>
                      {{ $item->sub_district_name }}
                      <span class="float-right"><b>{{ $item->count }}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: <?= ($item->count / $countRegistrant)*(1*100) ?>%"></div>
                      </div>
                    </div>
                  @endforeach

                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div> 
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- Main row -->
    <div class="row" hidden>
      <section class="col-lg-12 connectedSortable">

        <!-- PRODUCT LIST -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Recently Added Products</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <ul class="products-list product-list-in-card pl-2 pr-2">
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">Samsung TV
                    <span class="badge badge-warning float-right">$1800</span></a>
                  <span class="product-description">
                    Samsung 32" 1080p 60Hz LED Smart HDTV.
                  </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">Bicycle
                    <span class="badge badge-info float-right">$700</span></a>
                  <span class="product-description">
                    26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                  </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">
                    Xbox One <span class="badge badge-danger float-right">
                    $350
                  </span>
                  </a>
                  <span class="product-description">
                    Xbox One Console Bundle with Halo Master Chief Collection.
                  </span>
                </div>
              </li>
              <!-- /.item -->
              <li class="item">
                <div class="product-img">
                  <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                </div>
                <div class="product-info">
                  <a href="javascript:void(0)" class="product-title">PlayStation 4
                    <span class="badge badge-success float-right">$399</span></a>
                  <span class="product-description">
                    PlayStation 4 500GB Console (PS4)
                  </span>
                </div>
              </li>
              <!-- /.item -->
            </ul>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a href="javascript:void(0)" class="uppercase">View All Products</a>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->

      </section>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection