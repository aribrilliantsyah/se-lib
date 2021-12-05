@extends('admin.parent')

@section('title', 'Member')

@section('styles')
    
@endsection

@section('breadcrum')
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-white d-inline-block mb-0">Borrow Log</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="fas fa-history"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Borrow Log</li>
      </ol>
    </nav>
  </div>
@endsection

@section('page')
  <div class="row">
    <div class="col-xl-12 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0">Report </h3>
            </div>
            <div class="col-4 text-right">
              <a href="" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf"></i> Print</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive py-4">
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th>Member</th>
                  <th>Book</th>
                  <th>Borrowed At</th>
                  <th>Returned At</th>
                  <th>Return Estimate</th>
                  <th>Late Back?</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($collection as $item)
                <tr>
                  <td>{{ $item['member'] }}</td>
                  <td>{{ $item['book'] }}</td>
                  <td>{{ date('d/m/Y', strtotime($item['borrowed_at'])) }}</td>
                  <td>{{ date('d/m/Y', strtotime($item['returned_at'])) }}</td>
                  <td>{{ date('d/m/Y', strtotime($item['return_estimate'])) }}</td>
                  <td>
                    <span class='badge badge-{{ $item['late_back'] == 'YES' ? 'success': 'danger' }}'>YES</span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    
@endsection