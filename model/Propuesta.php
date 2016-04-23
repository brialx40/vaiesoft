<?php


/**
 * Description of propuesta
 *
 * @author Diana Calderon 
 */
class Propuesta {
    
    public $id_propuesta;
    public $convocatoria;
    public $nombre;
    public $grupo;
    public $propuesta;
    public $fechaInicio;
    public $fechaFinalizacion;
    public $presupuesto;
    public $prorroga;
    public $tipoParticipacion;
    public $horasInvestigacion;
    
    public function __construct() {
    }

    public function listarPropuesta()
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `propuesta`');
        $propuestas= array();
 
        while($propuesta = mysql_fetch_assoc($resultado))
        {  $propuestas[] = $propuesta;}
        
                      
        mysql_close();   
 
        return $propuestas;
    } 

    public function listarPropuestaPorInvestigador($id_investigador)
    {
        include 'conectar.php';
        
        $resultado = mysql_query('SELECT * FROM `propuesta` WHERE `investigador_principal` = '.$id_investigador. 
                                ' OR `coinvestigador1` = '.$id_investigador.' OR 
                                `coinvestigador2` = '.$id_investigador.' OR `coinvestigador3` = '.$id_investigador);
        $propuestas= array();
 
        while($propuesta = mysql_fetch_assoc($resultado))
        {  $propuestas[] = $propuesta;}
        
                      
        mysql_close();   
 
        return $propuestas;
    } 

    public function buscarPropuestaPorEstado($estado)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM propuesta WHERE estado='.$estado);
        $propuestas= array();
         
        while($propuesta = mysql_fetch_assoc($resultado))
        {  $propuestas[] = $propuesta;}
        
            if(sizeof($propuestas)==0)
            {
                $propuestas[0]['nombre']=0;
                
            }
                
        mysql_close();   
 
        return $propuestas[0];
    }

    public function buscarPropuesta($id)
    {
        include 'conectar.php';
                
        $resultado = mysql_query('SELECT * FROM propuesta WHERE id_propuesta='.$id);
        $propuestas= array();
         
        while($propuesta = mysql_fetch_assoc($resultado))
        {  $propuestas[] = $propuesta;}
        
            if(sizeof($propuestas)==0)
            {
                $propuestas[0]['nombre']=0;
                
            }
                
        mysql_close();   
 
        return $propuestas[0];
    }
       
public function agregarPropuesta($propuesta)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `propuesta` 
            (`convocatoria`, `ano_lectivo`, `nombre`, `objetivos`, `grupo`, `facultad`, `fechaInicio`, `fechaFinalizacion`, 
             `duracion`, `investigador_principal`, `horas_ip`, `coinvestigador1`, `horas_ci1`, `coinvestigador2`, 
             `horas_ci2`, `coinvestigador3`, `horas_ci3`, `evaluador_propuesta`, `observaciones`, `numero_convenio`,
              `nombre_convenio`, `estado`, `presupuesto`) VALUES ('".$propuesta[0]."', '".$propuesta[1]."', '".$propuesta[2]."', 
              '".$propuesta[3]."', '".$propuesta[4]."',  '".$propuesta[5]."', '".$propuesta[6]."', '".$propuesta[7]."', 
              '".$propuesta[8]."', '".$propuesta[9]."', '".$propuesta[10]."', '".$propuesta[11]."', '".$propuesta[12]."',
               '".$propuesta[13]."', '".$propuesta[14]."', '".$propuesta[15]."', '".$propuesta[16]."', 
               '".$propuesta[17]."', '".$propuesta[18]."', '".$propuesta[19]."', '".$propuesta[20]."', '".$propuesta[21]."'
               , '".$propuesta[22]."');");
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 
    

