<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Indicadores</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../public/lib/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../public/lib/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../public/lib/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/lib/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../public/lib/css/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../public/lib/css/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../public/lib/css/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../public/lib/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../public/lib/css/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../public/lib/css/bootstrap3-wysihtml5.min.css">
  <!-- Pace style -->
  <link rel="stylesheet" href="../public/lib/css/pace.min.css">
  <link rel="stylesheet" href="../public/css/toastr.min.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!--<link href="../public/css/sb_admin_min.css" rel="stylesheet">-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  -->
</head>

<body class="hold-transition fixed skin-purple sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
      <b>IND</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
      <img src="../public/img/PDA2.png" alt="MAPA" style="height: 50px;">  
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less 
    navbar navbar-expand-lg navbar-dark primary-color
    navbar navbar-static-top -->
    <!--
    <nav class=" navbar navbar-expand-lg navbar-dark primary-color">
     Sidebar toggle button-
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu" s>
        <ul class="nav navbar-nav">

           Messages: style can be found in dropdown.less
          <li class="dropdown messages-menu">
            <a href="../cerrarSesion.php">
              <i class="fa fa-sign-out"></i>
            </a>

          </li>
           Notifications: style can be found in dropdown.less

           Tasks: style can be found in dropdown.less 

           User Account: style can be found in dropdown.less 
          <li >
            <a href="#" >
              <?php
            //    if(isset($_SESSION['user_id'])){
              ?>
              <span class="hidden-xs"><?php //echo $_SESSION['user_id']  ?></span>
            <?php // } ?>
            </a>

          </li>
          Control Sidebar Toggle Button 
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
                
        </ul>   
      </div>
    </nav>
  -->  
<nav class="navbar navbar-expand-lg navbar-dark primary-color">

<!-- Sidebar Toggle (Topbar) -->
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
  <i class="fa fa-bars"></i>
</button>         
<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
  <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow"  id="menu_desplegable"  onmouseover="ver()" onmouseout="ocultar()">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      <span class="mr-2 d-none d-lg-inline text-withe-600 small" style=""><?php echo $_SESSION["user_id"];?></span>
<!--                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
      <img class="img-profile rounded-circle" style="width: 40px; height: 40px;" src="../public/img/victor.jpg">
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" id="contenido">
      <a class="dropdown-item" onclick="form('pda/frm_mod_pass.php')">
      <!--   <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>-->
        Perfil
      </a>
      <a class="dropdown-item" href="#">
     <!--    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>-->
        Configuración 
      </a>
      <a class="dropdown-item" href="#">
       <!-- <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>-->
        Acerca de 
      </a>
      <a class="dropdown-item" href="../cerrarSesion.php">
     <!--  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>-->
    <!--   <i class="fa fa-sign-out"></i>-->
    Cerrar Sesión
        
    </a>
    </div>
  </li>
</ul>
</nav>
  </header>
<script>
  function ver(){
    document.getElementById('contenido').className = 'dropdown-menu dropdown-menu-right shadow animated--grow-in show';
  }
  function ocultar(){
    document.getElementById('contenido').className = 'dropdown-menu dropdown-menu-right shadow animated--grow-in';
  }
