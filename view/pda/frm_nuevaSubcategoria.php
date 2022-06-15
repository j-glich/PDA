
<?php
try {
    require_once($_SERVER['DOCUMENT_ROOT']."/ae/config/newcnx.php");
  } catch (\Exception $e) {
    require_once("../config/newcnx.php");
  }
  $objeto = new Conexion();
  $conexion = $objeto->Conectar();
  
 $sql2 = 'call sp_li_categoria();';
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
            <h4 class="box-header with-border"><p style="font-size: 40px; text-align: center;">NUEVA SUBCATEGORÍA</p></h4>
        </div>
        <div class="box-body">
        <div class="form-group">
        <label class="font">Clave de la categoria </label>
            <select name="cat_clave" id="cat_clave" class="form-control"style="width: 40%;" >
            <?php 
                foreach( $data as $filas_D){ ?>
                  <option value="<?php echo $filas_D['CAT_CVE']; ?>"><?php echo $filas_D['CAT_CVE'].'.-'.$filas_D['CAT_TITULO']; ?> </option>   
                <?php } //Fin del Select?>
            </select>
        </div>
        <div class="form-group">
            <label class="font">Acrónimo de la nueva subcategoría (Ver ejemplo : IID_Implementa la instrumentación didáctica de las asignaturas)  </label>
            <input maxlength="3" type="text" name="subcat_clave" id="subcat_clave" class="form-control" required placeholder="Identificador de categoría">
        </div>
        <div class="form-group">
            <label class="font">Título del la categoria </label>
            <input name="titulo" id="titulo" class="form-control"  placeholder="Titulo del  la categoría ..." >
        </div>
        <div class="form-group">
            <label class="font">Descripción del la categoría (Grupo de actividades a desempeñar) </label>
            <textarea name="desc" maxlength="400" id="desc" class="form-control" rows="3" placeholder="Descripción ..." required></textarea>
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
    let cat_clave = document.getElementById('cat_clave').value;   
    let subcat_clave = document.getElementById('subcat_clave').value;   
    let titulo = document.getElementById("titulo").value;
    let desc =  document.getElementById("desc").value;


    if(cat_clave != "" && subcat_clave !="" && titulo !="" && desc != "" ){
        $.ajax({
        type : 'POST',
        url:'../controller/pda/coSubCategoria.php',
        data: {
            cat_clave : cat_clave,
            subcat_clave : subcat_clave,
            titulo:titulo,
            desc:desc,
            opcion: opcion
        },
        success:function(){
            toastr["success"]("¡Exito!","Subcategoria registrada");
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
              form('pda/subcategoria.php');
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