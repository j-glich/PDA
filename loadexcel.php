<?php
  date_default_timezone_set('America/Mexico_City');
try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
  } catch (\Exception $e) {
    require_once("../config/conexion.php");
  }
  require __DIR__ . "/vendor/autoload.php";

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
  use PhpOffice\PhpSpreadsheet\IOFactory;

$cve_docente = (isset($_GET['cve_docente'])) ? $_GET['cve_docente'] : '0';
$cve_periodo = (isset($_GET['cve_periodo'])) ? $_GET['cve_periodo'] : '0';

$sql ="CALL sp_pda_li_evidencia_x_docente_excel('$cve_docente','$cve_periodo')";
$datos = execQuery($sql);

if($datos == 0){
 echo "<script>window.location.replace('view/index.php?sp_registro=4')</script>";
}else{

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
     
    $nombreDelDocumento = 'P-DA-01-F-08 Plan de Trabajo de Actividades Sustantivas.xlsx';
    
    $rutaArchivo = "public/plantilla/P-DA-01-F-08 Plan de Trabajo de Actividades Sustantivas.xlsx";
    $documento = IOFactory::load($rutaArchivo);
    $sheet = $documento->getActiveSheet();
    $hoy = date("Y-m-d H:i:s");
    $sheet->setCellValue('D5',$datos[0]['DO_CATEGORIA']);
    $sheet->setCellValue('D4',$datos[0]['PE_DESCRIPCION']."-".$datos[0]['PE_ANIO'])->getStyle('D4')->getFont()->setSize(12);
    $sheet->getStyle('D4')->getAlignment()->setHorizontal('center');
    $sheet->setCellValue('K4',$hoy);
    $sheet->setCellValue('G5',$datos[0]['DO_NOMBRE_1']);
    
    
    
    
    
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
}


?>