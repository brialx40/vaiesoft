<?php

/**
 * Description of evaluador
 *
 * @author Diana Caldeorn
 */
class evaluador {

    public $identificacion;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $urlclvac;
    public $disciplinas;

    public function __construct() {
        
    }

    public function buscarEvaluadorIdentificacion($id) {
        include 'conectar.php';

        $resultado = mysql_query('SELECT * FROM evaluador WHERE id_evaluador=' . $id);
        $evaluadores = array();

        while ($evaluador = mysql_fetch_assoc($resultado)) {
            $evaluadores[] = $evaluador;
        }
        //agrego al array del usuario el array que contiene las disciplinas por nombre(String) y una lista de id de disciplinas     
        $evaluadores[0]['disciplinas'] = $this->buscarDisciplinaEvaluador($id);

        if (sizeof($evaluadores) == 0) {
            $evaluadores[0]['identificacion'] = 0;
            $evaluadores[0]['nombre'] = 0;
            $evaluadores[0]['apellido'] = 0;
            $evaluadores[0]['telefono'] = 0;
            $evaluadores[0]['email'] = 0;
        }

        mysql_close();

        return $evaluadores[0];
    }

    /**
     * Metodo para buscar las disciplinas registradas a un evaluador
     * @param integer $id identificacion en la BD del evaluador
     * @return array refrenciado que contiene en la posicion 'nombres'->un string con los nombre de las disciplinas, y en la posicion 'ids'-> un array con los id de las disciplinas registradas
     */
    private function buscarDisciplinaEvaluador($id) {
        $resultado = mysql_query('SELECT id_plan FROM evaluador_plan_estudio WHERE id_evaluador =' . $id);
        $disciplina_id = array();
        $disciplina = "";
        while ($evaludor = mysql_fetch_array($resultado)) {
            $disciplina_id[] = $evaludor["id_plan"];
            $disciplina .= $this->buscarNombreDisciplinaEvaluador($evaludor["id_plan"]) . ", ";
        }
        $lsta = array('nombres' => $disciplina, 'ids' => $disciplina_id);
        return $lsta;
    }

    /**
     * Metodo para buscar el nombre de una disciplina dado su id
     * @param integer $id_plan identificacion en la BD de la disciplina
     * @return string nombre de la disciplina
     */
    private function buscarNombreDisciplinaEvaluador($id_plan) {
        $resultado = mysql_query('SELECT nombre FROM plan_estudio WHERE id_plan =' . $id_plan);
        $datos = mysql_fetch_object($resultado);
        return utf8_encode($datos->nombre);
    }
    
    /**
     * 
     * @param type $identificacion
     * @return int
     */
    public function buscarEvaluadorPorCedula($identificacion) {
        include 'conectar.php';

        $resultado = mysql_query('SELECT * FROM evaluador WHERE identificacion=' . $identificacion);
        $evaluadores = array();

        while ($evaluador = mysql_fetch_assoc($resultado)) {
            $evaluadores[] = $evaluador;
        }

        if (sizeof($evaluadores) == 0) {
            $evaluadores[0]['identificacion'] = 0;
            $evaluadores[0]['nombre'] = 0;
            $evaluadores[0]['apellido'] = 0;
            $evaluadores[0]['telefono'] = 0;
            $evaluadores[0]['email'] = 0;
        }

        mysql_close();

        return $evaluadores[0];
    }
    
    /**
     * 
     * @return type
     */
    public function buscarEvaluadores() {
        include 'conectar.php';

        $resultado = mysql_query('SELECT * FROM `evaluador` ');
        $evaluadores = array();

        while ($evaluador = mysql_fetch_assoc($resultado)) {
            $evaluadores[] = $evaluador;
        }

        mysql_close();

        return $evaluadores;
    }

    public function eliminarEvaluador($id) {
        require 'conectar.php';

        $resultado = mysql_query('DELETE FROM evaluador WHERE id_evaluador=' . $id);

        mysql_close();

        return true;
    }

    public function agregarEvaluador($evaluador) {
        include 'conectar.php';

        $resultado = mysql_query("INSERT INTO `evaluador` (`identificacion`, `nombre`, `apellido`, `telefono`, `email`, `urlcvlac` ) VALUES ('" . $evaluador[0] . "', '" . $evaluador[1] . "', '" . $evaluador[2] . "', '" . $evaluador[3] . "', '" . $evaluador[4] . "', '" . $evaluador[5] . "');");

        $id = mysql_insert_id();
        mysql_close();

        if ($resultado == 1)
            return $id;

        return false;
    }

