<?php

function doLoginUser($name){
    $_SESSION["Login user"]=$name;
}

function isUserLoggedIn(){
   return isset($_SESSION["Login user"]);
}
 function getLoggedinUserName(){
    return ($_SESSION["Login user"]);
 }
function doLogOutUser(){
    session_unset();
    session_destroy();
}




?>