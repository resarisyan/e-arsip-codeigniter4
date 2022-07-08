 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->
     <a href="<?= route_to('superadmin.dashboard') ?>" class="brand-link">
         <img src="<?= base_url(); ?>/assets/images/logo.png" alt="E-Arsip Logo" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         <span class="brand-text font-weight-light">E-Arsip</span>
     </a>

     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 <img src="<?= base_url(); ?>/assets/images/superadmin.png" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
                 <span class="d-block text-white"><?= session()->get('nama_user') ?></span>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                 <li class="nav-item">
                     <a href="<?= route_to('superadmin.dashboard'); ?>" class="nav-link <?= ($halaman == 'dashboard') ? 'active' : '' ?>">
                         <i class="nav-icon fas fa-tachometer-alt"></i>
                         <p>
                             Dashboard
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= route_to('superadmin.kategori'); ?>" class="nav-link <?= ($halaman == 'kategori') ? 'active' : '' ?>">
                         <i class="nav-icon fas fa-cubes"></i>
                         <p>
                             Kategori
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= route_to('superadmin.departemen') ?>" class="nav-link <?= ($halaman == 'departemen') ? 'active' : '' ?>">
                         <i class="nav-icon fa fa-laptop-medical"></i>
                         <p>
                             Departemen
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= route_to('superadmin.arsip') ?>" class="nav-link <?= ($halaman == 'arsip') ? 'active' : '' ?>">
                         <i class="nav-icon fas fas fa-exchange-alt"></i>
                         <p>
                             Arsip
                         </p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="<?= route_to('superadmin.user') ?>" class="nav-link <?= ($halaman == 'user') ? 'active' : '' ?>">
                         <i class="nav-icon fas fa-user"></i>
                         <p>
                             User
                         </p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>