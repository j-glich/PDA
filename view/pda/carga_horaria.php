<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cAsignacionActividad.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cCargaHoraria.php");
$periodo_actual = (isset($_GET['cve_periodo'])) ? $_GET['cve_periodo'] : '0';
  //echo $cve_docente;
$sub = ["0" => "DFG" ];
  //Obtenemos el tamanio del arreglo 
$num_productos = sizeof($sub);

$sub_horas = ["0" => "000" ] ;
$hr = sizeof($sub_horas);
$docentes = listar_docentes();
$subcategoria= listar_subcategoria();
$aux =0;
?>
<div id="cargahoraria" class="box box-solid">
  <!-- /.box-header -->
  <div class="box-body "  >
  <style>
      .thead-green {
      background-color: #25d366;
      color: white;
    
    }
    .redondo{
        width: 40px;
        height: 40px;
        border-radius: 50%;
      }
  </style>
  <div class="row">
    <div class="col-6" style="text-align: center;">
    <div class="form-group row mb-4">
      <label for="" style="margin-left: 10px ;"> Clave docente</label>
      <div class="col-sm-9">
        <select name="cve_docente" id="cve_docente"  class="form-control" style="width: 80%; font-size: 20px;" >
                  <option value="0">Seleccione un docente...</option>
                <?php 
                foreach( $docentes as $filas_D){ ?>
                  <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave'].'.-'. 
                  $filas_D['nombre1'] ?></option>   

                <?php } //Fin del Select?>
        </select>
      </div>
    </div>
 <div>
    <button data-toggle="tooltip" style="margin-right: 60px; margin-left: -20px;" data-placement="top" title="Agregar" id="addCargaH" name="addCargaH" onclick="agregar_carga()" > 
          Salvar asignación
                <i class="bi bi-cloud-upload"></i> 
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                      <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                </svg>
        </button>
        <button data-toggle="tooltip" data-placement="top" title="Regresar" id="regresar" name="regresar" > 
         Limpiar
              <i class="bi bi-box-arrow-in-left"></i>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
              </svg>
        </button>
 </div> 
