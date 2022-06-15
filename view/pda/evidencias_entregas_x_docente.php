<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cEvaluacion.php");
$docente = (isset($_GET['cve_docente'])) ? $_GET['cve_docente'] : null;
$periodo_actual = (isset($_GET['cve_periodo'])) ? $_GET['cve_periodo'] : '0';
$datos = listar_productos_evaluacion($docente,$periodo_actual);
?>

<div class="box box-solid">
<div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Evaluacion a docente con identificador -> <?php echo $docente ;?>  </p></h4>
    <br>
</div>
<!-- /.box-header -->  
<div class="box-body" >
    <div class="row">
        <div class="col" style="overflow: hidden;">
        <button id="btnEvaluar" class="btn btn-success"> Evaluar</button>
        <form id="frmEvaluacionProducto" name="frmEvaluacionProducto" >
            <table id="tablaproductos" class="table table-striped" >
                <thead>
                    <tr style="text-align: center;"> 
                        <td style="width: 10%;">Id_producto</td>
                        <td >Fecha Programa</td>
                        <td >Fecha de Cumplimiento</td>
                        <td >Url</td>
                        <td>Cump_Tiempo</td>
                        <td>Cumpl_Forma </td>
                        <td>Observaciones</td>
                        <td>Grado de cumplimiento</td>
                       
                    </tr>
                </thead>
                <tbody>
                <?php 
                foreach( $datos as $fila){
                $fecha_cumplimiento = strtotime($fila['EC_FECHA_CUMPLIMIENTO']);
                $fecha_programada = strtotime($fila['fecha']);
               ?>
                <tr style="text-align: center;" id="<?php echo $fila['producto_id']; ?>">
                    <td>
                    <input name="<?php echo $fila['producto_id'];  ?>" onclick="comprobar(this)" type="checkbox" style=" width: 12px; height: 12px;" id="<?php echo $fila['producto_id'];?>-chk" value="<?php echo $fila['producto_id']; ?>"/>
                        <?php echo $fila['producto_id']; ?>
                    </td>
                    <td><?php echo $fila['fecha']; ?></td>
                    <td><?php echo $fila['EC_FECHA_CUMPLIMIENTO']; ?></td>
                    <td>
                    <?php $auxtem=0; if($fila['EC_RUTA'] != "") {  ?>
                        <a style="font-size: 14px;" target="_blank" href=" <?php $auxtem =1; echo $fila['EC_RUTA']; ?>">
                        <i class="bi bi-link"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16">
                        <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9c-.086 0-.17.01-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
                        <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4.02 4.02 0 0 1-.82 1H12a3 3 0 1 0 0-6H9z"/>
                        </svg>
                        </a>
                     <?php  }else{  ?> 
                        <a>No ha entregado</a>
                        <?php $auxtem = 0; } ?>   
                        
                    </td>
                    <td>
                    <?php  $auxtem2 =0 ;  if($fila['EC_RUTA'] != "") {  ?>
                        <?php if($fecha_cumplimiento > $fecha_programada) { ?>
                            <select class="form-control"  onchange="personalizar(this)" style="border: 3px solid  #ff6961;  color: black; width: 90%; "  name="<?php $auxtem2 =1; echo $fila['producto_id'] ?>T" id="<?php echo $fila['producto_id'] ?>T">
                            <option value="N">No</option>
                            <option value="S">Si</option>
                            <option value="P">Prorroga</option>
                        </select>
                       <?php 
                    }else
                    {
                        ?>
                        <select class="form-control"  onchange="personalizar(this)" style=" border: 3px solid #77dd77; color: black; width: 90%; "  name="<?php $auxtem2 = 2; echo $fila['producto_id'] ?>T" id="<?php echo $fila['producto_id'] ?>T">
                            <option value="S">Si</option>
                            <option value="N">No</option>
                            <option value="P">Prorroga</option>
                        </select>
                        <?php
                    }
                    ?>
                     <?php  }else{  ?> 
                        <select class="form-control"  onchange="personalizar(this)" style="border: 3px solid  #ff6961;  color: black; width: 90%; "  name="<?php  $auxtem2 =1;  echo $fila['producto_id'] ?>T" id="<?php echo $fila['producto_id'] ?>T">
                        <option value="N">No</option>
                        <option value="S">Si</option>
                        <option value="P">Prorroga</option>
                    </select>
                        <?php } ?>   

                   
                    </td>
                    <td>
                    <?php $auxtem3 =0 ; if($fila['EC_RUTA'] != "") {  ?>
                        <?php if($fecha_cumplimiento > $fecha_programada) { ?>
                            <select class="form-control"  onchange="personalizar(this)" style=" border: 3px solid #ff6961; color: black; width: 90%; "  name="<?php $auxtem3 = 1; echo $fila['producto_id'] ?>F" id="<?php echo $fila['producto_id'] ?>F">
                            <option value="N">No</option>
                            <option value="S">Si</option>
                            <option value="P">Prorroga</option>
                        </select>
                       <?php 
                    }else
                    {
                        ?>
                         <select class="form-control"  onchange="personalizar(this)" style=" border: 3px solid #77dd77; color: black; width: 90%; "  name="<?php $auxtem3 = 2; echo $fila['producto_id'] ?>F" id="<?php echo $fila['producto_id'] ?>F">
                            <option value="S">Si</option>
                            <option value="N">No</option>
                            <option value="P">Prorroga</option>
                        </select>
                        <?php
                    }
                    ?>
                     <?php  }else{  ?> 
                        <select class="form-control"  onchange="personalizar(this)" style=" border: 3px solid #ff6961; color: black; width: 90%; "  name="<?php $auxtem3 = 1; echo $fila['producto_id'] ?>F" id="<?php echo $fila['producto_id'] ?>F">
                            <option value="N">No</option>
                            <option value="S">Si</option>
                            <option value="P">Prorroga</option>
                        </select>
                       
                    </select>
                        <?php } ?>   
                    </td>
                    <td>
                        <textarea ree  maxlength="250" id="<?php echo $fila['producto_id'];?>Ob" rows="2"></textarea>
                    </td>
                    <td>
                        <input type="text" style="width: 30%;" id="<?php echo $fila['producto_id'];?>GC" value="<?php echo $auxtem + $auxtem2 +$auxtem3; ?>" >
                    </td>
    
                </tr>
                <?php }?>
                </tbody>
            </table>
        </form>
        </div>
    </div>
