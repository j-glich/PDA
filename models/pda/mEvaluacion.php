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
        $periodo='20221';
        $pr_activo = 'I';
      $stmt= "call sp_in_evaluacion_x_docente('$eval_producto', '$clave_docente','$num_productos','$periodo','$user','$pr_activo','$ip_adress')";
     //echo $stmt
      execQuery($stmt);
    break;
    case '2':
      $periodo = "20221";
      $ip_adress= $_SERVER['REMOTE_ADDR'];
      if($ip_adress=='::1')
        $ip_adress="127.0.0.1";
      //Actualizar el valor del usuario tomando el valor de la sesión
        $user=200;
      $stmt= "call sp_pda_in_productos_docente('$sp_cargaproducto', '$docente','$tam_productos','$periodo','$user','$ip_adress')";
     //echo $stmt
      execQuery($stmt);
    break;

    case '3':
      $ip_adress= $_SERVER['REMOTE_ADDR'];
      if($ip_adress=='::1')
        $ip_adress="127.0.0.1";
      //Actualizar el valor del usuario tomando el valor de la sesión
        $user=200;
      $stmt= "call sp_pda_in_modificacion_carga('$mCarga', '$tam','$docente','$ip_adress','$user')";
     //echo $stmt
      execQuery($stmt);
    break;
  }

 function mo_evidencia($id_docente,$periodo){

  $stmt= "call sp_li_evidecia_x_docente('$id_docente','$periodo')";
  // echo $stmt;
   $result = execQuery($stmt);
   $productos = array();
   foreach( $result as $row){
      $productos[]=array('producto_id'=>$row['EC_PR_CVE'],'fecha'=>$row["EC_FECHA_PROGRAMADA"],'EC_FECHA_CUMPLIMIENTO'=>$row['EC_FECHA_CUMPLIMIENTO'],'EC_TIEMPO'=>$row["EC_TIEMPO"],'EC_FORMA'=>$row["EC_FORMA"],'EC_RUTA'=>$row["EC_RUTA"]  );
   }
   return $productos;
 } 
 
 function mo_subcategoria($id_docente,$periodo){
  $stmt= "call sp_li_evidecia_x_docente_x_subc('$id_docente','$periodo')";
  // echo $stmt;
   $result = execQuery($stmt);
   $productos = array();
   foreach( $result as $row){
      $productos[]=array(
        'PR_SCAT_CVE'=>$row['PR_SCAT_CVE'],
        'SCAT_TITULO'=>$row["SCAT_TITULO"]);
   }
   return $productos;
 }
 
 function mo_pro_doc_x_sub($id_docente,$subcategoria,$periodo){
  $stmt= "call sp_li_ev_doc_productos('$id_docente','$periodo','$subcategoria')";
  // echo $stmt;
   $result = execQuery($stmt);
   $productos = array();
   foreach( $result as $row){
      $productos[]=array(
        'EC_PR_CVE'=>$row['EC_PR_CVE'],
        'PR_TITULO'=>$row["PR_TITULO"],
        'PR_DESCRIPCION'=>$row['PR_DESCRIPCION'],
        'EC_FECHA_PROGRAMADA'=>$row['EC_FECHA_PROGRAMADA'],
        'PR_DEFAULT'=>$row['PR_DEFAULT'],
        'SCAT_TITULO'=>$row['SCAT_TITULO'],
        'SCAT_DESCRIPCION'=>$row['SCAT_DESCRIPCION'],
        'CAT_TITULO'=>$row['CAT_TITULO'],
        'CAT_DESCRIPCION'=>$row['CAT_DESCRIPCION'],
        'RB_TITULO'=>$row['RB_TITULO'],
        'RB_DESCRIPCION'=>$row['RB_DESCRIPCION']);
   }
   return $productos;
 }
?>