</div>
<div class="col">
    <div class="form-group row mb-4">
        <label for="email" class="col-sm-3 col-form-label text-right tm-color-primary">  Total de horas al semestre</label>
        <div class="col-sm-9">
            <input type="text" name="total_hrs" id="total_hrs" class="form-control" aling-text="right">
        </div>
    </div>
    <div class="form-group row mb-4">
              <div class="col-sm-9">
                  <select name="cve_subcategoria"  id="cve_subcategoria" class="form-control" style="width: 80%; font-size: 20px;" >
                        <option value="0">Generar nueva subcategoria</option>
                <?php 
                foreach( $subcategoria as $row){   
                  if($row['clave'] != $sub['0']){
                  ?>
                        <option value="<?php echo $row['clave']; ?>"><?php echo $row['clave'].'.-'.  $row['titulo'] ?></option>   
                <?php } } //Fin del Select?>
              </select> 
              </div>
                  <input type="button"  onclick="insertar_sub()" value="Agregar" class="btn btn-info">
            </div>
    </div>
  </div>
  </div>   

  <div id="contenido2">
    <?php 
      $aux_tem_subcategoria =0;
      foreach( $subcategoria as $row){   
          $new_arreglo[] = array('clave' =>$row['clave']);
        } 
      $tam_sub = sizeof($new_arreglo);
      $count_temp =0;
      for ($i=0; $i < $tam_sub ; $i++) { 
        $count_temp++;
        $datos = listar_producto($new_arreglo[$i]['clave']);
        $productos_t = sizeof($datos);
      if($new_arreglo[$i]['clave'] == $sub['0'] ){
?>
<div id="<?php echo $new_arreglo[$i]['clave'] ?>D" style=" display: block">
<form action="" id="<?php echo $new_arreglo[$i]['clave'];  ?>F">
 <table style="float: left;" class="table table-sm table-striped table-hover table-bordered " id="<?php echo $new_arreglo[$i]['clave'] ?>T">
        <thead class="thead-green" style="text-align: center;">
        <tr>
        <td  valign="middle"  style="width: 30%;" >Nombre subcategoría
        <input type="button" id="<?php  echo $new_arreglo[$i]['clave'] ?>"  onclick="eliminar2(this)" value="Eliminar" class="btn btn-danger"></td>
        <td style="width: 50%;" >Nombre del producto</td>
        <td style="width: 10%;" >Activar producto</td>
        <td style="width: 10%;" >Horas del producto</td>
        </thead>
        </tr>
        <tbody id='pruebatabla' >
        <?php 
            //obetemos la longitud del arreglo mediante el metodo sizeof() el cual resive el arreglo productos 
            foreach( $datos as $subs){     
            ?>
            <tr style="text-align: center;" id="<?php echo $subs['clave']; ?>tr">
            <?php   if($aux_tem_subcategoria < 1 ){  $aux_tem_subcategoria++;?>
                <td valign="middle" rowspan="<?php echo $productos_t ?>" id="menu<?php echo $count_temp ?>"> <label style="position:relative; top: 80px;" for=""><?php echo $subs['categoría'];?></label></td>
                <?php }
                if($subs['default'] != 'E' ){
                ?>
                <td><label id="lb<?php echo $subs['clave'];?>" name="<?php echo $subs['clave']; ?>" for="<?php echo $subs['clave']; ?>-chk"><?php echo $subs['titulo'];?></label></td>
                <td><input class="chk_producto"  type="checkbox" id="<?php echo $subs['clave']; ?>-chk" value="<?php echo $subs['clave']; ?>"  onclick="verificar(this);"/></td>
                <td>
                <input max="3" maxlength="3" min="1" minlength="1"  onchange="modificar_horas(this)"  type="text" value="000" onkeypress="return solonumeros(event)" name="<?php echo $subs['clave']; ?>" id="<?php echo $subs['clave']; ?>" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/>  
             <?php 
            } ?>
              </td>   
            </tr> 
<?php  
            }
            $aux_tem_subcategoria =0;
?>
</tbody>      
</table>
</form>
</div>
<?php } else { ?>

<div id="<?php echo $new_arreglo[$i]['clave'] ?>D" style=" display: none">
<form action="" id="<?php echo $new_arreglo[$i]['clave'];  ?>F">
<table style="float: left;" class="table table-sm table-striped table-hover table-bordered " id="<?php echo $new_arreglo[$i]['clave'] ?>T">
       <thead class="thead-green" style="text-align: center;">
       <tr>
       <td  valign="middle"  style="width: 30%;" >Nombre subcategoría
       <input type="button" id="<?php  echo $new_arreglo[$i]['clave'] ?>"  onclick="eliminar2(this)" value="Eliminar" class="btn btn-danger">
     </td>
       <td style="width: 50%;" >Nombre del producto
     </td>
       <td style="width: 10%;" >Activar producto</td>
       <td style="width: 10%;" >Horas del producto</td>
       </thead>
       </tr>
       <tbody id='pruebatabla' >
       <?php 
           //obetemos la longitud del arreglo mediante el metodo sizeof() el cual resive el arreglo productos 
          foreach( $datos as $subs){ ?>
            <tr style="text-align: center;">
            <?php   if($aux_tem_subcategoria < 1 ){  $aux_tem_subcategoria++;?>
              <td valign="middle" rowspan="<?php echo $productos_t ?>" id="menu<?php echo $count_temp ?>"> <label style="position:relative; top: 80px;" for=""><?php echo $subs['categoría'];?></label></td>
              <?php }
                if($subs['default'] != 'E' ){
              ?>
              <td> <label id="lb<?php echo $subs['clave'];?>" name="<?php echo $subs['clave']; ?>" for="<?php echo $subs['clave']; ?>-chk"><?php echo $subs['titulo'];?></label></td>
              <td><input class="chk_producto"   type="checkbox" id="<?php echo $subs['clave']; ?>-chk" value="<?php echo $subs['clave']; ?>"  onclick="verificar(this);"/></td>
              <td>
              <input max="3" maxlength="3" min="1" minlength="1" onchange="modificar_horas(this)"  type="text" value="000" onkeypress="return solonumeros(event)" name="<?php echo $subs['clave']; ?>" id="<?php echo $subs['clave']; ?>" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/>  
              <?php 
            } ?>
              </td>   
            </tr> 
<?php      }
          $aux_tem_subcategoria =0;
?>
</tbody>      
</table>
</form>
</div>

<?php }
}
?>
</div>
  <p>
  <button class="btn btn-primary" id="btncollapse" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  <i class="bi bi-folder-plus"></i>
  <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
  <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
  <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
</svg>
Producto Especifico
  </button>
