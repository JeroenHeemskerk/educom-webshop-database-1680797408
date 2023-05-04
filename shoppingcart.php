<?php
function showShoppingcartHeader(){
    echo'shopping cart';
}
function handleAction(){
    $action = getPostVAR('action');
    switch ($action){
        case "addShoppingCart":
            $ProductId = getPostVAR('ProductId');
            $Quantity = getPostVAR('quantity');
            addShoppingCart($ProductId,$Quantity);
            break;
    }



}
function showShoppingcartContent($data){
    
}







?>