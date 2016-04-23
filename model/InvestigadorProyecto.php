<?php

/**
 * Description of InvestigadorProyecto
 *
 * @author Liliana
 */
class InvestigadorProyecto {
   
    public $cedula;
    public $numeroContrato;
    public $tipoParticipacion;
    public $horasInvestigacion;
    public $uno=0;
    
    public function __construct() {
        $this->uno=1;
    }
  public function agregarInvestigadorProyecto($invProyecto)
    {
        include 'conectar.php';
        
        $resultado = mysql_query("INSERT INTO `proyectofinu`.`investigadorproyecto` (`numeroContrato`, `cedula`, `tipoParticipacion`, `horasInvestigacion`) VALUES ('".$invProyecto[0]."', '".$invProyecto[1]."', '".$invProyecto[2]."', '".$invProyecto[3]."');");
       
        
        mysql_close();
        
        if($resultado==1)
            return true;
        
        return false;
    } 
    
    
}

?>
