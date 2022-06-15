<?php 
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cEvaluacion.php");
 require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cAsignacionActividad.php");
 $id_docente = (isset($_GET['cve_docente'])) ? $_GET['cve_docente'] : null;
 $datos = listar_docentes();
 $datos_subcategoria = listar_productos_ev_docente($id_docente);
 $tam = sizeof($datos_subcategoria);
 $aux = 0;
?>
<style>
    .thead-green {
    background-color: black ;
    color: white;
    
    }
</style>
<!-- Inicio -->
<div class="box box-solid">

  <div style="text-align: center;" class="box box-header">
    <label style="font-size: 25px;" for="modificar">Modificar plan de trabajo</label>
  </div>
<!-- Inicio -->

<!-- final -->
<form id="frmCargaHoraria" name="frmCargaHoraria" >
<div id="contenidoproductos">
<?php  
 $count =0;
    for ($i=0; $i <$tam; $i++) {
    $count++;
    $datos_productos = listar_producto_x_docente($datos_subcategoria[$i]["PR_SCAT_CVE"] , $id_docente);
    $productos_t = sizeof($datos_productos);
?>
<table style="float: left;" class="table table-sm table-striped table-info table-hover table-bordered " id="<?php echo $datos_subcategoria[$i]["PR_SCAT_CVE"] ?>">
        
          <thead class="thead-green" style="text-align: center;">
          <tr>
          <td  valign="middle"  style="width: 30%;" >Subcategoría</td>
          <td style="width: 50%;" >Nombre del producto</td>
          <td style="width: 10%;" >Activar producto</td>
          <td style="width: 10%;" >Estado del producto</td>
          </thead>
          </tr>
        <tbody id='pruebatabla' >
            <?php foreach ($datos_productos as $fila) {?>
            <tr style="text-align: center;">
            <?php if($aux < 1){  $aux++; ?>
            <td  valign="middle" rowspan="<?php echo $productos_t ?>" id="menu<?php echo $count ?>" > 
            <label style="margin-top: 100px;"><?php echo $datos_subcategoria[$i]['SCAT_TITULO'];?></label>
            </td>
            <?php } ?>
            <td> 
            <label id="lb<?php echo $fila['PR_CVE'];?>" name="<?php echo $fila['PR_CVE']; ?>" for="<?php echo $fila['PR_CVE']; ?>-chk"><?php echo $fila['PR_TITULO'];?></label>
            </td>
            <td><input  type="checkbox" style="width: 15px; height: 15px ;" id="<?php echo $fila['PR_CVE']; ?>-chk" value="<?php echo $fila['PR_CVE']; ?>"  onclick="verificar(this);"/></td>
            <td>
                <select name="<?php echo $fila['PR_CVE']; ?>S" onchange="accion_producto(this)" id="<?php echo $fila['PR_CVE']; ?>S">
                <?php if( $fila['EC_ACTIVO']  == "A") { ?>
                    <option value="A">Activo</option>
                    <option value="I">Inactivo</option>
                    <option value="P">No asignado</option>
                    <?php } ?>
                    <?php if( $fila['EC_ACTIVO']  == "I") { ?>
                    <option value="I">Inactivo</option>
                    <option value="A">Activo</option>
                    <option value="P">No asignado</option>
                    <?php } ?>
                    <?php if( $fila['EC_ACTIVO']  == "") { ?>
                    <option value="P">No asignado</option>
                    <option value="A">Activo</option>
                    <option value="I">Inactivo</option>
                    <?php } ?>
                </select>
            </td> 
        </tr> 

            <?php    }  ?>

        </tbody>


 <?php $aux =0; } ?>
 </table>
</div>
</form>
</div>

<div class="row" style="text-align: center ;">
    <div class="col">
        <input class="btn btn-primary form-control" style="width: 50%;" onclick="modificar_carga()" type="button" value="Modificar">
    </div>
<button class="btn btn-primary" id="btncollapse" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  <i class="bi bi-folder-plus"></i>
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
  <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
  <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
</svg>
  </button>
</p>
<div class="collapsing" id="collapseExample">
  <div class="card card-body">
  <div class="form-check">
  <input onclick="habilitar('cve_subcat','evidencia','desc_producto','hrs_producto','dias_entrega','pr_especifico','btnAddproductEs','cargar_producto_esp','cve_producto')" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    Crear producto especifico
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" onclick="deshabilitar('cve_subcat','evidencia','desc_producto','hrs_producto','dias_entrega','pr_especifico','btnAddproductEs','cargar_producto_esp','cve_producto')" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
  <label class="form-check-label" for="flexRadioDefault2">
   Seleccionar producto existente 
  </label>
