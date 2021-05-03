<?php

use patrickmitrotti\usm\model\UserModel;

require "./_autoload.php";

$userId = filter_input(INPUT_GET,'user_id',FILTER_SANITIZE_NUMBER_INT);
$usermodel = new UserModel();
$user = $usermodel->readOne($userId);

if($_SERVER['REQUEST_METHOD']==='GET'){
    $firstName = $user->getFirstName();
}