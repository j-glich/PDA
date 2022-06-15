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
      $stmt= "call sp_in_carga_actividad_x_producto('$carga', '$clave_docente', '$sPeriodo',$user,'$ip_adress')";
     //echo $stmt;
      execQuery($stmt);
    break;
    case '2':
      $ip_adress= $_SERVER['REMOTE_ADDR'];
      if($ip_adress=='::1')
        $ip_adress="127.0.0.1";
      //Actualizar el valor del usuario tomando el valor de la sesión
        $user=200;
        $stmt= "call sp_in_carga_pr_esp('$cve_subcat','$cve_producto','$evidencia' ,'$desc_producto','$ip_adress','$user','$dias_entrega')";
        $result = execQuery($stmt);
         //echo '***'.$result -> num_rows;
  //$product_especifico= array('EC_ACTIVO'=>'','titulo'=>'','desc'=>'');
          if($result !=0){
        foreach( $result as $row){
          $product_especifico[]=$row;
          }
          print json_encode($product_especifico, JSON_UNESCAPED_UNICODE);
        }
  //$result->free();
     //echo $stmt;
    break;
    case '3':
      $stmt = "call sp_li_pr_id('$cve_pr_es')";
      $result = execQuery($stmt);
      //echo '***'.$result -> num_rows;
     
//$product_especifico= array('clave'=>'','titulo'=>'','desc'=>'');
     foreach( $result as $row){
       $pr_especifico[]=$row;
}
//$result->free();
  //echo $stmt;
  print json_encode($pr_especifico, JSON_UNESCAPED_UNICODE);
    break;
    case '4':
      $stmt= "call sp_li_producto_x_scat('$cve_subcategoria')";
      // echo $stmt;
       $result = execQuery($stmt);
       if($result !=0){
        foreach( $result as $row){
          $subcategorias[]=$row;
          }
          print json_encode($subcategorias, JSON_UNESCAPED_UNICODE);
        }
      break;
      case '6':
        $stmt= "call sp_pda_li_prodc_x_defalut_x_subca('$cve_subcategoria')";
        // echo $stmt;
         $result = execQuery($stmt);
         if($result !=0){
          foreach( $result as $row){
            $product_especifico[]=array('PR_CVE'=>$row["PR_CVE"]);
            }
            print json_encode($product_especifico, JSON_UNESCAPED_UNICODE);
          }
      break;
      case '7':
        $stmt= "call sp_li_scat_x_cve('$cve_subcategoria')";
        // echo $stmt;
         $result = execQuery($stmt);
         if($result !=0){
          foreach( $result as $row){
            $product_especifico[]=array('SCAT_CVE'=>$row["SCAT_CVE"],'SCAT_TITULO'=>$row['SCAT_TITULO']);
            }
            print json_encode($product_especifico, JSON_UNESCAPED_UNICODE);
          }
      break;
  }

  function mAddActividad($cve_docente, $cve_pr){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
    //Actualizar el valor del usuario tomando el valor de la sesión
      $user=200;
    //$stmt= "call sp_in_actividad('$cve_docente', '$cve_pr', '$periodo', '$hrs_pr', '$fec_prog' '$ip_adress',$user)";
   // 
 //   $result = ejecutarConsulta($stmt);
   // echo " Se ha actualizado";

  }

  function li_productos(){
    $ip_adress= $_SERVER['REMOTE_ADDR'];
    if($ip_adress=='::1')
      $ip_adress="127.0.0.1";
      $stmt= "CALL sp_li_producto()";
  $result = execQuery($stmt);
  //echo '***'.$result -> num_rows;
  $productos = array();
  //$rubros= array('clave'=>'','titulo'=>'','desc'=>'');
  foreach( $result as $row){
    $productos=array('clave'=>$row["PR_CVE"],'SCAT_TITULO'=>$row['PR_SCAT_CVE'],'titulo'=>$row["PR_TITULO"],'desc'=>$row["PR_DESCRIPCION"]);
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


  }

function liProductoXClave($clave){
    $stmt= "call sp_pda_li_producto_x_scat('$clave')";
   // echo $stmt;
    $result = execQuery($stmt);
    $productos = array();
    foreach( $result as $row){
       $productos[]=array('categoría'=>$row['SCAT_TITULO'],'clave'=>$row["PR_CVE"],'default'=>$row['PR_DEFAULT'],'titulo'=>$row["PR_TITULO"],'desc'=>$row["PR_DESCRIPCION"]);
    }
    return $productos;
  }

 function liProducto_x_producto_x_docente($subcategoria , $cve_docente){
  $periodo='20221';
  $stmt= "call sp_pda_li_producto_x_docente_sub('$subcategoria', '$cve_docente', '$periodo')";
  // echo $stmt;
   $result = execQuery($stmt);
   $productos = array();
   foreach( $result as $row){
      $productos[]=array(
        'PR_CVE'=>$row['PR_CVE'],
        'EC_ACTIVO'=>$row["EC_ACTIVO"],
        'PR_TITULO'=>$row['PR_TITULO'],
        'PR_DESCRIPCION'=>$row["PR_DESCRIPCION"],  
      );
   }
   return $productos;
 }
?>