</div>

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id='modalxD' class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" id="btnClose" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas" method="POST">    
            <div class="modal-body">

            <table class="table table-striped ">
                <thead>
                    <tr style="text-align: center;">
                        <th style="width: 10%;">Producto_id</th>
                        <th style="width: 20%;">Tiempo</th>
                        <th style="width: 20%;">Forma</th>
                        <th style="width: 50%;">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="text-align: center;">
                        <td><input type="text" class="form-control" id="id_producto"></td>
                        <td> 
                    <select class="form-control"  name="cve_Tiempo" id="cve_Tiempo">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                        <option value="P">Prorroga</option>
                    </select>
                    </td>
                    <td> 
                    <select class="form-control" name="cve_Forma" id="cve_Forma">
                        <option value="S">Si</option>
                        <option value="N">No</option>
                        <option value="P">Prorroga</option>
                    </select>
                    </td>
                    <td> <textarea name="observaciones" id="observaciones"  cols ="80" rows="4"></textarea> </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnCancelar" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>
</div>

<script type="text/Javascript">
    function getDocente()
 {   
     var id_docente = "<?php echo $docente ; ?>"
     return id_docente;
 
}
    function verificar2(obj)
 {   
   //console.log(obj.id);
   var objeto = obj.id;
   var producto = objeto.substr(0, 4);
   //console.log(producto);  
    if (obj.checked){
      document.getElementById(producto).readOnly = false;
    }else
      document.getElementById(producto).readOnly = true;  
}

    
function personalizar(obj) {
        let valor = obj.value;
        objeto = obj.id;
        producto = objeto.substr(0, 4);
        valor_actual =  document.getElementById(producto+"GC").value;

        if(valor =="N"){
            obj.style.border = '3px solid rgb(255, 105, 97)' ;
            document.getElementById(producto+"GC").value = parseInt(valor_actual) -1 ;
        }
        if(valor =="P"){
            obj.style.border = '3px solid blue' ;
          
        }
        if(valor =="S"){
            document.getElementById(producto+"GC").value = parseInt(valor_actual) +1 ;
            obj.style.border = '3px solid  #77dd77  ' ;
        }

        }
    $(document).ready(function(){

        for (i=0;i<document.frmEvaluacionProducto.elements.length;i++){
      if(document.frmEvaluacionProducto.elements[i].type == "checkbox"){
        document.frmEvaluacionProducto.elements[i].checked = true;
        if( document.frmEvaluacionProducto.elements[i].checked){
            verificar2(document.frmEvaluacionProducto.elements[i]);
        }
        }
      }
    

function preprocesar() {
  var sp_cargaH ='';
  auxtem = 0;
  for (i=0;i<document.frmEvaluacionProducto.elements.length;i++){
      if(document.frmEvaluacionProducto.elements[i].type == "checkbox"){
        if (document.frmEvaluacionProducto.elements[i].checked){
            var check_obj = document.frmEvaluacionProducto.elements[i].id;
            var producto = check_obj.substr(0, 4);
                    var valor_tiempo =  document.getElementById(producto+"T").value;
                    var valor_Forma =  document.getElementById(producto+"F").value;
                    var observaciones =  document.getElementById(producto+"Ob").value;
                    var grad_cumpl =  document.getElementById(producto+"GC").value;
                      if(sp_cargaH === ''){
                          if(observaciones.length >10){
                            sp_cargaH = producto + valor_tiempo + valor_Forma + observaciones.length + observaciones + grad_cumpl ;
                          }
                      }else{
                           if(observaciones.length >10){
                            sp_cargaH +='-' + producto + valor_tiempo + valor_Forma + observaciones.length + observaciones + grad_cumpl;
                          }
                        
                  
              }  
          }
        }
      }
      if(sp_cargaH ==''){
          return 0;
      }else{
        return sp_cargaH;
      }
     
}

$(document).on("click", "#btnEvaluar", function(e){
    e.preventDefault(); 
    let opcion = 1;
    let eval_producto  =  preprocesar();
    console.log(eval_producto);
    if(eval_producto == 0){
        alertaError("Es necesario ingresar las observaciones de los productos a evaluar");
        $('#myModal').modal('toggle');
      setTimeout(() => {
        $('#myModal').modal('hide');
      }, 1500);
        return false;
    }else{
        var arrayDeCadenas = eval_producto.split('-');
        let num_productos = arrayDeCadenas.length;
        docente = getDocente();

$.ajax({
    type : 'POST',
    url:'../controller/pda/cEvaluacion.php',
    data: {
        eval_producto:eval_producto,
        opcion: opcion,
        num_productos:num_productos,
        docente:docente,
     },
    success:function (){
        alertaCorrecto("Productos evaluados correctamente .....");
      $('#myModal').modal('toggle');
      setTimeout(() => {
        $('#myModal').modal('hide');
      }, 1500);
        setTimeout(() => {
            location.reload();
        }, 5000);          

    }
    });
    }
   

        });
    });
</script>