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

// Busca en la base de datos el menu del tipo que se selecione y con los permisos del usuario
// lo devuelve en un array
function getMenu($type = 0){

    if(!isset($_SESSION['Rol'])){
        $result = consult("SELECT page,name,parameter FROM menu WHERE permissions = 0 AND type = ".$type." ORDER BY sequence ASC;");
    }
    else{
        $result = consult("SELECT page,name,parameter FROM menu WHERE permissions <= ".$_SESSION['Rol']." AND type = ".$type." ORDER BY sequence ASC;");
    }

    return $result;

}

// Recorta el texto por caracteres pero sin cortar palabras
function cutText($text, $numMaxCaract){
    if (strlen($text) <  $numMaxCaract){
        $textCut = $text;
    }else{
        $textCut = substr($text, 0, $numMaxCaract);
        $lastSpave = strripos($textCut, " ");
 
        if ($lastSpave !== false){
            $textoCortadoTmp = substr($textCut, 0, $lastSpave);
            if (substr($textCut, $lastSpave)){
                $textoCortadoTmp .= '...';
            }
            $textCut = $textoCortadoTmp;
        }elseif (substr($text, $numMaxCaract)){
            $textCut .= '...';
        }
    }
 
    return $textCut;
}

?>