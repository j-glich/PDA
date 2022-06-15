<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cAsignacionActividad.php");
  //echo $cve_docente;
$sp_Carga_Cat = $_GET["sp_Carga_Cat"];
$sub =explode('-', $sp_Carga_Cat);
  //Obtenemos el tamanio del arreglo 
$num_productos = sizeof($sub);
$docentes = listar_docentes();
?>
<form id="frmCargaHoraria" name="frmCargaHoraria" >
<div class="box box-solid">
    <div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center; font-size: 40px;">Asignación de productos</p></h4>
    <div class="row">
      <div class="col">
      <label for="lbl" style="font-size: 25px;"> Clave Docente</label>
            <select name="cve_docente" id="cve_docente" class="form-control"style="width: 100%; border: 2px solid black;"  value="<?php echo  $cve_docente;?>">
                <?php 
                foreach( $docentes as $filas_D){ ?> 
                    <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave'].'.-'. 
                    $filas_D['nombre1']. ' ' .$filas_D['nombre2']; ?></option>   
                <?php } //Fin del Select?>
            </select> 
      </div>
    </div>
  
</div>
<!-- /.box-header -->
<div class="box-body" >
<div class="row">
    <div class="col" style="background-color: none;" >
    <table id="tablaproductos" class="table table-striped border-primary" color="black">
        <tbody>
        <tr>
        <thead class="thead-dark" style="text-align: center;">
        <th style="width: 10%;" >id_Categoria</th>
        <th style="width: 50%;" >Nombre del producto</th>
        <th style="width: 20%;" >Activar producto</th>
        <th style="width: 20%;" >Horas del producto</th>

        </tr>
        <?php 
    for ($i=0; $i < $num_productos ; $i++) { 
            $datos = listar_producto($sub[$i]);
            //obetemos la longitud del arreglo mediante el metodo sizeof() el cual resive el arreglo productos 
            foreach( $datos as $subs){     
            ?>
            <tr style="text-align: center;">
            <td> <label  for=""><?php echo $subs['categoría'];?></label></td>
                <td> <label id="lb<?php echo $subs['clave'];?>" name="<?php echo $subs['clave']; ?>" for="<?php echo $subs['clave']; ?>-chk"><?php echo $subs['titulo'];?></label></td>
                <td><input  type="checkbox" id="<?php echo $subs['clave']; ?>-chk" value="<?php echo $subs['clave']; ?>"  onclick="verificar(this);"/></td>
                <td><input  type="text" onkeypress="return solonumeros(event)" name="<?php echo $subs['clave']; ?>" id="<?php echo $subs['clave']; ?>" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/></td>     
            </tr> 
<?php  
            }
        }
?>
</tbody>
    </table>
    <button id="CargarH" name="CargarH" style="width: 35%; background-color: #e7e7e7; color: black; border-radius: 8px; border: 2px solid black; float: right;">Insertar</button>
</div>
</div>
</div>
</form>
<!-- /.box-body -->
</div>
<script>
  function solonumeros(e) {
    key= e.keyCode || e.which;
    teclado = String.fromCharCode(key);
    numero="0123456789";
    especiales ="8-37-38-46-250"; //array
    teclado_es = false;
    for (var i in especiales) {
        if (key == especiales[i]) {
            teclado_es = true;
        }
    }
    if(numero.indexOf(teclado) == -1 && !teclado_es){
    return false;
}

}
function preprosesar(){
  var sp_cargaH ='';
  for (i=0;i<document.frmCargaHoraria.elements.length;i++){
      if(document.frmCargaHoraria.elements[i].type == "checkbox"){
        if (document.frmCargaHoraria.elements[i].checked){
            var check_obj = document.frmCargaHoraria.elements[i].id;
            var scat = check_obj.substr(0, 3);
                    var valor =  document.getElementById(scat).value;
                      if(sp_cargaH === ''){
                        sp_cargaH = scat + valor;
                      }else{
                        sp_cargaH +='-' + scat+valor;
              }  
          }
        }
      }
      return sp_cargaH;
}
 function verificar(obj)
 {   
   //console.log(obj.id);
   var objeto = obj.id;
   var scat = objeto.substr(0, 3);
   //console.log(scat);  
    if (obj.checked)
      document.getElementById(scat).readOnly = false;
    else
      document.getElementById(scat).readOnly = true;  
}
function verificar2(obj)
 {   
   //console.log(obj.id);
   var objeto = obj.id;
   var scat = objeto.substr(0, 3);
   //console.log(scat);  
    if (obj.checked)
      document.getElementById(scat).readOnly = false;
    else
      document.getElementById(scat).readOnly = true;  
}
$(document).ready(function(){   

  for (i=0;i<document.frmCargaHoraria.elements.length;i++){
      if(document.frmCargaHoraria.elements[i].type == "checkbox"){
        document.frmCargaHoraria.elements[i].checked = true;
        if( document.frmCargaHoraria.elements[i].checked){
            verificar2(document.frmCargaHoraria.elements[i]);
        }
        }
      }
  
    $(document).on("click", "#CargarH", function(e){
    e.preventDefault();     
    opcion = 1;
    var carga= preprosesar();
    clave_docente = document.getElementById('cve_docente').value; 
    $.ajax({
        type : 'POST',
        url:'../controller/pda/cAsignacionActividad.php',
        data: {
            clave_docente : clave_docente,
            carga:carga,
            opcion: opcion
        }, success: function(){
            toastr["success"]("Producto Registrados", "Exito")
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
            
          
        },
        error: function(error){
          console.log(error);
        }
    });
    setTimeout(() => {
              form('pda/carga_horaria2.php');
              history.pushState(null, "","index.php?cve_docente="+clave_docente+'&sp_cargaH='+carga);
    }, 1000);
   
  
});
  });
</script>