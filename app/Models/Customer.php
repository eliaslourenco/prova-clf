<?php 

namespace app\Models;


class Customer implements Entity {

    public $id;
    public $entityName;
    public function __construct() 
    {
        $this->id = '002';
        $this->entityName = 'customer';
    }

    function insert(array $row ){
        $_SESSION['db'][$this->entityName][trim($row[1])] = $this->insertKeys($row);
    }

    function insertKeys(array $row){
        return array(
            'id_entity' => trim($row[0]),
            'cnpj' => trim($row[1]),
            'name' => trim($row[2]),
            'business_area' => trim($row[3]),
        );
    }

    function total()
    {
        return (isset($_SESSION['db'][$this->entityName])) ? count($_SESSION['db'][$this->entityName]) : 0;
    }
    
    
}