</p>
<div class="collapsing" id="collapseExample">
  <div class="card card-body">

    <table class="table table-striped">
      <thead style="width: 100%">
        <th>
                  <div class="form-check">
            <input onclick="habilitar('cve_subcat','evidencia','desc_producto','hrs_producto','dias_entrega','pr_especifico','btnAddproductEs','cargar_producto_esp','cve_producto','cve_subcat2')" class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">
              Crear producto específico
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" onclick="deshabilitar('cve_subcat','evidencia','desc_producto','hrs_producto','dias_entrega','pr_especifico','btnAddproductEs','cargar_producto_esp','cve_producto','cve_subcat2')" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
            <label class="form-check-label" for="flexRadioDefault2">
            Seleccionar producto existente 
            </label>
          </div>  
        Asignacion de actividad particular a docente </th>
        <th>
        <div class="row">
            <div class="col">
            <label>Seleccione la subcategoría</label>
            <select name="cve_subcat2"  onchange="buscar_producto_especifico()" id="cve_subcat2" disabled class="form-control" >
                <option value ="">Subcategorías</option>
                <option value="DFG">DFG.-DOCENCIA FRENTE A GRUPO</option>   
            </select>
            </div>
            <div class="col">
            <label>Seleccione el producto Específico </label>
            <select name="pr_especifico"  id="pr_especifico" disabled class="form-control">
            </select>
            </div>
            <button disabled id="btnAddproductEs" name="btnAddproductEs">Agregar</button>
          </div>    
    
          
      </th>
      </thead>
      <tr>
        <td>
          <div class="row">
            <div class="col">
            <label>Seleccione la subcategoría</label>
            <select name="cve_subcat"  onchange="buscar_producto()" id="cve_subcat" disabled class="form-control" >
                <option value ="">Subcategorías</option>
                <option value="DFG">DFG.-DOCENCIA FRENTE A GRUPO</option>   
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
        <p>Descripcion del producto: </p><textarea disabled id="desc_producto"  class="form-control" type="textarea"></textarea>
        </td>
        </tr>
          </table>
          <div>
          <div id="divPadre" style=" width:100%;text-align:center;">
             <div id="divHijo" style="height:50px;width:400px;margin:0px auto;"> <button id="cargar_producto_esp"  style="width: 100%;" class="btn btn-info" name=" cargar_producto_esp" disabled >Cargar producto especifico </button>  </div>
         </div>
         
          
  </div>
        
  </div>
  

</div>
</div>
<script>
  function calculate_horas(hrs_producto){
  sub_horas = "";
 if(hrs_producto.length == 1){
   sub_horas = "00"+hrs_producto;
 }
 if(hrs_producto.length == 2){
   sub_horas = "0"+hrs_producto;
 }
 if(hrs_producto.length == 3){
   sub_horas = hrs_producto;
 }
 return sub_horas;
}
  function preprocesar() {
  var sp_cargaH ='';
  var chk_productos = document.getElementsByClassName("chk_producto");
  var productos = [];
    for(i=0;i<chk_productos.length;i++){
        if(chk_productos[i].checked){
            productos.push(chk_productos[i].value);
        }
    }
for (let index = 0; index < productos.length; index++) {
     var producto = productos[index];
     var valor =  document.getElementById(producto).value;
          cantidad+= parseInt(valor);
              if(sp_cargaH === ''){
                      sp_cargaH = producto + calculate_horas(valor);
                  }else{
                      sp_cargaH +='-'+producto + calculate_horas(valor);
                  
              }  
}
      return sp_cargaH;
}
  function agregar_carga(){
    clv_docente = document.getElementById('cve_docente').value;
    hr_producto = document.getElementById('total_hrs').value;
    opcion =  1;
    sp_cargaH  =  preprocesar();
    sPeriodo = "<?php echo $periodo_actual?>";
    console.log(sp_cargaH + sPeriodo);
    if(sp_cargaH == "" || clv_docente == "0"){
      if(sp_cargaH == ""){
      alertaError("Favor de registrar un subcategoria");
      }
      if(clv_docente == '0'){
        alertaError("Favor de seleccionar un docente");
      }
    }else{
      $.ajax({
        type : 'POST',
        url:'../controller/pda/cAsignacionActividad.php',
        data: {
            clv_docente : clv_docente ,
            sp_cargaH :sp_cargaH,
            sPeriodo : sPeriodo,
            opcion: opcion
        },
        success:function (){
          alertaCorrecto("La carga horaria se realizo con exito...");
          $('#myModal').modal('toggle');
          setTimeout(() => {
            $('#myModal').modal('hide');
          }, 1000);
          setTimeout(() => {
            history.pushState(null, "","index.php");
            window.location.href = window.location.href + "?sp_registro=2&cve_periodo="+sPeriodo;  
          }, 5000);
             
        },
        error: function(error){
          console.error(error)
        }
      });
    }
  }
