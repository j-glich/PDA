<?php
  include_once 'includes/session.php';
  include_once 'includes/functions.php';

  if($session->usuarioLogeado()=="") {
    redirect("login.php",false);
  }else{
    //require_once('layouts/header.php');
    redirect("view/index.php");
//header('Location: view/index.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
    <section id="alerta">
    </section>
  </section>
    <!-- Main content -->
    <section class="content">
      <div id="area">
      </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php  require_once ("footer.php");
} ?>

