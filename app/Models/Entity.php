<?php 

namespace app\Models;


interface Entity {

    function insert(array $row );

    function insertKeys(array $row);
    
}