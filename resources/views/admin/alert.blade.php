@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
  <span class="alert-inner--text"><strong>Success!</strong> {{ session('success') }}</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
@elseif(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <span class="alert-inner--icon"><i class="fa fa-times"></i></span>
  <span class="alert-inner--text"><strong>Error!</strong> {{ session('error') }}</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@elseif(session()->has('warning'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <span class="alert-inner--icon"><i class="fa fa-warning"></i></span>
  <span class="alert-inner--text"><strong>Warning!</strong> {{ session('warning') }}</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
@elseif(session()->has('info'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
  <span class="alert-inner--icon"><i class="fas fa-info-circle"></i></i></span>
  <span class="alert-inner--text"><strong>Info!</strong> {{ session('info') }}</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
