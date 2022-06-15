<?php
define('ruta',$_SERVER['DOCUMENT_ROOT']);
require_once(ruta."/ae/controller/pda/cCategoria.php");
?>
<div class="">
  <div class="row">
    <div class="col" style="background-color: white;">
    <form  id="frmcategoria">
    <div class="box-body">
      <div class="box-header with-border">
          <h4 class="box-header with-border"><p style="text-align:center;">Actualizar categoría</p></h4>
      </div>
      <!-- Contiene  un arreglo con los datos de la fila seleccionada  -->
      <?php $data= array('clave'=>'','titulo'=>'','desc'=>'');
      if(isset($_REQUEST['u'])){
        //Recupera los dados mediante una respuesta al servidor y manda a llamar auna funcion del archov cCategoria.
        $data=listar_categoria($_REQUEST['u']);
        } ?>
      <div class="form-group">
        <label>Clave de la categoría </label>
        <input type="text" name="cat_clave" id="cat_clave" class="form-control"  value="<?php echo $data['clave']; ?>" placeholder="Acrónimo de  categoria" readonly>
      </div>
      <div class="form-group">
        <label>Título del atributo </label>
        <input name="titulo" id="titulo" class="form-control" placeholder="Titulo de la categoria ..." value="<?php echo $data['titulo']; ?>">
      </div>
      <div class="form-group">
        <label>Descripción de la categoria(Grupo de actividades a desempeñar) </label>
        <textarea name="desc" id="desc" class="form-control" rows="4" placeholder="Descripción ..." ><?php echo $data['desc']; ?></textarea>  
    <!-- /.box-body -->
    <div class="box-footer">
      <?php if(isset($_REQUEST['u'])){ ?>
        <input type="hidden" name="actualizar" id="actualizar" value="actualizar" class="form-control" rows="3">
      </div>
    </div>
        <button id="btn_upCategoria" class="btn btn-primary btn-block" style="width: 50%; float: right;">Actualizar Categoria</button>
    <?php }else{
     ?> 
       <input type="hidden" name="agregar" id="agregar" value="agregar" class="form-control" rows="3">
      </div>
    </div>
      <input type="hidden" name="alta" class="form-control" id="alta" value="1" placeholder="Atributo de egreso">
      <button data-toggle="modal" data-target="#myModal" id="add" class="btn btn-primary btn-block">Registrar Categoria</button>
      
    <?php } ?>
    </div>
  </form>                                                     
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
//Evento de Refistro de Carga horaria 
$(document).on("click", "#btn_upCategoria", function(e){
  //prevenir que el evento se lanse solo
    e.preventDefault();  
    var opcion = 1;
    //Variables del formulario extraidas por el id
    let cat_clave = document.getElementById('cat_clave').value;   
    let titulo = document.getElementById("titulo").value;
    let desc =  document.getElementById("desc").value;
    //Validacion de varianles vacias
    if(cat_clave != "" && titulo !="" && desc != ""){
      $.ajax({
        type : 'POST',
        url:'../controller/pda/coCategoria.php',
        data: {
            cat_clave : cat_clave,
            titulo:titulo,
            desc:desc,
            opcion: opcion
        }, success: function(){
            toastr["success"]("Categoría modificada ", "Actualización exitosa")
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
              form('pda/categoria.php');
            }, 4000);
        },
        error: function(error){
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
  

});
});
  </script>
    <!--
<script type="text/javascript">
  $("#update").click(function(){
    $.ajax({
          method: "POST",
          dataType : "text",
          url :"../../ae/controller/pda/cCategoria.php" ,
          data: $("#frmcategoria").serialize(),
          success : function (data) {
            alert('Datos serializados: '+data);
              alertaCorrecto("Se actualizó correctamente el atributo");
              if(data=='ok'){
                alertaCorrecto("Se actulizó correctamente el atributo");
                $('#myModal').modal('toggle');
              }else{
                alertaError("Error al actualizar el atributo"+data)
                $('#myModal').modal('toggle');
              }
          },     error: function(XMLHttpRequest, textStatus, errorThrown) { 
                            console.log(err);
                        }
      });
  });

	$("#add").click(function(){
    $.ajax({

          method: "POST",
          dataType : "text",
          url :" /ae/controller/cCategoria.php",
          data: $("#frmatr").serialize(),
          success : function (data){
              alert(data);
              if(data=='ok'){
                alertaCorrecto("Se agrego correctamente el atributo, vaya a listar atributos para ver los cambios");
                $('#myModal').modal('toggle');

               // $('#frmatr').empty()
              }else{
                alertaError("Error al crear el atributo") 
                $('#myModal').modal('toggle');
              }
          }
     });
	});

</script>
-->