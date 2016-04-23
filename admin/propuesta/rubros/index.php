<?php require('header.php'); ?>
<?php
@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado" && $_SESSION['rol'] == "admin" ) {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../index.php'; </script>";
   }
require "../../../model/Propuesta.php";
require "../../../model/PropuestaRubro.php";
require "../../../model/PropuestaContrapartida.php";
require "../../../model/contrapartida.php";
require "../../../model/movimientoRubro.php";

$proy=new Propuesta();
$proyRubro=new PropuestaRubro();
$proyContrapartida=new PropuestaContrapartida();
$id=$_GET['id'];
$Propuesta=$proy->buscarPropuesta($id);
$rubros=$proyRubro->listaRubrosPorPropuesta($id);
$contrapartidas=$proyContrapartida->listaContrapartidaPorPropuesta($id);

$cont = new contrapartida();


?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="../../index.php">Inicio</a>
        </li>
        <li>
            <a href="../index.php">Propuesta</a>
        </li>
        <li>
            <a href="index.php">Rubros</a>
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
        
       <label class="control-label" for="inputSuccess4">Nombre del Propuesta:</label>
        <label class="control-label" style="width: 70%; font-weight: normal;" for="inputSuccess4"><?php echo $Propuesta['nombre']?></label>
       <br/><br/> 
        <label class="control-label" for="inputSuccess4">Presupuesto de la Propuesta:</label>
        <label class="control-label" style="width: 70%; font-weight: normal; color:red;" for="inputSuccess4"><?php echo $Propuesta['presupuesto']?></label>
       <br/><br/>         
      
        <a class="btn btn-default" href="agregarR.php?id=<?php echo $id?>">
            Agregar
        </a>
        <a class="btn btn-default" href="contrapartida.php?id=<?php echo $id?>">
            Agregar Contrapartida
        </a><br/><br/>
       <table class="table table-striped table-bordered responsive">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Valor</th>
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
                 <td class="center">
        
                <a href="editar.php?id='.$f['id_pru'].'">
                    <img alt="Editar" title="Editar" src="../../../img/editar.gif" height="18" width="18"/>
                </a>
                </td>
            </tr>';
        
            $i=$i+1;
        endforeach;
            echo '<tr>
                    <td class="center" style="font-weight:bold;color:red;">TOTAL</td>
                    <td class="center" style="font-weight:bold;color:red;">'.$Propuesta['presupuesto'].'</td> 
                     <td></td>
                </tr>';
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
    $contrapartida=$cont->buscarContrapartida($f['id_contrapartida']);
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



<?php require('footer.php'); ?>

