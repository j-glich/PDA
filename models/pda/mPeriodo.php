<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
  } catch (\Exception $e) {
    require_once("../config/conexion.php");
  }
  switch ($opcion) {
    case '1':
      $ip_adress= $_SERVER['REMOTE_ADDR'];
      if($ip_adress=='::1')
        $ip_adress="127.0.0.1";
      //Actualizar el valor del usuario tomando el valor de la sesión
        $user=200;
      
      $stmt= "call sp_pda_li_nuevo_periodo('$id', '$fechaI', '$fechaF','$anio','$periododes','$ip_adress','$user')";
     //echo $stmt;
      execQuery($stmt);
    break;
  }
function li_periodo_activo(){
    $stmt= "call sp_pda_li_periodo_activo()";
   // echo $stmt;
    $result = execQuery($stmt);
    $periodo_actual = array();
    foreach( $result as $row){
       $periodo_actual=array(
           'PE_CVE'=>$row["PE_CVE"],
           'PE_FECHA_INICIO'=>$row["PE_FECHA_INICIO"],
        'PE_FECHA_FIN'=>$row['PE_FECHA_FIN'],
        'PE_ANIO'=>$row['PE_ANIO'],
        'PE_DESCRIPCION'=>$row['PE_DESCRIPCION']);
    }

    return $periodo_actual;

  }
?>