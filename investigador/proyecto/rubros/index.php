<?php require('header.php'); ?>
<?php
session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../index.php'; </script>";
   }
require "../../../model/Proyecto.php";
require "../../../model/ProyectoRubro.php";
require "../../../model/ProyectoContrapartida.php";
require "../../../model/contrapartida.php";
require "../../../model/movimientoRubro.php";

$proy=new Proyecto();
$proyRubro=new ProyectoRubro();
$proyContrapartida=new ProyectoContrapartida();
$id=$_GET['id'];
$proyecto=$proy->buscarProyecto($id);
$rubros=$proyRubro->listaRubrosPorProyecto($id);
$contrapartidas=$proyContrapartida->listaContrapartidaPorProyecto($id);

$saldo=0;
$i=1;
foreach($rubros as $rub):             
    $saldo = $saldo + $rub['valor_disponible'];
        
     $i=$i+1;
 endforeach;


$cont = new contrapartida();
$mov = new movimientoRubro();
$retiros=$mov->listaRetirosPorProyecto($id);
$movimientos=$mov->listaMovimientosPorProyecto($id);


$total = $proyecto['presupuesto'] * 10 /100;
$i=1;
$valor=0;
foreach($movimientos as $movi): 
    $valor+=$movi['valor_solicitado'];        
    $i=$i+1;
endforeach;
$cntMov = ($valor/$total)*100;
$por = round(($valor/$proyecto['presupuesto'])*100, 2);

$msj= "Cambio de Rubro: ".$valor." (".$por."%)";


?>

<?php
$tablaT='';
$contador=1;
$totales= array();
$totales[] = $proyecto['presupuesto'];
    foreach($rubros as $f):             
        $tablaT=$tablaT.$f['id_contrapartida'].','.$f['valor'].',';

        foreach($contrapartidas as $contr):             
            $rub=explode(',',$contr['valor']);     
            for($i=0; $i < count($rub) -1; $i=$i+2){
                if($f['id_contrapartida'] == $rub[$i]){
                    $tablaT=$tablaT.$rub[$i+1].',';
                }
            }
             
            
        endforeach;
        
    endforeach;

?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../../index.php">Inicio</a>
        </li>
        <li>
            <a href="../index.php">Proyecto</a>
        </li>
        <li>
            <a href="#">Rubros</a>
        </li>
    </ul>
</div>
<div class="row">
  <div class="box col-md-12">
    <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-usd"></i> Gestionar Rubros</h2>
        </div>

        <div class="box-content">
        <label class="control-label" for="inputSuccess4">N&uacute;mero de Contrato:</label>
        <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $proyecto['numeroContrato']?></label>
       <br/><br/> 
       <label class="control-label" for="inputSuccess4">Nombre del Proyecto:</label>
        <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $proyecto['nombre']?></label>
       <br/><br/> 
        <label class="control-label" for="inputSuccess4">Presupuesto del Proyecto:</label>
        <label class="control-label" style="width: 70%; font-weight: normal; color:red;" for="inputSuccess4"><?php echo $proyecto['presupuesto']?></label>
       <br/><br/>
        <label class="control-label" for="inputSuccess4">Saldo:</label>
        <label class="control-label" style="width: 70%; font-weight: normal;color:blue;" for="inputSuccess4"><?php echo $saldo?></label>
       <br/><br/>  
       <div class="progress progress-striped progress-success active">
            <div class="progress-bar" title="<?php echo $msj?>" style="width: <?php echo $cntMov?>%;"></div>
        </div>
        <a class="btn btn-default" href="agregar.php?id=<?php echo $id?>">
            Agregar
        </a>
        <a class="btn btn-default" href="contrapartida.php?id=<?php echo $id?>">
            Agregar Contrapartida
        </a>
        <a class="btn btn-default" href="pdf/pdfgenerator.php?id=<?php echo $id?>">
            Generar Reporte
        </a><br/><br/>
        <table class="table table-striped table-bordered responsive">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Valor</th>
            <th>Valor Disponible</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php       
            $i=1;
            
         foreach($rubros as $f):             
            $contrapartida=$cont->buscarContrapartida($f['id_contrapartida']);
            echo '<tr>
                <td class="center">'.$contrapartida['nombre'].'</td>
                <td class="center">'.$f['valor'].'</td> 
                <td class="center">'.$f['valor_disponible'].'</td> 
                <td class="center">
        
                <a href="editar.php?id='.$f['id_pru'].'">
                    <img alt="Editar" title="Editar" src="../../../img/editar.gif" height="18" width="18"/>
                </a>
                <a href="retiro.php?id='.$f['id_pru'].'">
                    <img alt="Retiro" title="Retiro" src="../../../img/retiro.jpg" height="18" width="18"/>
                </a>
                <a href="../../../controller/movimientoRubro.php?opc=3&id_pru='.$f['id_pru'].'&id='.$id.'">
                    <img alt="Movimiento" title="Movimiento" src="../../../img/movimiento.jpg" height="20" width="20"/>
                </a>
                </td>
            </tr>';
        
            $i=$i+1;
        endforeach;
         echo '<tr>
                    <td class="center" style="font-weight:bold;color:red;">TOTAL</td>
                    <td class="center" style="font-weight:bold;color:red;">'.$proyecto['presupuesto'].'</td> 
                    <td class="center" style="font-weight:bold;color:blue;">'.$saldo.'</td> 
                     <td></td>
                </tr>';
            
      ?>
       
        </tbody>
        </table>
        </div>
    </div>
  </div>    
</div>

