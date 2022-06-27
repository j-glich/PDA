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
    $CellA = 'A';
    $CellB = 'B';
    $CellD = 'D';
    $CellF = 'F';
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


    for ($i=0; $i < sizeof($datos) ; $i++) { 
      $array_categorias[] = array('clave' =>$datos[$i]['CAT_CVE'],'titulo' =>$datos[$i]['CAT_TITULO']);
      $array_subcategorias[] = array('clave' =>$datos[$i]['SCAT_CVE'],'titulo' =>$datos[$i]['SCAT_TITULO']);
      $array_productos[] = array('titulo' =>$datos[$i]['PR_TITULO'],
                                  'desc' =>$datos[$i]['PR_DESCRIPCION'],
                                  'cve_subCat' =>$datos[$i]['PR_SCAT_CVE'],
                                  'fecha_programa' =>$datos[$i]['EC_FECHA_PROGRAMADA'],
                                  'fecha_cumplimiento' =>$datos[$i]['EC_FECHA_CUMPLIMIENTO'],
                                  'cve_categoria' =>$datos[$i]['SCAT_CVE_CAT'],
                                  'forma' =>$datos[$i]['EC_FORMA'],
                                  'tiempo' =>$datos[$i]['EC_TIEMPO']);
    
    }
    $array_categorias =  array_merge(array_unique($array_categorias, SORT_REGULAR));
    $array_subcategorias = array_merge(array_unique($array_subcategorias, SORT_REGULAR));


    $count_productos = 0;
    $count_subCat = 0;

    for ($i=0; $i < sizeof($array_productos) ; $i++) { 
      $sheet->setCellValue($CellD.(9+$i),$array_productos[$i]['titulo'])
      ->getStyle($CellD.(9+$i))->getAlignment()->setWrapText(true);
      $sheet->setCellValue($CellF.(9+$i),$array_productos[$i]['desc'])
      ->getStyle($CellF.(9+$i))->getAlignment()->setWrapText(true);
      $sheet->setCellValue('E'.(9+$i),substr($array_productos[$i]['fecha_programa'],0,11))
      ->getStyle('E'.(9+$i))->getFont()->setSize(12);
      $sheet->setCellValue('G'.(9+$i),$array_productos[$i]['fecha_cumplimiento'])
      ->getStyle('G'.(9+$i))->getFont()->setSize(12);
      $sheet->setCellValue('H'.(9+$i),$array_productos[$i]['tiempo'])
      ->getStyle('H'.(9+$i))->getFont()->setSize(12);
      $sheet->setCellValue('I'.(9+$i),$array_productos[$i]['forma'])
      ->getStyle('I'.(9+$i))->getFont()->setSize(12);
      $sheet->getRowDimension((9+$i))->setRowHeight(30,'px');
    }

    foreach ($array_categorias as $row) {
      $count = array_count_values(array_column($array_productos,'cve_categoria'))[$row['clave']];
      $array_contenedor[] = array(
        'clave'=>$row['clave'],
        'titulo'=>$row['titulo'],
        'count'=>$count);
    }
    $count_suma;
    for ($i=0; $i <sizeof($array_contenedor) ; $i++) { 
      if($i==0){
        $count_suma = (8+$array_contenedor[0]['count']);
        $sheet->mergeCells('A9:A'.$count_suma)
        ->setCellValue('A9',$array_contenedor[0]['titulo'])
        ->getStyle('A9:A'.$count_suma)->getAlignment()->setHorizontal('center');
        $sheet->mergeCells('l9:L'.$count_suma)
        ->setCellValue('l9','')
        ->getStyle('l9:L'.$count_suma)->getAlignment()->setHorizontal('center');
      }else{
        $count_suma2 = ($count_suma+$array_contenedor[$i]['count']);
        $sheet->mergeCells('A'.($count_suma+1).':A'.$count_suma2)
        ->setCellValue('A'.($count_suma+1),$array_contenedor[$i]['titulo'])
        ->getStyle('A'.($count_suma+1).':A'.$count_suma2)->getAlignment()->setHorizontal('center');
        $sheet->mergeCells('L'.($count_suma+1).':L'.$count_suma2)
        ->setCellValue('L'.($count_suma+1),"")
        ->getStyle('L'.($count_suma+1).':L'.$count_suma2)->getAlignment()->setHorizontal('center');
        $count_suma = $count_suma2;
      }
    }

    foreach( $array_subcategorias as $row){   
      $count = array_count_values(array_column($array_productos,'cve_subCat'))[$row['clave']];
      $array_contadores[] = array(
        'clave'=>$row['clave'],
        'titulo'=>$row['titulo'],
        'count'=>$count);
    } 
    $suma =0;
    $acom_sumas;
    for ($i=0; $i <sizeof($array_contadores) ; $i++) { 
      if($i==0){
        $suma = (8+$array_contadores[0]['count']);
        $sheet->mergeCells('B9:B'.$suma)
        ->setCellValue('B9',$array_contadores[0]['titulo'])
        ->getStyle('B9:B'.$suma)->getAlignment()->setHorizontal('center');
        $sheet->mergeCells('C9:C'.$suma)->setCellValue('C9','');
      }else{
        $suma2 = ($suma+$array_contadores[$i]['count']);
        $sheet->mergeCells('B'.($suma+1).':B'.$suma2)
        ->setCellValue('B'.($suma+1),$array_contadores[$i]['titulo'])
        ->getStyle('B'.($suma+1).':B'.$suma2)->getAlignment()->setHorizontal('center');
        $sheet->mergeCells('C'.($suma+1).':C'.$suma2)->setCellValue('C'.($suma+1),'');
        $suma = $suma2;
      }

    }
    
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