<?php

use patrickmitrotti\usm\entity\User;

spl_autoload_register(function($className){
    echo "sto cercando la classe $className\n\n";
    require __DIR__."/../$className.php";
    //require __DIR__."/../validator/$className.php";
});

$user = new User('roby','rossi','a@b.it','2020-01-01');
//$val = new UserValidation($user);
//$task = new Task;
print_r($user);