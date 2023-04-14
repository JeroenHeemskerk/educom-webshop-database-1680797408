  <?php 
  function showContactHeader(){
    echo 'Contact';
  }

  function validateContact()
  {
  $aanhrefErr = $firstnameErr = $lastnameErr = $telefoonErr = 
  $emailErr = $commentErr = $communicationChannelErr ="";
  $aanhref = $firstname = $lastname = $telefoon = 
  $email = $communicationChannel = $comment = "";
  $valid = false;


  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(getPostVAR ("aanhref"))) {
      $aanhrefErr = "aanhref is required";
    } else {
      $aanhref = test_input(getPostVAR ("aanhref"));
    }
    if (empty(getPostVAR ("firstname"))) {
      $firstnameErr = "firstname is required";
    } else {
      $firstname = test_input(getPostVAR ("firstname"));
    }
    if (empty($_POST["lastname"])) {
      $lastnameErr = "lastname is required";
    } else {
      $lastname = test_input((getPostVAR ("lastname")));
    }
    if (empty(getPostVAR ("telefoon"))) {
      $telefoonErr = "telefoon is required";
    } else {
      $telefoon = test_input((getPostVAR ("telefoon")));
    }
  
    if (empty(getPostVAR ("email"))) {
      $emailErr = "Email is required";
    } else {
      $email = test_input((getPostVAR ("email")));
    }
  
    if (empty(getPostVAR ("comment"))) {
      $commentErr = "comment is required";
    } else {
      $comment = test_input(getPostVAR ("comment"));
    }
  
    if (empty(getPostVAR ("communicationChannel"))) {
      $communicationChannelErr = "communicationChannel is required";
    } else {
      $communicationChannel = test_input(getPostVAR ("communicationChannel"));
    }
  
    if (empty($aanhrefErr)  && empty($firstnameErr) && empty ($lastnameErr) && empty ($telefoonErr) &&
        empty($emailErr) && empty($commentErr) && empty($communicationChannelErr)){
      $valid = true;
    }

  }
  return ["aanhrefErr"=> $aanhrefErr, "firstnameErr" => $firstnameErr, "lastnameErr" => $lastnameErr, "telefoonErr" => $telefoonErr,
  "emailErr"=>$emailErr, "commentErr" => $commentErr, "communicationChannelErr"=> $communicationChannelErr,
  "aanhref"=>$aanhref,"firstname"=> $firstname,"lastname"=> $lastname,"telefoon"=> $telefoon, 
  "email"=>$email,"communicationChannel"=> $communicationChannel, "comment" => $comment,
  "valid"=>$valid];
}


  function showContactValid($data){
 
    echo $data["aanhref"];
    echo "<br>";
    echo $data["firstname"]; 
    echo "<br>";
    echo $data["lastname"];
    echo "<br>";
    echo $data["telefoon"];
    echo "<br>";
    echo $data["email"]; 
    echo "<br>";
    echo $data["communicationChannel"];
    echo "<br>";
    echo $data["comment"];
    echo "<br>";}

    function showContactForm($data){
      echo '    <br>
      <p><span class="error">* required field</span></p>
      <form method="post" action="index.php">   
        <label for="aanhref">Aanhref:</label>
        <select name="aanhref" id="aanhref">
          <option name="" '; if ($data["aanhref"]=="other") {echo "selected";}echo'></option>
          <option value="Dhr" name="Dhr" '; if ($data["aanhref"]=="Dhr") {echo "selected";} echo'>Dhr</option>
          <option value="Mvr" name="Mvr" '; if ($data["aanhref"]=="Mvr") {echo "selected";} echo'>Mvr</option>
        </select>
        
        </br>
        <span class="error">* ' .$data["aanhrefErr"] .'</span> 
        <div>
          <label for="firstname">First name:</label>
          <input type="text" id="firstname" name="firstname" value="'.$data["firstname"] .'" />
        </div>
        <span class="error">* ' .$data["firstnameErr"] .'</span>
        <div>
          <label for="lastname">Last name:</label>
          <input type="text" id="lastname" name="lastname" value="' .$data["lastname"] .'" />
        </div>
        <span class="error">* ' .$data["lastnameErr"] .'</span>
        <div>
          <label for="telefoon">Telefoonnumer:</label>
          <input type="text" id="telefoon" name="telefoon" value="' .$data["telefoon"] .'" />
        </div>
        <span class="error">* ' .$data["telefoonErr"] .'</span>
        <div>
          <label for="email">Email:</label>
          <input type="text" id="email" name="email" value="' .$data["email"] .'" />
        </div>
        <span class="error">* ' .$data ["emailErr"] .'</span>
        <div>
          <p>Hoe kunnen wij u bereiken?</p>
          <input type="radio" name="communicationChannel" ';
           if (isset($communicationChannel) && $communicationChannel=="email"){echo "checked";} echo' value="email">
          <label for="email">Email</label><br/>
          <input type="radio" name="communicationChannel" ';
           if (isset($communicationChannel) && $communicationChannel=="telefoon"){echo "checked";} echo' value="telefoon">
          <label for="telefoon">Telefoon</label><br />
        </div>
       <br><br>
        <div>
          <textarea rows="4" cols="50" name="comment" placeholder="Waarom wilt u contact opnemen?"> '.$data["comment"] .'</textarea>
        </div>
        <span class="error">* '.$data["commentErr"] .'</span>
        <br />
        <input type="submit" value="Send" name="send"/>
        <input type="hidden" value="contact" name="page"/>
  
        <br />
      </form>';
    }

    function showThankyouPage($data)
    {
        echo '<div class="content">
        <p>Thank you for your message, ' . $data['firstname'] . '!</p>
        </div>';
    }


