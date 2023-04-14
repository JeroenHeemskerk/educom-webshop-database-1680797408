<?php
include_once "file_repository.php";
function checkIfUserExist($email){
    $user=findUserByEmail($email);
    if (empty ($user)){
        return false;
    }
    return true;
}

function storeUser($email,$name,$password){
    saveUser($email,$name,$password);
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