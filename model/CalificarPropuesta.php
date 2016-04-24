<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalificarPropuesta
 *
 * @author W7HOME
 */
class CalificarPropuesta {

    //put your code here

    function __construct() {
        
    }

    /**
     * Metodo para registrar la calificacion de una propuesta elaborada por un evaluador asignado
     * @param integer $id_propuesta identificacion de la propuesta
     * @param array $criterios lista de criterios calificados por el evaluador
     * @param array $preguntas lista de las respuestas dadas por el evaluador
     * @param array $observaciones lista de las observaciones realizadas en cada pregunta por el evaluador
     * @return boolean true si la transaccion se realizo correctamente, en caso contrario false
     */
    function agregarCalificacionPropuesta($id_propuesta, $criterios, $preguntas, $observaciones) {
        include 'conectar.php';
        mysql_query("START TRANSACTION");
        mysql_query("BEGIN");
        $resultado = mysql_query("INSERT INTO `proyectofinu`.`pregunta_propuesta` (`puntaje1`, `puntaje2`, `puntaje3`, `puntaje4`, `puntaje5`,"
                . " `puntaje6`, `puntaje7`, `puntaje8`, `puntaje9`, `puntaje10`, `puntaje11`, `puntaje12`, `puntaje13`) VALUES ('" . $preguntas[1] . "',"
                . " '" . $preguntas[2] . "', '" . $preguntas[3] . "', '" . $preguntas[4] . "', '" . $preguntas[5] . "', '" . $preguntas[6] . "',"
                . " '" . $preguntas[7] . "', '" . $preguntas[8] . "', '" . $preguntas[9] . "','" . $preguntas[10] . "', '" . $preguntas[11] . "', '" . $preguntas[12] . "',"
                . " '" . $preguntas[13] . "');");
        if (!$resultado) {
            mysql_query("ROLLBACK");
            mysql_close();
            return false;
        }
        $resultado = mysql_query("INSERT INTO `proyectofinu`.`observacion_propuesta` (`obser1`, `obser2`, `obser3`, `obser4`, `obser5`, `obser6`,"
                . " `obser7`, `obser8`, `obser9`, `obser10`, `obser11`, `obser12`, `obser13`) VALUES ('" . $observaciones[1] . "','" . $observaciones[2] . "',"
                . " '" . $observaciones[3] . "', '" . $observaciones[4] . "', '" . $observaciones[5] . "', '" . $observaciones[6] . "', '" . $observaciones[7] . "',"
                . " '" . $observaciones[8] . "', '" . $observaciones[9] . "', '" . $observaciones[10] . "', '" . $observaciones[11] . "', '" . $observaciones[12] . "',"
                . " '" . $observaciones[13] . "');");
        if (!$resultado) {
            mysql_query("ROLLBACK");
            mysql_close();
            return false;
        }
        $preguntas[0] = $this->obtenerUltimoIdPreguntas();
        $observaciones[0] = $this->obtenerUltimoIdObservaciones();
        $resultado = mysql_query("INSERT INTO `proyectofinu`.`calificar_propuesta` (`id_propuesta`, `id_pregunta`, `id_observacion`, `criterio1`,"
                . " `criterio2`, `criterio3`) VALUES ('$id_propuesta', '" . $preguntas[0] . "', '" . $observaciones[0] . "', '" . $criterios[1] . "',"
                . " '" . $criterios[2] . "','" . $criterios[3] . "');");
        if (!$resultado) {
            mysql_query("ROLLBACK");
            mysql_close();
            return false;
        }

        mysql_query("COMMIT");
        mysql_close();
        return true;
    }

