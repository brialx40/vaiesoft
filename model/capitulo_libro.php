<?php


/**
 * Description of capitulo_libro
 *
 * @author Diana Calderon 
 */
class capitulo_libro {
    
    
    public function __construct() {
    }

    public function listarCapituloLibro()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `capitulo_libro`');
        $capitulo_libros= array();
 
        while($capitulo_libro = mysql_fetch_assoc($resultado))
        {  $capitulo_libros[] = $capitulo_libro;}
                              
        mysql_close();   
 
        return $capitulo_libros;
    } 

    public function listarCapituloLibroProyecto($id)
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `capitulo_libro` WHERE id_proyecto='.$id);
        $capitulo_libros= array();
 
        while($capitulo_libro = mysql_fetch_assoc($resultado))
        {  $capitulo_libros[] = $capitulo_libro;}
                              
        mysql_close();   
 
        return $capitulo_libros;
    } 

    
    public function buscarCapituloLibro($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM capitulo_libro WHERE id_capitulo='.$id);
        $capitulo_libros= array();
         
        while($capitulo_libro = mysql_fetch_assoc($resultado))
        {  $capitulo_libros[] = $capitulo_libro;}
         
        mysql_close();   
 
        return $capitulo_libros[0];
    }
       
public function agregarCapituloLibro($capitulo_libro)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `capitulo_libro` 
            (`id_proyecto`, `titulo_libro`, `titulo_capitulo`, `ISBN`, `fecha`, `autor`, `editorial`, `lugar_publicacion`)   
             VALUES ('".$capitulo_libro[0]."', '".$capitulo_libro[1]."', '".$capitulo_libro[2]."', '".$capitulo_libro[3]."', 
                '".$capitulo_libro[4]."',  '".$capitulo_libro[5]."', '".$capitulo_libro[6]."', '".$capitulo_libro[7]."');");
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 
    

public function eliminarCapituloLibro($id_capitulo)
    {
        include 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM capitulo_libro WHERE id_capitulo LIKE '".$id_capitulo."'");
        
        mysql_close();
        
        return true;
    }
    
     public function editarCapituloLibro($id_capitulo, $nuevoCapitulo)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `capitulo_libro` SET  
            `titulo_libro`='".$nuevoCapitulo[0]."', `titulo_capitulo`='".$nuevoCapitulo[1]."', 
            `ISBN`='".$nuevoCapitulo[2]."', `fecha`='".$nuevoCapitulo[3]."', `autor`='".$nuevoCapitulo[4]."',
            `editorial`='".$nuevoCapitulo[5]."', `lugar_publicacion`='".$nuevoCapitulo[6]."'
             WHERE `id_capitulo` = '".$id_capitulo."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function cantidadCapituloProyecto($id)
    {
        include 'conectar.php';
        $num_rows = 0;
        $resultado = mysql_query("SELECT * FROM `capitulo_libro` WHERE id_proyecto=".$id);

        $num_rows = mysql_num_rows($resultado);
                      
        mysql_close();   
 
        return $num_rows;
    }
    
}


?>
