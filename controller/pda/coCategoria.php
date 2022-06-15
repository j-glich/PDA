<?php 
$cat_clave = $_POST['cat_clave'];
$titulo = $_POST['titulo'];
$desc = ($_POST['desc']) ;
$opcion = ($_POST['opcion']);
//Para que no genere al hacer la actulizacion solo cunado la opcion es = 2 correponde al formulario del nuevo registro
if($opcion == 2){
    $rb_clave = $_POST['rb_clave'];
}


require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/moCategoria.php");

?>