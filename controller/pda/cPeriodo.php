<?php 
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

if($opcion == 1){
  $anio = $_POST['anio'];
  $fechaI = $_POST['fechaI'];
  $fechaF = $_POST['fechaF'];
  $id = $_POST['id'];
  $periododes = $_POST['dPeriodo'];

}
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mPeriodo.php");


 function listar_periodo_activo(){
    return li_periodo_activo();
  }
?>