    public function editarEvaluador($id, $nuevoEvaluador, $seleccionadas, $viejas) {
        include 'conectar.php';
        $resultado = mysql_query("UPDATE  `evaluador` SET  `identificacion` =  '" . $nuevoEvaluador[0] . "',`nombre` =  '" . $nuevoEvaluador[1] . "', `apellido` =  '" . $nuevoEvaluador[2] . "', `telefono` =  '" . $nuevoEvaluador[3] . "', `email` =  '" . $nuevoEvaluador[4] . "', urlcvlac='" . $nuevoEvaluador[5] . "' WHERE `id_evaluador` =  '" . $id . "' LIMIT 1 ;");
        mysql_close();

        return $this->editarDisciplinas($id, $seleccionadas, $viejas);
    }

    /**
     * Metodo para editar la lista de disciplinas de un evaluador
     * @param integer $id identificacion en la BD del evaluador
     * @param array $seleccionadas array de las disciplinas seleccionadas en el formulario de editar evaluador
     * @param array $viejas array de las disicplinas que tenia ya registradas el evaluador
     * @return boolean true si se actualizo correctamenet , en caso contrario false
     */
    function editarDisciplinas($id, $seleccionadas, $viejas) {
        $resultado = $this->agregarNuevaDisciplinaEvaluador($id, $seleccionadas, $viejas);
        $resultado = $this->eliminarDisciplinaNoSeleccionada($id, $seleccionadas, $viejas);
        $resultado = true;
        unset($_SESSION['viejas']);
        return $resultado;
    }

    /**
     * Metodo para agregar una nueva disciplina seleccionanda  en el formulario editar evaluador
     * @param integer $id identificacion en la BD del evaluador
     * @param array $seleccionadas array de las disciplinas seleccionadas en el formulario de editar evaluador
     * @param array $viejas array de las disicplinas que tenia ya registradas el evaluador
     * @return boolean true si se actualizo correctamenet , en caso contrario false
     */
    function agregarNuevaDisciplinaEvaluador($id, $seleccionadas, $viejas) {
        $resultado = false;
        foreach ($seleccionadas as $id_plan) {
            if (!in_array($id_plan, $viejas)){
                $resultado = $this->agregarDisciplinasEvaluador($id, $id_plan);
            }
        }
        return $resultado;
    }

    /**
     * Metodo para eliminar una disciplina que se quitó en el formulario editar evaluador
     * @param integer $id identificacion en la BD del evaluador
     * @param array $seleccionadas array de las disciplinas seleccionadas en el formulario de editar evaluador
     * @param array $viejas array de las disicplinas que tenia ya registradas el evaluador
     * @return boolean true si se actualizo correctamente , en caso contrario false
     */
    function eliminarDisciplinaNoSeleccionada($id, $seleccionadas, $viejas) {
        $resultado = false;
        foreach ($viejas as $id_plan) {
            if (!in_array($id_plan, $seleccionadas)){
                $resultado = $this->eliminarDisciplinaEvaluador($id, $id_plan);
            }
        }
        return $resultado;
    }

    public function agregarDisciplinasEvaluador($id_evaluador, $id_plan) {
        include 'conectar.php';

        $resultado = mysql_query("INSERT INTO `evaluador_plan_estudio` (`id_evaluador`, `id_plan`) VALUES (" . $id_evaluador . ", " . $id_plan . ");");

        mysql_close();

        if ($resultado == 1)
            return true;

        return false;
    }

    /**
     * Metodo para eliminar una disciplina de un evaluador
     * @param integer $id_evaluador identificacion en la BD del evaluador
     * @param integer $id_plan identificacion de una disciplina en la BD
     * @return boolean true si se eliminó correctamente , en caso contrario false
     */
    function eliminarDisciplinaEvaluador($id_evaluador, $id_plan) {
        include 'conectar.php';

        $resultado = mysql_query("DELETE FROM `proyectofinu`.`evaluador_plan_estudio` WHERE `evaluador_plan_estudio`.`id_evaluador` = $id_evaluador AND `evaluador_plan_estudio`.`id_plan` = $id_plan LIMIT 1");

        mysql_close();

        if ($resultado == 1)
            return true;

        return false;
    }

}

?>
