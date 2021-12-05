@extends('admin.parent')

@section('title', 'Library')

@section('styles')
    
@endsection

@section('breadcrum')
  <div class="col-lg-6 col-7">
    <h6 class="h2 text-white d-inline-block mb-0">Library</h6>
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
      <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
        <li class="breadcrumb-item"><a href="#"><i class="ni ni-books"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Library</li>
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
              <h3 class="mb-0"><i class="fas fa-search"></i> Search Members</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div class="input-group mb-3">
              <select class="form-control" id="member" name="member_id" readonly></select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0"><i class="fas fa-user"></i> Member Information</h3>
            </div>
          </div>
        </div>
        <div class="card-body" id="profile-information">
          <div class="alert alert-info"><strong>Please</strong> select one of any members!</div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 order-xl-1">
      <div class="card">
        <div class="card-header">
          <div class="row align-items-center">
            <div class="col-8">
              <h3 class="mb-0"><i class="fas fa-book"></i> Detail Books</h3>
            </div>
            <div class="col-4 text-right">
              <a href="" class="btn btn-sm btn-primary" id="borrow_button" style="display: none;"><i class="ni ni-fat-add"></i> Borrow</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive py-4">
            <table class="table dt_table table-flush table-vertical-align" id="borrowed_books">
              <thead class="thead-light">
                <tr>
                  <th>Cover</th>
                  <th>Book</th>
                  <th>Borrowed At</th>
                  <th>Returned?</th>
                  <th>Return Estimate</th>
                  <th>Late Back?</th>
                  <th>Action</th>
                </tr>
            </thead>
              <tbody>
              
              </tbody>
              <tfoot>
                <tr>
                  <th>Cover</th>
                  <th>Book</th>
                  <th>Borrowed At</th>
                  <th>Returned?</th>
                  <th>Return Estimate</th>
                  <th>Late Back?</th>
                  <th>Action</th>
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