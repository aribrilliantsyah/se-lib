@extends('admin.parent')

@section('title', 'Category')

@section('breadcrum')
<div class="col-lg-6 col-7">
  <h6 class="h2 text-white d-inline-block mb-0">Category</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
      <li class="breadcrumb-item"><a href="#"><i class="ni ni-settings"></i></a></li>
      <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
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
            <h3 class="mb-0">Update Category </h3>
          </div>
        </div>
      </div>
      <div class="card-body">
        @include('admin.alert')
        <form action="{{ route('category.update', $id) }}" method="POST">
          @csrf
          @method('PUT')
          
          @include('pages.category.form')            
        </form>
      </div>
    </div>
  </div>
</div>
@endsection