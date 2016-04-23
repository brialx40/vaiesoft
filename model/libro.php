<?php


/**
 * Description of libro
 *
 * @author Diana Calderon 
 */
class libro {
    
    
    public function __construct() {
    }

    public function listarLibro()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `libro`');
        $libros= array();
 
        while($libro = mysql_fetch_assoc($resultado))
        {  $libros[] = $libro;}
                              
        mysql_close();   
 
        return $libros;
    } 

    public function listarLibroProyecto($id)
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `libro` WHERE id_proyecto='.$id);
        $libros= array();
 
        while($libro = mysql_fetch_assoc($resultado))
        {  $libros[] = $libro;}
                              
        mysql_close();   
 
        return $libros;
    } 

    
    public function buscarLibro($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM libro WHERE id_libro='.$id);
        $libros= array();
         
        while($libro = mysql_fetch_assoc($resultado))
        {  $libros[] = $libro;}
         
        mysql_close();   
 
        return $libros[0];
    }
       
public function agregarLibro($libro)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `libro` 
            (`id_proyecto`, `titulo`, `ISBN`, `fecha`, `autor`, `editorial`, `lugar_publicacion`)  
             VALUES ('".$libro[0]."', '".$libro[1]."', '".$libro[2]."', 
              '".$libro[3]."', '".$libro[4]."',  '".$libro[5]."', '".$libro[6]."');");
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 
    

public function eliminarLibro($id_libro)
    {
        include 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM libro WHERE id_libro LIKE '".$id_libro."'");
        
        mysql_close();
        
        return true;
    }
    
     public function editarLibro($id_libro, $nuevoLibro)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `libro` SET  
            `titulo`='".$nuevoLibro[1]."', `ISBN`='".$nuevoLibro[2]."',
            `fecha`='".$nuevoLibro[3]."', `autor`='".$nuevoLibro[4]."',
            `editorial`='".$nuevoLibro[5]."', `lugar_publicacion`='".$nuevoLibro[6]."'
             WHERE `id_libro` = '".$id_libro."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function cantidadLibroProyecto($id)
    {
        include 'conectar.php';
        $num_rows = 0;
        $resultado = mysql_query("SELECT * FROM `libro` WHERE id_proyecto=".$id);

        $num_rows = mysql_num_rows($resultado);
                      
        mysql_close();   
 
        return $num_rows;
    }
    
}


?>
