<?php
  define('ruta',$_SERVER['DOCUMENT_ROOT']);
  //include('../config/routes.php');
  require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cSubcategoria.php");
  //include_once '../includes/session.php';
  //include_once '../includes/functions.php';
  //var_dump($rubros);
  //print_r($datos);

//  while($rubros = $rubro) {
    # code..
 
//   echo $rubro[0];
   // echo $rubro[0].'-'.$rubro[1].'-'.$rubro[2];
 // }

  

 if(isset($_REQUEST['d']))
{
  del_subcategoria($_REQUEST['d']);   
}


$datos = listar_subcategorias();

 
?>
<div class="box box-solid">
<div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Listado de Subcategorias</p></h4>
    <button class="btn btn-xs btn btn-success" id="btnRegistrasSubc">Nueva Subcatecoría</button>
  </div>
  <!-- /.box-header -->
  <div class="box-body" >
    <table class="table table-striped">
      <tbody>
        <tr style="text-align:center;">
          <th style="width: 10%;">Id_SubCat</th>
          <th style="width: 25%;">Titulo</th>
          <th style="width: 45%;">Producto</th>
          <th style="width: 15%;">Acciones</th>
        </tr>
        <?php 
          foreach( $datos as $fila){
        ?>
          <tr style="text-align: center;">
            <td><?php echo $fila['clave']; ?></td>
            <td aling="justify"><?php echo $fila['titulo']; ?></td>
            <td aling="justify"><?php echo $fila['desc']; ?></td>
            <td>
            <button class="btn btn-xs btn btn-info" 
              onclick="acc_subcategoria('C','<?php echo $fila['clave']?>')">
              <i class="bi bi-gear"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
              <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
              <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
              </svg>
            </button>
              <button class=" btn btn-xs btn btn-error"
              onclick="acc_subcategoria('U','<?php echo $fila['clave']?>')">
              <i class="bi bi-eye-slash"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                  <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                  <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                  <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
              </svg></button>
            </td>

          </tr>
        <?php } 
        ?>


      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<script type="text/javascript">

$(document).ready(function(){
    $("#btnRegistrasSubc").click(function(e){
    e.preventDefault();
    form('../view/pda/frm_nuevaSubcategoria.php');

  }); 

  });

function acc_subcategoria(tipo, codigo){
  if(tipo=='U'){    
    confirmar("¿Confirmar desactivar Subcategoria?",'../view/pda/subcategoria.php?d='+codigo);
  }else if (tipo=='C') {
    form('../view/pda/frm_subcategoria.php?u='+codigo);
  }else if(tipo=='A'){
    form('../view/pda/frm_subcategoria.php');
  }
}
</script>

