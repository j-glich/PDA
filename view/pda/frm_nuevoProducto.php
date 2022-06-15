<?php
try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/newcnx.php");
  } catch (\Exception $e) {
    require_once("../config/newcnx.php");
  }
  $objeto = new Conexion();
  $conexion = $objeto->Conectar();
  
 $sql2 = 'call sp_li_subcategoria();';
 $stmt2 = $conexion->query($sql2);
 //Recoleccion de datos para crear un array con el contenido de la consulta
 while($row = $stmt2->fetch_assoc()){
   $data[] = $row; // Inside while loop
 }
?>
<style>
    .font{
        font-size: 20px;
    }
</style>
<div class="">
    <div class="row" >
    <div class="col" style="background-color: white;">
    <form>
    <div class="box-header with-border">
            <h4 class="box-header with-border"><p style="font-size: 40px; text-align: center;">NUEVO PRODUCTO</p></h4>
        </div>
        <div class="box-body">
        <div class="form-group">
        <label class="font">Clave de la subactividad </label>
            <select name="subcat_clave" id="subcat_clave" class="form-control"style="width: 40%;" >
            <?php 
                foreach( $data as $filas_D){ ?>
                  <option value="<?php echo $filas_D['SCAT_CVE']; ?>"><?php echo $filas_D['SCAT_CVE'].'.-'.$filas_D['SCAT_TITULO']; ?> </option>   
                <?php } //Fin del Select?>
            </select>
        </div>
        <div class="form-group">
            <label class="font">Acrónimo de la nuevo producto (Ver ejemplo : 1100_1101_1102)  </label>
            <input maxlength="4" type="text" name="id_producto" id="id_producto" class="form-control" required placeholder="Identificador del producto">
        </div>
        <div class="form-group">
            <label class="font">Título del producto </label>
            <input name="titulo" id="titulo" class="form-control"  placeholder="Titulo del producto ..." >
        </div>
        <div class="form-group">
            <label class="font">Descripción del producto</label>
            <textarea name="desc" maxlength="400" id="desc" class="form-control" rows="3" placeholder="Descripción ..." required></textarea>
        </div>
        <div class="form-group">
            <label class="font">Dias de entrega</label>
            <input name="d_entrega" id="d_entrega" class="form-control"  placeholder="Dias de entrega" >
        </div>
    </div>
    <div class="box-footer">
    <button id="btnRegistrarsub" class="btn btn-primary btn-block" style="width: 50%; float: right;"> Registrar</button>
    </div>
</form>
    </div>
</div>  
<script type="text/javascript">
$(document).ready(function(){
//Evento de Refistro de Carga horaria 
$(document).on("click", "#btnRegistrarsub", function(e){
  //prevenir que el evento se lanse solo
e.preventDefault(); 
//Variable que se preparan para ser insertadas en la base de datos
    let opcion = 2;
    let subcat_clave = document.getElementById('subcat_clave').value;   
    let id_producto = document.getElementById('id_producto').value;   
    let titulo = document.getElementById("titulo").value;
    let desc =  document.getElementById("desc").value;
    let d_entrega =  document.getElementById("d_entrega").value;

    if(id_producto != "" && subcat_clave !="" && titulo !="" && desc != "" ){
        $.ajax({
        type : 'POST',
        url:'../controller/pda/coProducto.php',
        data: {
            id_producto : id_producto,
            subcat_clave : subcat_clave,
            titulo:titulo,
            desc:desc,
            d_entrega:d_entrega,
            opcion: opcion
        },
        success:function(){
            toastr["success"]("¡Exito!","Subcategoria registrada");
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
            setTimeout(() => {
              form('pda/producto.php');
            }, 4000);
            
        },
        error:function(error){
            console.log(error);
        }
    
    });
    }else{
        toastr["error"]("Favor de insertar todos los campos ", "Campos vacíos ")
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
    }
    /* Validacion de campos en caso del que require no funcione
    if(rb_clave != "" && titulo !="" && desc != "" ){
        $.ajax({
        type : 'POST',
        url:'../controller/pda/pdacRubro.php',
        data: {
            rb_clave : rb_clave,
            titulo:titulo,
            desc:desc,
            opcion: opcion
        },
        dataType: 'JSON',
        success: function(data){
            console.log(data);  
        toastr["success"]("¡Exito!","Rubro registrado");
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
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
            setTimeout(() => {
              form('pda/rubros.php');
            }, 4000);
            
        },
        error: function(error){
          console.log(error);
        }
        
    });
    }else{
        toastr["error"]("¡Error campos vacios!","Rubro no registrado");
          toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
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
    }
    */
});
});
    </script>