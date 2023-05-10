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
function getShoppingCartData($cart){
    $genericErr = "";
    $total = 0;
    $cartLines = array();
    try{

        $allProducts = getAllProducts(); 
    
        foreach($cart as $productId => $quantity){
            $product = $allProducts[$productId];
            $sub_total = $product['price']*$quantity;
            $cartLines[$productId]=['name'=>$product['name'],'image'=>$product['image'],
                                    'price'=>$product['price'],'quantity'=>$quantity,'sub_total'=>$sub_total,'productId'=>$productId];
            $total += $sub_total;
        }

    }    
    catch (Exception $e) {
        $genericErr = "Sorry, er is een technische storing bij het ophalen van de producten";
        logToServer("get products failed" .  $e->getMessage());
    }  
    return['total'=> $total , 'cartLines' =>$cartLines, 'genericErr'=>$genericErr];

}


function storeOrder(){
  
}


?>