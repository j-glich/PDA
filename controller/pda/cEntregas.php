<?php
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '0';

if($opcion == 1){
    $id_producto = $_POST['id_producto'];
    $cve_Tiempo = $_POST['cve_Tiempo'];
    $cve_Forma = $_POST['cve_Forma'];
    $observaciones = $_POST['observaciones'];
    $id_docente = $_POST['id_docente'];
}

require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/pda/mEntregas.php");

