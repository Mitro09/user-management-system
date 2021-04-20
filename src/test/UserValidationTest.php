<?php

require __DIR__."/../../vendor/testTools/testTool.php";
require __DIR__."/../entity/User.php";
require __DIR__."/../validator/UserValidation.php";
require __DIR__."/../validator/ValidationResult.php";



$user = new User('Mario','Draghi','md@prez.gov','2000-01-01');

$val = new UserValidation($user);
$firstNameValidation = $val->getError('firstName');

assertEquals(true, $firstNameValidation->getIsValid());
assertEquals(UserValidation::FIRTS_NAME_ERROR_NONE_MSG, $firstNameValidation->getMessage());

$user = new User('','draghi','mg@prez.gov','2000-01-01');

$val = new UserValidation($user);
$firstNameValidation = $val->getError('firstName');

assertEquals(false,$firstNameValidation->getIsValid());
assertEquals(UserValidation::FIRTS_NAME_ERROR_REQUIRED_MSG,$firstNameValidation->getMessage());