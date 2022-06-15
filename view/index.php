<?php
  define('ruta',$_SERVER['DOCUMENT_ROOT']);
  //include('../config/routes.php');

  include_once '../includes/session.php';
  include_once '../includes/functions.php';

 if($session->usuarioLogeado()=="") {
  redirect("../login.php",false);
  }else{ 
    include("header.php");
    //require_once('layouts/header.php');
$carga = (isset($_GET['sp_registro'])) ? $_GET['sp_registro'] : '0';
$sp_Carga_Cat = (isset($_GET['sp_ex_cat'])) ? $_GET['sp_ex_cat'] : null;
$sp_horas = (isset($_GET['sp_carga_horas'])) ? $_GET['sp_carga_horas'] : null;
$evaluacion = (isset($_GET['sp_docenteEva'])) ? $_GET['sp_docenteEva'] : null;
$editar = (isset($_GET['sp_docente_Editar'])) ? $_GET['sp_docente_Editar'] : null;
$id_docente = (isset($_GET['cve_docente'])) ? $_GET['cve_docente'] : null;
$cve_periodo = (isset($_GET['cve_periodo'])) ? $_GET['cve_periodo'] : null;
//header('Location: view/index.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <section class="content-header">

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
}



 ?>

<script>
var carga_exito = <?php echo $carga ; ?>;
var sp_Carga_cat = "<?php echo $sp_Carga_Cat ; ?>";
var sp_horas ="<?php echo $sp_horas ; ?>";
var evaluacion ="<?php echo $evaluacion ; ?>";
var id_docente ="<?php echo $id_docente ; ?>";
var editar ="<?php echo $editar ; ?>";
var periodo ="<?php echo $cve_periodo; ?>";


 if(carga_exito ==2){
  form('pda/carga_horaria.php?cve_periodo='+periodo);
  document.getElementById('menu').style = 'display:block';
}
else if(carga_exito == 3){
  form('pda/rubros.php');
}

if(evaluacion == 1){
  document.getElementById('menu').style = 'display:block';
  form('pda/evidencias_entregas_x_docente.php?cve_docente='+id_docente+"&cve_periodo="+periodo);
}

if(editar == 1){
  document.getElementById('menu').style = 'display:block';
  form('pda/editar_plan_de_trabajo.php?cve_docente='+id_docente+"&cve_periodo="+periodo);
}
</script>
