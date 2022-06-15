<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
  } catch (\Exception $e) {
    require_once("../config/conexion.php");
  }


  function li_docentes(){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    $stmt= "CALL sp_li_docentes()";
     // echo $stmt;
    $result = execQuery($stmt);
    //print_r($result);
    $docentes = array();
    //$docentes= array('clave'=>'','nombre'=>'');
  foreach( $result as $row){
    $docentes[]=array('clave'=>$row["cve"],'nombre1'=>$row["nom1"],'grado'=>$row["grado"], 'cedula'=>$row["cedula"] );
  }
  // $result->free();
  return $docentes;
  }


?>