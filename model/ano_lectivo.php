<?php

/**
 * Description of ano_lectivo
 *
 * @author Diana Calderon
 */
class ano_lectivo {
   
    public $id_anle;    
    
    public function __construct() {
    }

    
public function buscarAnoLectivo($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM ano_lectivo WHERE id_anle='.$id);
        $ano_lectivos= array();
         
        while($ano_lectivo = mysql_fetch_assoc($resultado))
        {  $ano_lectivos[] = $ano_lectivo;}
        
        if(sizeof($ano_lectivos)==0){
            $ano_lectivos[0]['id_anle']=0;                   
        }
                
        mysql_close();   
 
        return $ano_lectivos;
    }
    
public function listaAnoLectivo()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `ano_lectivo`  ORDER BY ID_ANLE DESC');
        $ano_lectivos= array();
 
        while($ano_lectivo = mysql_fetch_assoc($resultado)){  
            $ano_lectivos[] = $ano_lectivo;
        }
               
        mysql_close();   
 
        return $ano_lectivos;
    }
    
    public function eliminarAnoLectivo($id)
    {
        require 'conectar.php';
       
        $resultado = mysql_query('DELETE FROM ano_lectivo WHERE id_anle='.$id);
        
        mysql_close();
        
        return true;
    }
    public function agregarAnoLectivo($ano_lectivo)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `ano_lectivo` (`id_anle`) VALUES ('".$ano_lectivo[0]."');");
        
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    }
    public function editarAnoLectivo($id, $nuevoAnoLectivo)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `ano_lectivo` SET  `id_anle` =  '".$nuevoAnoLectivo[0]."' WHERE `id_anle` =  '".$id."' LIMIT 1 ;");
        
        mysql_close();
        
     
        return true;      
       
        
      
    }
    
}
?>
