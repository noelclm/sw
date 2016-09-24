<?php

/*
	Practica ValoRest: Pagina par la asignatura SW
    Copyright (C) 2016  
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

//-------------------------------------------------------------------
// Funciones para interacturar con la base de datos
//-------------------------------------------------------------------

// Consulta en la base de datos y devuelve un array con los resultados
function consult($sql){
    
    $result = array();
    $bd = new DataAccess();
    $bd->run($sql);
    
    while(($fila = $bd->row()) !== false ){
        $result[] = $fila;
    }
 
    $bd->close();
    unset($bd);
    
    return $result;
    
}

// Modifica una entrada en la base de datos y devuelve true o false si da error
function modify($sql){
    
    $bd = new DataAccess();
    $result = $bd->run($sql);
    $bd->close();
    unset($bd);
    
    return $result;

}

// Inserta una nueva entrada en la base de datos y devuelve el id de la entrada o false si da error
function insert($sql){
    
    $bd = new DataAccess();
    if($bd->run($sql)){
        $result = $bd->lastId();
    }
    else{
        $result = false;
    }
    $bd->close();
    unset($bd);
    
    return $result;

}

// Elimina una entrada en la base de datos y devuelve true o false si da error
function remove($sql){
    
    $bd = new DataAccess();
    $result = $bd->run($sql);
    $bd->close();
    unset($bd);
    
    return $result;

}

// Clase de acceso a la base de datos
class DataAccess {

    var $bd;
    var $query;
    
    function DataAccess($server = SERVER_CONNECTION, $user = USER_CONNECTION, $psw = PSW_CONNECTION, $bd = BBDD_CONNECTION){

        $this->bd = new mysqli($server, $user, $psw, $bd);
        $this->bd->set_charset("utf8");

    }

    function run($sql){

        if( ($this->query = $this->bd->query($sql)) === false ) {
            return false;
        } else {
            return true;
        }

    }

    function row(){  

        if ( $fila = $this->query->fetch_assoc())
            return $fila;
        else
            return false;

    }  
    
    function lastId(){
        
        return mysqli_insert_id($this->bd);
        
    }
    
    function close(){
        
        mysqli_close($this->bd);
        
    }

}

?>
