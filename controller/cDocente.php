<?php
 //define('ruta',$_SERVER['DOCUMENT_ROOT']);
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/mDocentes.php");

 function listar_docentes(){
    return li_docentes();
  }

?>