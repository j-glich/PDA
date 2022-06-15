<?php 
$opcion = ($_POST['opcion']);
//Para que no genere al hacer la actulizacion solo cunado la opcion es = 2 correponde al formulario del nuevo registro
if($opcion == 2){
    $subcat_clave = $_POST['subcat_clave'];
    $titulo = $_POST['titulo'];
    $desc = ($_POST['desc']) ;
    $id_producto = $_POST['id_producto'];
    $d_entrega = ($_POST['d_entrega']) ;
}
if($opcion == 3){
    $id_cve = $_POST['product'];
}
if($opcion == 4){
    $clv_docente  =  $_POST['clv_docente']; 
    $clv_producto  = $_POST['clv_producto'];
    $hr_producto = $_POST['hr_producto'];
    $fecha = $_POST['fecha'];

}



require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/moProducto.php");

?>