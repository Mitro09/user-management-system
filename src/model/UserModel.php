<?php

namespace patrickmitrotti\usm\model;

use Error;
use patrickmitrotti\usm\entity\User;
use \PDO;

class UserModel
{

    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:dbname=corso_formarete;host=localhost', 'root', '');
        } catch (\PDOException $e) {
            // TODO: togliere echo
            echo $e->getMessage();
        }
    }

    // CRUD
    public function create(User $user)
    {

        try {
            $pdostm = $this->conn->prepare('INSERT INTO User (firstName,lastName,email,birthday)
            VALUES (:firstName,:lastName,:email,:birthday);');

            $pdostm->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
            $pdostm->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
            $pdostm->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
            $pdostm->bindValue(':birthday', $user->getBirthday(), PDO::PARAM_STR);

            $pdostm->execute();
        } catch (\PDOException $e) {
            // TODO: Evitare echo
            echo $e->getMessage();
        
        }
    }


    public function read()
    {
        $sql = "select * from User;";
        $pdostm = $this->conn->prepare($sql);
        $pdostm->execute();
        return $pdostm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,User::class,['','','','']);
    
    }

    public function readOne($user_id){
        $sql = "select * from user where userId=:user_id;";
        $pdostm = $this->conn->prepare($sql);
        $pdostm->bindValue(':user_id',$user_id,PDO::PARAM_INT);
        $pdostm->execute();
        $result = $pdostm->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,User::class,['','','','']);
        return count($result) === 0 ? null : $result[0];

    }
    public function update(User $user)
    {
        $sql = "UPDATE user set firstName = :firstName
                                lastName = :lastName
                                email = :email
                                birthday = :birthday
                                where userId=:user_id;";
        $pdostm = $this->conn->prepare($sql);
        $pdostm->bindValue(':firstName', $user->getFirstName(), PDO::PARAM_STR);
        $pdostm->bindValue(':lastName', $user->getLastName(), PDO::PARAM_STR);
        $pdostm->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $pdostm->bindValue(':birthday',$user->getBirthday(),PDO::PARAM_STR);
        $pdostm->bindValue(':user_id',$user->getUserId());
        $pdostm->execute();
        if($pdostm->rowCount()===0){
            return false;
        }
        else if($pdostm->rowCount()===1){
            return true;
        }
        else{
            throw new Error("ERRORE NEL DB");
        }
    }
    public function delete($user_id)
    {
        $sql = "delete from user where userID=:user_id;";
        $pdostm = $this->conn->prepare($sql);
        $pdostm->bindValue(':user_id',$user_id,PDO::PARAM_INT);
        $pdostm->execute();
        if($pdostm->rowCount()===0){
            return false;
        }
        else if($pdostm->rowCount()===1){
            return true;
        }
        else{
            throw new Error("ERRORE NEL DB");
        }
    }
}