  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Brunch Me</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <!-- Dashboard -->
          <li class="nav-item">
            <a href="{{route('admin.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- Dashboard End -->

          <!-- Users -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.users.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="{{route('admin.users.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New User</p>
                </a>
              </li> -->
            </ul>
          </li>

          <li class="nav-item {{request()->is('admins/business') || request()->is('admins/business/*')?'menu-open':''}}">
            <a href="#" class="nav-link {{request()->is('admins/business') || request()->is('admins/business/*')?'active':''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Business Management<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.business.index')}}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="{{route('admin.users.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New User</p>
                </a>
              </li> -->
            </ul>
          </li>
          
          <!-- Users End -->

          <!-- Category -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.category.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.category.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Category</p>
                </a>
              </li>
            </ul>
          </li> -->
          <!-- Category End -->
           <!-- Product -->
           <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.product.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.product.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Product</p>
                </a>
              </li>
            </ul>
          </li> -->
          <!-- Product End -->

          <!-- vendors -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Vendors
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.vendors.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.vendors.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Vendor</p>
                </a>
              </li>
            </ul>
          </li> -->
          <!-- vendors End -->

          <!-- vendors -->
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Sliders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.sliders.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.sliders.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Slider</p>
                </a>
              </li>
            </ul>
          </li> -->
          <!-- vendors End -->

           <!-- Settings -->
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.settings.change-password')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="{{route('admin.settings.slider')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Slider</p>
                </a>
              </li> -->
            </ul>
          </li>
          <!-- Settings End -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>