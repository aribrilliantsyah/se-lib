@extends('admin.parent')

@section('title', 'Dashboard')

@section('styles')
    
@endsection

@section('breadcrum')
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="ni ni-tv-2"></i></a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
@endsection

@section('page')
  <div class="row">
    <div class="col-xl-3">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Books borrowed</h5>
              <span class="h2 font-weight-bold mb-0">{{ $total_borrowed }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                <i class="ni ni-spaceship"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
            <span class="text-nowrap"></span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Books Returned</h5>
              <span class="h2 font-weight-bold mb-0">{{ $total_returned }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-blue text-white rounded-circle shadow">
                <i class="ni ni-books"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
            <span class="text-nowrap"></span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Late return</h5>
              <span class="h2 font-weight-bold mb-0">{{ $late_return }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-red text-white rounded-circle shadow">
                <i class="fas fa-times"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
            <span class="text-nowrap"></span>
          </p>
        </div>
      </div>
    </div>
    <div class="col-xl-3">
      <div class="card card-stats">
        <!-- Card body -->
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="card-title text-uppercase text-muted mb-0">Timely Return</h5>
              <span class="h2 font-weight-bold mb-0">{{ $timely_return }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                <i class="fas fa-undo"></i>
              </div>
            </div>
          </div>
          <p class="mt-3 mb-0 text-sm">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
            <span class="text-nowrap"></span>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    
@endsection