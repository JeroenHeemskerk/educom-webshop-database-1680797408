<?php
function showChangePasswordHeader(){
    echo 'Change Password';
}

function ValidateChangePassword(){
    $currentPassword = $currentPasswordErr="";
    $changePassword = $changePasswordErr= "";
    $repeateChangePassword = $repeateChangePasswordErr=""; 
    $valid = false;
    $genericErr="";
    $userId="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty(getPostVAR ("currentPassword"))) {
            $currentPasswordErr = "Current Password is required";
          } else {
            $currentPassword = test_input(getPostVAR ("currentPassword"));
          }  

        if (empty(getPostVAR ("changePassword"))) {
            $changePasswordErr = "Password is required";
          } else {
            $changePassword = test_input(getPostVAR ("changePassword"));
          } 

          if (empty(getPostVAR ("repeateChangePassword"))) {
            $repeateChangePasswordErr = "Repeate Password is required";
          } else {
            $repeateChangePassword = test_input(getPostVAR ("repeateChangePassword"));
            if ($changePassword != $repeateChangePassword){
                $repeateChangePasswordErr = "Your password doesn't match";
          } 
        }
          if ( empty($currentPasswordErr) && empty ($changePasswordErr) && empty ($repeateChangePasswordErr)) {
            try {
                include("user_service.php");
                $userId=getLoggedinUserId();
                $user= checkPassword($userId,$currentPassword);
                
                if(empty($user)) {
                    $currentPasswordErr = "uncorrect password";
                }
                else{
                    $name=$user["name"];
                    $valid=true;
                }
            } catch (Exception $exception) {
                $genericErr = "Unable to Login, please try again later";
                logToServer("unable to Login: " . $exception->getMessage());
            }
        }

    }
    return[
        "currentPassword"=>$currentPassword, "currentPasswordErr"=>$currentPasswordErr,
        "changePassword"=>$changePassword, "changePasswordErr"=>$changePasswordErr,
        "repeateChangePassword"=>$repeateChangePassword, "repeateChangePasswordErr"=>$repeateChangePasswordErr, "valid"=>$valid , "genericErr"=>$genericErr, "userId"=>$userId];
}



function showChangePasswordForm($data){
    echo
    '<div class="content">
        <h2>Change Password:</h2>
        <span class="error">'.$data["genericErr"].'</span>
        <form class="changePassword-form" method="post" action="index.php">
            <label for="currentPassword">Current Password:</label>
            <input class="form-field" type="password" id="currentPassword" name="currentPassword" value="' . $data["currentPassword"] . '" />
            <span class="error">* ' . $data["currentPasswordErr"] . '</span>
            <br />
            <label for="changePassword">Change Password:</label>
            <input class="form-field" type="password" id="changePassword" name="changePassword" value="' . $data["changePassword"] . '" />
            <span class="error">* ' . $data["changePasswordErr"] . '</span>
            <br />
            <label for="repeateChangePassword">Repeate Change Password:</label>
            <input class="form-field" type="password" id="repeateChangePassword" name="repeateChangePassword" value="' . $data["repeateChangePassword"] . '" />
            <span class="error">* ' . $data["repeateChangePasswordErr"] . '</span>
            <br />
            <input type="hidden" name="page" value="changePassword">
            <input type="submit" name="change password" value="change password" id="change password">
        </form>
    </div>';
    }

function showChangePasswordValid(){
    echo 'Your Password is updated';
}




?>