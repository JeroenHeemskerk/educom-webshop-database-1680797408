<?php
include_once 'database_repository.php';
function getWebshopData(){ 
    $allProducts = array();
    $genericErr = "";
    try {
        $allProducts = getAllProducts(); 
    } 
    catch (Exception $e) {
        $genericErr = "Sorry, er is een technische storing bij het ophalen van de producten";
        logToServer("get products failed" .  $e->getMessage());
    }  
    return ["allProducts" => $allProducts, "genericErr" => $genericErr]; 
} 

function getDetailData($productId){
    $product = getProductById($productId);
    return["product" => $product];

}





?>