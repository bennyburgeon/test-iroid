<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="height: 50px;padding:.5rem 1rem;">
      <img src="{{asset('image/logo-white.png')}}" alt="AdminLTE Logo" class=" elevation-10" style="height: 40px; object-fit: cover;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- SidebarSearch Form -->
 <!--      <div class="form-inline">
        <div class="col-lg-auto col-2 d-flex align-items-lg-center"> -->
          <!-- <div style="background-color: white;"> -->
          <!-- <a class="header-logo"><img src="image/logo.png" style="width: 200px;" alt="" class="img-fluid"></a> -->
       <!--  </div> -->
      <!-- </div> -->
        <!-- <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div> -->
      <!-- </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
           
          </li> -->
  <li class="nav-item">
  <a href="#" class="nav-link">
  <i class="nav-icon fas fa-tachometer-alt"></i>
  <p>Company<i class="right fas fa-angle-left"></i></p> </a>
      <ul class="nav nav-treeview" style="display: none;">
        
        <li class="nav-item">
          <a href="{{route('admin.company.index')}}" id="marq" class="nav-link">
          <i class="far fa-circle nav-icon"></i><p> List</p>
          </a>
        </li>
      </ul>
  </li> 

  <li class="nav-item">
  <a href="#" class="nav-link">
  <i class="nav-icon fas fa-tachometer-alt"></i>
  <p>Employee<i class="right fas fa-angle-left"></i></p> </a>
      <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
          <a href="{{route('admin.employee.index')}}" class="nav-link" id="carousalid">
          <i class="far fa-circle nav-icon"></i><p>List</p>
          </a>
        </li>
      </ul>
  </li> 


           
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>