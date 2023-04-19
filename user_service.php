<?php
include_once "database_repository.php";
function checkIfUserExist($email){
    $user=findUserByEmail($email);
    if (empty ($user)){
        return false;
    }
    return true;
}

function storeUser($name,$email,$password){
    saveUser($name,$email,$password);
}
function authenicateUser($email,$password){
    $user=findUserByEmail($email);
    if (empty ($user)){
        return null;
    }
    if($password != $user["password"])
        {
            return null;
        }
    return $user;
    
}




?>