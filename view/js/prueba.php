<?php
  define('ruta',$_SERVER['DOCUMENT_ROOT']);

  require_once(ruta."/ae/config/conexion.php");
  require_once(ruta."/ae/models/prueba.php");
  require_once(ruta."/ae/models/ProyectoIntegrador.php");
  require_once(ruta."/ae/models/guiaObservacion.php");
  require_once(ruta."/ae/models/gopi.php");

  $nom= $_POST['proyecto'];
  $equipo= $_POST['equipo'];
  $semestre= $_POST['semestre'];
  $grupo= $_POST['grupo'];

  echo $nom.$equipo;
  $asignaturas=json_decode($_POST['prueba']);

  $id=insertarPI($nom,$equipo,$semestre,$grupo);

  foreach ($asignaturas as $a) {
    $go=buscarGuia($a);
    echo 'Guia de observación: '.$go;
    insertarGOPI($go,$id);
  }

  

  function buscarGuia($materia){
    $guia= buscaGuia($materia);
    $id=9;
    foreach ($guia  as $g) {
      $id=$g['GO_CLAVE'];
    }
    return $id;
  }




?>
