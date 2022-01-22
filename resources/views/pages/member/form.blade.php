
<div class="form-group">
  <label>Full Name</label>
  <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{ old('name', @$data->name) }}">
  @if($errors->has('name'))
    <span class="text-danger text-sm">{{ $errors->first('name') }}</span>
  @endif
</div>
<div class="form-group">
  <label>Gender</label>
  <select name="gender" class="form-control select2">
    @php
      $cvalue = old('gender', @$data->gender);     
    @endphp
    <option value="Male"   @if($cvalue == 'Male') selected  @endif >Male</option>
    <option value="Female" @if($cvalue == 'Female') selected  @endif>Female</option> 
  </select>
  @if($errors->has('gender'))
    <span class="text-danger text-sm">{{ $errors->first('gender') }}</span>
  @endif
</div>
<div class="form-group">
  <label>Address</label>
  <textarea class="form-control" name="address" placeholder="Address">{{ old('address', @$data->address) }}</textarea>
  @if($errors->has('address'))
    <span class="text-danger text-sm">{{ $errors->first('address') }}</span>
  @endif
</div>
<div class="form-group">
  <label>Professiom</label>
  <input type="text" name="profession" class="form-control" placeholder="Professiom" value="{{ old('profession', @$data->profession) }}">
  @if($errors->has('profession'))
    <span class="text-danger text-sm">{{ $errors->first('profession') }}</span>
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
    <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ old('photo', @$data->photo) }}" readonly>
    <span class="input-group-append">
      <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-outline-default">
        <i class="fa fa-picture-o"></i> Choose
      </button>
    </span>
  </div>
  <div id="holder" style="margin-top:15px;max-height:100px;">
    @if(@$data->photo)
      <img src="{{$data->photo}}" style="height:100px;">
    @endif
  </div>
  @if($errors->has('photo'))
    <span class="text-danger text-sm">{{ $errors->first('photo') }}</span>
  @endif
</div>
<div class="form-group">
  <button id="btn-save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
  <button id="btn-reset" type="reset" class="btn btn-default"><i class="fas fa-redo"></i> Reset</button>
  <a href="{{ route('user.index') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Back</a>
</div>  