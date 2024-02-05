<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('adminlte/images/c3.webp') }}" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @can('master-data-list')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              {{-- <i class="fas fa-cogs nav-icon"></i> --}}
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">

              @can('brand-list')
              <li class="nav-item">
                <a href="{{ url('admin/brands') }}" class="nav-link">
                  <i class="far fa-copyright nav-icon"></i>
                  <p>
                    Brand
                  </p>
                </a>
              </li>
              @endcan

              @can('category-list')
              <li class="nav-item">
                <a href="{{ url('admin/categories') }}" class="nav-link">
                  {{-- <i class="fas fa-solid fa-list nav-icon"></i> --}}
                  <i class="fas fa-solid fa-sitemap nav-icon"></i>
                  <p>
                    Category
                  </p>
                </a>
              </li>
              @endcan

            </ul>
          </li>
          @endcan

          @can('product-list')
          <li class="nav-item">
            <a href="{{ url('admin/products') }}" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Product
              </p>
            </a>
          </li>
          @endcan

          <li class="nav-item">
            <a href="{{ url('admin/orders') }}" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Order
              </p>
            </a>
          </li>

          @can('user-list')
            <li class="nav-item">
              <a href="{{ url('admin/users') }}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Users</p>
              </a>
            </li>
          @endcan

          <li class="nav-item">
            <a href="{{ url('admin/subscribers') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Subscribers
              </p>
            </a>
          </li>

          @can('setting-list')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-cogs nav-icon"></i>
              <p>
                Setting
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">

              @can('admin-list')
              <li class="nav-item">
                <a href="{{ url('admin/admin-accounts') }}" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
              @endcan

              @can('role-list')
              <li class="nav-item">
                <a href="{{ url('admin/roles') }}" class="nav-link">
                  <i class="fas fa-dice-three nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              @endcan

              @can('permission-list')
              <li class="nav-item">
                <a href="{{ url('admin/permissions') }}" class="nav-link">
                  <i class="fas fa-gavel nav-icon"></i>
                  <p>Permissions</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>