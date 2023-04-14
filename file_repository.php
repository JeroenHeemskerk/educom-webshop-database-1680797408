<?php
    function findUserByEmail($email){
        // 1. open user file
        $userFile = @fopen("users/users.txt", "r");
        // 1a.  is de file is niet gevonden
        if ($userFile == false) {
        //    T => throw Exception
           throw new Exception("user file not found");
        //    F => ga verder
        }
        // 2. lees een regel
        try{
         fgets($userFile);
        // 2a. is de file bij het einde?
        //     T => return false
        //     F => ga verder
        while(!feof($userFile)) {  
            // 3. lees een regel => $row
            $row = fgets($userFile);
            // 4. breek de regel in brokjes met explode()
            $parts = explode("|",$row,3);
            // 5. vergelijk eerste brokje met $email
            if($parts[0]==$email){
            //    T => return true;
               return ["email" =>$parts[0],"name"=>$parts[1],"password"=>$parts[2]];
            //    F => ga naar stap 2a
    
            }
        } 
        return null;
        }finally{
            // 6. close de file
            fclose($userFile);
            //    return false
        
        }
    } 

    function saveUser($email,$name,$password){
        $userFile = fopen("users/users.txt", "a");
        $txt =PHP_EOL."$email| $name| $password";
        fwrite($userFile,$txt);
        fclose($userFile);
    
    }





?>