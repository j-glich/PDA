<?php
//require_once("../pruebas/conectar.php");
session_start();
try {
  require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
} catch (\Exception $e) {
  require_once("../config/conexion.php");
}


function addAtributo($atributo, $descripcion){
  $ip_adress= $_SERVER['REMOTE_ADDR'];
  if($ip_adress=='::1')
    $ip_adress="127.0.0.1";
  
  //echo $ip_adress." ss ";
  $stmt= "CALL sp_in_atributo('$atributo', '$descripcion', '$ip_adress')";
     //echo $stmt. ";   " ;
  //$sql="INSERT INTO atributos(AT_CVE,AT_DESCRIPCION) VALUES('$atributo','$descripcion')";
  return ejecutarConsulta($stmt);
}

#------------------------------------------
function mlistAE($area){
#------------------------------------------
  $stmt="call sp_listar_ae_area('".$_SESSION['area']."')";

  return execProcedurePeek($stmt,1);;
}

#------------------------------------------
function mDelAtributo($atributo){
  #------------------------------------------
    $stmt="call sp_del_atributo('$atributo')";
  
    return ejecutarConsulta($stmt);
  }


function listar(){
  $sql="select * from atributos_egreso;";
  return execQuery($sql);
}

  function atributosAsigna($id){
    //$sql="call atr_mat('$id')";
    $sql="select
	atributos_egreso.AE_CLAVE, atributos_egreso.AE_DESCRIPCION
from
	atributos_egreso
inner join
	criterios_desempenio
on
	criterios_desempenio.CD_CVE_ATR_EG = atributos_egreso.AE_CLAVE
inner join
	asignatura_cd
on
	asignatura_cd.ACD_CVE_CD = criterios_desempenio.CD_CLAVE
where
	ACD_CVE_ASIGNATURA='$id'
group by AE_CLAVE;";
//echo $sql;
    return execQuery($sql);
  }

  function buscaAtributo($atributo){
    $sql ="call sp_busca_atributo('{$atributo}');";
    return execQuery($sql);
  }

  function actualizaAtributo($atributo,$desc){
    $sql="call sp_up_atributo('{$desc}','{$atributo}');";
    return execQuery($sql);
  }
?>