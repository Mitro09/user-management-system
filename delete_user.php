<?php

use patrickmitrotti\usm\model\UserModel;

require "./_autoload.php";

$userId = filter_input(INPUT_GET,'user_id',FILTER_SANITIZE_NUMBER_INT);
$usermodel = new UserModel;
$deletedUser = $usermodel->delete($userId);
if($deletedUser){
    echo "Utente Cancellato";
}
else{
    echo "Non cancellato";
}


include "./view/delete_user_view.php";
//echo $userId;