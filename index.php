<?php 
session_start();
include("sessionManager.php");
$page = getRequestedPage();
$data = processRequest($page);
showResponsePage ($data);

function getRequestedPage () {
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        $page = getPostVAR ("page", "home");
     }else {
        $page = getURLVAR ("page", "home");
     }
     return $page;
    
} 

function processRequest($page){

        switch($page) {

            case 'contact':
                include_once 'contact.php';
                $data = validateContact();
                if ($data["valid"]) { 
                $page = "thanks";
                }
                break;
            case 'register':
                include_once 'register.php';
                $data = validateRegister();
                if ($data["valid"]) { 
                    storeUser($data["name"],$data["email"],$data["password"]);
                    $page = "login";
                }
                break;
            case 'webshop':
                include_once 'products_service.php';
                $data = getWebshopData();
                break;
            case 'detail':
                include_once 'products_service.php';
                $productId = getURLVAR("id");
                $data = getDetailData($productId);
                break;    
            case 'login':
                include_once 'login.php';
                $data = validateLogin();
                if ($data["valid"]){
                doLoginUser($data["name"],$data["userId"]);
                $page = "home";
                }
                break;
            case 'changePassword';
                include_once 'changePassword.php';
                $data = ValidateChangePassword();
                if ($data["valid"]) { 
                    changePassword($data["userId"],$data["changePassword"]);
                    $page = "home";
                }
                break;
            case 'shoppingcart':
                include_once 'shoppingcart.php';
                handleAction();
                break;
            case 'logout';
                doLogOutUser();
                $page = "home";
                break;    
        }
        $data["page"]=$page;
        $data['menu'] = array('home' => 'Home', 'contact' => 'Contact', 'about' => 'About', 'webshop' => 'Webshop');
        if (isUserLoggedIn()) {
            $data['menu']['logout'] = "Logout " . getLoggedInUserName(); 
            $data['menu']['changePassword'] = 'change Password';
          } else {
            $data['menu']['register'] = "Register";
            $data['menu']['login'] = "Login";
         }
        return $data;
    }




function getPostVAR ($key, $default=""){
 $value = filter_input(INPUT_POST, $key);
    
 if (isset ($value)){
    return ($value);
}
    return $default;
}
function getURLVAR ($key, $default=""){
    $value = filter_input(INPUT_GET, $key);
    
    if (isset ($value)){
       return ($value);
   }
       return $default;
   }

function showResponsePage($data){
    showHtmlStart();
    showHtmlHeader();
    showHtmlBody($data);
    showHtmlEND();

}

function showHtmlStart(){
    echo '<!doctype Html>  </html>';
}

function showHtmlHeader(){
    echo "<head>";
    showTitle();
    showLinks();
    echo "</head>";
}

function showTitle(){
    echo " <title>Chocolate</title>";
}
function showLinks(){
    echo '<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />';
}

function showHtmlBody($data){
    echo "<body>";
    showHeader($data["page"]);
    showMenu($data);
    showContent($data);
    showFooter();
    echo "</body>";
}

function showHtmlEND(){
    echo "</html>";
}
function showHeader($page){
    echo '   <i>
    <header>
      <h1>';
    switch($page) {
        case 'home':
            include_once 'home.php';
            showHomeHeader();
            break;
        case 'about':
            include_once 'about.php';
            showAboutHeader();
            break;
        case 'contact':
            include_once 'contact.php';
            showContactHeader();
            break;
        case 'register':
            include_once 'register.php';
            showRegisterHeader();
            break;
        case 'login':
            include_once 'login.php';
            showLoginHeader();
            break;
        case 'detail':
            include_once 'detail.php';
            showDetailHeader();
            break;
        case 'webshop':
            include_once 'webshop.php';
            showWebshopHeader();
            break;
        case 'shoppingcart':
            include_once 'shoppingcart.php';
            showShoppingcartHeader();
            break;
        case 'changePassword':
            include_once 'changePassword.php';
            showChangePasswordHeader();
            break;
    }
      
    echo '</h1>
  </header>
  </i>';
}
function showMenuItem($link, $label){
    echo "
    <li>
      <a href='./index.php?page=$link'> '$label' </a>

    </li>";
  }
function showMenu($data){
    echo
    '<ul class="menu">';
    foreach( $data['menu']as $link => $label){
        showMenuItem($link,$label);
    }
    echo
     '</ul>';
    }


function showContent($data){
    switch($data["page"]){
        case "home":
            include_once("home.php");
            showHomeContent();
            break;
        case "about":
            include_once("about.php");
            showAboutContent();
            break;
        case "contact":
            include_once("contact.php");
            showContactForm($data);
            break;
        case "webshop":
            include_once("webshop.php");
            showWebshopContent($data);
            break;
        case "detail":
            include_once("detail.php");
            showDetailContent($data);
            break;
        case "shoppingcart":
            include_once("shoppingcart.php");
            showShoppingcartContent($data);
            break;    
        case "thanks":
            showContactValid($data);
            showThankyouPage($data);
            break;
        case "register":
            include_once("register.php");
            showRegisterForm($data);
            break;
        case "login":
            include_once("login.php");
            showLoginForm($data);
            break;
        case "changePassword":
            include_once("changePassword.php");
            showChangePasswordForm($data);
            break;
        case "logout":
            include_once("login.php");
            showLogoutValid();
            include_once("home.php");
            showHomeContent();
            break;
        default: 
            showError();
            break;
    }


}

function showError(){
    echo "This page is not available";
}


function showFooter(){
    echo "<footer>";
    echo "Copy Right © 2023 Hana"; 
    echo "</footer>";
}

function logToServer($message) {
    echo "LOGGING TO THE SERVER: " . $message;
}

function test_input($data) { 
    $data = trim($data); 
    $data = stripslashes($data); 
    $data = htmlspecialchars($data); 
    return $data; 
  } 

?>