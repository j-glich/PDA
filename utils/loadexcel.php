<?php
//require __DIR__ . "../vendor/autoload.php";
require_once($_SERVER['DOCUMENT_ROOT']."/ae/vendor/autoload.php");


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;



 
$documento = new Spreadsheet();
$documento
    ->getProperties()
    ->setCreator('Aquí va el creador, como cadena')
    ->setTitle('Mi primer documento creado con PhpSpreadSheet')
    ->setLastModifiedBy('Parzibyte')  //última vez modificado por
    ->setSubject('El asunto')
    ->setDescription('Este documento fue generado para parzibyte.me')
    ->setKeywords('etiquetas o palabras clave separadas por espacios')
    ->setCategory('La categoría');
 
$nombreDelDocumento = 'Mi primer archivo.xlsx';

//  Los siguientes encabezados son necesarios para que
 // el navegador entienda que no le estamos mandando
 // simple HTML
 // Por cierto no hagas ningún echo ni cosas de esas; es decir, no imprimas nada
 
 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombreDelDocumento . '"');
header('Cache-Control: max-age=0');
 
$writer = IOFactory::createWriter($documento, 'Xlsx');
$writer->save('php://output');
exit;

?>