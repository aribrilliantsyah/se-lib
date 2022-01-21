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
        <li class="breadcrumb-item" aria-current="page"><a href="{{ route('borrow_log.index') }}">Library</a></li>
        <li class="breadcrumb-item active" aria-current="page">Borrow</li>
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
            <h3 class="mb-0"><i class="fas fa-user"></i> Member Information</h3>
          </div>
        </div>
      </div>
      <div class="card-body" id="profile-information">
        <div class="alert alert-info"><strong>Please</strong> wait until member information showed!</div>
      </div>
    </div>
  </div>
  <div class="col-xl-12 order-xl-1">
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-8">
            <h3 class="mb-0">Borrow Books </h3>
          </div>
          <div class="col-4 text-right">
            <a href="{{ url('admin/borrow_log?member_id='.$member_id) }}" class="btn btn-sm btn-primary"><i class="fas fa-chevron-left"></i> Back</a>
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
$(() => {
  setTimeout(() => {
    get_info_member({{ @$member_id }});
  }, 2000);
})

function get_info_member(member_id){
  let url = `${base_url}admin/borrow_log/member_detail/${member_id}`;
  $.getJSON(url).done((res) => {
    if(res.status != undefined && res.status){
      let html = '<div class="alert alert-info"><strong>Please</strong> select one of any members!</div>'
      if(res.data != '' || res.data.length > 0){
        html = `<table class="table table-bordered">
          <tr>
            <td>Code</td>
            <th>${res.data.code}</th>
          </tr>
          <tr>
            <td>Full Name</td>
            <th>${res.data.full_name}</th>
          </tr>
          <tr>
            <td>Address</td>
            <th>${res.data.address}</th>
          </tr>
          <tr>
            <td>Gender</td>
            <th>${res.data.gender}</th>
          </tr>
          <tr>
            <td>Photo</td>
            <th><img onerror="this.src='${base_url}assets/img/theme/team-3.jpg'" src="${res.data.photo}" class="avatar rounded-circle"></th>
          </tr>
          <tr>
            <td>Profession</td>
            <th>${res.data.profession}</th>
          </tr>
        </table>`;
      }
      g_member_id = member_id;
      $('#profile-information').html(html)
    }
  }).fail((xhr) => {
    console.log(res)
    alert('Server is busy!')
  })
}
</script>
@endsection