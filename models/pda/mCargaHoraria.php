<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
  } catch (\Exception $e) {
    require_once("../config/conexion.php");
  }

  function mAddCarga($cve_docente, $cargaH){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
      $periodo='20221';
    $stmt= "call sp_in_carga_actividad_x_scat('$cargaH', '$cve_docente', '$periodo', '$ip_adress',$user)";
   //echo $stmt;
    $result = ejecutarConsulta($stmt);
    return "OK";


  }

  function mDelCategoria($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_categoria('$clave', '', '','I','$ip_adress',$user)";
  //  echo $stmt;
    $result = ejecutarConsulta($stmt);
    echo " Se ha borrado";


  }


  function mUpCategoria($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_categoria('$clave', '$titulo', '$desc','','$ip_adress',$user)";
   // echo $stmt;
    $result = ejecutarConsulta($stmt);
   // echo " Se ha actualizado";


  }

function liCategoriaXClave($clave){
    $stmt= "call sp_li_cat_x_cve('$clave')";
   // echo $stmt;
    $result = execQuery($stmt);
    foreach( $result as $row){
       $categorias=array('clave'=>$row["CAT_CVE"],'titulo'=>$row["CAT_TITULO"],'desc'=>$row["CAT_DESCRIPCION"]);
    }
    print_r($categorias);
    return $categorias;

  }
?>