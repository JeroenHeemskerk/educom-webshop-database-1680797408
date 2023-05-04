<?php

function showDetailHeader(){
    echo 'Product Detail';
}
function showDetailContent($data){
    
    echo '<h2>'.$data["product"]["name"].'  </h2>';
    echo '<p>Price = &euro; '.$data["product"]["price"].'  </p>';
    echo '<p>'.$data["product"]["description"].'  </p>';
    echo '<img src="images/' . $data["product"]["image"] . '" width="400" height="400" >';
}







?>