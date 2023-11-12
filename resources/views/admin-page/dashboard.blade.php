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
            <h3>150</h3>

            <p>New Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Bounce Rate</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>44</h3>

            <p>User Registrations</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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

              <div class="card-tools">
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
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Goal Completion</strong>
                  </p>

                  <div class="progress-group">
                    Add Products to Cart
                    <span class="float-right"><b>160</b>/200</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <div class="progress-group">
                    Complete Purchase
                    <span class="float-right"><b>310</b>/400</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger" style="width: 75%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Visit Premium Page</span>
                    <span class="float-right"><b>480</b>/800</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Send Inquiries
                    <span class="float-right"><b>250</b>/500</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-warning" style="width: 50%"></div>
                    </div>
                  </div>
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
    <div class="row">   
      <section class="col-lg-7 connectedSortable">

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

        <!-- USERS LIST -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Latest Members</h3>

            <div class="card-tools">
              <span class="badge badge-danger">8 New Members</span>
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
            <ul class="users-list clearfix">
              <li>
                <img src="dist/img/user1-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Alexander Pierce</a>
                <span class="users-list-date">Today</span>
              </li>
              <li>
                <img src="dist/img/user8-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Norman</a>
                <span class="users-list-date">Yesterday</span>
              </li>
              <li>
                <img src="dist/img/user7-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Jane</a>
                <span class="users-list-date">12 Jan</span>
              </li>
              <li>
                <img src="dist/img/user6-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">John</a>
                <span class="users-list-date">12 Jan</span>
              </li>
              <li>
                <img src="dist/img/user2-160x160.jpg" alt="User Image">
                <a class="users-list-name" href="#">Alexander</a>
                <span class="users-list-date">13 Jan</span>
              </li>
              <li>
                <img src="dist/img/user5-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Sarah</a>
                <span class="users-list-date">14 Jan</span>
              </li>
              <li>
                <img src="dist/img/user4-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Nora</a>
                <span class="users-list-date">15 Jan</span>
              </li>
              <li>
                <img src="dist/img/user3-128x128.jpg" alt="User Image">
                <a class="users-list-name" href="#">Nadia</a>
                <span class="users-list-date">15 Jan</span>
              </li>
            </ul>
            <!-- /.users-list -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-center">
            <a href="javascript:">View All Users</a>
          </div>
          <!-- /.card-footer -->
        </div>
        <!--/.card -->  

      </section>
      
      <section class="col-lg-5 connectedSortable">
        <!-- Calendar -->
        <div class="card bg-gradient-success">
          <div class="card-header border-0">

            <h3 class="card-title">
              <i class="far fa-calendar-alt"></i>
              Calendar
            </h3>
            <!-- tools card -->
            <div class="card-tools">
              <!-- button with a dropdown -->
              <div class="btn-group">
                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                  <i class="fas fa-bars"></i>
                </button>
                <div class="dropdown-menu" role="menu">
                  <a href="#" class="dropdown-item">Add new event</a>
                  <a href="#" class="dropdown-item">Clear events</a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">View calendar</a>
                </div>
              </div>
              <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body pt-0">
            <!--The calendar -->
            <div id="calendar" style="width: 100%"></div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </section>
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection