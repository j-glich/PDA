<?php
 //define('ruta',$_SERVER['DOCUMENT_ROOT']);
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mProducto.php");


 /* Bloque de control para poder realizar la actualización de los registros */


//if(isset($_REQUEST['rb_clave'])&&isset($_REQUEST['titulo'])&&isset($_REQUEST['desc'])){
if(isset($_REQUEST['actualizar'])){
  up_producto($_REQUEST['pr_clave'], $_REQUEST['titulo'], $_REQUEST['desc']);
}

/**      ******************** */ 


 function listar_productos(){
    return li_producto();
  }

  function up_producto($clave, $titulo, $desc){
    mUpProducto($clave, $titulo, $desc);

  }


  function del_producto($pr_cve){
    mDelProducto($pr_cve, '', '');
  }

  function listar_producto($pr_cve){
    return liProductoXClave($pr_cve);
  }
?>