function solonumeros(e) {
                key= e.keyCode || e.which;
                teclado = String.fromCharCode(key);
                numero="0123456789";
                especiales ="8-37-38-46"; //array
                teclado_es = false;
                for (var i in especiales) {
                    if (key == especiales[i]) {
                        teclado_es = true;
                    }
                }
                if(numero.indexOf(teclado) == -1 && !teclado_es){
                    alert("No puedes ingresar lestras");
                return false;
            }
    }

function cargar_tabla(subcategoria){
    console.log(document.getElementById(subcategoria+"F"));
    for (i=0;i<document.getElementById(subcategoria+"F").elements.length;i++){
        if(document.getElementById(subcategoria+"F").elements[i].type == "checkbox"){
          document.getElementById(subcategoria+"F").elements[i].checked = true;
          if( document.getElementById(subcategoria+"F").elements[i].checked){
              verificar2(document.getElementById(subcategoria+"F").elements[i]);
              var check_obj = document.getElementById(subcategoria+"F").elements[i].id;
              var producto = check_obj.substr(0, 4);
              verificar(document.getElementById(producto));
          }
          }
        }
      document.getElementById('total_hrs').value = cantidad;
}

function desabilitar_tabla(subcategoria){
  opcion = 6;

  $.ajax({
        type : 'POST',
        url:'../controller/pda/cAsignacionActividad.php',
        dataType:'JSON',
        data: {
            cve_subcategoria : subcategoria ,
            opcion: opcion
        },
        success:function (data){
          aux_temp =0;
          producto_array= [];
          for (j=0;j<document.getElementById(subcategoria+"F").elements.length;j++){
            if(document.getElementById(subcategoria+"F").elements[j].type == "checkbox"){
              document.getElementById(subcategoria+"F").elements[j].checked = true;
              if(document.getElementById(subcategoria+"F").elements[j].checked){
                var check_obj = document.getElementById(subcategoria+"F").elements[j].id;
                var producto = check_obj.substr(0, 4);
                producto_array.push(producto);
                document.getElementById(subcategoria+"F").elements[j].checked = false;
              }
            
            }
          }
          console.log(producto_array);
          console.log(data)

          revers_arreglo = producto_array.reverse();
          for (let i = 0; i < data.length; i++) {
            revers_arreglo.pop(data[i].PR_CVE); 
          }

          for (let j = 0; j < revers_arreglo.length; j++) {
          
            console.log(document.getElementById(revers_arreglo[j]+"tr").remove());
          }
          console.log(revers_arreglo);
        },
        error: function(error){
          console.error(error)
        }
      });

     
}


function insertar_sub(){
  opcion = 7;
  var subcategoria = document.getElementById('cve_subcategoria').value;
if(subcategoria ==0 ){
     alertaError("Seleccione una subcategoría");
}else{

document.getElementById(subcategoria+"D").style = "display:block";
cargar_tabla(subcategoria);

var chk_productos = document.getElementsByClassName("chk_producto");
  var productos = [];
    for(i=0;i<chk_productos.length;i++){
        if(chk_productos[i].checked){
            productos.push(chk_productos[i].value);
        }
    }
for (let index = 0; index < productos.length; index++) {
     var producto = productos[index];
     var valor =  document.getElementById(producto).value;
          cantidad+= parseInt(valor);
}
document.getElementById('total_hrs').value = cantidad;
$("#cve_subcategoria").find("option[value="+subcategoria+"]").remove();  

$.ajax({
        type : 'POST',
        url:'../controller/pda/cAsignacionActividad.php',
        dataType:'JSON',
        data: {
            cve_subcategoria : subcategoria ,
            opcion: opcion
        },
        success:function (data){
          $("#cve_subcat").append('<option value='+data[0].SCAT_CVE+'>'+data[0].SCAT_CVE+'.-'+ data[0].SCAT_TITULO+' </option>');  
          $("#cve_subcat2").append('<option value='+data[0].SCAT_CVE+'>'+data[0].SCAT_CVE+'.-'+ data[0].SCAT_TITULO+' </option>');  
        },
        error: function(error){
          console.error(error)
        }
      });
      

}



}

