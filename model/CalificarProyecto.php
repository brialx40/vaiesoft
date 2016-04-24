<?php


/**
 * Description of propuesta
 *
 * @author Wendy Carrascal
 */
class CalificarProyecto {
    
    
    public function __construct() {
    }

    /**
     * Método que lista la calificacón relacionado a un proyecto.
     * @param type $id_proyecto
     * @return type
     */
    

    public function listarCalificacionProyecto($id_proyecto)
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM calificacion_proyecto WHERE id_proyecto='.$id_proyecto);
        $calificaciones= array();
 
        while($cal = mysql_fetch_assoc($resultado))
        {  $calificaciones[] = $cal;}
        
         
        mysql_close();   
 
        return $calificaciones[0];
    } 

   public function agregarCalificacionProyecto($calificacionProyecto)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `calificacion_proyecto` 
            (`id_propuesta`, `obser1`,  `obser2`, `obser3`, `obser4`, `obser5`, `obser6`, `obser7`, `obser8`, `obser9`, `obser10`,
             `obser11`, `obser12`, `obser13`, `obser14`) 
        VALUES ('".$calificacionProyecto[0]."', '".$calificacionProyecto[1]."','".$calificacionProyecto[2]."','".$calificacionProyecto[3]."', '".$calificacionProyecto[4]."', '".$calificacionProyecto[5]."','".$calificacionProyecto[6]."',
        '".$calificacionProyecto[7]."', '".$calificacionProyecto[8]."', '".$calificacionProyecto[9]."', '".$calificacionProyecto[10]."', '".$calificacionProyecto[11]."', '".$calificacionProyecto[12]."','".$calificacionProyecto[13]."', '".$calificacionProyecto[14]."');");
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 

}


?>
  