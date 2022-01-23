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
              <h5 class="card-title text-uppercase text-muted mb-0">All Members</h5>
              <span class="h2 font-weight-bold mb-0">{{ $total_member }}</span>
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
              <h5 class="card-title text-uppercase text-muted mb-0">Books Borrowed</h5>
              <span class="h2 font-weight-bold mb-0">{{ $total_borrowed }}</span>
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
              <h5 class="card-title text-uppercase text-muted mb-0">TOTAL ADMIN</h5>
              <span class="h2 font-weight-bold mb-0">{{ $total_admin }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                <i class="ni ni-settings"></i>
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
              <h5 class="card-title text-uppercase text-muted mb-0">BOOKS RETURNED</h5>
              <span class="h2 font-weight-bold mb-0">{{ $total_returned }}</span>
            </div>
            <div class="col-auto">
              <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
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
  <div class="row">
    <div class="col-xl-6">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Borrowing history</h3>
            </div>
            <div class="col text-right">
              <a href="{{ route('borrow_log.index') }}" class="btn btn-sm btn-primary">See all</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Member</th>
                <th scope="col">Book</th>
                <th scope="col">Date Transaction</th>
                <th scope="col">Returned?</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($borrowing_history as $item)
                <tr>
                  <th scope="row">{{ $item->member->full_name }}</th>
                  <td><span class="badge badge-info">{{ $item->book->book }}</span></td>
                  <td>{{ date('d/m/Y H:i:s', strtotime($item->created_at)) }}</td>
                  <td>
                    <span class='badge badge-{{ $item->is_returned == 1 ? 'success': 'danger' }}'>{{ $item->is_returned == 1 ? 'YES': 'NO' }}</span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xl-6">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Popular Books</h3>
            </div>
            <div class="col text-right">
              <a href="{{ route('borrow_log.index') }}" class="btn btn-sm btn-primary">See all</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">Books</th>
                <th scope="col">Borrower</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($popular_books as $item)   
              <tr>
                <th scope="row">{{ $item->title }}</th>
                <td>{{ $item->total }}</td>
                <td>
                  <div class="d-flex align-items-center">
                    @php
                      $percent = $item->total/$total_borrowed*100;    
                      $percent = round($percent);
                    @endphp
                    <span class="mr-2">{{ $percent }}%</span>
                    <div>
                      <div class="progress">
                        <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="{{ $percent }}" aria-valuemin="0" 
                        aria-valuemax="100" style="width: {{ $percent }}%;"></div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    
@endsection