function eliminar2(obj){
  var div = document.getElementById(obj.id+"D");
  opcion = 7;
  var cve_subcategoria = obj.id;

  $.ajax({
        type : 'POST',
        url:'../controller/pda/cAsignacionActividad.php',
        dataType:'JSON',
        data: {
            cve_subcategoria : cve_subcategoria ,
            opcion: opcion
        },
        success:function (data){
          $("#cve_subcategoria").append('<option value='+data[0].SCAT_CVE+' selected="selected"> '+data[0].SCAT_CVE+'.-'+ data[0].SCAT_TITULO+' </option>');  
        },
        error: function(error){
          console.error(error)
        }
      });
      
      document.getElementById(cve_subcategoria+"D").style = 'display:none';
  desabilitar_tabla(cve_subcategoria);
  $("#cve_subcat").find("option[value="+cve_subcategoria+"]").remove(); 
  $("#cve_subcat2").find("option[value="+cve_subcategoria+"]").remove(); 
  alertaCorrecto("Se ha eliminado correctamenta la tabla con identificador: " + obj.id);
  }
  function modificar_horas(obj){
    console.log(obj.id)
    let cantidad_modificada = document.getElementById(obj.id).value;
    console.log(cantidad_modificada);
    let valor_actual =   document.getElementById('total_hrs').value ;
    document.getElementById('total_hrs').value   =  parseInt(valor_actual) + parseInt(cantidad_modificada) ;
  }
  function buscar_producto(){
    let opcion = 4;
    let cve_subcategoria = document.getElementById('cve_subcat').value;
    if(cve_subcategoria !=""){
      $.ajax({
                      type : 'POST',
                      url:'../controller/pda/cAsignacionActividad.php',
                      dataType:'JSON',
                      data: {
                        cve_subcategoria: cve_subcategoria,
                          opcion: opcion
                      },
        success:function (data){
          document.getElementById("cve_producto").innerHTML ="";
    for(var i=0;i<data.length;i++){ 
      if(data[i].PR_DEFAULT != 'E'){
        document.getElementById("cve_producto").innerHTML += "<option value='"+data[i].PR_CVE+"'>"+data[i].PR_CVE+".-"+data[i].PR_TITULO+"</option>"; 
      }
    }  
        } 
      });
    }else{
      document.getElementById("cve_producto").innerHTML ="";
    }
 
  }

  function buscar_producto_especifico(){
    let opcion = 4;
    let cve_subcategoria = document.getElementById('cve_subcat2').value;
    if(cve_subcategoria !=""){
      $.ajax({
                      type : 'POST',
                      url:'../controller/pda/cAsignacionActividad.php',
                      dataType:'JSON',
                      data: {
                        cve_subcategoria: cve_subcategoria,
                          opcion: opcion
                      },
        success:function (data){
          document.getElementById("pr_especifico").innerHTML ="";
    for(var i=0;i<data.length;i++){ 
      if(data[i].PR_DEFAULT == 'E'){
        document.getElementById("pr_especifico").innerHTML += "<option value='"+data[i].PR_CVE+"'>"+data[i].PR_CVE+".-"+data[i].PR_TITULO+"</option>"; 
      }
    }  
        } 
      });
    }else{
      document.getElementById("cve_producto").innerHTML ="";
    }
 
  }
  
  /*Funcion de los cambios cambia lo que esta en id=area*/

 function comprobar(obj)
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
</script>
<script type="text/javascript">
function habilitar(id_subcat,id_evidencia,id_desc,id_horas,id_diasE,id_especifico,btnAddproductEs,cargar_producto_esp,cve_producto,cve_subcat2) {
  document.getElementById(id_subcat).disabled = false;
  document.getElementById(cve_producto).disabled = false;
  document.getElementById(id_evidencia).disabled = false;
  document.getElementById(id_desc).disabled = false;
  document.getElementById(id_horas).disabled = false;
  document.getElementById(id_diasE).disabled = false;
  document.getElementById(id_especifico).disabled = true;
  document.getElementById(btnAddproductEs).disabled = true;
  document.getElementById(cargar_producto_esp).disabled = false;
  document.getElementById(cve_subcat2).disabled = true;

}
function deshabilitar(id_subcat,id_evidencia,id_desc,id_horas,id_diasE,id_especifico,btnAddproductEs,cargar_producto_esp,cve_producto,cve_subcat2){
  document.getElementById(id_subcat).disabled = true;
  document.getElementById(cve_producto).disabled = true;
  document.getElementById(id_evidencia).disabled = true;
  document.getElementById(id_desc).disabled = true;
  document.getElementById(id_horas).disabled = true;
  document.getElementById(id_diasE).disabled = true;
  document.getElementById(cargar_producto_esp).disabled = true;
  document.getElementById(id_especifico).disabled = false;
  document.getElementById(btnAddproductEs).disabled = false;
  document.getElementById(cve_subcat2).disabled = false;
}

