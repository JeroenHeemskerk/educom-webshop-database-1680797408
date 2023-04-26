<?php
function showWebshopHeader(){
echo "This is our webshop page";

}

function showWebshopContent($data){

    foreach ($data["allProducts"] as $product) {
      echo showWebshopProducts($product);
    }

}

function showWebshopProducts($product){
 
    echo '<a
       
    href="http://localhost/educom-webshop-database/index.php?page=detail&id='.$product["id"].'"
    >';
    echo '<div class="webshopProduct">';
    echo '<div class="webshopName">';
    echo '<h1>'.$product["name"].'</h1>';
    echo '</div>';
    echo '<div class="webshopImage">';
    echo '<img src="images/' . $product["image"] . '" width="300" height="300" >';
    echo '</div>';
    echo '</div>';
    echo'</a

  >';

}




?>