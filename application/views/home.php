<!DOCTYPE html>
<html clear="all">
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="shortcut icon" href="<?php echo base_url('assets/icon/favicon.ico');?>">
        
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.css');?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/plugins/fontawesome/css/font-awesome.css');?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('assets/plugins/ionicons/css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <!-- <link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" /> -->
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/dist/css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="<?php echo base_url('assets/dist/css/skins/_all-skins.css');?>" rel="stylesheet" type="text/css" />
        <!-- <link href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" /> -->
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js');?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>" type="text/javascript"></script>    
        <!-- FastClick -->
        <!-- <script src='<?php echo base_url('assets/plugins/fastclick/fastclick.min.js');?>'></script> -->
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('assets/dist/js/app.js');?>" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->

        <script src="<?php echo base_url('assets/dist/Chart.bundle.js');?>"></script>
        <script src="<?php echo base_url('assets/utils.js');?>"></script>

        <style>
            canvas {
                -moz-user-select: none;
                -webkit-user-select: none;
                -ms-user-select: none;
            }
            .chart-container {
                width: 100%;
                margin-left: 20px;
                margin-right: 20px;
                margin-bottom: 20px;
            }
            .container {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .container2 {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .container3 {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .container4 {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .container5 {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .container6 {
                display: flex;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }
        </style>    

    </head>
    <body class="skin-blue fixed">
        <div class="wrapper">
            <header class="main-header">
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="" class="logo" style="width: 230px"> Dashboard Monitoring</a>
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url('assets/icon/favicon.ico');?>" class="user-image" alt="User Image"/>
                                    <span class="hidden-xs"><?php echo $this->session->userdata('nama_user'); ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo base_url('assets/icon/favicon.ico');?>" class="img-circle" alt="User Image" />
                                        <p><?php echo $this->session->userdata('nama_user'); ?> - <?php echo $this->session->userdata('unit_up'); ?><small>Member since <?php echo $this->session->userdata('tglinsert'); ?></small></p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo base_url('home/logout');?>" class="btn btn-default btn-flat btn-block">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
      
            <aside class="main-sidebar">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url('assets/icon/favicon.ico');?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $this->session->userdata('nama_user'); ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>                    
         
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <!-- <li <?php if ($konten=='309_rupiah/vdashboard') {echo "class=active";} ?>>
                            <a href="<?php echo base_url('Rupiah_309/main');?>"><i class="fa fa-bar-chart"></i><span> Dashboard</span></a>
                        </li> -->
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-bar-chart"></i> <span>309 Rupiah</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('Rupiah_309/data309/perbulan');?>"><i class="fa fa-circle-o"></i> Perbulan All</a></li>
                            <li><a href="<?php echo base_url('Rupiah_309/data309/kumulatif');?>"><i class="fa fa-circle-o"></i> Perbulan Akumulasi/ Kumulatif</a></li>
                            <li><a href="<?php echo base_url('Rupiah_309/delta309/delta');?>"><i class="fa fa-circle-o"></i> Perbulan Delta</a></li>
                          </ul>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-bar-chart"></i> <span>309 Kwh</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('Rupiah_309/data309/allKwh');?>"><i class="fa fa-circle-o"></i> Perbulan All</a></li>
                            <li><a href="<?php echo base_url('Rupiah_309/data309/kumulatifKwh');?>"><i class="fa fa-circle-o"></i> Perbulan Akumulasi/ Kumulatif</a></li>
                            <li><a href="<?php echo base_url('Rupiah_309/delta309/deltaKwh');?>"><i class="fa fa-circle-o"></i> Perbulan Delta</a></li>
                          </ul>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-bar-chart"></i> <span>404 Saldo</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('data_404/saldo');?>"><i class="fa fa-circle-o"></i> Perbulan All</a></li>
                            <li><a href="<?php echo base_url('data_404/delta_saldo');?>"><i class="fa fa-circle-o"></i> Perbulan Delta</a></li>
                          </ul>
                        </li>
                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-bar-chart"></i> <span>404 Pelunasan</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('data_404/pelunasan');?>"><i class="fa fa-circle-o"></i> Perbulan All</a></li>
                            <li><a href="<?php echo base_url('data_404/delta_pelunasan');?>"><i class="fa fa-circle-o"></i> Perbulan Delta</a></li>
                          </ul>
                        </li>

                       <!--  <li <?php if ($konten=='statistik/index') {echo "class=active";} ?>>
                            <a href="<?php echo base_url('statistik');?>"><i class="fa fa-file-archive-o"></i><span> Dashboard</span></a>
                        </li> -->
                    </ul>
                </section>
            </aside>

            <div class="content-wrapper">
                <?php $this->load->view($konten); ?>
            </div>

            <footer class="main-footer">
                <strong>Copyright &copy; 2016 <a href="#">AP2T</a>.</strong> All rights reserved.
            </footer>

        </div>
    </body>
</html>
