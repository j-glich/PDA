<?php
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';
if($opcion == 2 || $opcion == 1){
$rb_clave = $_POST['rb_clave'];
$titulo = $_POST['titulo'];
$desc = ($_POST['desc']) ;
}

 require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mRubro.php");
 /* Bloque de control para poder realizar la actualización de los registros */

/**      ******************** */ 
 function listar_rubros(){
    return li_rubros();
  }
  function up_rubro($clave, $titulo, $desc){
    mUpRubro($clave, $titulo, $desc);

  }
  function del_rubro($rb_cve){
    mDelRubro($rb_cve, '', '');
  }
  function listar_rubro($rb_cve){
    return liRubroXClave($rb_cve);
  }
?>



