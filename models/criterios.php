<?php
  define('ruta',$_SERVER['DOCUMENT_ROOT']);
  require_once(ruta."/ae/config/conexion.php");

  if(!isset($_SESSION))
  { session_start(); }
  

#-------------------------------------------
  function listarC($id)
#-------------------------------------------
{
    $sql = "SELECT cd_clave as id, cd_detalle as detalle FROM criterios_desempenio WHERE cd_cve_atr_eg = '$id'";
    $sql ="CALL sp_list_cd_atributo('$id')";
    return execQuery($sql);
  }

  
#-------------------------------------------
 function listarAC($asi,$c)
#-------------------------------------------
  {
    $sql="select
	CD_CLAVE, CD_DETALLE, asignatura_cd.ACD_NIVEL
FROM
	criterios_desempenio
inner join
	asignatura_cd
on
	criterios_desempenio.CD_CLAVE = asignatura_cd.ACD_CVE_CD
where
	asignatura_cd.ACD_CVE_CD LIKE '%$c%'
AND
	asignatura_cd.ACD_CVE_ASIGNATURA='$asi';";
  return execQuery($sql);
  echo $sql;

  }

#-------------------------------------------
  function criteriosAtributos($asignatura,$atributo)
#-------------------------------------------  
{    //$sql ="call sp_getCriterios('$asignatura','$atributo');";
    $sql = "select
	criterios_desempenio.CD_CLAVE
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
	ACD_CVE_ASIGNATURA='$asignatura'
AND
	atributos_egreso.AE_CLAVE= '$atributo';";
    //var_dump(execQuery($sql));
    echo $sql;
    return execQuery($sql);
  }

#-------------------------------------------
  function mUpCriterio($criterio,$desc)
#-------------------------------------------
 {
  $ip_adress= $_SERVER['REMOTE_ADDR'];
  if($ip_adress=='::1')
    $ip_adress="127.0.0.1";
 $user_id= $_SESSION['usuario_id'];
   $sql = "CALL sp_up_criterio_desempenio('$criterio', '$desc', '$ip_adress', $user_id)";
      return execQuery($sql);
 }

#-------------------------------------------
 function mInCriterio($criterio,$desc, $atributo)
#------------------------------------------- 
{
  $ip_adress= $_SERVER['REMOTE_ADDR'];
  $user_id=$_SESSION['usuario_id'];
  if($ip_adress=='::1')
    $ip_adress="127.0.0.1";
  $sql = "call sp_in_criterio_desempenio('$criterio','$desc','$atributo', '$ip_adress',$user_id)";
  echo $sql;
     return execQuery($sql);
}

#------------------------------------------- 
function buscaCriterio($criterio)
#-------------------------------------------
{
   $sql = "call sp_busca_criterio('{$criterio}')";
   //echo $sql;
   return execQuery($sql);
 }

 #--------------------------------------------------
 function mDelCriterio($criterio)
 #--------------------------------------------------
 {
  $ip_adress= $_SERVER['REMOTE_ADDR'];
  $user_id=$_SESSION['usuario_id'];
  if($ip_adress=='::1')
    $ip_adress="127.0.0.1";
    $sql = "call sp_del_criterio_desempenio('$criterio','$ip_adress',$user_id)";
    echo $sql;
    return execQuery($sql);
 }


 #------------------------------------------
 function mInDetalleCriterio($acd, $cve_asignatura,$nivel){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    $user_id=$_SESSION['usuario_id'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    $stmt= "CALL sp_in_asignatura_cd('$acd', '$cve_asignatura','$nivel', '$ip_adress',$user_id)";
    return execProcedurePeek($stmt,1);
 }
 //echo $_GET['var'];