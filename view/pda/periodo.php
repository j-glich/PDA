<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cPeriodo.php");
$datos = listar_periodo_activo();
?>
<div id="cargahoraria" class="box box-solid">
<!-- /.box-header -->
<div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Periodo actual</p></h4>
            <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Terminar Período
</button>
  </div>

    <div class="box-body"  >
      <table class="table table-light">
        <thead class="thead-light">
          <tr>
            <th>#</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Año</th>
            <th>Descripcion</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $datos['PE_CVE']?></td>
            <td><?php echo $datos['PE_FECHA_INICIO']?></td>
            <td><?php echo $datos['PE_FECHA_FIN']?></td>
            <td><?php echo $datos['PE_ANIO']?></td>
            <td><?php echo $datos['PE_DESCRIPCION']?></td>
            <td style="text-align: center;">
              <button class="btn btn-xs btn btn-info"  data-toggle="modal" data-target="#exampleModal2" >
              <i class="bi bi-gear"></i>
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
              <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
              <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
              </svg>
            </button>  
            </td>

          </tr>
        </tbody>
      </table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <h5 class="modal-title" id="exampleModalLabel">Inicio del nuevo período</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="guardar">
        <div class="form-group">
          <label for="anio">Año de inicio</label>
          <?php $cont = date('Y');?>
            <select class="form-control" name='anio' id="anio">
                  <?php while ($cont >= 2021) { ?>
                      <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                  <?php $cont = ($cont-1); } ?>
            </select>
        </div>
        <div class="form-group">
          <label for="my-input">Fecha Inicio</label>
          <input class="form-control" type="date" name="fechaI" min="2020-01-01" max="2050-12-20" required />
        </div>
        <div class="form-group">
          <label for="my-input">Fecha Inicio</label>
          <input class="form-control" type="date" name="fechaF" min="2020-01-01" max="2050-12-20" required />
        </div>
        <div class="form-group">
          <label for="my-input">Descripcion</label>
        <select class="form-control" name="descripcion" id="descripcion">
          <option value="1">Enero-Mayo</option>
          <option value="3">Junio Julio</option>
          <option value="2">Agosto-Diciembre</option>
        </select>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="guardar()">Salvar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <h5 class="modal-title" id="exampleModalLabel">Editar período</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="anio">Año de inicio</label>
          <?php $cont = date('Y');?>
            <select class="form-control" id="sel1">
                  <?php while ($cont >= 1950) { ?>
                      <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                  <?php $cont = ($cont-1); } ?>
            </select>
        </div>
        <div class="form-group">
          <label for="my-input">Fecha Inicio</label>
          <input class="form-control" type="date" name="party" min="2020-01-01" max="2050-12-20" required />
        </div>
        <div class="form-group">
          <label for="my-input">Fecha Inicio</label>
          <input class="form-control" type="date" name="party" min="2020-01-01" max="2050-12-20" required />
        </div>
        <div class="form-group">
          <label for="my-input">Descripcion</label>
        <select class="form-control" name="descripcion" id="descripcion">
          <option value="1">Enero-Mayo</option>
          <option value="2">Junio Julio</option>
          <option value="3">Agosto-Diciembre</option>
        </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Modificar</button>
      </div>
    </div>
  </div>
</div>
    </div>
</div>

<script>
function guardar(){
  id="";
  fPeriodo ="";
  datos = $("#guardar").serializeArray();
  id = datos[0]['value'] +""+ datos[3]['value'];
  if(datos[3]['value'] == 1){
    fPeriodo ="Enero-Mayo"
  }
  if(datos[3]['value'] == 2){
    fPeriodo ="Agosto-Diciembre"
  }
  if(datos[3]['value'] == 3){
    fPeriodo ="  Junio-Julio"
  }
  datos.push({name: 'id', value: id})
  datos.push({name: 'dPeriodo', value: fPeriodo})
  datos.push({name: 'opcion', value: 1})
opcion =1;
  if(datos[0]['value'] !="" && datos[1]['value'] !=""  &&datos[2]['value'] !=""  && datos[3]['value'] !=""  && datos[4]['value'] !=""  && datos[5]['value'] !="" ){
    alert('Registro exitoso')
    $.ajax({
        type : 'POST',
        url:'../controller/pda/cPeriodo.php',
        data: {
          id : id,
          fechaI : datos[1]['value'],
          fechaF : datos[2]['value'],
          dPeriodo : fPeriodo,
          anio : datos[0]['value'],
          opcion : opcion,
        },
        success:function (){
          alertaCorrecto('Con exito se registro el periodo espere un momento para reiniciar');
          setTimeout(() => {
          window.location.replace("../cerrarSesion.php");
          }, 5000);
          
      
        },
        error: function(error){
          console.error(error)
        }
      });


  }else{
    alert('Campos vacios')
  }
}
</script>