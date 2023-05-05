<?php
function connectToDataBase(){
    $servername = "localhost";
    $username = "webshop-user";
    $password = "Nawras.1991";
    $dbname = "hana_webshop";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    return $conn;
}

function findUserByEmail($email){
    try{$conn = connectToDataBase();
        $sql = "SELECT * FROM `users` WHERE email = '$email'";
        $result = $conn->query($sql);
    
        while($row = mysqli_fetch_assoc($result)){
            return $row;
        }
        
        return null;
    }
   finally{
    mysqli_close($conn);
    }

}
function findUserByUserId($userId){
    try{$conn = connectToDataBase();
        $sql = "SELECT * FROM `users` WHERE userId = '$userId'";
        $result = $conn->query($sql);
    
        while($row = mysqli_fetch_assoc($result)){
            return $row;
        }
        
        return null;
    }
   finally{
    mysqli_close($conn);
    }
}



function updatePassword($userId,$password){
    try{$conn = connectToDataBase();
        $sql = "UPDATE users SET password='$password' WHERE id=$userId ";
    
        if (mysqli_query($conn, $sql)) {
            echo "updated successfully";
          } else {
            echo "Error updating: " . mysqli_error($conn);
          }
    }
   finally{
    mysqli_close($conn);
    }
}



function saveUser($name,$email,$password){
    try{$conn = connectToDataBase();
    $sql = "INSERT INTO users (name, email, password)
    VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    }
    finally{
    mysqli_close($conn);
    }

}
// function saveInvoice(){
//     $date = "20-04-2023";
//     $userId = 620;
//     $deliveryDate = "24-04-2023";
//     $deliveryAdresId = 41;

//     $conn = connectToDataBase();
//     $sql = "INSERT INTO invoice (date, user-id, delivery-date, delivery-adres-id)
//     values('$date', '$userId' , '$deliveryDate', '$deliveryAdresId')";

//     if (mysqli_query($conn, $sql)) {
//         } else {
//         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//         }

//         $invoiceId = mysqli_last_insert_id($conn);
    
//     foreach ($cart as $proaductId => $quantity){
//         $sql = "INSERT INTO invoiceRow (invoice-id, product-id, quantity)
//         values('$invoiceId', '$productId' , '$quantity');
//         if (mysqli_query($conn, $sql)) {
//         } else {
//         echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//         }
     
//     }
        
function getAllProducts(){
    try{$conn = connectToDataBase();
        $sql = "SELECT id ,name, price, image FROM `products`";
        $result = $conn->query($sql);
        $products = array();
        
        while($row = mysqli_fetch_assoc($result)){
            $products[$row["id"]]= $row;
        }
        
        return $products;
    }
   finally{
    mysqli_close($conn);
    }

}

function getProductById($productId){
    try{$conn = connectToDataBase();
        $sql = "SELECT id ,name, price, image,description FROM `products` where id = $productId";
        $result = $conn->query($sql);
        $product = array();
        while($row = mysqli_fetch_assoc($result)){
            $product= $row;
        }

        return $product;
    }
   finally{
    mysqli_close($conn);
    }

}

function deleteProductById($productId){
    $conn = connectToDataBase();
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      $sql = "SELECT id ,name, price, image,description FROM `products` where id = $productId";
      if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
      } else {
        echo "Error deleting record: " . mysqli_error($conn);
      }
      
      mysqli_close($conn);

}


?>