</script>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php
            if($_SESSION['area'] == 'ISC'){  
              echo '<ul class="sidebar-menu" data-widget="tree">
                  <li class="treeview">
                    <a href="#">
                      <i id="atr" class="fa  fa-chevron-right"></i>
                      <span>Proceso y producto &nbsp&nbsp&nbsp'.$_SESSION['area'].'</span>
                      <span class="pull-right-container">
                        <span class="label label-primary pull-right"></span>
                      </span>
                    </a>
                    <ul id="menu" class="treeview-menu">';
                  echo '<li><a onclick="form(\''.'pda'.'/'.'rubros'.'.php\')" href="#"><i class="fa fa-clone"></i>rubros</a></li>';              
                  echo '<li><a onclick="form(\''.'pda'.'/'.'categoria'.'.php\')" href="#"><i class="fa fa-clone"></i>Categorías</a></li>';              
                  echo '<li><a onclick="form(\''.'pda'.'/'.'subcategoria'.'.php\')" href="#"><i class="fa fa-clone"></i>Subcategorias</a></li>';           
                  echo '<li><a onclick="form(\''.'pda'.'/'.'producto'.'.php\')" href="#"><i class="fa fa-clone"></i>Producto</a></li>';           
                  echo '<li><a onclick="form(\''.'pda/carga_horaria.php?cve_periodo='.$_SESSION['periodo'].'\')" href="#"><i class="fa fa-folder-open"></i>Carga Horaria</a></li>';   
                  echo '<li><a onclick="form(\''.'pda'.'/'.'control_evaluacion'.'.php?cve_periodo='.$_SESSION['periodo'].'\')" href="#"><i class="fa fa-address-card"></i>Editar o Evaluar plan de trabajo</a></li>';
                  echo '<li><a onclick="form(\''.'pda'.'/'.'plan_de_trabajo'.'.php\')" href="#"><i class="fa fa-briefcase"></i>Plan de Trabajo</a></li>';            
                  echo '<li><a onclick="form(\''.'pda'.'/'.'periodo'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Periodo</a></li>';           
                //  echo '<li><a onclick="form(\''.'pda'.'/'.'cierre_evaluacion'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Subcaterorias</a></li>';
                //  echo '<li><a onclick="form(\''.'pda'.'/'.'entrega_evidencia'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Entrega de evidencias</a></li>';              
                 // echo '<li><a onclick="form(\''.'pda'.'/'.'constancia_cumplimiento'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Constancia Cumplimiento</a></li>';
                  //echo '<li><a onclick="form(\''.'pda'.'/'.'generar_pda_8'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Constancia Cumplimiento</a></li>';
            }else if($_SESSION['area'] == 'DOC'){
              echo '<ul class="sidebar-menu" data-widget="tree">
              <li class="treeview">
                <a href="#">
                  <i id="atr" class="fa  fa-chevron-right"></i>
                  <span>Productos &nbsp&nbsp&nbsp'.$_SESSION['area'].'</span>
                  <span class="pull-right-container">
                    <span class="label label-primary pull-right"></span>
                  </span>
                </a>
                <ul class="treeview-menu">';
              echo '<li><a  onclick="form(\''.'pda'.'/'.'entrega_actividades'.'.php?cve_docente='.$_SESSION["id_docente"].'&cve_periodo='.$_SESSION["periodo"].'\')" href="#"><i class="fa fa-briefcase"></i>Asignacion de Actividades</a></li>';              
             // echo '<li><a href="#"><i class="fa fa-clone"></i>Categorías</a></li>';              
            //echo '<li><a href="#"><i class="fa fa-clone"></i>Subcategorias</a></li>';           
            //  echo '<li><a href="#"><i class="fa fa-clone"></i>Producto</a></li>';           
              //echo '<li><a href="#"><i class="fa fa-folder-open"></i>Carga Horaria</a></li>';   
             // echo '<li><a href="#"><i class="fa fa-address-card"></i>Registro de Actividad</a></li>';         
            } 
            ?>
              
          </ul>
          
        </li>
        </ul>
        
        <?php
            if($_SESSION['area'] == 'ISC'){  
              echo '<ul class="sidebar-menu" data-widget="tree">
                  <li class="treeview">
                    <a style="font-size: 10px;" href="#">
                      <i id="atr" class="fa  fa-chevron-right"></i>
                      <span>Seguimiento y Evaluación PDA &nbsp&nbsp&nbsp'.$_SESSION['area'].'</span>
                      <span class="pull-right-container">
                        <span class="label label-primary pull-right"></span>
                      </span>
                    </a>
                    <ul class="treeview-menu">';
                  echo '<li><a onclick="form(\''.'pda'.'/'.''.'.php\')" href="#"><i class="fa fa-clone"></i>Segimiento</a></li>';              
                  echo '<li><a onclick="form(\''.'pda'.'/'.''.'.php\')" href="#"><i class="fa fa-clone"></i>Evaluación</a></li>';              
                 
                //  echo '<li><a onclick="form(\''.'pda'.'/'.'evaluación'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Evaluación</a></li>';           
                //  echo '<li><a onclick="form(\''.'pda'.'/'.'cierre_evaluacion'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Subcaterorias</a></li>';
                //  echo '<li><a onclick="form(\''.'pda'.'/'.'entrega_evidencia'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Entrega de evidencias</a></li>';              
                 // echo '<li><a onclick="form(\''.'pda'.'/'.'constancia_cumplimiento'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Constancia Cumplimiento</a></li>';
                  //echo '<li><a onclick="form(\''.'pda'.'/'.'generar_pda_8'.'.php\')" href="#"><i class="fa fa-circle-o"></i>Constancia Cumplimiento</a></li>'; 
            } 
            ?>
              
          </ul>
          
        </li>
        </ul>
    </section>

   
    <!-- /.sidebar -->
  </aside>