public function eliminarPropuesta($id_propuesta)
    {
        include 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM propuesta WHERE id_propuesta LIKE '".$id_propuesta."'");
        
        mysql_close();
        
        return true;
    }
    
     public function editarPropuesta($id_propuesta, $nuevaPropuesta)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `propuesta` SET  
            `convocatoria`='".$nuevaPropuesta[0]."', `ano_lectivo`='".$nuevaPropuesta[1]."',
            `nombre`='".$nuevaPropuesta[2]."', `objetivos`='".$nuevaPropuesta[3]."',`grupo`='".$nuevaPropuesta[4]."',
            `facultad`='".$nuevaPropuesta[5]."', `fechaInicio`='".$nuevaPropuesta[6]."',`fechaFinalizacion`='".$nuevaPropuesta[7]."',
            `duracion`='".$nuevaPropuesta[8]."', `investigador_principal`='".$nuevaPropuesta[9]."',`horas_ip`='".$nuevaPropuesta[10]."',
            `coinvestigador1`='".$nuevaPropuesta[11]."',`horas_ci1`='".$nuevaPropuesta[12]."',
            `coinvestigador2`='".$nuevaPropuesta[13]."',`horas_ci2`='".$nuevaPropuesta[14]."',`coinvestigador3`='".$nuevaPropuesta[15]."',
            `horas_ci3`='".$nuevaPropuesta[16]."',`evaluador_propuesta`='".$nuevaPropuesta[17]."',
            `observaciones`='".$nuevaPropuesta[18]."',`numero_convenio`='".$nuevaPropuesta[19]."',`nombre_convenio`='".$nuevaPropuesta[20]."'
             WHERE `id_propuesta` = '".$id_propuesta."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function editarPropuesta2($id_propuesta, $nuevaPropuesta)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `propuesta` SET  
            `convocatoria`='".$nuevaPropuesta[0]."', `ano_lectivo`='".$nuevaPropuesta[1]."',
            `nombre`='".$nuevaPropuesta[2]."', `objetivos`='".$nuevaPropuesta[3]."',`grupo`='".$nuevaPropuesta[4]."',
            `facultad`='".$nuevaPropuesta[5]."', `fechaInicio`='".$nuevaPropuesta[6]."',`fechaFinalizacion`='".$nuevaPropuesta[7]."',
            `duracion`='".$nuevaPropuesta[8]."', `investigador_principal`='".$nuevaPropuesta[9]."',`horas_ip`='".$nuevaPropuesta[10]."',
            `coinvestigador1`='".$nuevaPropuesta[11]."',`horas_ci1`='".$nuevaPropuesta[12]."',
            `coinvestigador2`='".$nuevaPropuesta[13]."',`horas_ci2`='".$nuevaPropuesta[14]."',`coinvestigador3`='".$nuevaPropuesta[15]."',
            `horas_ci3`='".$nuevaPropuesta[16]."',`numero_convenio`='".$nuevaPropuesta[17]."',`nombre_convenio`='".$nuevaPropuesta[18]."'
             WHERE `id_propuesta` = '".$id_propuesta."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

    public function editarEstado($id_propuesta, $estado)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `propuesta` SET `estado`='".$estado."' WHERE `id_propuesta` = '".$id_propuesta."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }

     public function editarPresupuesto($id_propuesta, $presupuesto)
    {
        include 'conectar.php';
      
        $resultado = mysql_query("UPDATE  `propuesta` SET `presupuesto`='".$presupuesto."' WHERE `id_propuesta` = '".$id_propuesta."' LIMIT 1 ;");
        
        mysql_close();
        
        return true;    
    }
    /**
     * Método para buscar el último id registrado en la tabla propuesta.
     * @return int
     */
    public function consultarUltimoId()
    {
        include 'conectar.php';
      
        $resultado = mysql_query("SELECT MAX(`id_propuesta`) FROM `propuesta` ;");
        
        mysql_close();
        
        $row = mysql_fetch_row($resultado);
              
        return $row[0];    
    }
    /**
     * Método para listar las propuestas por el id_evaluador.
     * @param int $id_evaluador
     * @return Array
     */
    public function listarPropuestaEvaluador($id_evaluador)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM `propuesta` WHERE estado='PENDIENTE' AND evaluador_propuesta = $id_evaluador" );
        $propuestas= array();
 
        while($propuesta = mysql_fetch_assoc($resultado))
        {  $propuestas[] = $propuesta;}
        
                      
        mysql_close();   
 
        return $propuestas;
    } 
}


?>
