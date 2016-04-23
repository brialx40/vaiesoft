                                                                                                                                                                                            <?php require('header.php'); 

@session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "admin") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../index.php'; </script>";
   }

require "../../model/articulo.php";
$art = new articulo();

require "../../model/libro.php";
$lib = new libro();

require "../../model/capitulo_libro.php";
$cap = new capitulo_libro();

$id_proyecto=$_GET['id'];

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
                <a href="#">Productos</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
        <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-user"></i> Productos</h2>
        </div>

        <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Puntos</th>
            <th ></th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center">Art&iacute;culos A1</td>
                <?php
                $cantidad=$art->cantidadArticuloProyectoCategoria($id_proyecto, "'Articulos A1'");
                $puntos=$cantidad*15;
                ?>
                <td class="center"><?php echo $cantidad?></td>
                <td class="center"><?php echo $puntos?></td>
                <td class="center">        
                <a href="articulo/index.php?id=<?php echo $id_proyecto?>">
                   <img alt="agregar" title="agregar" src="../../../img/agregar.gif" height="19" width="17"/>
                </a>
            </td>
            </tr>
            <tr>
                <td class="center">Art&iacute;culos A2</td>
                <?php
                $cantidad=$art->cantidadArticuloProyectoCategoria($id_proyecto, "'Articulos A2'");
                $puntos=$cantidad*12;
                ?>
                <td class="center"><?php echo $cantidad?></td>
                <td class="center"><?php echo $puntos?></td>
                <td class="center">        
                <a href="articulo/index.php?id=<?php echo $id_proyecto?>">
                   <img alt="agregar" title="agregar" src="../../../img/agregar.gif" height="19" width="17"/>
                </a>
            </td>
            </tr> 
            <tr>
                <td class="center">Art&iacute;culos B</td>
                <?php
                $cantidad=$art->cantidadArticuloProyectoCategoria($id_proyecto, "'Articulos B'");
                $puntos=$cantidad*8;
                ?>
                <td class="center"><?php echo $cantidad?></td>
                <td class="center"><?php echo $puntos?></td>
                <td class="center">        
                <a href="articulo/index.php?id=<?php echo $id_proyecto?>">
                   <img alt="agregar" title="agregar" src="../../../img/agregar.gif" height="19" width="17"/>
                </a>
            </td>
            </tr>        
            <tr>
                <td class="center">Art&iacute;culos C</td>
                <?php
                $cantidad=$art->cantidadArticuloProyectoCategoria($id_proyecto, "'Articulos C'");
                $puntos=$cantidad*5;
                ?>
                <td class="center"><?php echo $cantidad?></td>
                <td class="center"><?php echo $puntos?></td>
                <td class="center">        
                <a href="articulo/index.php?id=<?php echo $id_proyecto?>">
                   <img alt="agregar" title="agregar" src="../../../img/agregar.gif" height="19" width="17"/>
                </a>
            </td>
            </tr>    
            <tr>
                <td class="center">Art&iacute;culos en revista no indexada</td>
                <?php
                $cantidad=$art->cantidadArticuloProyectoCategoria($id_proyecto, "'Articulo Revista No Indexada'");
                $puntos=$cantidad*3;
                ?>
                <td class="center"><?php echo $cantidad?></td>
                <td class="center"><?php echo $puntos?></td>
                <td class="center">        
                <a href="articulo/index.php?id=<?php echo $id_proyecto?>">
                   <img alt="agregar" title="agregar" src="../../../img/agregar.gif" height="19" width="17"/>
                </a>
            </td>
            </tr> 
            <tr>
                <td class="center">Libro</td>
                <?php
                $cantidad=$lib->cantidadLibroProyecto($id_proyecto);
                $puntos=$cantidad*15;
                ?>
                <td class="center"><?php echo $cantidad?></td>
                <td class="center"><?php echo $puntos?></td>
                <td class="center">        
                <a href="libro/index.php?id=<?php echo $id_proyecto?>">
                   <img alt="agregar" title="agregar" src="../../../img/agregar.gif" height="19" width="17"/>
                </a>
            </td>
            </tr> 
            <tr>
                <td class="center">Cap&iacute;tulo de Libro </td>
                <?php
                $cantidad=$cap->cantidadCapituloProyecto($id_proyecto);                
                $puntos=$cantidad*15;
                ?>
                <td class="center"><?php echo $cantidad?></td>
                <td class="center"><?php echo $puntos?></td>
                <td class="center">        
                <a href="capitulo_libro/index.php?id=<?php echo $id_proyecto?>">
                   <img alt="agregar" title="agregar" src="../../../img/agregar.gif" height="19" width="17"/>
                </a>
            </td>
            </tr> 
            <tr>
                <td class="center">Consultor&iacute;as Cient&iacute;fico Tecnol&oacute;gicas</td>
                <?php
                $cantidad=$con->cantidadConsultoriaProyecto($id_proyecto);                
                $puntos=$cantidad*7;
                ?>
                <td class="center"><?php echo $cantidad?></td>
                <td class="center"><?php echo $puntos?></td>
                <td class="center">        
                <a href="consultoria/index.php?id=<?php echo $id_proyecto?>">
                   <img alt="agregar" title="agregar" src="../../../img/agregar.gif" height="19" width="17"/>
                </a>
            </td>
            </tr> 
            <tr>
                <td class="center">Consultorias Cientifico Tecnologicas</td>
                <?php
                $cantidad=$con->cantidadConsultoriaProyecto($id_proyecto);                
                $puntos=$cantidad*7;
                ?>
                <td class="center"><?php echo $cantidad?></td>
                <td class="center"><?php echo $puntos?></td>
                <td class="center">        
                <a href="consultoria/index.php?id=<?php echo $id_proyecto?>">
                   <img alt="agregar" title="agregar" src="../../../img/agregar.gif" height="19" width="17"/>
                </a>
            </td>
            </tr> 
       
        </tbody>
        </table>
        </div>
        </div>
        </div>
    
    </div><!--/row-->

<?php require('footer.php'); ?>