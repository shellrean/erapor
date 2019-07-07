<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | SMKN 43 JAKARTA</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/dist/img/brand.png" type="image/x-icon">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/sweetalert2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/skins/_all-skins.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/custom.css">
    <!-- jQuery 3 -->
    <script src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/dist/js/sweetalert.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/font.css">
  </head>
  <body class="hold-transition skin-pink sidebar-mini fixed">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="../../index2.html" class="logo">

          <span class="logo-mini"><b>S</b>SM</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="<?= base_url() ?>assets/dist/img/favicon.png" alt=""><b>Raport</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <!-- <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a> -->

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/dist/img/default.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= $this->session->userdata('name') ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url(); ?>assets/dist/img/default.png" class="img-circle" alt="User Image">
                    <p>
                      <?= $this->session->userdata('name') ?> - <?= $this->session->userdata('jabatan') ?>
                      <small>Member since Nov. 2017</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                    </div>
                    <div class="pull-right">
                      <a href="<?= base_url(); ?>login/out" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url(); ?>assets/dist/img/default.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?= $this->session->userdata('name') ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            <!-- area menu dinamis -->
            <?php 
            $menu = $this->session->userdata('menu');
            $main_menu = $this->db->get_where('tabel_menu',array('is_main_menu'=>0,'type'=>$menu))->result();
            foreach ($main_menu as $main) {
              // cek apakah ada sub menu
              
              $submenu = $this->db->get_where('tabel_menu',array('is_main_menu'=>$main->id_menu));
              if ($submenu->num_rows()>0) {
                // tampilkan sub menu disini
                echo "<li class='treeview'>
                        <a href='#'>
                          <i class='".$main->icon."'></i> <span>".$main->nama_menu."</span>
                          <span class='pull-right-container'>
                            <i class='fa fa-angle-left pull-right'></i>
                          </span>
                        </a>
                        <ul class='treeview-menu'>";
                        foreach ($submenu->result() as $sub) {
                          echo "<li>".anchor($sub->link, "<i class='".$sub->icon."'></i>".$sub->nama_menu)."</li>";
                        }
                  echo "</ul>
                    </li>";
              }
              else {
                // tampilkan main menu
                echo "<li>".anchor($main->link, "<i class='".$main->icon."'></i>".$main->nama_menu)."</li>";
              }
            }
            ?>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <?php echo $content_view; ?>
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0 Beta
        </div>
        <strong>Copyright &copy; 2018 <a href="<?= base_url(); ?>">ICT 43</a></strong> All rights reserved |By Kuswandi and Safikri Zikri S.Kom | Page load on <strong>{elapsed_time}</strong> second
        
      </footer>

      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?= base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?= base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url(); ?>assets/dist/js/demo.js"></script>
    <script>
      $(document).ready(function () {
        $('.sidebar-menu').tree()
      })
    </script>
  </body>
</html>
