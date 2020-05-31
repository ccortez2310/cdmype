<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link navbar-navy">
      <img src="views/img/plantilla/logo.png" alt="CDMYPE" class="brand-image img-circle elevation-3"
           style="opacity: 1">
      <span class="brand-text font-weight-light"><b>CDMYPE</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">

          <?php

          if($_SESSION["foto"] != ""){

            echo '<img src="'.$_SESSION["foto"].'" class="img-circle elevation-2" alt="'.$_SESSION["nombre"].'">';

          }else{


            echo '<img src="views/img/usuarios/default/anonymous.png" class="img-circle elevation-2" alt="usuario">';

          }

          ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["nombre"]; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-leaf"></i>
              <p>
                Gestión Insumos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="insumos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Insumos</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-cart-arrow-down"></i>
                    <p>
                        Gestión Compras
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="proveedores" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Proveedores</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="compras" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Compras</p>
                        </a>
                    </li>
                </ul>
            </li>
<!--          <li class="nav-item">-->
<!--            <a href="#" class="nav-link">-->
<!--              <i class="nav-icon fas fa-th"></i>-->
<!--              <p>-->
<!--                Simple Link-->
<!--                <span class="right badge badge-danger">New</span>-->
<!--              </p>-->
<!--            </a>-->
<!--          </li>-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>