<div class="row">
  <div class="box col-md-12">
    <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-usd"></i> Ejecuci&oacute;n del Presupuesto</h2>
            <div class="box-icon">
              <a href="#" class="btn btn-minimize btn-round btn-default"><i
                      class="glyphicon glyphicon-chevron-up"></i></a>
            </div>
        </div>

        <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
        <tr>
            <th>Rubro</th>
            <th>Valor Solicitado</th>
            <th>Fecha</th>
            <th>Numero Orden</th>
            <th>Observacion</th>
        </tr>
        </thead>
        <tbody>
        <?php       
            $i=1;
            
        foreach($retiros as $f): 
            $rubro_origen=$proyRubro->buscarProyectoRubro($f['rubro_origen']);
            $contrapartida=$cont->buscarContrapartida($rubro_origen['id_contrapartida']);
            echo '<tr>
                <td class="center">'.$contrapartida['nombre'].'</td>
                <td class="center">'.$f['valor_solicitado'].'</td> 
                <td class="center">'.$f['fecha'].'</td> 
                <td class="center">'.$f['numero_orden'].'</td>
                <td class="center">'.$f['observacion'].'</td>                
            </tr>';        
            $i=$i+1;
        endforeach;
            
      ?>
       
        </tbody>
        </table>
        </div>
    </div>
  </div>    
</div>

<div class="row">
  <div class="box col-md-12">
    <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-usd"></i> Cambio de Rubro</h2>
            <div class="box-icon">
              <a href="#" class="btn btn-minimize btn-round btn-default"><i
                      class="glyphicon glyphicon-chevron-up"></i></a>
            </div>
        </div>

        <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
        <tr>
            <th>Rubro Origen</th>
            <th>Valor Solicitado</th>            
            <th>Rubro Destino</th>
            <th>Fecha</th>
            <th>Numero Orden</th>
            <th>Observacion</th>
        </tr>
        </thead>
        <tbody>
        <?php       
            $i=1;
            
        foreach($movimientos as $f): 
            $rubro_origen=$proyRubro->buscarProyectoRubro($f['rubro_origen']);
            $contrOrigen=$cont->buscarContrapartida($rubro_origen['id_contrapartida']);
            $rubro_destino=$proyRubro->buscarProyectoRubro($f['rubro_destino']);
            $contrDest=$cont->buscarContrapartida($rubro_destino['id_contrapartida']);
            echo '<tr>
                <td class="center">'.$contrOrigen['nombre'].'</td>
                <td class="center">'.$f['valor_solicitado'].'</td> 
                <td class="center">'.$contrDest['nombre'].'</td>
                <td class="center">'.$f['fecha'].'</td> 
                <td class="center">'.$f['numero_orden'].'</td>
                <td class="center">'.$f['observacion'].'</td>                
            </tr>';        
            $i=$i+1;
        endforeach;
            
      ?>
       
        </tbody>
        </table>
        </div>
    </div>
  </div>    
</div>


<?php       
  $i=1;
            
  foreach($contrapartidas as $contr):
    $contador=$contador+1;
                         
    $contrapartida=$cont->buscarContrapartida($f['id_contrapartida']);
    $totales[] = $contr['total'];
  ?>
      <div class="row">
      <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-usd"></i> <?php echo $contr['nombre']?></h2>
            </div>

            <div class="box-content">
            <a class="btn btn-default" href="editar_contrapartida.php?id=<?php echo $contr['id_pru']?>">
                Editar
            </a><br/><br/>
           <table class="table table-striped table-bordered responsive">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
            <?php  
            $rubros=explode(',',$contr['valor']);     
             
              for($i=0; $i < count($rubros) -1; $i=$i+2){
                $contrapartida=$cont->buscarContrapartida($rubros[$i]);
                echo '<tr>
                    <td class="center">'.$contrapartida['nombre'].'</td>
                    <td class="center">'.$rubros[$i+1].'</td> 
                     
                </tr>';
              }
             
            echo '<tr>
                    <td class="center" style="font-weight:bold;color:red;">TOTAL</td>
                    <td class="center" style="font-weight:bold;color:red;">'.$contr['total'].'</td> 
                     
                </tr>';
                
          ?>
           
            </tbody>
            </table>
            </div>
        </div>
      </div>    
    </div>
<?php
    
    $i=$i+1;
  endforeach;
            
  ?>

  <div class="row">
      <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-usd"></i> PRESUPUESTO GLOBAL DEL PROYECTO</h2>
            </div>

            <div class="box-content">
           <table class="table table-striped table-bordered responsive">
            <thead>
            <tr>
                <th>Rubros</th>
                <th>UFPS - FINU</th>
                <?php
                foreach($contrapartidas as $contr):
                    echo '<th> '.$contr['nombre'].'</th>';
                endforeach;

                ?>
            </tr>
            </thead>
            <tbody>
            <?php  
            $rub=explode(',',$tablaT);  
            $j=0;
            echo '<tr>';

            for($i=0; $i < count($rub)-1; $i=$i+1){
                $j=$j+1;
                if($j == 1){
                    $contrapartida=$cont->buscarContrapartida($rub[$i]);
                    echo '<td class="center">'.$contrapartida['nombre'].'</td>';
                }
                else{
                    echo '<td class="center">'.$rub[$i].'</td> ';
                }
                                
                if($j == $contador+1){
                    echo '</tr><tr>';
                    $j=0;
                }

            }
            echo '</tr>
                  <tr>
                    <td class="center" style="font-weight:bold;color:red;">TOTAL</td>';

            for($i=0; $i < count($totales); $i=$i+1){
                echo '<td class="center" style="font-weight:bold;color:red;">'.$totales[$i].'</td> ';
                  
            }
            echo '</tr>';
                
          ?>
           
            </tbody>
            </table>
            </div>
        </div>
      </div>    
    </div>




<?php require('footer.php'); ?>