</div>
    <table class="table table-striped">
      <thead style="width: 100%">
        <th>Asignacion de actividad particular a docente </th>
        <th> </th>
      </thead>
        <td>
          <div class="row">
            <div class="col">
            <label>Seleccione la subcategoría</label>
            <select name="cve_subcat"  onchange="buscar_producto()" id="cve_subcat" disabled class="form-control" value="<?php echo  $datos;?>">
                <option value ="">Subcategorías</option>
              <?php   for ($i=0; $i < $num_productos ; $i++) {
                  foreach ($categorias as $fila) {
                  if($fila['clave'] ==$sub[$i]){
              ?>
                  <option value="<?php echo $sub[$i]; ?>"><?php echo $sub[$i].'.-'. $fila['titulo'] ?></option>   
              <?php }}} 
              ?>
            </select>
            </div>
            <div class="col">
            <label>Seleccione el producto </label>
            <select name="cve_producto"  id="cve_producto" disabled class="form-control">
            </select>
            </div>
          </div>
        <br>
        <p>Evidencia a entregar: </p><input disabled id="evidencia" type="text" class="form-control"></input>
        <p>Descripcion del producto: </p><textarea disabled id="desc_producto"  class="form-control" type="textarea"></textarea>
        
        </td> 
        <td style="width: 50%">
        <div class="row">
          <div class="col">
          <p>Total horas del producto: </p><input disabled id="hrs_producto" min="0"  type="number" class="form-control"></input>
          </div>
          <div class="col">
          <p>Dias de entrega: </p><input disabled id="dias_entrega" type="number" min="0"  class="form-control"></input>
          </div>
        </div>
        <br>        
        <div class="card-body d-flex">
          <button id="cargar_producto_esp"  style="width: 50%;"  class="btn btn-info ml-auto" name=" cargar_producto_esp" disabled >Cargar producto especifico </button>
        </div>
        <div class="row">
            <dvi class="col-10">
            <label>Seleccionar producto especifico</label>  
        <select name="pr_especifico" id="pr_especifico" disabled class="form-control" style="width: 100%;"  value="<?php echo  $datos;?>">
        <?php   for ($i=0; $i < $num_productos ; $i++) { 
            $datos = listar_producto($sub[$i]);
            $productos_t = sizeof($datos);
            foreach( $datos as $filas_D){  
              if($filas_D['default'] == 'E' ){
        ?>
            <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave'].'-'.$filas_D['titulo'];?></option>   
        <?php } } }
        ?>
        </select>
      
            </dvi>
            <div class="col">
              <button disabled id="btnAddproductEs" name="btnAddproductEs">Agregar</button>
            </div>
          </div> 
        </td>

          </table>
  </div>
</div>
<?php ?>
<script>
  function getDocente(){
    var docente = "<?php echo $id_docente; ?>";
    return docente;
  }
  function accion_producto (obj){
    var objeto = obj.id;
    var producto_chk =  objeto.substr(0,4)+"-chk";
    var valor_select = document.getElementById(objeto).value;
    if(valor_select === "I"){
      document.getElementById(producto_chk).checked = true;
    }
    if(valor_select === "A"){
      document.getElementById(producto_chk).checked = true;
    }
    if(valor_select === "P"){
      document.getElementById(producto_chk).checked = false;
    }
    console.log(document.getElementById(objeto).value);
    console.log(producto_chk); 
  }
  function habilitar(id_subcat,id_evidencia,id_desc,id_horas,id_diasE,id_especifico,btnAddproductEs,cargar_producto_esp,cve_producto) {
  document.getElementById(id_subcat).disabled = false;
  document.getElementById(cve_producto).disabled = false;
  document.getElementById(id_evidencia).disabled = false;
  document.getElementById(id_desc).disabled = false;
  document.getElementById(id_horas).disabled = false;
  document.getElementById(id_diasE).disabled = false;
  document.getElementById(id_especifico).disabled = true;
  document.getElementById(btnAddproductEs).disabled = true;
  document.getElementById(cargar_producto_esp).disabled = false;

}
function deshabilitar(id_subcat,id_evidencia,id_desc,id_horas,id_diasE,id_especifico,btnAddproductEs,cargar_producto_esp,cve_producto){
  document.getElementById(id_subcat).disabled = true;
  document.getElementById(cve_producto).disabled = true;
  document.getElementById(id_evidencia).disabled = true;
  document.getElementById(id_desc).disabled = true;
  document.getElementById(id_horas).disabled = true;
  document.getElementById(id_diasE).disabled = true;
  document.getElementById(cargar_producto_esp).disabled = true;
  document.getElementById(id_especifico).disabled = false;
  document.getElementById(btnAddproductEs).disabled = false;
}
function verificar(obj)
 {  
   //console.log(obj.id);
   var objeto = obj.id;
   var producto = objeto.substr(0, 4);
   //console.log(producto);  
    if (obj.checked){
      document.getElementById(producto).readOnly = false;
      document.getElementById(producto).value = '000';
    }else{
      document.getElementById(producto).readOnly = true;  
      document.getElementById(producto).value = "";
}   
}

cantidad = 0;
$(document).ready(function(){   
  var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
var collapseList = collapseElementList.map(function (collapseEl) {
  return new bootstrap.Collapse(collapseEl)
})

for (i=0;i<document.frmCargaHoraria.elements.length;i++){
      if(document.frmCargaHoraria.elements[i].type == "checkbox"){
        var id_producto = document.frmCargaHoraria.elements[i].id;
        var id_select_producto = id_producto.substr(0, 4) +"S"};
        if(document.getElementById(id_select_producto).value === "A"){
          document.frmCargaHoraria.elements[i].checked = true;
        }
      }
});


