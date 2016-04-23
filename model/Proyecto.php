<?php


/**
 * Description of Proyecto
 *
 * @author Diana Calderon
 */
class Proyecto {
    
    public $id_proyecto;
    public $convocatoria;
    public $nombre;
    public $grupo;
    public $facultad;
    public $fechaInicio;
    public $fechaFinalizacion;
    public $presupuesto;
    public $prorroga;
    public $tipoParticipacion;
    public $horasInvestigacion;
    
    public function __construct() {
    }

    public function listarProyectos()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `proyecto`');
        $proyectos= array();
 
        while($proyecto = mysql_fetch_assoc($resultado))
        {  $proyectos[] = $proyecto;}
        
                      
        mysql_close();   
 
        return $proyectos;
    } 

    
    
    public function buscarProyecto($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM proyecto WHERE id_proyecto='.$id);
        $proyectos= array();
         
        while($proyecto = mysql_fetch_assoc($resultado))
        {  $proyectos[] = $proyecto;}
        
            if(sizeof($proyectos)==0)
            {
                $proyectos[0]['id_proyecto']=0;
                $proyectos[1]['convocatoria']=0;
                $proyectos[2]['nombre']=0;
                $proyectos[3]['grupo']=0;
                $proyectos[4]['facultad']=0;
                $proyectos[5]['fechaInicio']=0;
                $proyectos[6]['fechaFinalizacion']=0;
                $proyectos[7]['presupuesto']=0;
                $proyectos[8]['prorroga']=0;
                $proyectos[9]['tipoParticipacion']=0;
                $proyectos[10]['horasInvestigacion']=0;                
            }
                
        mysql_close();   
 
        return $proyectos[0];
    } 

    public function buscarProyectoPorPropuesta($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM proyecto WHERE id_propuesta='.$id);
        $proyectos= array();
         
        while($proyecto = mysql_fetch_assoc($resultado))
        {  $proyectos[] = $proyecto;}
                                    
        mysql_close();   
 
        return $proyectos[0];
    } 
    
 public function buscarProyectoPorId($id_proyecto)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM proyecto WHERE id_proyecto = '".$id_proyecto."'");
        $proyectos = array();
 
        while($proyecto = mysql_fetch_assoc($resultado))
        {   $proyectos[] = $proyecto;}
        
        mysql_close();   
 
        return $proyectos;
    }

    public function buscarProyectoPorEstado($estado)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM proyecto WHERE estado = '".$estado."'");
        $proyectos = array();
 
        while($proyecto = mysql_fetch_assoc($resultado))
        {   $proyectos[] = $proyecto;}
        
        mysql_close();   
 
        return $proyectos;
    }

          
public function agregarProyecto($proyecto)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `proyecto` 
            (`id_propuesta`, `numeroContrato`, `convocatoria`, `ano_lectivo`, `nombre`, `grupo`, `facultad`, `fechaInicio`, `fechaFinalizacion` , 
            `duracion`, `presupuesto`, `prorroga`, `investigador_principal`, `horas_ip`, `coinvestigador1`, `horas_ci1`, 
            `coinvestigador2`, `horas_ci2`, `coinvestigador3`, `horas_ci3`, `evaluador_propuesta`, `evaluador_final`, 
            `observaciones`, `numero_convenio`, `nombre_convenio`, `estado`,  `numero_acta`) 
        VALUES ('".$proyecto[0]."', '".$proyecto[1]."', '".$proyecto[2]."', '".$proyecto[3]."', '".$proyecto[4]."', 
            '".$proyecto[5]."', '".$proyecto[6]."', '".$proyecto[7]."', '".$proyecto[8]."', '".$proyecto[9]."', 
            '".$proyecto[10]."', '".$proyecto[11]."', '".$proyecto[12]."', '".$proyecto[13]."', '".$proyecto[14]."', 
            '".$proyecto[15]."', '".$proyecto[16]."', '".$proyecto[17]."', '".$proyecto[18]."', '".$proyecto[19]."', 
            '".$proyecto[20]."', '".$proyecto[21]."', '".$proyecto[22]."', '".$proyecto[23]."', '".$proyecto[24]."', 
            '".$proyecto[25]."', '".$proyecto[26]."');");
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 
    

public function eliminarProyecto($id_proyecto)
    {
        include 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM proyecto WHERE id_proyecto LIKE '".$id_proyecto."'");
        
        mysql_close();
        
        return true;
    }
    
     public function editarProyecto($id_proyecto, $nuevoProyecto)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `proyecto` SET  
            `numeroContrato`='".$nuevoProyecto[0]."',`convocatoria`='".$nuevoProyecto[1]."',`ano_lectivo`='".$nuevoProyecto[2]."',
            `nombre`='".$nuevoProyecto[3]."',`grupo`='".$nuevoProyecto[4]."',`facultad`='".$nuevoProyecto[5]."',
            `fechaInicio`='".$nuevoProyecto[6]."',`fechaFinalizacion`='".$nuevoProyecto[7]."',`duracion`='".$nuevoProyecto[8]."',
            `investigador_principal`='".$nuevoProyecto[9]."',`horas_ip`='".$nuevoProyecto[10]."',`coinvestigador1`='".$nuevoProyecto[11]."',
            `horas_ci1`='".$nuevoProyecto[12]."', `coinvestigador2`='".$nuevoProyecto[13]."',`horas_ci2`='".$nuevoProyecto[14]."',
            `coinvestigador3`='".$nuevoProyecto[15]."', `horas_ci3`='".$nuevoProyecto[16]."',`evaluador_propuesta`='".$nuevoProyecto[17]."',
            `evaluador_final`='".$nuevoProyecto[18]."',`observaciones`='".$nuevoProyecto[19]."',`numero_convenio`='".$nuevoProyecto[20]."',
            `nombre_convenio`='".$nuevoProyecto[21]."'
             WHERE `id_proyecto` = '".$id_proyecto."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function editarPresupuesto($id_proyecto, $presupuesto)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `proyecto` SET `presupuesto`='".$presupuesto."' WHERE `id_proyecto` = '".$id_proyecto."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }
    

}


?>
