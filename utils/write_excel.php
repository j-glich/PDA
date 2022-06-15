<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ae/vendor/autoload.php");
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
$spreadsheet = $reader->load("08_formato_web.xlsx");
try {
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . 'competencias_asignatura(JPE).xlsx' . '"');
    header('Cache-Control: max-age=0');
    // a partir de una plantilla copiar el documento y escribir en el.



    //$spread = new Spreadsheet();
    $sheet = $spreadsheet->getSheetByName('Plantilla');
    $sheet->setTitle("Plantilla");
    $sheet->setCellValueByColumnAndRow(3, 3, "ISIC-2010-224");
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $sheet->setCellValue("C4", "Administración de Base de Datos.");

        //$writer->save("competencias_asignatura.xlsx");
 

$writer->save('php://output');
exit;

} catch (\Exception $e) {
  echo 'Ocurrió un error al intentar abrir el archivo ' . $e;
} 

?>