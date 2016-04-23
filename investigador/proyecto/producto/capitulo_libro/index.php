                                                                                                                                                                                            <?php require('header.php'); 

session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "investigador") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../../index.php'; </script>";
   }

require "../../../../model/capitulo_libro.php";
$lib = new capitulo_libro();
$id=$_GET['id'];

$capitulos=$lib->listarCapituloLibroProyecto($id);

?>
    <div>
        <ul class="breadcrumb">
            <li>
              <a href="../../../index.php">Inicio</a>
            </li>
            <li>
              <a href="../../index.php">Proyecto</a>
            </li>
            <li>
              <a href="../index.php">Productos</a>
            </li>
            <li>
              <a href="#">Cap&iacute;tulo del Libro</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
        <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-user"></i> Gestionar Cap&iacute;tulo del Libro</h2>
        </div>

        <div class="box-content">
        <a class="btn btn-default" href="agregar.php?id=<?php echo $id?>">
            Agregar
        </a> <br/><br/>
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
        <tr>
            <th>T&iacute;tulo del Cap&iacute;tulo</th>
            <th>T&iacute;tulo del Libro</th>
            <th style="width:150px;">ISBN</th>
            <th>Autor</th>
            <th>Editorial</th>
            <th style="width:125px;">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php       
            $i=1;            
         foreach($capitulos as $lib): 
            echo '<tr>
                <td class="center">'.$lib['titulo_capitulo'].'</td>
                <td class="center">'.$lib['titulo_libro'].'</td>
                <td class="center">'.$lib['ISBN'].'</td>
                <td class="center">'.$lib['autor'].'</td>
                <td class="center">'.$lib['editorial'].'</td> 
                <td class="center">
        
                <a href="ver.php?id='.$lib['id_capitulo'].'">
                   <img alt="Ver" title="Ver" src="../../../../img/ver.png" height="19" width="19"/>
                </a>
                <a href="editar.php?id='.$lib['id_capitulo'].'">
                    <img alt="Editar" title="Editar" src="../../../../img/editar.gif" height="18" width="18"/>
                </a>
                <a href="eliminar.php?id='.$lib['id_capitulo'].'">
                    <img alt="Eliminar" title="Eliminar" src="../../../../img/eliminar.png" height="18" width="18"/>
                </a>
                </td>
            </tr>';
        
            $i=$i+1;
        endforeach;
            
      ?>
       
        </tbody>
        </table>
        </div>
        </div>
        </div>
    
    </div><!--/row-->

<?php require('footer.php'); ?>