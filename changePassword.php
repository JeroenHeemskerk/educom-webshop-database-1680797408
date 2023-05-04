<?php
function ValidateChangePassword(){
    $currentPassword = $currentPasswordErr="";
    $changePassword = $changePasswordErr= "";
    $repeateChangePassword = $repeateChangePasswordErr=""; 

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
          } 

    }
    return[
        "currentPassword"=>$currentPassword, "currentPasswordErr"=>$currentPasswordErr,
        "changePassword"=>$changePassword, "changePasswordErr"=>$changePasswordErr,
        "repeateChangePassword"=>$repeateChangePassword, "repeateChangePasswordErr"=>$repeateChangePasswordErr];
}


function showChangePasswordForm($data){
    echo
    '<div class="content">
        <h2>Change Password:</h2>
        <span class="error">'.$data["genericErr"].'</span>
        <form class="changePassword-form" method="post" action="index.php">
            <label for="current password">Current Password:</label>
            <input class="form-field" type="password" id="current Password" name="Current Password" value="' . $data["currentPassword"] . '" />
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
            <input type="hidden" name="page" value="login">
            <input type="submit" name="login" value="Login" id="login">
        </form>
    </div>';
    }

function showChangePasswordValid(){
    echo 'Your Password is updated';
}




?>