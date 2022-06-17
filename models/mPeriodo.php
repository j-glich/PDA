<?php
try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
  } catch (\Exception $e) {
    require_once("../config/conexion.php");
  }

  function li_periodos(){
    $ip_adress= $_SERVER['REMOTE_ADDR'];

    $stmt= "CALL sp_pda_li_periodos()";
     // echo $stmt;
    $result = execQuery($stmt);
    //print_r($result);
    $periodos = array();
    //$periodos= array('clave'=>'','nombre'=>'');
  foreach( $result as $row){
    $periodos[]=array('clave'=>$row["PE_CVE"],'anio'=>$row["PE_ANIO"],'desc'=>$row["PE_DESCRIPCION"]);
  }
  // $result->free();
  return $periodos;
  }
  function li_periodo_x_clave($clave){
    $ip_adress= $_SERVER['REMOTE_ADDR'];

    $stmt= "CALL sp_li_peridodo($clave)";
     // echo $stmt;
    $result = execQuery($stmt);
    //print_r($result);
    $periodos = array();
    //$periodos= array('clave'=>'','nombre'=>'');
  foreach( $result as $row){
    $periodos[]=array('clave'=>$row["PE_CVE"],'anio'=>$row["PE_ANIO"],'desc'=>$row["PE_DESCRIPCION"], ''=>$row["cedula"] );
  }
  // $result->free();
  return $periodos;
  }


?>