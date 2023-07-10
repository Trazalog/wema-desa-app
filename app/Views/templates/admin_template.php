
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WEMA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <!--   <link rel="stylesheet" href="<?= base_url()?>/public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- jQuery -->
  <script src="<?= base_url()?>/public/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url()?>/public/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url()?>/public/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url()?>/public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url()?>/public/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/css/adminlte.min.css">
  
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/css/stylesTrazalog.css">
  <!-- Plugin form multiples tabs JS -->
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/bs-stepper/css/bs-stepper.min.css">
  

  <!-- Balkan and Balkan style -->  
  <script src="<?= base_url() ?>/lib/balkan/orgchart/orgchart.js"></script>
  <link rel="stylesheet" type="t-ext/css" src="<?= base_url() ?>/lib/balkan/css/stylesBalkan.css">

  <!-- Bootstrap Switch -->
  <script src="<?= base_url()?>/public/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- Plugin checkboxs into toggles -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <!-- Sweet Alert 2 -->
  <script src="<?= base_url()?>/lib/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" src="<?= base_url()?>/lib/sweetalert2/dist/sweetalert2.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Scripts para Notificaciones -->
  <script src="<?= base_url()?>/lib/notificaciones.js"></script>
  <!--Scripts Generales -->
  <script src="<?= base_url()?>/lib/scriptsGenerales.js"></script>
  <!--Scripts para Formularios -->
  <script src="<?= base_url()?>/lib/forms.js"></script>
  <!--Recorder JS -->
  <script src="<?= base_url()?>/lib/recorderjs/dist/recorder.js"></script>
  <!-- Masonry Plugin -->
  <script src="<?= base_url()?>/public/plugins/masonry/masonry.pkgd.min.js"></script>
  <!-- WaveSurfer Plugin -->
  <script type="module" src="<?= base_url()?>/public/plugins/wavesurfer/wavesurfer_6.6.4.js"></script>
  <script type="module" src="<?= base_url()?>/public/plugins/wavesurfer/plugin_wavesurfer.microphone_6.6.3.min.js"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url()?>/public/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

    
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?= base_url()?>/public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
       <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> 

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <!-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('dashboard') ?>" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              
            </ul> 
          </li>  -->
          <li class="nav-item">
            <a href="<?= site_url('persona') ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Persona
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('cuenta') ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Cuenta
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('cliente') ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Clientes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('persona/cargarListadoEntrevistados') ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Entrevista
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('resultado') ?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Revisar Resultados
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->renderSection('content') ?>
    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2023 <a href="https://trazalog.com/">TRAZALOG.COM</a>.</strong>
    All rights reserved.
  <!--   <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div> -->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- iCheck -->
<link rel="stylesheet" href="<?= base_url()?>/public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>/public/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url()?>/public/plugins/summernote/summernote-bs4.min.css">

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script>
  $.widget.bridge('uibutton', $.ui.button)
  //Definicion de variables JS con valores PHP
  frmUrl = "<?= site_url('form') ?>";
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url()?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url()?>/public/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url()?>/public/plugins/sparklines/sparkline.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url()?>/public/plugins/moment/moment.min.js"></script>
<script src="<?= base_url()?>/public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url()?>/public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url()?>/public/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url()?>/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>/public/dist/js/adminlte.js"></script>

<!-- Select2 -->
<script src="<?= base_url()?>/public/plugins/select2/js/select2.full.min.js"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url()?>/public/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url()?>/public/dist/js/pages/dashboard.js"></script> -->

<!-- plugin form multiples tabs JS-->
<script src="<?= base_url()?>/public/plugins/bs-stepper/js/bs-stepper.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?= base_url()?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url()?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url()?>/public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url()?>/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url()?>/public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url()?>/public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url()?>/public/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url()?>/public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url()?>/public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url()?>/public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url()?>/public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url()?>/public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<!-- Balkan Orgchart -->
<!--<script src="<?= base_url() ?>/lib/balkan/js/balkanAdmin.js"></script>-->


<!-- lenguaje datatable NO FUNCA-->
<!-- <script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>  -->


</body>
</html>
