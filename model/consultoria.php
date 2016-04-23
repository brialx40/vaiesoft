<?php


/**
 * Description of consultoria 
 *
 * @author Diana Calderon 
 */
class consultoria {
    
    
    public function __construct() {
    }

    public function listarConsultoria()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `consultoria_cien_tecn`');
        $consultorias= array();
 
        while($consultoria = mysql_fetch_assoc($resultado))
        {  $consultorias[] = $consultoria;}
                              
        mysql_close();   
 
        return $consultorias;
    } 

    public function listarConsultoriaProyecto($id)
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `consultoria_cien_tecn` WHERE id_proyecto='.$id);
        $consultorias= array();
 
        while($consultoria = mysql_fetch_assoc($resultado))
        {  $consultorias[] = $consultoria;}
                              
        mysql_close();   
 
        return $consultorias;
    } 

    
    public function buscarConsultoria($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM consultoria_cien_tecn WHERE id_consultoria='.$id);
        $consultorias= array();
         
        while($consultoria = mysql_fetch_assoc($resultado))
        {  $consultorias[] = $consultoria;}
         
        mysql_close();   
 
        return $consultorias[0];
    }
       
public function agregarConsultoria($consultoria)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `consultoria_cien_tecn` 
            (`id_proyecto`, `titulo`, `numero_contrato`, `fecha`)   
             VALUES ('".$consultoria[0]."', '".$consultoria[1]."', '".$consultoria[2]."', 
              '".$consultoria[3]."');");
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 
    

public function eliminarConsultoria($id_consultoria)
    {
        include 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM consultoria_cien_tecn WHERE id_consultoria LIKE '".$id_consultoria."'");
        
        mysql_close();
        
        return true;
    }
    
     public function editarConsultoria($id_consultoria, $nuevaConsultoria)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `consultoria_cien_tecn` SET  
            `titulo`='".$nuevaConsultoria[1]."', `numero_contrato`='".$nuevaConsultoria[2]."',
            `fecha`='".$nuevaConsultoria[3]."'
             WHERE `id_consultoria` = '".$id_consultoria."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function cantidadConsultoriaProyecto($id)
    {
        include 'conectar.php';
        $num_rows = 0;
        $resultado = mysql_query("SELECT * FROM `consultoria_cien_tecn` WHERE id_proyecto=".$id);

        $num_rows = mysql_num_rows($resultado);
                      
        mysql_close();   
 
        return $num_rows;
    }
    
}


?>
