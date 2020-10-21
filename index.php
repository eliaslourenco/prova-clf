<?php
session_start();


class AlterSession 
{
  public function setSession(){
    $_SESSION['arr'] =  ['a','b','c'];
  }
  public function setSessionPlus($add){
    $_SESSION['arr'][] = $add;
  }
}

print_r($_SESSION);
$objSession = new AlterSession();

$objSession->setSession();
print_r($_SESSION);
$objSession->setSessionPlus('foi mezera!');
print_r($_SESSION);