    /**
     * Metodo para actualizar la calificacion de una propuesta elaborada por un evaluador asignado
     * @param integer $id_propuesta identificacion de la propuesta
     * @param array $criterios lista de criterios calificados por el evaluador
     * @param array $respuestas lista de las respuestas dadas por el evaluador
     * @param array $observaciones lista de las observaciones realizadas en cada pregunta por el evaluador
     * @return boolean true si la transaccion se realizo correctamente, en caso contrario false
     */
    function editarCalificacionPropuesta($id_propuesta, $criterios, $respuestas, $observaciones) {
        include 'conectar.php';
        try {
            mysql_query("START TRANSACTION");
            mysql_query("BEGIN");
            $resultado = mysql_query("UPDATE `proyectofinu`.`pregunta_propuesta` SET `puntaje1` = '".$respuestas[1]."', `puntaje2` = '".$respuestas[2]."',"
                    . " `puntaje3` = '".$respuestas[3]."', `puntaje4` = '".$respuestas[4]."', `puntaje5` = '".$respuestas[5]."',"
                    . " `puntaje6` = '".$respuestas[6]."', `puntaje7` = '".$respuestas[7]."', `puntaje8` = '".$respuestas[8]."',"
                    . " `puntaje9` = '".$respuestas[9]."', `puntaje10` = '".$respuestas[10]."', `puntaje11` = '".$respuestas[11]."',"
                    . " `puntaje12` = '".$respuestas[12]."', `puntaje13` = '".$respuestas[13]."' "
                    . "WHERE `pregunta_propuesta`.`id_pregunta` =".$respuestas[0].";");
            if (!$resultado) {
                mysql_query("ROLLBACK");
                mysql_close();
                return false;
            }
            $resultado = mysql_query("UPDATE `proyectofinu`.`observacion_propuesta` SET `obser1` = '" . $observaciones[1] . "', `obser2` = '" . $observaciones[2] . "',"
                    . " `obser3` = '" . $observaciones[3] . "', `obser4` = '" . $observaciones[4] . "', `obser5` = '" . $observaciones[5] . "',"
                    . " `obser6` = '" . $observaciones[6] . "', `obser7` = '" . $observaciones[7] . "', `obser8` = '" . $observaciones[8] . "',"
                    . " `obser9` = '" . $observaciones[9] . "', `obser10` = '" . $observaciones[10] . "', `obser11` = '" . $observaciones[11] . "',"
                    . " `obser12` = '" . $observaciones[12] . "', `obser13` = '" . $observaciones[13] . "'"
                    . " WHERE `observacion_propuesta`.`id_observacion` = " . $observaciones[0] . ";");
            if (!$resultado) {
                mysql_query("ROLLBACK");
                mysql_close();
                return false;
            }
            mysql_query("COMMIT");
            mysql_close();
            return true;
        } catch (Exception $ex) {
            mysql_query("ROLLBACK;");
            mysql_close();
            echo 'Fallo la operacion: ', $e->getMessage(), "\n";
            return false;
        }
    }
    
    /**
     * Metodo para buscar la informacion regstrada de una calificacion dado su identificacion
     * @param integer $id_pregunta identficacion de las preguntas registradas
     * @return array de las preguntas registradas
     */
    function buscarPreguntasPropuestas($id_pregunta){
        include 'conectar.php';
        $resultado = mysql_query("SELECT * FROM `pregunta_propuesta` WHERE `id_pregunta`= $id_pregunta LIMIT 1;");
        $preguntas = array()        ;
        while($array = mysql_fetch_assoc($resultado)){
            $preguntas[]=$array;
        }
        if(count($preguntas)==0){            
            $preguntas[0]["id_pregunta"]="";
            $i=1;
            while($i<=13){
                $preguntas[0]["puntaje$i"]="";
                $i++;
            }
        }
        mysql_close();
        
        return $preguntas[0];
    }
    
    /**
     * buscar las observaciones realizada por un evaluador a una propuesta especifica
     * @param integer $id_observacion identificacion propuesta
     * @return array con los datos solicitados
     */
    function buscarObservacionesPropuestas($id_observacion){
        include 'conectar.php';
        $resultado = mysql_query("SELECT * FROM `observacion_propuesta` WHERE `id_observacion` = $id_observacion LIMIT 1");
        $obser = array();
        while($obs = mysql_fetch_assoc($resultado)){
            $obser[] = $obs;
        }
        if(count($obser)==0){            
            $obser[0]["id_observacion"]="";
            $i=1;
            while($i<=13){
                $obser[0]["obser$i"]="";
                $i++;
            }
        }
        mysql_close();
        return $obser[0];
    }
    
    /**
     * buscar la calificacion realizada por un evaluador a una propuesta especifica
     * @param integer $id_propuesta identificacion propuesta
     * @return array con los datos solicitados
     */
    function buscarConflictosPropuesta($id_propuesta){
        include 'conectar.php';
        $resultado = mysql_query("SELECT * FROM `calificar_propuesta` WHERE `id_propuesta` = $id_propuesta LIMIT 1");
        $conflictos = array();
        while($confli = mysql_fetch_assoc($resultado)){
            $conflictos[] = $confli;
        }
        if(count($conflictos)==0){
            $conflictos[0]["id_propuesta"] = $id_propuesta;
            $conflictos[0]["id_pregunta"] = 0;
            $conflictos[0]["id_observacion"] = 0;
            $conflictos[0]["criterio1"] = 0;
            $conflictos[0]["criterio2"] = 0;
            $conflictos[0]["criterio3"] = 0;
        }
        mysql_close();
        return $conflictos[0];
    }

    /**
     * Metodo para buscar el ultimo registro realizado de preguntas para obtener ese id
     * @return integer id del ultimo registro realizado
     */
    function obtenerUltimoIdPreguntas() {
        $resultado = mysql_query("SELECT `id_pregunta` FROM `pregunta_propuesta` ORDER BY `id_pregunta` DESC LIMIT 1");
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

    /**
     * Metodo para buscar el ultimo registro realizado de observaciones para obtener ese id
     * @return integer id del ultimo registro realizado
     */
    function obtenerUltimoIdObservaciones() {
        $resultado = mysql_query("SELECT `id_observacion` FROM `observacion_propuesta` ORDER BY `id_observacion` DESC LIMIT 1");
        $row = mysql_fetch_row($resultado);
        return $row[0];
    }

}
