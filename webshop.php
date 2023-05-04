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
    echo '<h2>'.$product["name"].'</h2>';
    echo '</div>';
    echo '<div class="webshopImage">';
    echo '<img src="images/' . $product["image"] . '" width="300" height="300" >';
    echo '</div>';
    echo '</div>';
    echo'</a>';
    echo '<form action="index.php" method="post">
    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" max="100">
    <input type="hidden" name="ProductId" value="'.$product["id"].'">
    <input type="submit" value="Add Product">
    <input type="hidden" name="page" value="shoppingcart">
    <input type="hidden" name="action" value="addShoppingCart">
  </form>
  ';

}






?>