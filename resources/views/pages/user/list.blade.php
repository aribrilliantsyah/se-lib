@extends('admin.parent')

@section('title', 'Book')

@section('styles')
<style>
  .avatar{
    object-fit: cover;
  }
</style>
@endsection

@section('breadcrum')
<div class="col-lg-6 col-7">
  <h6 class="h2 text-white d-inline-block mb-0">User</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
      <li class="breadcrumb-item"><a href="#"><i class="ni ni-settings"></i></a></li>
      <li class="breadcrumb-item active" aria-current="page">User</li>
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
            <h3 class="mb-0">List User </h3>
          </div>
          <div class="col-4 text-right">
            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary btn-fab btn-icon btn-round"><i class="fas fa-plus-square"></i> Create New Data</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        @include('admin.alert')
        <div class="table-responsive py-4">
          {!! $dataTable->table(['class' => 'table dt_table table-flush table-vertical-align']) !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
{!! $dataTable->scripts() !!}

<script>
  function destroy(target, id){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#007bff',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      console.log(result)
      if (result.value) {
        $.ajax({
          url: target,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'DELETE',
          data: {
            id: id
          },
          success: function (response){
            Swal.fire(
              response.message,
              '',
              'info'
            )
            setTimeout(() => {
              //Change to id datatable
              window.LaravelDataTables["users-table"].draw()
            }, 500);
          }
        });
      }
    })
  }
</script>
@endsection