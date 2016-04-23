<?php


/**
 * Description of propuesta
 *
 * @author Diana Calderon 
 */
class PlanEstudio {
    
    public $id_plan;   
    public $nombre;   
    public $id_facultad;
    
    
    public function __construct() {
    }

    

    public function listarPlanEstudioFacultad($id)
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `plan_estudio` WHERE `id_facultad` = '.$id);
        $planesEstudio= array();
 
        while($plan = mysql_fetch_assoc($resultado))
        {  $planesEstudio[] = $plan;}
        
                      
        mysql_close();   
 
        return $planesEstudio;
    } 

   

}


?>
