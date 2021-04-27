<?php

use patrickmitrotti\usm\entity\User;

try {
    $conn = new PDO('mysql:dbname=corso_formarete;host=localhost',
                    'root','');
    $stm = $conn->prepare('select * from user;');
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_CLASS,User::class);
} 
catch (\PDOException $e) {
    echo $e->getMessage()."\n";
}

include "./view/list_users_view.php";
?>

