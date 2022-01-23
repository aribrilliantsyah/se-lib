
<div class="form-group">
  <label>Author</label>
  <input type="text" name="author" class="form-control" placeholder="Author" value="{{ old('author', @$data->author) }}">
  @if($errors->has('author'))
    <span class="text-danger text-sm">{{ $errors->first('author') }}</span>
  @endif
</div>
<div class="form-group">
  <button id="btn-save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
  {{--<button id="btn-reset" type="reset" class="btn btn-default"><i class="fas fa-redo"></i> Reset</button>--}}
  <a href="{{ route('author.index') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Back</a>
</div>  