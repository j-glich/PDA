<?php

    if(isset($_REQUEST['desc'])&&isset($_REQUEST['atr'])){
      define('ruta',$_SERVER['DOCUMENT_ROOT']);
      require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/atributo.php");
      cambiaAtributo($_REQUEST['atr'],$_REQUEST['desc']);
    }else{
      require_once($_SERVER['DOCUMENT_ROOT']."/ae/models/atributo.php");
    }

    function atributos_egreso(){
      return listar();
    }

    function valores($atributo){
      $valor= array('id'=>'','desc'=>'');
      $atributo= buscaAtributo($atributo);
      foreach ($atributo as $a) {
        $valor['id']=$a['AE_CLAVE'];
        $valor['desc']=$a['AE_DESCRIPCION'];
      }

      return $valor;
    }

    function cambiaAtributo($atributo,$desc){
      $result = actualizaAtributo($atributo,$desc);
      if($result){
        echo 'ok';
      }else{
        echo 'error';
      }
    }
 ?>
