<?php

use patrickmitrotti\usm\entity\User;
use patrickmitrotti\usm\model\UserModel;
use patrickmitrotti\usm\validator\bootstrap\ValidationFormHelper;
use patrickmitrotti\usm\validator\UserValidation;

require "./_autoload.php";
/*require __DIR__."/src/model/UserModel.php";
require __DIR__."/src/entity/User.php";
require __DIR__."/src/validator/UserValidation.php";
require __DIR__."/src/validator/ValidationResult.php";
require __DIR__."/src/validator/bootstrap/ValidationFormHelper.php";*/

if($_SERVER['REQUEST_METHOD']==='GET'){

    list($firstName,$firstNameClass,$firstNameClassMessage,$firstNameMessage) = ValidationFormHelper::getDefault();
    list($lastName,$lastNameClass,$lastNameClassMessage,$lastNameMessage) = ValidationFormHelper::getDefault();
    list($email,$emailClass,$emailClassMessage,$emailMessage) = ValidationFormHelper::getDefault();
    list($birthday,$birthdayClass,$birthdayClassMessage,$birthdayMessage) = ValidationFormHelper::getDefault();

    

}

if($_SERVER['REQUEST_METHOD']==='POST'){
    $user = new User($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['birthday']);
    /*$user = new User();
    $user->setUser($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['birthday']);*/
    $userValidation = new UserValidation($user);
    $firstNameValidation = $userValidation->getError('firstName');
    $lastNameValidation = $userValidation->getError('lastName');
    $emailValidation = $userValidation->getError('email');
    $birthdayValidation = $userValidation->getError('birthday');

    list($firstName,$firstNameClass,$firstNameClassMessage,$firstNameMessage) = ValidationFormHelper::getValidationClass($firstNameValidation);
    list($lastName,$lastNameClass,$lastNameClassMessage,$lastNameMessage) = ValidationFormHelper::getValidationClass($lastNameValidation);
    list($email,$emailClass,$emailClassMessage,$emailMessage) = ValidationFormHelper::getValidationClass($emailValidation);
    list($birthday,$birthdayClass,$birthdayClassMessage,$birthdayMessage) = ValidationFormHelper::getValidationClass($birthdayValidation);
   
    if($userValidation->getIsValidForm()){
        $userModel = new UserModel();
        $userModel->create($user);
        header('location: add_user_form.php');

    }
   }
include __DIR__."/view/add_user_view.php";
?>
