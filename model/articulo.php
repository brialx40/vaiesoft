<?php


/**
 * Description of articulo
 *
 * @author Diana Calderon 
 */
class articulo {
    
    
    public function __construct() {
    }

    public function listarArticulo()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `articulo`');
        $articulos= array();
 
        while($articulo = mysql_fetch_assoc($resultado))
        {  $articulos[] = $articulo;}
                              
        mysql_close();   
 
        return $articulos;
    } 

    public function listarArticuloProyecto($id)
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `articulo` WHERE id_proyecto='.$id);
        $articulos= array();
 
        while($articulo = mysql_fetch_assoc($resultado))
        {  $articulos[] = $articulo;}
                              
        mysql_close();   
 
        return $articulos;
    } 

    
    public function buscarArticulo($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM articulo WHERE id_articulo='.$id);
        $articulos= array();
         
        while($articulo = mysql_fetch_assoc($resultado))
        {  $articulos[] = $articulo;}
         
        mysql_close();   
 
        return $articulos[0];
    }
       
public function agregarArticulo($articulo)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `articulo` 
            (`id_proyecto`, `titulo`, `autor`, `pagina_inicial`, `pagina_final`, `DOI`, `ano_lectivo`, `mes`, 
            `categoria`, `nombre_revista`, `volumen`, `numero`, `ISSN`, `indice_bibliografico`, `URL`) 
             VALUES ('".$articulo[0]."', '".$articulo[1]."', '".$articulo[2]."', 
              '".$articulo[3]."', '".$articulo[4]."',  '".$articulo[5]."', '".$articulo[6]."', '".$articulo[7]."', 
              '".$articulo[8]."', '".$articulo[9]."', '".$articulo[10]."', '".$articulo[11]."', '".$articulo[12]."',
               '".$articulo[13]."', '".$articulo[14]."');");
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 
    

public function eliminarArticulo($id_articulo)
    {
        include 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM articulo WHERE id_articulo LIKE '".$id_articulo."'");
        
        mysql_close();
        
        return true;
    }
    
     public function editarArticulo($id_articulo, $nuevoArticulo)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `articulo` SET  
            `titulo`='".$nuevoArticulo[0]."', `autor`='".$nuevoArticulo[1]."',
            `pagina_inicial`='".$nuevoArticulo[2]."', `pagina_final`='".$nuevoArticulo[3]."',`DOI`='".$nuevoArticulo[4]."',
            `ano_lectivo`='".$nuevoArticulo[5]."', `mes`='".$nuevoArticulo[6]."',`categoria`='".$nuevoArticulo[7]."',
            `nombre_revista`='".$nuevoArticulo[8]."', `volumen`='".$nuevoArticulo[9]."',`numero`='".$nuevoArticulo[10]."',
            `ISSN`='".$nuevoArticulo[11]."',`indice_bibliografico`='".$nuevoArticulo[12]."', `URL`='".$nuevoArticulo[13]."'
             WHERE `id_articulo` = '".$id_articulo."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function cantidadArticuloProyecto($id)
    {
        include 'conectar.php';
        $num_rows = 0;
        $resultado = mysql_query("SELECT * FROM `articulo` WHERE id_proyecto=".$id);

        $num_rows = mysql_num_rows($resultado);
                      
        mysql_close();   
 
        return $num_rows;
    }

    public function cantidadArticuloProyectoCategoria($id, $categoria)
    {
        include 'conectar.php';
        $num_rows = 0;
        
        $resultado = mysql_query('SELECT * FROM `articulo` WHERE id_proyecto='.$id.' AND categoria='.$categoria);

        $num_rows = mysql_num_rows($resultado);
                      
        mysql_close();   
 
        return $num_rows;
    }
    
}


?>
