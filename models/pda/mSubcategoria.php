<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
  } catch (\Exception $e) {
    require_once("../config/conexion.php");
  }


  function li_subcategorias(){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
      $stmt= "CALL sp_li_subcategoria()";

 
  

  $result = execQuery($stmt);
  //echo '***'.$result -> num_rows;
  $subcategorias = array();
  //$rubros= array('clave'=>'','titulo'=>'','desc'=>'');
  foreach( $result as $row){
    $subcategorias[]=array('clave'=>$row["SCAT_CVE"],'titulo'=>$row["SCAT_TITULO"],'desc'=>$row["SCAT_DESCRIPCION"]);
  }
 // $result->free();
  return $subcategorias;

  }


  function mDelSubcategoria($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_subcategoria('$clave', '', '','I','$ip_adress',$user)";
   // echo $stmt;
    $result = ejecutarConsulta($stmt);
    echo " Se ha borrado";


  }


  function mUpSubcategoria($clave,$titulo,$desc){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    $stmt= "call sp_up_subcategoria('$clave', '$titulo', '$desc','','$ip_adress',$user)";
   // echo $stmt;
   
    $result = ejecutarConsulta($stmt);
    echo " Se ha actualizado";


  }

function liSubcategoriaXClave($clave){
    $stmt= "call sp_li_scat_x_cve('$clave')";
    //echo $stmt;
    $result = execQuery($stmt);
    foreach( $result as $row){
       $subcategorias=array('clave'=>$row["SCAT_CVE"],'titulo'=>$row["SCAT_TITULO"],'desc'=>$row["SCAT_DESCRIPCION"]);
    }
    print_r($subcategorias);
    return $subcategorias;

  }
?>