
<div class="form-group">
  <label>Category</label>
  <input type="text" name="category" class="form-control" placeholder="Category" value="{{ old('category', @$data->category) }}">
  @if($errors->has('category'))
    <span class="text-danger text-sm">{{ $errors->first('category') }}</span>
  @endif
</div>
<div class="form-group">
  <button id="btn-save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
  {{--<button id="btn-reset" type="reset" class="btn btn-default"><i class="fas fa-redo"></i> Reset</button>--}}
  <a href="{{ route('category.index') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Back</a>
</div>  