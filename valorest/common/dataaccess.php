<?php

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
