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
        case "order":
            echo 'Ordering in progress';
            break;
    }



}
function showShoppingcartContent($data){
    $cart = getShoppingCart();
    $shoppingCartData = getShoppingCartData($cart);
    echo '<h2>Shopping Cart</h2>

    <table style="width:100%">';
    foreach($data['cartLines'] as $productId => $cartLine){
       echo '
        <tr>
        <td>'.$cartLine['quantity'].'</td>
        <td>'.$cartLine['name'].'</td>
        <td><img src="Images/'.$cartLine['image'].'"style="heigth:80px; width:80px;"></img></td>
        <td>'.$cartLine['price'].'</td>
        <td>'.$cartLine['sub_total'].'</td>
        <td><a href= "index.php?page=detail&id='.$cartLine['productId'].'">Datail</a></td>

      </tr>';
    }
    echo '<tr><td></td> 
    <td></td>
    <td></td>
    <td></td>
    <td>'
    .$data['total'].'</td>
    </tr>';
    echo '
    </table>';
    echo '   
    <form action= "index.php" method="Post">
    <input type="submit" value="Add order">
    <input type="hidden" name="page" value="shoppingCart">
    <input type="hidden" name="action" value="order">
    </form>';

}
 




?>