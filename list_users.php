<?php
error_reporting(E_ALL);
require "./_autoload.php";
use patrickmitrotti\usm\model\UserModel;
try{
    $usermodel = new UserModel();
    $users = $usermodel->read();
}
catch(\Throwable $e){
    echo $e->getMessage();
}



include "./view/list_users_view.php";
?>

