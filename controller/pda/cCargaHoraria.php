<?php
 define('ruta',$_SERVER['DOCUMENT_ROOT']);
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mSubcategoria.php");
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mCargaHoraria.php"); 

/**      ******************** */ 

function add_carga($cve_docente, $cargaH){
   return mAddCarga($cve_docente, $cargaH);
}

 function listar_subcategoria(){
    return li_subcategorias();
  }



?>