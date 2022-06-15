<?php

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';
if($opcion == 1){
  $eval_producto = $_POST['eval_producto'];
  $clave_docente = $_POST['docente'];
  $num_productos = $_POST['num_productos'];

}
if($opcion == 2){
  
  $sp_cargaproducto = $_POST['sp_cargaproducto'];
  $tam_productos = $_POST['tam_productos'];
  $docente = $_POST['docente'];

}

if($opcion == 3){
  
  $mCarga = $_POST['mCarga'];
  $docente = $_POST['docente'];
  $tam = $_POST['tam'];


}

 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mEvaluacion.php");


 function listar_productos_evaluacion($id_docente,$periodo){
    return mo_evidencia($id_docente,$periodo);
    
  }
  function listar_subcategoria($id_docente,$periodo){
    return mo_subcategoria($id_docente,$periodo);
    
  }
  function listar_pro_subcategoria($id_docente , $subcategoria,$periodo)
  {
   return mo_pro_doc_x_sub($id_docente , $subcategoria,$periodo);
  }
?>