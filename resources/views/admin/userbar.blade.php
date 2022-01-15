<li class="nav-item dropdown">
  <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <div class="media align-items-center">
      <span>
        @php
          $avatar = \App\Helpers\AuthCommon::user()->avatar;
          $avatar = $avatar != null ? $avatar : asset('assets/img/theme/team-3.jpg');
        @endphp
        <img class="avatar avatar-sm rounded-circle" style="object-fit: cover" alt="Image placeholder" src="{{ $avatar }}">
      </span>
      <div class="media-body ml-2 d-none d-lg-block">
        <span class="mb-0 text-sm  font-weight-bold">{{ \App\Helpers\AuthCommon::user()->name }}</span>
      </div>
    </div>
  </a>
  <div class="dropdown-menu dropdown-menu-right">
    <div class="dropdown-header noti-title">
      <h6 class="text-overflow m-0">Welcome!</h6>
    </div>
    <a href="#!" class="dropdown-item">
      <i class="ni ni-single-02"></i>
      <span>My profile</span>
    </a>
    <div class="dropdown-divider"></div>
    <a href="{{ route('user.logout') }}" class="dropdown-item">
      <i class="fas fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </div>
</li>