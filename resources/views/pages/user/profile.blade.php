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
            <h3 class="mb-0">Update User </h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        @include('admin.alert')
        <form action="{{ route('user.update_profile', $id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', @$data->name) }}">
            @if($errors->has('name'))
              <span class="text-danger text-sm">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username', @$data->username) }}">
            @if($errors->has('username'))
              <span class="text-danger text-sm">{{ $errors->first('username') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', @$data->email) }}">
            @if($errors->has('email'))
              <span class="text-danger text-sm">{{ $errors->first('email') }}</span>
            @endif
          </div>
          <div class="form-group" id="group_pw">
            <label>Password</label>
            <div class="input-group">
              <input type="password" name="password" class="form-control" placeholder="Password" id="password">
              <div class="input-group-append">
                <button class="btn btn-outline-default" type="button" id="btn-sh-password"><i class="fa fa-eye-slash"></i></button>
              </div>
            </div>
            @if($errors->has('password'))
              <span class="text-danger text-sm">{{ $errors->first('password') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label>Profile Picture</label>
            <div class="input-group" id="group_pp">
              <input id="thumbnail" class="form-control" type="text" name="avatar" value="{{ old('avatar', @$data->avatar) }}" readonly>
              <span class="input-group-append">
                <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-outline-default">
                  <i class="fa fa-picture-o"></i> Choose
                </button>
              </span>
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;">
              @if(@$data->avatar)
                <img src="{{$data->avatar}}" class="prev-image">
              @endif
            </div>
            @if($errors->has('avatar'))
              <span class="text-danger text-sm">{{ $errors->first('avatar') }}</span>
            @endif
          </div>
          <div class="form-group">
            <button id="btn-save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
          </div>  
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