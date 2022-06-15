<style>
    .font{
        font-size: 20px;
    }
</style>
<div class="">
    <div class="row"style="text-align: center;" >
    <div class="col" style="background-color: white;">
    <form>
        <div class="box-body" style="text-align: center;">
        <div class="box-header with-border">
            <h4 class="box-header with-border"><p style="text-align:center; font-size: 40px;">NUEVO RUBRO</p></h4>
        </div>
        <div class="form-group">
            <label class="font">Acrónimo del nuevo rubro (Ver ejemplo) : DOCENCIA_DOC, FORMACIÓN PROFESIONAL_FOP ...</label>
            <input maxlength="3" type="text" name="rb_clave" id="rb_clave" class="form-control" required placeholder="Nombre del rubro">
        </div>
        <div class="form-group">
            <label class="font">Título del rubro </label>
            <input name="titulo" id="titulo" class="form-control" onchange="create_id_rubro()"  placeholder="Titulo del rubro ..." >
        <div class="form-group">
            <label class="font">Descripción del rubro (Grupo de actividades a desempeñar) </label>
            <textarea name="desc" maxlength="50" id="desc" class="form-control" rows="4" placeholder="Descripción ..." required></textarea>
        </div>
    </div>
    <div class="box-footer">
    <button id="btnNuevo" class="btn btn-primary btn-block" style="width: 50%; float: right;"> Registrar</button>
    </div>
</form>
    </div>
</div>  
<script type="text/javascript">
    function create_id_rubro() {
        evidencia = document.getElementById('titulo').value;
  tam_texto = 0;
  delimitador = 0;
  random =0;
  texto_evidencia = evidencia.toLocaleUpperCase();
   auxtexto = texto_evidencia.split(" ").join("");
   tam_texto = auxtexto.length -1;
   id_subcat = "";
    for (let i = 0; i < tam_texto; i++) {
      if( delimitador < 3){
        random = Math.round(Math.random() * (tam_texto - 1) + 1);
        id_subcat += auxtexto.charAt(random);
        delimitador++;
      }
    }
    document.getElementById('rb_clave').value = id_subcat;
}
$(document).ready(function(){
//Evento de Refistro de Carga horaria 
$(document).on("click", "#btnNuevo", function(e){
  //prevenir que el evento se lanse solo
e.preventDefault(); 
//Variable que se preparan para ser insertadas en la base de datos
    let opcion = 2;
   // document.getElementById('rb_clave').readonly = false;
    let rb_clave = document.getElementById('rb_clave').value;   
    let titulo = document.getElementById("titulo").value;
    let desc =  document.getElementById("desc").value;
    
    //Validacion de campos en caso del que require no funcione
    if(rb_clave != "" && titulo !="" && desc != "" ){
        $.ajax({
        type : 'POST',
        url:'../controller/pda/cRubro.php',
        data: {
            rb_clave : rb_clave,
            titulo:titulo,
            desc:desc,
            opcion: opcion
        },
        success:function (data){
           console.log(data);
           if(data == 1 ){
            alertaCorrecto("El rubro se registro correctamente");
          $('#myModal').modal('toggle');
          setTimeout(() => {
            $('#myModal').modal('hide');
          }, 1000);
            setTimeout(() => {
              form('pda/rubros.php');
            }, 4000);          
           }else if(data == 0){
            alertaError("Error al creal rubro");
             create_id_rubro();
           }
        }   
    });
    }else{
    alert('Campos vacios');
    }   
});
});
    </script>