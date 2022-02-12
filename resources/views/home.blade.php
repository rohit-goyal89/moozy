@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$ownerCount}}</h3>

                <p>Restaurant Owner Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('users.index') }}?role=2" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$driverCount}}</h3>

                <p>Driver Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('users.index') }}?role=3" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$customerCount}}</h3>

                <p>Customer Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('users.index') }}?role=4" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$pageCount}}</h3>

                <p>CMS Pages</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('pages.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">

<section class="col-lg-6 connectedSortable">

<div class="card">
  <div class="card-header border-0">
<h3 class="card-title">
<i class="fas fa-map-marker-alt mr-1"></i>
Sales
</h3>
</div>
<div class="card-body">
 <div class="tab-content p-0">

<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
<canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
</div>
<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
<canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
</div>
</div>
</div>
</div>



</section>


<section class="col-lg-5 connectedSortable">

<div class="card bg-gradient-primary" style="display:none;">
<div class="card-header border-0">
<h3 class="card-title">
<i class="fas fa-map-marker-alt mr-1"></i>
Visitors
</h3>

<div class="card-tools">
<button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
<i class="far fa-calendar-alt"></i>
</button>
<button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
<i class="fas fa-minus"></i>
</button>
</div>

</div>
<div class="card-body">
<div id="world-map" style="height: 150px; width: 100%;"></div>
</div>

<div class="card-footer bg-transparent">
<div class="row">
<div class="col-4 text-center">
<div id="sparkline-1"></div>
<div class="text-white">Visitors</div>
</div>

<div class="col-4 text-center">
<div id="sparkline-2"></div>
<div class="text-white">Online</div>
</div>

<div class="col-4 text-center">
<div id="sparkline-3"></div>
<div class="text-white">Sales</div>
</div>

</div>

</div>
</div>


<div class="card bg-gradient-info">
<div class="card-header border-0">
<h3 class="card-title">
<i class="fas fa-th mr-1"></i>
Order Graph
</h3>
<div class="card-tools">
<button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
<i class="fas fa-minus"></i>
</button>
</div>
</div>
<div class="card-body">
<canvas class="chart" id="line-chart" style="min-height: 150px; height: 150px; max-height: 150px; max-width: 100%;"></canvas>
</div>

<div class="card-footer bg-transparent">
<div class="row">
<div class="col-4 text-center">
<input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC">
<div class="text-white">Mail-Orders</div>
</div>

<div class="col-4 text-center">
<input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">
<div class="text-white">Online</div>
</div>

<div class="col-4 text-center">
<input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">
<div class="text-white">In-Store</div>
</div>

</div>

</div>

</div>



</section>

</div>
</div>
@endsection
