
  
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cAsignacionActividad.php");
require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/cPeriodo.php");

$docentes = listar_docentes();
$periodos = listar_periodos();
?>
<div class="box box-solid">
<div class="box-header with-border">
    <h4 class="box-header with-border"><p style="text-align:center;">Reportes de Plan de Trabajo</p></h4>
</div>

<!-- /.box-header -->
<div class="box-body"  id="pdf" >
<select name="cve_periodo" id="cve_periodo" class="form-control" style="font-size: 20px; margin-bottom: 20px;" value="">
<option value="">Seleccioar el periodo del reporte</option>
                <?php 
                foreach( $periodos as $filas_D){ ?>
                    <option value="<?php echo $filas_D['clave']; ?>"><?php echo $filas_D['clave'].'.-'. 
                    $filas_D['anio'].'.-'. $filas_D['desc']  ?></option>   
                    <?php } //Fin del Select?>
        </select>  
    <table class="table table-striped" id='tablaDocentes'>
        <thead>
          <tr style="text-align: center; font-size: 20px;">
            <th style="width: 10%;">id_Docente</th>
            <th style="width: 40%;">Nombre</th>
            <th style="width: 10%;">Grado</th>
            <th style="width: 15%;">Acciones</th>
          </tr>
        </thead>
        
    <tbody>
        <?php 
            foreach($docentes as $fila){
        ?>
        <tr style="text-align: center; ">
            <td aling="justify"><?php echo $fila['clave']  ?></td>
            <td aling="justify"><?php echo $fila['nombre1']  ?></td>
            <td aling="justify"><?php echo $fila['grado']  ?></td>
            <td style="text-align: center;"> <button class="btn" onclick="" id="generarPDF">
            <i class="bi bi-file-earmark-spreadsheet"></i>
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-file-earmark-spreadsheet" viewBox="0 0 25 16">
               <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V9H3V2a1 1 0 0 1 1-1h5.5v2zM3 12v-2h2v2H3zm0 1h2v2H4a1 1 0 0 1-1-1v-1zm3 2v-2h3v2H6zm4 0v-2h3v1a1 1 0 0 1-1 1h-2zm3-3h-3v-2h3v2zm-7 0v-2h3v2H6z"/>
            </svg>
            Excel
            </button></td>
        </tr>
        <?php } 
        ?>
    </tbody>
    </table>
    </form>
</div>
<!-- /.box-body -->
</div>

<script type="text/javascript">
$(document).ready(function(){
tablaPersonas = $("#tablaDocentes").DataTable({    
  "language": {
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast":"Último",
              "sNext":"Siguiente",
              "sPrevious": "Anterior"
          },
          "sProcessing":"Procesando...",
      }
  });
});
$(document).on("click", "#generarPDF", function(e){
  e.preventDefault();
  cve_docente = parseInt($(this).closest("tr").find('td:eq(0)').text());
  cve_periodo = document.getElementById('cve_periodo').value;
  if (cve_periodo != "") {
    window.location.replace('../loadexcel.php?cve_docente='+cve_docente +"&+"+"cve_periodo="+cve_periodo);
  }else{
    alertaError('Ingresar el periodo')
    return false;
  }
});
</script>