function preprocesar() {
  var sp_cargaH ='';
  for (i=0;i<document.frmCargaHoraria.elements.length;i++){
      if(document.frmCargaHoraria.elements[i].type == "checkbox"){
        if (document.frmCargaHoraria.elements[i].checked){
            var check_obj = document.frmCargaHoraria.elements[i].id;
            var producto = check_obj.substr(0, 4);
                    var input_select =  document.getElementById(producto+"S").value;
    
                      if(sp_cargaH === ''){
                        sp_cargaH = producto + input_select;
                      }else{
                        sp_cargaH +='-'+ producto  + input_select;
                  
              }  
          }
        }
      }
      return sp_cargaH;
}
function modificar_carga(){
    opcion = 3;

    document.getElementById("contenidoproductos").style = "display:block";
    var docente = getDocente();
    var mCarga = preprocesar();
    arreglo = mCarga.split('-');
    tam = arreglo.length;
        $.ajax({
    type : 'POST',
    url:'../controller/pda/cEvaluacion.php',
    data: {
        opcion: opcion,
        docente:docente,
        mCarga: mCarga,
        tam:tam
     },dataType:"JSON",
    success:function (){
      alertaCorrecto("Se modifico la carga con exito")

    }
    });
 }

 $(document).ready(function(){ 
  $(document).on("click","#cargar_producto_esp", function(e){
  e.preventDefault();
  opcion = 2;
  var cve_subcat = document.getElementById('cve_subcat').value;
  var cve_producto = document.getElementById('cve_producto').value;
  var evidencia = document.getElementById('evidencia').value;
  var hrs_producto = document.getElementById('hrs_producto').value;
  var desc_producto = document.getElementById('desc_producto').value;
  var dias_entrega = document.getElementById('dias_entrega').value;
  hrs_producto = calculate_horas(hrs_producto);
      if(evidencia !='' && cve_subcat !='' && hrs_producto !='' && desc_producto !='' && dias_entrega != ''){

              $.ajax({
                      type : 'POST',
                      url:'../controller/pda/cAsignacionActividad.php',
                      dataType:'JSON',
                      data: {
                          cve_subcat: cve_subcat,
                          cve_producto:cve_producto,
                          desc_producto : desc_producto,
                          dias_entrega :dias_entrega,
                          evidencia,evidencia,
                          opcion: opcion
                      },
        success:function (data){
          console.log(data);
          if(data !=0){
            alertaCorrecto("Se registro correctamente el producto especifico");
          //creo una variable para cada una de las tablas con la respectiva clave de la categoria 
          let objtable = document.getElementById(data[0].PR_SCAT_CVE);
          //Encontrar el elemento del menu de la tabla indespensable para seleccionar el contenido de
          menu_content_pr = $("#"+data[0].PR_SCAT_CVE+"").find('td:first-child')[1].id;
          document.getElementById(menu_content_pr).rowSpan+=1;
          let row = objtable.insertRow(-1);
          let cell1 = row.insertCell(0);
          cell1.innerHTML = ' <div style=text-align:center;> <label>'+data[0].PR_TITULO +'</label> </div> ';
          cell1.style.backgroundColor="#66ff33";
          let cell2 = row.insertCell(1);
          cell2.innerHTML = ' <div style=text-align:center;><input type="checkbox" id="'+data[0].PR_CVE+'-chk" value="" onclick="verificar(this);"/> </div> ';
          cell2.style.backgroundColor="#66ff33";
          let cell3 = row.insertCell(2);
          cell3.innerHTML = ' <div style=text-align:center;><input  onchange="modificar_horas(this)"  type="text" value="'+hrs_producto +'" onkeypress="return solonumeros(event)" name="'+data[0].PR_CVE+'" id="'+data[0].PR_CVE+'" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/>   </div> ';
          cell3.style.backgroundColor="#66ff33"
          var objeto_nuevo_inp = data[0].PR_CVE;
          var objeto_nuevo_chk = data[0].PR_CVE+'-chk';
          document.getElementById(objeto_nuevo_inp).readOnly = false;
          document.getElementById(objeto_nuevo_chk).checked = true;
          select = document.getElementById("pr_especifico");
          option = document.createElement("option");
          option.value =data[0].PR_CVE ;
          option.text = data[0].PR_CVE + ".-"+ data[0].PR_TITULO ;
          select.appendChild(option);
          document.getElementById('total_hrs').value = parseInt(hrs_producto) + parseInt(document.getElementById('total_hrs').value);
         limpiar();
         console.log(document.getElementById('collapseExample').className);
         document.getElementById('collapseExample').className = 'collapse';
         document.getElementById(data[0].PR_RE_PE+"-chk").checked=false;
         inputtemp= document.getElementById(data[0].PR_RE_PE);
         inputtemp.value="";
         inputtemp.disabled=true;
        }else{
          alertaError("Error al crear producto especifico subcategoria ya registrada"); 
        }       
        }
      });

 }else{
  alertaError("Error al crear producto especifico campos vacios"); 
 }
 

});

});
</script>