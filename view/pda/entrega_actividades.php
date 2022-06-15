<?php
require_once($_SERVER['DOCUMENT_ROOT']."/ae/controller/pda/cEvaluacion.php");
$docente = (isset($_GET['cve_docente'])) ? $_GET['cve_docente'] : '0';
$periodo_actual = (isset($_GET['cve_periodo'])) ? $_GET['cve_periodo'] : '0';
$datos = listar_subcategoria($docente,$periodo_actual);

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
width: 160px;
height: auto;
border-radius: 8px;
box-shadow: 0 2px 2px rgba(0, 0,0,0.2);
overflow: hidden;
margin: 6px;
text-align: center;
transition: all 0.25px;
float: left;
}
#cargahoraria .card:hover{
  transform: translate(-5px) ;
  box-shadow: 0 12px 16px rgba(0, 0,0,0.2);
}
#cargahoraria .card h4{
  border-bottom: 4px solid black;
  background-color: black;
}
#cargahoraria .card p{
  font-size: 17px;

}
</style>
<div id="cargahoraria" class="box box-solid">
<?php foreach ($datos as $fila) {?>
    <div class="card text-white bg-info " id="<?php echo $fila["PR_SCAT_CVE"]; ?>"  onclick="card(this)">
    <i class="bi bi-journal-bookmark-fill"></i>
        <h4 >
        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-journal-bookmark-fill" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z"/>
  <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
  <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
</svg>
        <?php echo $fila['PR_SCAT_CVE']?> </h4>
        <p><?php echo $fila['SCAT_TITULO']?> </p>
      </form>
      </div>
<?php } ?>
</div>

<script>

function card(obj){   
    docente = "<?php echo $docente ?>";
    periodo_actual = "<?php echo $periodo_actual ?>"
    form("pda/entrega_actividades_individuales_x_docente.php?entrega_sub="+obj.id+ "&cve_docente="+docente+"&cve_periodo="+periodo_actual);
    history.pushState(null, "","index.php?entrega_sub="+obj.id + "&cve_docente="+docente+"&cve_periodo="+periodo_actual);
}
</script> 