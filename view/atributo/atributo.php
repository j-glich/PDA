<?php
define('ruta',$_SERVER['DOCUMENT_ROOT']);
require_once(ruta."/ae/controller/AtributosController.php");
$data= array('id'=>'','desc'=>'');

if(isset($_REQUEST['d']))
{
   mdelAtributo($_REQUEST['d']);   
}

if(!isset($_REQUEST['d']))
{
if(isset($_REQUEST['u'])){
  $data= valores($_REQUEST['u']);
} ?>
<div class="">
  <form  id="frmatr">
    <div class="box-body">
      <div class="form-group">
        <label for="atributo">Acrónimo de atributo de egreso (Completa con el número de atributo siguiente. Ver ejemplo) : </label>
        <input type="text" name="atr" class="form-control" id="atributo" value="<?php echo $data['id']; if(!isset($_REQUEST['u'])){echo $_SESSION['area']."_AE";} ?>" placeholder="Atributo de egreso">
        <p class="help-block">ej. ISC_AE1, ISC_AE2, ISC_AE3... </p>
      </div>
      <div class="form-group">
        <label>Descripción del atributo de egreso (Competencia del atributo de egreso) </label>
        <textarea name="desc" class="form-control" rows="3" placeholder="Descripción ..." ><?php echo $data['desc']; ?></textarea>
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <?php if(isset($_REQUEST['u'])){ ?>
      <button data-toggle="modal" data-target="#myModal" id="update" class="btn btn-primary btn-block">Actualizar Atributo</button>
    <?php }else{
     ?> 
      <input type="hidden" name="alta" class="form-control" id="alta" value="1" placeholder="Atributo de egreso">
      <button data-toggle="modal" data-target="#myModal" id="add" class="btn btn-primary btn-block">Registrar Atributo</button>
      
    <?php } ?>
    </div>
  </form>
</div>
    <?php }else{ echo "Registro eliminado"; } ?>

<script type="text/javascript">
  $("#update").click(function(){
    $.ajax({
          method: "POST",
          dataType : "text",
          url :"ae/controller/AtributosController.php" ,
          data: $("#frmatr").serialize(),
          success : function (data) {
              if(data=='ok'){
                alertaCorrecto("Se actulizó correctamente el atributo");
                $('#myModal').modal('toggle');
          //      $('#frmatr').empty()
              }else{
                alertaError("Error al actualizar el atributo")
                $('#myModal').modal('toggle');
              }
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
