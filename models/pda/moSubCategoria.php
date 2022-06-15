<?php 
//Establecer Conexion con validacion con objeto conexion de rutas utilizando la variable global $_SERVER['DOCUMENT_ROOT'] y con un path relativo
try {
  require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/newcnx.php");
} catch (\Exception $e) {
  require_once("../config/newcnx.php");
}
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$ip_adress= $_SERVER['REMOTE_ADDR'];
if($ip_adress=='::1'){
  //Validacion de ip
  $ip_adress="127.0.0.1";
}
//Actualizar el valor del usuario tomando el valor de la sesión
//usuario 
$user=200;
//Switch sirve para poder ejecutar diferentes procesos en un solo menu.
  switch ($opcion) {
    //Primer caso de consulta sera actulizar los rubros ya que no realizaba la inserccion de datos
    case '1':
    break;
    case '2':
        //Variable ip del usuario obtenida con la variable global 
          //Conforme ala codigo de mRubro.php el campo de UP_ACTIVO de ser = "";
          //Creamos  una varivale sql que contiene el String que ejecutara la llamada al procedimiento alamacenado de la update
          $sql = "call sp_in_subcategoria('$subcat_clave','$cat_clave','$titulo','$desc','$ip_adress','$user');";
          $stmt = $conexion->query($sql);
          echo $stmt;
      break;

}
//Cerramos la conexion
$conexion = null;
//y imprime el JSON en coonsola pra resivir en el frm_Rubro
?>