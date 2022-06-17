<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/cDocente.php");
$periodo_actual = (isset($_GET['cve_periodo'])) ? $_GET['cve_periodo'] : '0';
  //echo $cve_docente;
$docentes = listar_docentes();
?>
<style>
#cargahoraria{
  width: auto;
  max-width: auto;
  height: auto;
  display:  flex;
  flex-wrap: wrap;
  justify-content: center;
   overflow: hidden;
}

#cargahoraria .card{
width: 130px;
height: 130px;
border-radius: 8px;
border: 2px solid #0088ff;
box-shadow: 0 2px 2px rgba(0, 0,0,0.2);
overflow: hidden;
margin: 6px;
text-align: center;
transition: all 0.25px;
float: left;
background-color: none;
}
#cargahoraria .card:hover{
  transform: translate(-5px) ;
  box-shadow: 0 12px 16px rgba(0, 0,0,0.2);
  background: #84b6f4;
  cursor: pointer;
}
#cargahoraria .card h4{
    color:white;
  border-bottom: 4px solid black;
  border-bottom: 3px solid white;
  background-color:none;
}
#cargahoraria .card p{
  font-size: 15px;
  color: black;
  font-weight: bold;
}
</style>
<form id="frmCargaHoraria" name="frmCargaHoraria" >
<div id="cargahoraria" class="box box-solid" >
  <div class="box box-header" style="text-align:center ;">
    <h4 for="">Control de plan de trabajo</h4>
  <nav style="text-align: center;"  class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
       <select name="accion_docente" id="accion_docente" class="form-control" style="width: 100%;"  required>
        <option value="0"> Seleccione una acción</option>
        <option value="1">Evaluar plan de trabajo</option>
        <option value="2">Editar plan de trabajo</option>
       </select>
      </li>
    </ul>
  </div>
</nav>
  </div>
<?php foreach( $docentes as $subs){     ?>
      <div class="card text-white" style="" id="<?php echo $subs['clave']; ?>"  onclick="card(this)">
      <i class="bi bi-person-workspace"></i>
        <h4 >
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
  <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
  <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
</svg>
        <?php echo $subs['clave']?> </h4>
     
        <p><?php echo $subs['nombre1']?> </p>
      </form>
      </div>
      <?php
          }
      ?>    
</div>

  <!-- /.box-body -->
</div>

<script> function card(obj){   
  var periodo_actual ="<?php echo $periodo_actual ?>";
  var proceso = document.getElementById('accion_docente').value;

  if( proceso === '0'){
    alertaError("Falta seleccionar de la lista la acción de trabjo");
    return false;
  }
  if(proceso === "1"){
    var id_docente = obj.id;
    history.pushState(null, "","index.php");
    window.location.href = window.location.href + "?cve_docente="+id_docente+"&sp_docenteEva=1&cve_periodo="+periodo_actual;
  }
  if(proceso === "2"){
    var id_docente = obj.id;
    history.pushState(null, "","index.php");
    window.location.href = window.location.href + "?cve_docente="+id_docente+"&sp_docente_Editar=1&cve_periodo="+periodo_actual;
  }
  }
 </script>