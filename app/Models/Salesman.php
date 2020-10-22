<?php 

namespace app\Models;


class Salesman implements Entity {

    public $id;

    public function __construct() 
    {
        $this->id = '001';
    }

    function insert(array $row ){
        $_SESSION['db']['salesman'][] = $row;
        return true;
    }
    
    function insertKeys(array $row){
        
    }
    
}