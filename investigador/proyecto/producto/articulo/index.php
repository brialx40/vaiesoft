                                                                                                                                                                                            <?php require('header.php'); 

session_start();
$nombres="";


  if ( $_SESSION['estado'] == "logeado"  && $_SESSION['rol'] == "investigador") {
      //$nombres=$_SESSION['nombre'];
      //$cedula=$_SESSION['cedula'];
   } else {
      echo "<script language=Javascript> location.href='../../../../index.php'; </script>";
   }

require "../../../../model/articulo.php";
$art = new articulo();
$id=$_GET['id'];

$articulos=$art->listarArticuloProyecto($id);

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
              <a href="#">Art&iacute;culo</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="box col-md-12">
        <div class="box-inner">
        <div class="box-header well" data-original-title="">
            <h2><i class="glyphicon glyphicon-user"></i> Gestionar Art&iacute;culo</h2>
        </div>

        <div class="box-content">
        <a class="btn btn-default" href="agregar.php?id=<?php echo $id?>">
            Agregar
        </a> <br/><br/>
        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
        <thead>
        <tr>
            <th>T&iacute;tulo</th>
            <th>A&ntilde;o</th>
            <th>Autor(es)</th>
            <th>Categor&iacute;a</th>
            <th>Revista</th>
            <th style="width:110px;">&Iacute;ndice Bibliogr&aacute;fico</th>  
            <th style="width:125px;">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php       
            $i=1;            
         foreach($articulos as $art): 
            echo '<tr>
                <td class="center">'.$art['titulo'].'</td>
                <td class="center">'.$art['ano_lectivo'].'</td>
                <td class="center">'.$art['autor'].'</td>
                <td class="center">'.$art['categoria'].'</td> 
                <td class="center">'.$art['nombre_revista'].'</td>
                <td class="center">'.$art['indice_bibliografico'].'</td>
                <td class="center">
        
                <a href="ver.php?id='.$art['id_articulo'].'">
                   <img alt="Ver" title="Ver" src="../../../../img/ver.png" height="19" width="19"/>
                </a>
                <a href="editar.php?id='.$art['id_articulo'].'">
                    <img alt="Editar" title="Editar" src="../../../../img/editar.gif" height="18" width="18"/>
                </a>
                <a href="eliminar.php?id='.$art['id_articulo'].'">
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