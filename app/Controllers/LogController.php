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
            
            $errorFile = fopen($pathErrorFile, "a");
            fwrite( $errorFile, $msg . '\n
');
            fclose($errorFile);
        }
    }

    public static function writeSuccessLog(string $msg) 
    {
        $pathSuccessFile = './app/logs/success.txt';
        if(is_file($pathSuccessFile)){
            $successFile = fopen($pathSuccessFile, "a");
            fwrite( $successFile, $msg . '\n
');
            fclose($successFile);
        }
        
    }
}