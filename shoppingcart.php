<?php
function showShoppingcartHeader(){
    echo'shopping cart';
}
function handleAction(){
    $action = getPostVAR('action');
    switch ($action){
        case "addShoppingCart":
            $ProductId = test_input(getPostVAR('ProductId'));
            $Quantity = test_input(getPostVAR('quantity'));
            addShoppingCart($ProductId,$Quantity);
            break;
    }



}
function showShoppingcartContent($data){
    
}







?>