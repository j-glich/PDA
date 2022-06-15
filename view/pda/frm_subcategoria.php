<?php
define('ruta',$_SERVER['DOCUMENT_ROOT']);
require_once(ruta."/ae/controller/pda/cSubcategoria.php");
$data= array('clave'=>'','titulo'=>'','desc'=>'');

if(isset($_REQUEST['u'])){
  $data=listar_subcategoria($_REQUEST['u']);
  print_r($data);
} ?>
<div class="">
  <form  id="frmsubcategoria">
    <div class="box-body">
      <div class="form-group">
        <label>Acrónimo de atributo de egreso (Completa con el número de atributo siguiente. Ver ejemplo) : </label>
        <input type="text" name="scat_clave" id="scat_clave" class="form-control"  value="<?php echo $data['clave']; ?>" placeholder="Subategoria" readonly>
        <p class="help-block">ej. ISC_AE1, ISC_AE2, ISC_AE3... </p>
      </div>
      <div class="form-group">
        <label>Título del atributo </label>
        <textarea name="titulo" id="titulo" class="form-control"  rows="2" placeholder="Titulo de la subcategoria ..." ><?php echo $data['titulo']; ?></textarea>
      </div>
      <div class="form-group">
        <label>Descripción de la subcategoria(Grupo de actividades a desempeñar) </label>
        <textarea name="desc" id="desc" class="form-control" rows="3" placeholder="Descripción ..." ><?php echo $data['desc']; ?></textarea>
     
    <!-- /.box-body -->

    <div class="box-footer">
      <?php if(isset($_REQUEST['u'])){ ?>
        <input type="hidden" name="actualizar" id="actualizar" value="actualizar" class="form-control" rows="3">
      </div>
    </div>
      <button data-toggle="modal" data-target="#myModal" id="update" class="btn btn-primary btn-block">Actualizar Subcategoria</button>
    <?php }else{
     ?> 
      <input type="hidden" name="alta" class="form-control" id="alta" value="1" placeholder="Atributo de egreso">
      <button data-toggle="modal" data-target="#myModal" id="add" class="btn btn-primary btn-block">Registrar Subcategoria</button>
      
    <?php } ?>
    </div>
  </form>
</div>
    
    
<script type="text/javascript">
  $("#update").click(function(){
    $.ajax({
          method: "POST",
          dataType : "text",
          url :"../../ae/controller/pda/cSubcategoria.php" ,
          data: $("#frmsubcategoria").serialize(),
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
                            console.log("err");
                        }
      });
  });

	$("#add").click(function(){
    $.ajax({
          method: "POST",
          dataType : "text",
          url :" /ae/controller/AtributosController.php" ,
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
