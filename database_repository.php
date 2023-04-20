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
function saveUser($name,$email,$password){
    $conn = connectToDataBase();
    $sql = "INSERT INTO users (name, email, password)
    VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
function saveInvoice(){
    
}

?>