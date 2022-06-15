<?php
 //define('ruta',$_SERVER['DOCUMENT_ROOT']);
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mSubcategoria.php");


 /* Bloque de control para poder realizar la actualización de los registros */


//if(isset($_REQUEST['rb_clave'])&&isset($_REQUEST['titulo'])&&isset($_REQUEST['desc'])){
if(isset($_REQUEST['actualizar'])){
  up_subcategoria($_REQUEST['scat_clave'], $_REQUEST['titulo'], $_REQUEST['desc']);
}

/**      ******************** */ 


 function listar_subcategorias(){
    return li_subcategorias();
  }

  function up_subcategoria($clave, $titulo, $desc){
    mUpSubcategoria($clave, $titulo, $desc);

  }


  function del_subcategoria($scat_cve){
    mDelSubcategoria($scat_cve, '', '');
  }

  function listar_subcategoria($scat_cve){
    return liSubcategoriaXClave($scat_cve);
  }
?>