function getCategorias(){
  return carga_cat = "DFG" ;
}

function gethoras(){
  return carga_hr = "000" ;
}

function verificar(obj)
 {  
   //console.log(obj.id);
   var objeto = obj.id;
   var producto = objeto.substr(0, 4);
   //console.log(producto);  

      document.getElementById(producto).disabled = false;
      document.getElementById(producto).value = '000';
     
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
cantidad = 0;
$(document).ready(function(){   
  var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
var collapseList = collapseElementList.map(function (collapseEl) {
  return new bootstrap.Collapse(collapseEl)
})

cargar_tabla('DFG');


$(document).on("click","#regresar" , function(e){
  e.preventDefault();  
  history.pushState(null, "","index.php");
  window.location.href = window.location.href + "?sp_registro=2";
});



function limpiar(){

          document.getElementById('evidencia').value ="";
          document.getElementById('hrs_producto').value = "";
          document.getElementById('desc_producto').value = "";
          document.getElementById('dias_entrega').value = ""
}

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
          cell2.innerHTML = ' <div style=text-align:center;><input class="chk_producto" type="checkbox" id="'+data[0].PR_CVE+'-chk" value="" onclick="verificar(this);"/> </div> ';
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
aux = 0;
$(document).on("click", "#btnAddproductEs", function(e){
    e.preventDefault();
    let opcion = 3;
    alert('Cargar nuevo producto especifico ');
     product_especifico = document.getElementById('pr_especifico').value;
     if(product_especifico != ""){
      $.ajax({
                      type : 'POST',
                      url:'../controller/pda/cAsignacionActividad.php',
                      dataType: "JSON",
                      data: {
                          product_especifico: product_especifico ,
                          opcion: opcion
                      },
        success:function (data){

        
          alertaCorrecto("Se registro correctamente el producto especifico");
          let objtable = document.getElementById(data[0].PR_SCAT_CVE+"T");

          $("#pr_especifico").find("option[value="+data[0].PR_CVE+"]").remove();  
            //Encontrar el elemento del menu de la tabla indespensable para seleccionar el contenido de
          menu_content_pr = $("#"+data[0].PR_SCAT_CVE+"T").find('td:first-child')[1].id;
          document.getElementById(menu_content_pr).rowSpan+=1;
          let row = objtable.insertRow(-1);
          row.id = data[0].PR_CVE +'tr';
          let cell1 = row.insertCell(0);
          cell1.innerHTML = ' <div style=text-align:center;> <label>'+data[0].PR_TITULO +'</label> </div> ';
          cell1.style.backgroundColor="#66ff33";
          let cell2 = row.insertCell(1);
          cell2.innerHTML = ' <div style=text-align:center;><input class="chk_producto" type="checkbox" id="'+data[0].PR_CVE+'-chk" value="" onclick="verificar(this);"/> </div> ';
          cell2.style.backgroundColor="#66ff33";
          let cell3 = row.insertCell(2);
          cell3.innerHTML = ' <div style=text-align:center;><input  onchange="modificar_horas(this)"  type="text" value="000" onkeypress="return solonumeros(event)" name="'+data[0].PR_CVE+'" id="'+data[0].PR_CVE+'" readonly="true" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"aling="right"/>   </div> ';
          cell3.style.backgroundColor="#66ff33"
        // console.log(document.getElementById('collapseExample').className);
        //document.getElementById('collapseExample').className = 'collapse';
          console.log(data);
          var objeto_nuevo_inp = data[0].PR_CVE;
          var objeto_nuevo_chk = data[0].PR_CVE+'-chk';
          document.getElementById(objeto_nuevo_inp).readOnly = false;
          document.getElementById(objeto_nuevo_chk).checked = true;
          document.getElementById(data[0].PR_RE_PE+"-chk").checked=false;
         inputtemp= document.getElementById(data[0].PR_RE_PE);
         inputtemp.value="";
         inputtemp.disabled=true;
            
        
        } 
      
      });
     }else{
       alertaError('Error al cargar el producto especifico');
     }

});



    });
</script>