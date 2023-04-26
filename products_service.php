<?php
include_once 'database_repository.php';
function getWebshopData(){
    $allProducts = getAllProducts();

    return ["allProducts" => $allProducts];
}


function getDetailData($productId){
    $product = getProductById($productId);
    return["product" => $product];

}





?>