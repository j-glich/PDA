<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cEvaluacion.php");
$subcategoria = (isset($_GET['entrega_sub'])) ? $_GET['entrega_sub'] : '0';
$docente = (isset($_GET['cve_docente'])) ? $_GET['cve_docente'] : '0';
$periodo_actual = (isset($_GET['cve_periodo'])) ? $_GET['cve_periodo'] : '0';
$datos = listar_pro_subcategoria($docente , $subcategoria,$periodo_actual);
$aux = 0;
?>
<form  id="cargaproductos">
<?php foreach ($datos as $fila) {   $aux++;?>
<?php  if($aux == 1)  { ?>
    <input type="button" onclick="ha_info()"  value="más información" style="margin-bottom: 10px;">
  <div id="informacion"class="row box box-solid" style=" display: none; margin-left: 5px;">
      <div class="col">
          <table class="table table-hove " >
              <thead class="thead-light">
                  <tr>
                      <th >Categoría</th>
                      <th >Actividad Específica</th>
                      <th style="width: 35%;">Subactividades o Acciones</th>
                  </tr>
              </thead>
              <tbody>
                  <td><label style="font-size: 15px;" > <?php echo $datos[0]["CAT_TITULO"]; ?></label></td>
                  <td><label style="font-size: 15px;"> <?php echo $datos[0]["SCAT_TITULO"]; ?></label></td>
                  <td>
                  <?php
                    $pr =  $datos[0]["SCAT_DESCRIPCION"]; 
                    $porciones = explode(",", $pr);
                    $tam = sizeof($porciones);
                    for ($i=0; $i < $tam ; $i++) { ?>
                        <label style="font-size: 12px; "><?php echo $porciones[$i]?></label>
                <?php }?>
                  </td>
              </tbody>
          </table>  
      </div>
  </div>
    <?php   } ?>
<div id="cargahoraria" class="box box-solid">
    <div class="row" style="margin-left: 10px;">
    <img src="../public/img/bd1.png" style="width: 4%; height: 4%; margin-top: 20px;" alt="">
        <div class="col-8"  >
        <h6 style="margin-top: 10px;" >  Act. <?php echo  $aux . " ".$fila["PR_TITULO"];?>  </h6>
        <div style="position: relative; float: left;">
        <h6 style="position: relative; float: left;"> <strong>Detalle producto:</strong>  <?php echo $fila["PR_DESCRIPCION"];?> </h6>
        <h6 > <strong>Vence:</strong>  <?php echo $fila["EC_FECHA_PROGRAMADA"];?> </h6>
      </div>
    </div>
    <div class="col" style="text-align: right; margin-top: 30px;">
    <div style="margin-right: 10px; position: relative; float: left;">
    <input  type="checkbox" style="width: 18px; height: 18px;" id="<?php echo $fila['EC_PR_CVE']; ?>-chk" value="<?php echo $fila['EC_PR_CVE']; ?>"  onclick="verificar(this);"/>
    </div>
    <div style="position: relative; float: left;">
    <textarea id="<?php echo $fila['EC_PR_CVE']; ?>txt" name="url" readonly="true" id="url" class="form-control" style="width: 100%; margin-bottom: 10px;" rows="2"></textarea>
    </div>
      </div>
    </div>
</div>
<?php } ?>
<div style="text-align: center;">
  <input class="btn btn-primary" style="width: 40%;" type="button" id="Agregar" value="Guardar">
</div>
<script>
function verificar(obj){
    var objeto = obj.id;
    var producto = objeto.substr(0, 4) + "txt";
   //console.log(producto);  
    if (obj.checked)
      document.getElementById(producto).readOnly = false;
    else
      document.getElementById(producto).readOnly = true;  
}

    aux = 0;
function ha_info(){
    if (aux == 0) {
        document.getElementById("informacion").style.display = "block";
        aux++;
    }else{
        document.getElementById("informacion").style.display = "none";
        aux--;
    }

}
function getDocente(){
  docente = "<?php echo $docente; ?>";
  return docente;
}

function preprocesar() {
  var sp_cargaProducto ='';
  formulario = document.getElementById("cargaproductos")
  for (i=0;i<formulario.elements.length;i++){
      if(formulario.elements[i].type == "checkbox"){
        if (formulario.elements[i].checked){
          var check_obj = formulario.elements[i].id;
          var producto = check_obj.substr(0, 4);
          var url = document.getElementById(producto+"txt").value;
          if(url === ""){
            alertaError('Se requiere que ingrese la dirección del producto');
            return false;
          }else
          if(sp_cargaProducto === ''){
            num_c = ""+url.length;
                sp_cargaProducto = producto + num_c.length +url.length + url ;
            }else{
              num_c = ""+url.length;
                sp_cargaProducto +='-' + producto + num_c.length+ url.length + url;
              }  
          }
        }
      }
      return sp_cargaProducto;
    }
    



$(document).ready(function(){



$(document).on("click", "#Agregar", function(e){
e.preventDefault();
var opcion = 2;
var sp_cargaproducto = preprocesar();

if(sp_cargaproducto == ""){
  alertaError('Se requiere que ingrese la dirección del producto');
}else{
  var arreglo_productos = sp_cargaproducto.split("-");
  var tam_productos =arreglo_productos.length;
  var docente = getDocente();
$.ajax({
    type : 'POST',
    url:'../controller/pda/cEvaluacion.php',
    data: {
        sp_cargaproducto:sp_cargaproducto,
        opcion: opcion,
        tam_productos:tam_productos,
        docente:docente,
     },
    success:function (){
      alertaCorrecto("se registro");
          $('#myModal').modal('toggle');
          setTimeout(() => {
            $('#myModal').modal('hide');
          }, 1000);    
          setTimeout(() => {
            history.pushState(null, "","index.php");
            window.location.href = window.location.href ;  
          }, 5000);
    }
    });
  }
});


});

</script>
