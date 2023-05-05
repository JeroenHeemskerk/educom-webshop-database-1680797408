<?php
//user//
function doLoginUser($name,$userId){
    $_SESSION["Login user"]=$name;
    $_SESSION["userId"]=$userId;
}

function isUserLoggedIn(){
   return isset($_SESSION["Login user"]);
}
 function getLoggedinUserName(){
    return ($_SESSION["Login user"]);
 }
 function getLoggedinUserId(){
  return ($_SESSION["userId"]);
}
function doLogOutUser(){
    session_unset();
    session_destroy();
}


//Product//

function addShoppingCart($productId, $quantity){
    
    if(isset($_SESSION['cart'][$productId])){
      $_SESSION['cart'][$productId] += $quantity;
    }else{
      $_SESSION['cart'][$productId] = $quantity;
    }

}

function getShoppingCart(){
    return ($_SESSION['cart']);

}





?>