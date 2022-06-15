<?php 
$subcat_clave = $_POST['subcat_clave'];
$titulo = $_POST['titulo'];
$desc = ($_POST['desc']) ;
$opcion = ($_POST['opcion']);
//Para que no genere al hacer la actulizacion solo cunado la opcion es = 2 correponde al formulario del nuevo registro
if($opcion == 2){
    $cat_clave = $_POST['cat_clave'];
}


require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/moSubCategoria.php");

?>