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
  <h6 class="h2 text-white d-inline-block mb-0">Member</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
      <li class="breadcrumb-item"><a href="#"><i class="ni ni-spaceship"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ route('member.index') }}">Member</a></li>
      <li class="breadcrumb-item active" aria-current="page">Update</li>
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
          <div class="col-12">
            <h3 class="mb-0">Update Member </h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        @include('admin.alert')
        <form action="{{ route('member.update', $id) }}" method="POST">
          @csrf
          @method('PUT')
          
          @include('pages.member.form')            
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script>
  $('#btn-sh-password').on('click', () => {
    let icon = $('#btn-sh-password i').attr('class');
    if(icon == 'fa fa-eye-slash'){
      $('#password').attr('type', 'text')
      $('#btn-sh-password i').attr('class', 'fa fa-eye')
    }else{
      $('#password').attr('type', 'password')
      $('#btn-sh-password i').attr('class', 'fa fa-eye-slash')
    }
  })

  $('#lfm').filemanager('image');
</script>
@endsection