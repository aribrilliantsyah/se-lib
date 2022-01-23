
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
  <label>Role</label>
  <select name="role_id" class="form-control select2">
    <option value="" disabled selected>[ Select One ]</option>
    @if (count($roles) > 0)
      @foreach ($roles as $role)
        @php
          $cvalue = old('role_id', @$data->role_id);     
        @endphp

        @if($cvalue == $role->id)
          <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
        @else
          <option value="{{ $role->id }}">{{ $role->role }}</option>
        @endif
      @endforeach
    @endif
  </select>
  @if($errors->has('role'))
    <span class="text-danger text-sm">{{ $errors->first('role') }}</span>
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
  {{--<button id="btn-reset" type="reset" class="btn btn-default"><i class="fas fa-redo"></i> Reset</button>--}}
  <a href="{{ route('user.index') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Back</a>
</div>  