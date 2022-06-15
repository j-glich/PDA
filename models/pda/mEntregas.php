<?php

try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/conexion.php");
} catch (\Exception $e) {
    require_once("../config/conexion.php");
}

switch ($opcion) {
    case '1':
    $in_activo = 'I';
    $periodo = "20221";
    $grado_cumplimiento = 0;

    $stmt_subcat= "call sp_li_categorias_cargadas_x_docente('$id_docente')";
    // echo $stmt_subcat;
    $result_sub = execQuery($stmt_subcat);
    $subcat_cargadas = array();
    foreach( $result_sub as $row){
        $subcat_cargadas[]=array('categoria'=>$row['SCAT_CVE_CAT'],'CAT_CVE_RB'=>$row["CAT_CVE_RB"]);
    }
    $_auxtem_docencia = 0;
    $_auxtem_tutoria = 0;
    $_auxtem_generacionCono=0;
    $_auxtem_gestionAcademica = 0;
    $_auxtem_formacionPro = 0;
    $_auxtem_otra = 0;
    $num_cat_cargadas = sizeof($subcat_cargadas);
    for ($i=0; $i < $num_cat_cargadas ; $i++) { 
        if($subcat_cargadas[$i]['CAT_CVE_RB'] == 'DOC'){
            $_auxtem_docencia++;
        }
        if($subcat_cargadas[$i]['CAT_CVE_RB'] == 'TUD'){
            $_auxtem_tutoria++;
        }
        if($subcat_cargadas[$i]['CAT_CVE_RB'] == 'GAC'){
            $_auxtem_generacionCono++;
        }
        if($subcat_cargadas[$i]['CAT_CVE_RB'] == 'GEA'){
            $_auxtem_gestionAcademica++;
        }
        if($subcat_cargadas[$i]['CAT_CVE_RB'] == 'FOP'){
            $_auxtem_formacionPro++;
        }
        if($subcat_cargadas[$i]['CAT_CVE_RB'] == 'OTR'){
            $_auxtem_otra++;
        }
    }
    $sum_prod_docencia=0;
    $sum_prod_tutoria=0;
    $sum_prod_generacion=0;
    $sum_prod_gestionAca=0;
    $sum_prod_formacionPro=0;
    $sum_prod_otr=0;
    for ($i=0; $i < $num_cat_cargadas ; $i++) { 
        if($_auxtem_docencia == 1 || $_auxtem_tutoria == 1 || $_auxtem_generacionCono == 1 || $_auxtem_gestionAcademica == 1 || $_auxtem_formacionPro == 1){
            //Categorias del rubro de Docencia
            if($subcat_cargadas[$i]['categoria'] == 'DFG'){
                $sum_prod_docencia = 5;
            }
            if($subcat_cargadas[$i]['categoria'] == 'ACB'){
                $sum_prod_docencia = 5;
            }
            if($subcat_cargadas[$i]['categoria'] == 'ASE'){
                $sum_prod_docencia = 5;
            }
            if($subcat_cargadas[$i]['categoria'] == 'OTA'){
                $sum_prod_docencia = 2;
            }
            // Categoria Tutoría y dirección individualizada de estudiantes
            if($subcat_cargadas[$i]['categoria'] == 'PRT'){
                $sum_prod_tutoria = 3;
            }
            if($subcat_cargadas[$i]['categoria'] == 'DIT'){
                $sum_prod_tutoria = 5;
            } 
            if($subcat_cargadas[$i]['categoria'] == 'TUR'){
                $sum_prod_tutoria = 4;
            }
             // Generación y aplicación del conocimiento
             if($subcat_cargadas[$i]['categoria'] == 'RPI'){
                $sum_prod_generacion = 6;
            }
            if($subcat_cargadas[$i]['categoria'] == 'RPA'){
                $sum_prod_generacion = 6;
            }
            if($subcat_cargadas[$i]['categoria'] == 'ICS'){
                $sum_prod_generacion = 4;
            }
            //Gestion Academica
            if($subcat_cargadas[$i]['categoria'] == 'ACA'){
                $sum_prod_gestionAca = 6;
            }
            if($subcat_cargadas[$i]['categoria'] == 'VSP'){
                $sum_prod_gestionAca = 6;
            }
            //Formacion Profecional 
            if($subcat_cargadas[$i]['categoria'] == 'CAP'){
                $sum_prod_formacionPro = 5;
            }
        } 
        if($_auxtem_docencia <= 4 || $_auxtem_tutoria <=3 ||  $_auxtem_generacionCono <= 3 ||  $_auxtem_gestionAcademica <=2){
            //Categorias del rubro docencia 
            if($subcat_cargadas[$i]['categoria'] == 'DFG'){
                $sum_prod_docencia += 5;
            }
            if($subcat_cargadas[$i]['categoria'] == 'ACB'){
                $sum_prod_docencia += 5;
            }
            if($subcat_cargadas[$i]['categoria'] == 'ASE'){
                $sum_prod_docencia += 5;
            }
            if($subcat_cargadas[$i]['categoria'] == 'OTA'){
                $sum_prod_docencia += 2;
            }
            // Categoria Tutoría y dirección individualizada de estudiantes
            if($subcat_cargadas[$i]['categoria'] == 'PRT'){
                $sum_prod_tutoria += 3;
            }
            if($subcat_cargadas[$i]['categoria'] == 'DIT'){
                $sum_prod_tutoria += 5;
            } 
            if($subcat_cargadas[$i]['categoria'] == 'TUR'){
                $sum_prod_tutoria += 4;
            }
            //Generación y aplicación del conocimiento
              // Generación y aplicación del conocimiento
            if($subcat_cargadas[$i]['categoria'] == 'RPI'){
                $sum_prod_generacion += 6;
            }
            if($subcat_cargadas[$i]['categoria'] == 'RPA'){
                $sum_prod_generacion += 6;
            }
            if($subcat_cargadas[$i]['categoria'] == 'ICS'){
                $sum_prod_generacion += 5;
            }
               //Gestion Academica
            if($subcat_cargadas[$i]['categoria'] == 'ACA'){
                $sum_prod_gestionAca += 6;
            }
            if($subcat_cargadas[$i]['categoria'] == 'VSP'){
                $sum_prod_gestionAca += 6;
            }
        }
    }
    $stmt_producto= "call sp_li_pr_id('$id_producto')";
    // echo $stmt_producto;
    $result_pr = execQuery($stmt_producto);
    $producto_evaluado = array();
    foreach( $result_pr as $row){
        $producto_evaluado[]=array('SCAT_CVE_CAT'=>$row['SCAT_CVE_CAT']);
    }

    if($cve_Tiempo =='S' && $cve_Forma == 'S'){
        if($producto_evaluado[0]['SCAT_CVE_CAT'] == 'DFG'){
            $grado_cumplimiento = (5/$sum_prod_docencia);
        }
        if($producto_evaluado[0]['SCAT_CVE_CAT'] == 'ACB'){
            $grado_cumplimiento = (5/$sum_prod_docencia);
        }
    }else if($cve_Tiempo =='S' && $cve_Forma == 'N' || $cve_Tiempo =='N' && $cve_Forma == 'S'  ){   
        if($producto_evaluado[0]['SCAT_CVE_CAT'] == 'DFG'){
            $grado_cumplimiento = (5/$sum_prod_docencia);
            $valor_individual = $grado_cumplimiento / 2;
            $grado_cumplimiento = $grado_cumplimiento -($valor_individual/2);
        }
    }else if($cve_Tiempo =='N' && $cve_Forma == 'N'){   
        if($producto_evaluado[0]['SCAT_CVE_CAT'] == 'DFG'){
            $grado_cumplimiento = (5/$sum_prod_docencia);
            $valor_individual = $grado_cumplimiento / 2;
            $grado_cumplimiento = ($valor_individual/2) +($valor_individual/2);
        }
    }else if($cve_Tiempo =='P' && $cve_Forma == 'P'){   
        if($producto_evaluado[0]['SCAT_CVE_CAT'] == 'DFG'){
            $grado_cumplimiento = 0;
        }
    }else if($cve_Tiempo =='P' && $cve_Forma == 'N' || $cve_Tiempo =='N' && $cve_Forma == 'P' ){   
        if($producto_evaluado[0]['SCAT_CVE_CAT'] == 'DFG'){
            $grado_cumplimiento = (5/$sum_prod_docencia);
            $valor_individual = $grado_cumplimiento / 2;
            $grado_cumplimiento = ($valor_individual/2);
        }
    }else if($cve_Tiempo =='P' && $cve_Forma == 'S' || $cve_Tiempo =='S' && $cve_Forma == 'P' ){   
        if($producto_evaluado[0]['SCAT_CVE_CAT'] == 'DFG'){
            $grado_cumplimiento = (5/$sum_prod_docencia);
            $grado_cumplimiento = ($grado_cumplimiento / 2);
        }
    }
    echo $grado_cumplimiento;

    // $stmt= "call sp_evaluar('$id_producto','$id_docente','$cve_Tiempo','$cve_Forma','$observaciones','$in_activo','$','$')";
    // echo $stmt;
     //$result = execQuery($stmt);
    break;
}
?>