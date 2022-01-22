
<div class="form-group">
  <label>Title</label>
  <input type="text" name="book" class="form-control" placeholder="Title" value="{{ old('book', @$data->book) }}">
  @if($errors->has('book'))
    <span class="text-danger text-sm">{{ $errors->first('book') }}</span>
  @endif
</div>
<div class="form-group">
  <label>Summary</label>
  <input type="text" name="summary" class="form-control" placeholder="Summary" value="{{ old('summary', @$data->summary) }}">
  @if($errors->has('summary'))
    <span class="text-danger text-sm">{{ $errors->first('summary') }}</span>
  @endif
</div>
<div class="form-group">
  <label>Stock</label>
  <input type="number" name="stock" class="form-control" placeholder="Stock" value="{{ old('stock', @$data->stock) }}">
  @if($errors->has('stock'))
    <span class="text-danger text-sm">{{ $errors->first('stock') }}</span>
  @endif
</div>
<div class="form-group">
  <label>Author</label>
  <select name="author_id" class="form-control select2">
    <option value="" disabled selected>[ Select One ]</option>
    @if (count($authors) > 0)
      @foreach ($authors as $author)
        @php
          $cvalue = old('author_id', @$data->author_id);     
        @endphp

        @if($cvalue == $author->id)
          <option value="{{ $author->id }}" selected>{{ $author->author }}</option>
        @else
          <option value="{{ $author->id }}">{{ $author->author }}</option>
        @endif
      @endforeach
    @endif
  </select>
  @if($errors->has('author_id'))
    <span class="text-danger text-sm">{{ $errors->first('author_id') }}</span>
  @endif
</div>
<div class="form-group">
  <label>Category</label>
  <select name="category_id[]" class="form-control select2" multiple="">
    <option value="" disabled>[ Select Multiple ]</option>
    @if (count($categories) > 0)
      @foreach ($categories as $category)
      
        @if(in_array($category->id, $catAll))
          <option value="{{ $category->id }}" selected>{{ $category->category }}</option>
        @else
          <option value="{{ $category->id }}">{{ $category->category }}</option>
        @endif

      @endforeach
    @endif
  </select>
  @if($errors->has('category_id'))
    <span class="text-danger text-sm">{{ $errors->first('category_id') }}</span>
  @endif
</div>
<div class="form-group">
  <label>cover</label>
  <div class="input-group" id="group_pp">
    <input id="thumbnail" class="form-control" type="text" name="cover" value="{{ old('cover', @$data->cover) }}" readonly>
    <span class="input-group-append">
      <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-outline-default">
        <i class="fa fa-picture-o"></i> Choose
      </button>
    </span>
  </div>
  <div id="holder" style="margin-top:15px;max-height:100px;">
    @if(@$data->cover)
      <img src="{{$data->cover}}" style="height:100px;">
    @endif
  </div>
  @if($errors->has('cover'))
    <span class="text-danger text-sm">{{ $errors->first('cover') }}</span>
  @endif
</div>
<div class="form-group">
  <button id="btn-save" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
  <button id="btn-reset" type="reset" class="btn btn-default"><i class="fas fa-redo"></i> Reset</button>
  <a href="{{ route('book.index') }}" class="btn btn-light"><i class="fas fa-arrow-left"></i> Back</a>
</div>  