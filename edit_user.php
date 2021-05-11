<?php

use patrickmitrotti\usm\entity\User;
use patrickmitrotti\usm\model\UserModel;
use patrickmitrotti\usm\validator\bootstrap\ValidationFormHelper;
use patrickmitrotti\usm\validator\UserValidation;

require "./_autoload.php";


//var_dump($user);


if($_SERVER['REQUEST_METHOD']==='GET'){

    $userId = filter_input(INPUT_GET,'user_id',FILTER_SANITIZE_NUMBER_INT);
    $usermodel = new UserModel();
    $user = $usermodel->readOne($userId);
    list($firstName,$firstNameClass,$firstNameClassMessage,$firstNameMessage) = ValidationFormHelper::getDefault($user->getFirstName());
    list($lastName,$lastNameClass,$lastNameClassMessage,$lastNameMessage) = ValidationFormHelper::getDefault($user->getLastName());
    list($email,$emailClass,$emailClassMessage,$emailMessage) = ValidationFormHelper::getDefault($user->getEmail());
    list($birthday,$birthdayClass,$birthdayClassMessage,$birthdayMessage) = ValidationFormHelper::getDefault($user->getBirthday());    
    //var_dump($user);
}

if ($_SERVER['REQUEST_METHOD']==='POST') {
    // passare  id in qualche modo
    // - hidden field  input type hidden
    $userId = filter_input(INPUT_POST,'user_id',FILTER_SANITIZE_NUMBER_INT);
   //var_dump($userId);
    $user = new User($_POST['firstName'],$_POST['lastName'],$_POST['email'],$_POST['birthday']);
    $user->setUserId($_POST['user_id']);
    /*$user->setFirstName($_POST['firstName']);
    $user->setLastName($_POST['lastName']);
    $user->setEmail($_POST['email']);
    $user->setBirthday($_POST['birthday']);*/

    $val = new UserValidation($user);
    $firstNameValidation = $val->getError('firstName');
    $lastNameValidation = $val->getError('lastName');
    $emailValidation = $val->getError('email');
    $birthdayValidation = $val->getError('birthday');
    var_dump($user);

    list($firstName, $firstNameClass, $firstNameClassMessage, $firstNameMessage) = ValidationFormHelper::getValidationClass($firstNameValidation);
    list($lastName,$lastNameClass,$lastNameClassMessage,$lastNameMessage) = ValidationFormHelper::getValidationClass($lastNameValidation);
    list($email,$emailClass,$emailClassMessage,$emailMessage) = ValidationFormHelper::getValidationClass($emailValidation);
    list($birthday,$birthdayClass,$birthdayClassMessage,$birthdayMessage) = ValidationFormHelper::getValidationClass($birthdayValidation);

    if ($val->getIsValidForm()) {
        //TODO
        $userModel = new UserModel();
        $userModel->update($user);
        //header('location: ./list_users.php');
    }
}

include __DIR__."/view/edit_user_view.php";