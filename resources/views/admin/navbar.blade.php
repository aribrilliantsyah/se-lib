<nav class="navbar navbar-top navbar-expand navbar-dark bg-danger border-bottom">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Search form -->
      {{-- @include('admin.searchform') --}}
      <!-- Navbar links -->
      <ul class="navbar-nav align-items-center ml-md-auto">
        <li class="nav-item d-xl-none">
          <!-- Sidenav toggler -->
          <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </li>
        {{-- @include('admin.searchbar') --}}
        {{-- @include('admin.notification') --}}
        {{-- @include('admin.shortcut') --}}
      </ul>
      <ul class="navbar-nav align-items-center ml-auto ml-md-0">
        @include('admin.userbar')
      </ul>
    </div>
  </div>
</nav>