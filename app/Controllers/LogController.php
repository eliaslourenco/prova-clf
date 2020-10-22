<?php

namespace app\Controllers;

class LogController
{
    
    public function __construct() 
    {}


    public static function writeErrorLog(string $msg) 
    {
        $pathErrorFile = './app/logs/error.txt';
        
        if(is_file($pathErrorFile)){
            $at = date('Y-m-d-H-i-s-u');
            $errorFile = fopen($pathErrorFile, "a");
            fwrite( $errorFile, $at .' '. $msg . '
');
            fclose($errorFile);
        }
    }

    public static function writeSuccessLog(string $msg) 
    {
        $pathSuccessFile = './app/logs/success.txt';
        if(is_file($pathSuccessFile)){
            $successFile = fopen($pathSuccessFile, "a");
            fwrite( $successFile, $msg . '
');
            fclose($successFile);
        }
        
    }
}