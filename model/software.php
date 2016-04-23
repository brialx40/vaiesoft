<?php


/**
 * Description of software
 *
 * @author Diana Calderon 
 */
class software {
    
    
    public function __construct() {
    }

    public function listarSoftware()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `software`');
        $softwares= array();
 
        while($software = mysql_fetch_assoc($resultado))
        {  $softwares[] = $software;}
                              
        mysql_close();   
 
        return $softwares;
    } 

    public function listarSoftwareProyecto($id)
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `software` WHERE id_proyecto='.$id);
        $softwares= array();
 
        while($software = mysql_fetch_assoc($resultado))
        {  $softwares[] = $software;}
                              
        mysql_close();   
 
        return $softwares;
    } 

    
    public function buscarSoftware($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM software WHERE id_software='.$id);
        $softwares= array();
         
        while($software = mysql_fetch_assoc($resultado))
        {  $softwares[] = $software;}
         
        mysql_close();   
 
        return $softwares[0];
    }
       
public function agregarSoftware($software)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `software` 
            (`id_proyecto`, `titulo`, `numero_registro`, `ano_lectivo`, `descripcion`)   
             VALUES ('".$software[0]."', '".$software[1]."', '".$software[2]."', 
              '".$software[3]."', '".$software[4]."');");
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 
    

public function eliminarSoftware($id_software)
    {
        include 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM software WHERE id_software LIKE '".$id_software."'");
        
        mysql_close();
        
        return true;
    }
    
     public function editarSoftware($id_software, $nuevoSoftware)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `software` SET  
            `titulo`='".$nuevoSoftware[1]."', `numero_registro`='".$nuevoSoftware[2]."',
            `ano_lectivo`='".$nuevoSoftware[3]."', `descripcion`='".$nuevoSoftware[4]."'
             WHERE `id_software` = '".$id_software."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function cantidadSoftwareProyecto($id)
    {
        include 'conectar.php';
        $num_rows = 0;
        $resultado = mysql_query("SELECT * FROM `software` WHERE id_proyecto=".$id);

        $num_rows = mysql_num_rows($resultado);
                      
        mysql_close();   
 
        return $num_rows;
    }
    
}


?>
