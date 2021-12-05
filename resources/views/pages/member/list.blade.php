@extends('admin.parent')

@section('title', 'Member')

@section('styles')
<style>
  .avatar{
    object-fit: cover;
  }
</style>
@endsection

@section('breadcrum')
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-white d-inline-block mb-0">Member</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="ni ni-spaceship"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Member</li>
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
              <h3 class="mb-0">List Member </h3>
            </div>
            <div class="col-4 text-right">
              <a href="" class="btn btn-sm btn-primary"><i class="ni ni-fat-add"></i> Create</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive py-4">
            <table class="table dt_table table-flush table-vertical-align" >
              <thead class="thead-light">
                <tr>
                  <th>Action</th>
                  <th>Photo</th>
                  <th>Code</th>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Address</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($collection as $item)
                <tr>
                  <td>
                    <a href="#" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                  <td><img class="avatar rounded-circle" src="{{ $item['photo'] }}"></td>
                  <td>{{ $item['code'] }}</td>
                  <td>{{ $item['full_name'] }}</td>
                  <td>{{ $item['gender'] }}</td>
                  <td>{{ $item['address'] }}</td>
                </tr>
              @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>Action</th>
                  <th>Photo</th>
                  <th>Code</th>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Address</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
    
@endsection