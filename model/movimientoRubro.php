<?php

/**
 * Description of movimientoRubro
 *
 * @author Diana Calderon
 */
class movimientoRubro {
    //put your code here
    public $id_proyecto;
    public $rubro_origen;
    public $rubro_destino;
    public $valor_solicitado;
    public $fecha;
    public $observacion;
            
public function agregarMovimiento($movimiento)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `movimiento_rubro` (`id_proyecto`, `rubro_origen`, `valor_solicitado`, `rubro_destino`, `fecha`, `observacion`, `numero_orden`) VALUES ('".$movimiento[0]."', '".$movimiento[1]."', '".$movimiento[2]."', '".$movimiento[3]."','".$movimiento[4]."', '".$movimiento[5]."', '".$movimiento[6]."');");
               
        mysql_close();
        
        if($resultado==1){
            return true;
        }        
        return false;
    } 

    public function listaRetirosPorProyecto($id_proyecto)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM `movimiento_rubro` WHERE rubro_destino = 0 and id_proyecto = '".$id_proyecto."'");
        $retiros= array();
 
        while($retiro = mysql_fetch_assoc($resultado)){  
            $retiros[] = $retiro;
        }
               
        mysql_close();   
 
        return $retiros;
    }

    public function listaMovimientosPorProyecto($id_proyecto)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("SELECT * FROM `movimiento_rubro` WHERE rubro_destino != 0 and id_proyecto = '".$id_proyecto."'");
        $movimientos= array();
 
        while($movimiento = mysql_fetch_assoc($resultado)){  
            $movimientos[] = $movimiento;
        }
               
        mysql_close();   
 
        return $movimientos;
    }

    public function eliminarMovimientoRubroPorProyecto($id_proyecto)
    {
        require 'conectar.php';
       
        $resultado = mysql_query("DELETE FROM movimiento_rubro WHERE id_proyecto='".$id_proyecto."'" );
        
        mysql_close();
        
        return true;
    }  


}

?>
