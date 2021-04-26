<?php

require __DIR__."/../../vendor/testTools/testTool.php";
require __DIR__."/../entity/User.php";
require __DIR__."/../validator/UserValidation.php";
require __DIR__."/../validator/ValidationResult.php";



$user = new User('Mario','Draghi','md@prez.gov','2000-01-01');

$val = new UserValidation($user);
$firstNameValidation = $val->getError('firstName');
$lastNameValidation = $val->getError('lastName');
$emailValidation = $val->getError('email');

assertEquals(true, $firstNameValidation->getIsValid());
assertEquals(UserValidation::FIRTS_NAME_ERROR_NONE_MSG, $firstNameValidation->getMessage());

assertEquals(true, $lastNameValidation->getIsValid());
assertEquals(UserValidation::LAST_NAME_ERROR_NONE_MSG, $lastNameValidation->getMessage());

assertEquals(true, $emailValidation->getIsValid());
assertEquals(UserValidation::EMAIL_ERROR_NONE_MSG, $emailValidation->getMessage());


$user = new User('','','','2000-01-01');

$val = new UserValidation($user);
$firstNameValidation = $val->getError('firstName');
$lastNameValidation = $val->getError('lastName');
$emailValidation = $val->getError('email');


assertEquals(false,$firstNameValidation->getIsValid());
assertEquals(UserValidation::FIRTS_NAME_ERROR_REQUIRED_MSG,$firstNameValidation->getMessage());

assertEquals(false, $lastNameValidation->getIsValid());
assertEquals(UserValidation::LAST_NAME_ERROR_REQUIRED_MSG, $lastNameValidation->getMessage());

assertEquals(false, $emailValidation->getIsValid());
assertEquals(UserValidation::EMAIL_ERROR_REQUIRED_MSG, $emailValidation->getMessage());


$user = new User('','','popopo','2000-01-01');

$val = new UserValidation($user);
$emailValidation = $val->getError('email');

assertEquals(false, $emailValidation->getIsValid());
assertEquals(UserValidation::EMAIL_ERROR_MSG, $emailValidation->getMessage());

