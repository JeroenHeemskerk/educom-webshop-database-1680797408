
<?php

function validateRegister(){ 
    $name = $nameErr = ""; $email =  $emailErr = ""; $password = $passwordErr = ""; 
    $herhaalPassword = $herhaalPasswordErr=""; $valid = false; $genericErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty(getPostVAR ("name"))) {
          $nameErr = "name is required";
        } else {
          $name = test_input(getPostVAR ("name"));
        }
      
        if (empty(getPostVAR ("email"))) {
          $emailErr = "Email is required";
        } else {
          $email = test_input(getPostVAR ("email"));
        }
      
        if (empty(getPostVAR ("password"))) {
          $passwordErr = "password is required";
        } else {
          $password = test_input(getPostVAR ("password"));
        }
      
        if (empty(getPostVAR ("herhaalPassword"))) {
          $herhaalPasswordErr = "Herhaal password is required";
        } else {
          $herhaalPassword = test_input(getPostVAR ("herhaalPassword"));
        }
        if($password!=$herhaalPassword){
            $herhaalPasswordErr="Password doesn't match";
        }

      
        if (empty($nameErr)  && empty($emailErr) && empty ($passwordErr)) {
          $valid = true;

        }
        try {
            include_once ("user_service.php");
            if($valid==true && checkIfUserExist($email)) {
                $emailErr = "Account already exists";
                $valid = false; 
            }
        } catch (Exception $exception) {
            $genericErr = "Unable to register, please try again later";
            logToServer("unable to register: " . $exception->getMessage());
            $valid = false;
        }
       
    }
      
      return ["nameErr"=> $nameErr, 
    
      "emailErr"=>$emailErr, "passwordErr" => $passwordErr, "herhaalPasswordErr"=> $herhaalPasswordErr,
      "name"=> $name,
      "email"=>$email,"password"=> $password, 
      "herhaalPassword"=>$herhaalPassword,"valid"=>$valid, "genericErr" => $genericErr];
    
}




function showRegisterHeader(){
    echo 'This is register page';
}

function showRegisterForm($data)
{
    echo
    '<div class="content">
        <h2>Register:</h2>
        <span class="error">'.$data['genericErr'].'</span>
        <form class="register-form" method="post" action="index.php">
            <label for="name">Name:</label>
            <input class="form-field" type="text" id="name" name="name" value="' . $data["name"] . '" />
            <span class="error">* ' . $data["nameErr"] . '</span>
            <br />
            <label for="email">Email:</label>
            <input class="form-field" type="text" id="email" name="email" value="' . $data["email"] . '" />
            <span class="error">* ' . $data["emailErr"] . '</span>
            <br />
            
            <label for="password">Password:</label>
            <input class="form-field" type="text" id="password" name="password" value="' . $data["password"] . '" />
            <span class="error">* ' . $data["passwordErr"] . '</span>
            <br />
            <label for="herhaalPassword">herhaal password:</label>
            <input class="form-field" type="text" id="herhaalPassword" name="herhaalPassword" value="' . $data["herhaalPassword"] . '" />
            <span class="error">* ' . $data["herhaalPasswordErr"] . '</span>
            <br />
            <input type="hidden" name="page" value="register">
            <input type="submit" name="submit" value="Submit" id="submit">
        </form>
    </div>';
}
function showRegisterValid() {
    echo "You Are Registered";

}
?>