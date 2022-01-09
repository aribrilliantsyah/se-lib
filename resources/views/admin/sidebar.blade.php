<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
  
  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header d-flex align-items-center">
      <a class="navbar-brand">
        <img src="{{ asset('img/logo2.png') }}" class="navbar-brand-img" alt="..." style="max-height: 5rem !important;">
      </a>
      <div class="ml-auto">
        <!-- Sidenav toggler -->
        <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar-inner">
      @php
        use App\Helpers\Menu;
        
        $prefix = Request::segment(1);
        $menu = '';

        if($prefix == 'admin'){
          $obj_menu = new Menu();
          $obj_menu->init()
            ->start_group()
            ->item('Dashboard', 'ni ni-tv-2', 'admin/dashboard', Request::is('admin/dashboard'))
            ->item('Member', 'ni ni-spaceship', 'admin/member', Request::is('admin/member'))
            ->item('Library', 'ni ni-books', 'admin/borrow_log', Request::is('admin/borrow_log'))
            ->end_group()
            ->divinder('Master Data')
            ->start_group()
            ->item('Author', 'ni ni-single-02', 'admin/author', Request::is('admin/author'))
            ->item('Category', 'ni ni-bulb-61', 'admin/category', Request::is('admin/category'))
            ->item('Book', 'ni ni-ruler-pencil', 'admin/book', Request::is('admin/book'))
            ->end_group()
            ->divinder('Report')
            ->start_group()
            ->item('Borrow Log', 'fas fa-history', 'admin/borrow_log/report', Request::is('admin/borrow_log/report'))
            ->end_group()
            ->divinder('User Management')
            ->start_group()
            // ->item('Role', 'ni ni-settings-gear-65', 'admin/role', Request::is('admin/role'))
            ->item('User', 'ni ni-settings', 'admin/user', Request::is('admin/user'))
            ->end_group();
            
            $menu = $obj_menu->to_html();
          }else if($prefix == 'member'){
            $obj_menu = new Menu();
            $obj_menu->init()
              ->start_group()
              ->item('Dashboard', 'ni ni-tv-2', 'member/dashboard', Request::is('member/dashboard'))
              ->end_group()
              ->divinder('Report')
              ->start_group()
              ->item('Borrow Log', 'fas fa-history', 'member/borrow_log/report', Request::is('member/borrow_log/report'))
              ->end_group();
        
            $menu = $obj_menu->to_html();
        }
    
      @endphp
      {!! $menu !!}
    </div>
  </div>
</nav>