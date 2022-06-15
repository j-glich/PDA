<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
  } catch (\Exception $e) {
    require_once("../config/conexion.php");
  }


  function li_producto(){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";

      $stmt= "CALL sp_li_producto()";

 

  $result = execQuery($stmt);
  //echo '***'.$result -> num_rows;
  $productos = array();
  //$rubros= array('clave'=>'','titulo'=>'','desc'=>'');
  foreach( $result as $row){
    $productos[]=array('clave'=>$row["PR_CVE"],'titulo'=>$row["PR_TITULO"],'desc'=>$row["PR_DESCRIPCION"]);
  }

  return $productos;


  }

  function mDelProducto($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_producto('$clave', '', '','I','$ip_adress',$user)";
    //echo $stmt;
    $result = ejecutarConsulta($stmt);
    echo " Se ha borrado";


  }


  function mUpProducto($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_producto('$clave', '$titulo', '$desc','','$ip_adress',$user)";
    //echo $stmt;
    $result = ejecutarConsulta($stmt);
   // echo " Se ha actualizado";
   echo 'ok';

  }

function liProductoXClave($clave){
    $stmt= "call sp_li_pr_id('$clave')";
   // echo $stmt;
    $result = execQuery($stmt);
    foreach( $result as $row){
       $productos=array('clave'=>$row["PR_CVE"],'titulo'=>$row["PR_TITULO"],'desc'=>$row["PR_DESCRIPCION"]);
    }
    print_r($productos);
    return $productos;

  }
?>