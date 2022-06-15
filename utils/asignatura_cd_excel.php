<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ae/vendor/autoload.php");  

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;

/**El proceso de llenado del documento base "competencias_asignatura.xlsx" se llena mediante la consta la base de datos del encabezado y el los atributos por asignatura"<div class="
 * Este proceso se encarga de trabajar la extracción de los datos, además de llenar cada celda que corresponda
 * Usando la base de datos requiere aplicar llamadas a procedimientos almacendados. 
 * Usar PhpSpreedSheet para cargar el archivo y escribir datos en el.
*/


$connect= new mysqli("200.79.180.234:3306", "cima", "KillZone.3","cima2");
    if(mysqli_connect_error()){ //Inicio del proceso de conexión
        //Proceso de verificación de error
        printf("No se ha podido establecer la conexión", mysqli_connect_error());
        exit();

    }else{
        //Cuerpo general el proceso
        
        // printf("Conectado"); //Asert

        //Necesitamos llamar al procedimeinto almacenado que nos permita obtener los datos de la cabecera.
        //Requerimos leer dos argumentos de posto o get
        $docente_cve=1;
        $periodo=2021;
        $tiempo='S';
        $forma='S';
        $observaciones="";
        $activo='A';
        $grado_cumplimiento=5;
        $usuario_evaluador=1;
        $fecha=10-10-2000;
        $categoriaProfesor='Docente';
        $nombreProfesor='Nombre';

        $pstm_cabecera=$connect->prepare('call indicadores.sp_evaluar(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);') or die($connect->error);
      
       
        //Asociación de las variables
        $pstm_cabecera->bind_param('sssssssssss', $docente_cve,$periodo,$tiempo, $forma, 
        $observaciones,$activo, $grado_cumplimiento, $usuario_evaluador, $fecha,
        $categoriaProfesor, $nombreProfesor); 
        $pstm_cabecera->execute();
        
        //$pstm_cabecera->store_result();
        
      //$pstm_cabecera->bind_result($clave, $semestre, $nom_asignatura, $ht, $hp,$total_horas, $tipo_curso, $area_conocimiento)or die($connect->error);
       
       

       $pstm_cabecera->fetch();
      // $pstm_asignatura->fetch();
    //Termnación del cuerpo
 //Aqui va el cuerpo de los atributos de egreso 
      $pstm_cabecera->close();
    // ___________________________________________________________________________
      $pstm_asignatura=$connect->prepare('call cima2.sp_listar_aporte_cd_asigantura(?);') or die($connect->error);
       
      //Asociación de las variables
     $pstm_asignatura->bind_param('s',$asignatura);
     $pstm_asignatura->execute();
     //$pstm_asignatura->store_result();

      //Codigo par la extracción del nombre de los campos
      /////---------------------------------------------
      
      /////---------------------------------------------
      //Ligado de las variables
      $pstm_asignatura->bind_result($num_atributo, $atributo, $descripcion, $num_criterio, $criterio_desempenio, $descripcion_criterio, $nivel_aporte)or die($connect->error);
      
      if($connect->errno<>0){
       die($pstm_asignatura.errno.":  ".$pstm_asignatura);
      }
     
      $iteracion=0;
    while($pstm_asignatura->fetch()){ 
        $tablas_asignatura[$iteracion][0]= $num_atributo;
        $tablas_asignatura[$iteracion][1]= $atributo;
        $tablas_asignatura[$iteracion][2]= $descripcion;
        $tablas_asignatura[$iteracion][3]= $num_criterio;
        $tablas_asignatura[$iteracion][4]= $criterio_desempenio;
        $tablas_asignatura[$iteracion][5]= $descripcion_criterio;
        $tablas_asignatura[$iteracion][6]= $nivel_aporte;
        $iteracion ++;
        //echo $num_atributo, $atributo, $descripcion, $num_criterio, $criterio_desempenio, $descripcion_criterio, $nivel_aporte; 
      }
  

    //************************ */
    

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load("competencias_asignatura.xlsx");
    try {
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' .$carrera.'-'.$asignatura.'.xlsx"');
        header('Cache-Control: max-age=0');
        // a partir de una plantilla copiar el documento y escribir en el.
    
        $areas="F";
        if($area_conocimiento=="Ciencias Básicas"){
            $areas="D";
        }else if($area_conocimiento=="Ciencias de la Ingeniería"){
            $areas="E";
        }
        else if($area_conocimiento=="Ingeniería Aplicada"){
            $areas="F";
        }
        else if($area_conocimiento=="Diseño en Ingeniería"){
            $areas="G";
        }
        else if($area_conocimiento=="Ciencias Sociales y Humanidades"){
            $areas="H";
        }
        else if($area_conocimiento=="Ciencias Económico Administrarivas"){
            $areas="I";
        }
        else if($area_conocimiento=="Otros Cursos"){
            $areas="J";
        }

        $tipo="O";
        if($tipo_curso=="OB"){
            $tipo="A";
        }else if($tipo_curso=="OP"){
            $tipo="B";
        }
        //$spread = new Spreadsheet();
       $sheet = $spreadsheet->getActiveSheet('AE_ASIGNATURA');
        $sheet->setTitle("Plantilla");
        $sheet->setCellValueByColumnAndRow(3, 3, $carrera);
        $sheet->setCellValue("F3",$semestre);
        $sheet->setCellValue("C4", $nom_asignatura);
        $sheet->setCellValue("I3", $clave);
        $sheet->setCellValue($areas."8", $ht);
        $sheet->setCellValue($areas."9", $hp);
        $sheet->setCellValue($areas."10", $total_horas);
        $sheet->setCellValue($tipo."9", 'X');
        $sheet->setCellValue("B10", $total_horas);

         
        //$sheet->setCellValue("8D", $area_conocimiento);

       $letra = "B";
       $letraDos = "C";
       $iteracion = 14;
       $contador=$tablas_asignatura[0][0];
     $contadorDos = 0;
     //Atributo de egreso

     

       for ($j = 0; $j < sizeof($tablas_asignatura); $j++){
           if($contador != $tablas_asignatura[$j][0]){
               $contador=$tablas_asignatura[$j][0];
               //$sheet->setCellValue($letra."13", $tablas_asignatura[0][1].'.- '.$tablas_asignatura[0][2]);
               switch ($contador){
                   case 1:
                    $letra = "B";
                    $letraDos = "C";
                    $sheet->setCellValue($letra."13",$tablas_asignatura[$j][1].'.- '. $tablas_asignatura[$j][2]);
                    $iteracion = 14;
                    break;
                    case 2:
                        $letra = "E";
                        $letraDos = "F";   
                    $sheet->setCellValue($letra."13",$tablas_asignatura[$j][1].'.- '. $tablas_asignatura[$j][2]);
                    $iteracion = 14;
                    break;
                    case 3:
                        $letra = "H";
                        $letraDos = "I";
                    $sheet->setCellValue($letra."13",$tablas_asignatura[$j][1].'.- '. $tablas_asignatura[$j][2]);
                    $iteracion = 14;
                    break;
                    case 4:
                        $letra = "B";
                        $letraDos = "C";
                    $sheet->setCellValue($letra."19",$tablas_asignatura[$j][1].'.- '. $tablas_asignatura[$j][2]);
                    $iteracion = 20;
                    break;
                    case 5:
                        $letra = "E";
                        $letraDos = "F";   
                    $sheet->setCellValue($letra."19",$tablas_asignatura[$j][1].'.- '. $tablas_asignatura[$j][2]);
                    $iteracion = 20;
                    break;
                    case 6:
                        $letra = "H";
                        $letraDos = "I";
                    $sheet->setCellValue($letra."19",$tablas_asignatura[$j][1].'.- '. $tablas_asignatura[$j][2]);
                    $iteracion = 20;
                    break;
                    case 7:
                        $letra = "B";
                        $letraDos = "C";
                    $sheet->setCellValue($letra."26", $tablas_asignatura[$j][1].'.- '.$tablas_asignatura[$j][2]);
                    $iteracion = 27;
                    break;
                    case 8:
                        $letra = "E";
                        $letraDos = "F";
                    $sheet->setCellValue($letra."26",$tablas_asignatura[$j][1].'.- '. $tablas_asignatura[$j][2]);
                    $iteracion = 27;
                    break;
                    case 9:
                        $letra = "H";
                        $letraDos = "I";
                    $sheet->setCellValue($letra."26",$tablas_asignatura[$j][1].'.- '. $tablas_asignatura[$j][2]);
                    $iteracion = 27;
                    break;
               }
               
           }
             
        $sheet->setCellValue($letraDos.$iteracion,$tablas_asignatura[$j][4].'.- '. $tablas_asignatura[$j][5]);
        $sheet->setCellValue($letra.$iteracion, $tablas_asignatura[$j][6]);
        $iteracion ++;
       }
        
        //$sheet->setCellValue("E13", $descripcion);
        //$sheet->setCellValue("H13", $descripcion);
    
            //$writer->save("competencias_asignatura.xlsx");
     
    //mysql_free_result()
    //************************ */
    $writer = IOFactory::createWriter($spreadsheet,'Xlsx');
    $writer->save('php://output');
    mysqli_close($connect);


    
    exit;
    
    } catch (\Exception $e) {
      //echo 'Ocurrió un error al intentar abrir el archivo ' . $e;
    } 

}

?>