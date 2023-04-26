<?php
function showDetailContent($data){
    
    echo '<h1>'.$data["product"]["name"].'  </h1>';
    echo '<p>Price = &euro; '.$data["product"]["price"].'  </p>';
    echo '<p>'.$data["product"]["description"].'  </p>';
    echo '<img src="images/' . $data["product"]["image"] . '" width="400" height="400" >';
}







?>