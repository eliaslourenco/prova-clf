<?php 

namespace app\Models;


class Customer implements Entity {

    public $id;

    public function __construct() 
    {
        $this->id = '002';
    }

    function insert(array $row ){
        $_SESSION['db']['customer'][] = $row;
    }

    function insertKeys(array $row){
        
    }
    
}