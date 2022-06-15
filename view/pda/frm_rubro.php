<?php
define('ruta',$_SERVER['DOCUMENT_ROOT']);
require_once(ruta."/ae/controller/pda/cRubro.php");
$data= array('clave'=>'','titulo'=>'','desc'=>'');
?>
<div class="">
  <div class="row">
    <div class="col" style="background-color: white;">
    <form  id="frmrubro">
    <div class="box-body" style="text-align: center;">
        <div class="box-header with-border">
            <h4 class="box-header with-border"><p style="text-align:center; font-size: 40px;">Actualizar Rubro</p></h4>
        </div>
    <div class="box-body">
      <div class="form-group">
      <?php if(isset($_REQUEST['u'])){
        $data=listar_rubro($_REQUEST['u']);
        } ?> <br>
        <label>Acrónimo del rubro : </label>
        <input type="text" name="rb_clave" id="rb_clave" class="form-control"  value="<?php echo $data['clave']; ?>" placeholder="Rubro" readonly>
      </div>
      <div class="form-group">
        <label>Título del rubro</label>
        <input name="titulo" id="titulo" class="form-control" placeholder="Titulo del rubro ..."  value="<?php echo $data['titulo']; ?>">
      </div>
      <div class="form-group">
        <label>Descripción del rubro (Grupo de actividades a desempeñar) </label>
        <textarea name="desc" id="desc" class="form-control" rows="3" placeholder="Descripción ..." ><?php echo $data['desc']; ?></textarea>
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <?php if(isset($_REQUEST['u'])){ ?>
      <button id="update" class="btn btn-primary btn-block" style="width: 50%; float: right;" >Actualizar Rubro</button>
      <?php }?>
    </div>
    </div>
  </form>
  </div>
  </div>
</div>  

  <script type="text/javascript">
    $(document).ready(function(){
//Evento de Refistro de Carga horaria 
$(document).on("click", "#update", function(e){
  //prevenir que el evento se lanse solo
    e.preventDefault();  
    //variable que nos permite manejar el switch
    var opcion = 1;
    //Variables del formulario extraidas por el id
    let rb_clave = document.getElementById('rb_clave').value;   
    let titulo = document.getElementById("titulo").value;
    let desc =  document.getElementById("desc").value;
    //Ajax que permite el envio de parametros mediante post
    $.ajax({
        type : 'POST',
        url:'../controller/pda/cRubro.php',
        data: {
            rb_clave : rb_clave,
            titulo:titulo,
            desc:desc,
            opcion: opcion
        },
        success: function(){
          alertaCorrecto("Se actulizó correctamente el rubro");
          $('#myModal').modal('toggle');
          setTimeout(() => {
            $('#myModal').modal('hide');
          }, 1000);
            setTimeout(() => {
              form('pda/rubros.php');
            }, 4000);           
        },
        error: function(error){
          alertaCorrecto("Error al actulizar el rubro");
          $('#myModal').modal('toggle');
          setTimeout(() => {
            $('#myModal').modal('hide');
          }, 1000);
        }
        
    });
});
});
  </script>
<!--<script type="text/javascript">

  $("#update").click(function(){
    $.ajax({
          method: "POST",
          dataType : "text",
          url :"../../ae/controller/pda/cRubro.php" ,
          data: $("#frmrubro").serialize(),
          success : function (data) {
            alert('Datos serializados: '+data);
              alertaCorrecto("Se actulizó correctamente el atributo");
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

-->


</script>
