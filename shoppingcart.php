<?php
function showShoppingcartHeader(){
    echo'Shopping cart';
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
            $userId=getLoggedinUserId();
            $cart=($_SESSION['cart']);
            saveInvoice($userId,$cart);
            break;
        case "update":
            echo 'Your order is updated';
            $ProductId = test_input(getPostVAR('ProductId'));
            $Quantity = test_input(getPostVAR('quantity'));
            updateShoppingCart($ProductId,$Quantity);
            break;    

    
    }



}
function showShoppingcartContent($data){
    echo'

    <table style="width:100%">';
    foreach($data['cartLines'] as $productId => $cartLine){
       echo '
        <tr>  
        <td><form action="index.php" method="post">
        <input type="number" id="quantity" name="quantity" value="'.$cartLine['quantity'].'" min="0" max="100">
        <input type="submit" value="Update">
        <input type="hidden" value="'.$cartLine['productId'].'" name="ProductId"></input>
        </input>
        <input type="hidden" name="page" value="shoppingCart">
        <input type="hidden" name="action" value="update">
        </form></td>
        <td>'.$cartLine['name'].'</td>
        <td><img src="Images/'.$cartLine['image'].'"style="heigth:80px; width:80px;"></img></td>
        <td>&euro;&nbsp;'.number_format($cartLine['price'],2,",",".").'</td>
        <td>&euro;&nbsp;'.number_format($cartLine['sub_total'],2,",",".").'</td>
        <td><a href= "index.php?page=detail&id='.$cartLine['productId'].'">Datail</a></td>


      </tr>';
    }
    echo '<tr><td></td> 
    <td></td>
    <td></td>
    <td></td>
    <td> &euro;&nbsp;'
    .number_format($data['total'],2,",",".").'</td>
    </tr>';
    echo '
    </table>';
    echo '
    <div>   
    <form action= "index.php" method="post">
    <input type="submit" value="Add order">
    <input type="hidden" name="page" value="shoppingCart">
    <input type="hidden" name="action" value="order">
    </form>
    </div>';

}







?>