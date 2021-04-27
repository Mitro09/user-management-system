<?php

// patrickmitrotti\usm ---->>> src
// \ ---->>> DIRECTORY_SEPARATOR

//use patrickmitrotti\usm\entity\User;

spl_autoload_register(function($className){
    $classPath = str_replace('patrickmitrotti\usm','./src',$className);
    $classSeparator = str_replace('\\',DIRECTORY_SEPARATOR,$classPath).".php";
    require $classSeparator;
});

//$u = new User('a','b','c','d');
//print_r($u);