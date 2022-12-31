<?php


require_once "conn.php";
require_once "session.php";


function Redirect_to($location){
    header("Location:".$location);
    exit;
}


function CheckEmailExist($Email){

    global $conn;
    $sql = "SELECT * FROM user WHERE email=:emaiL";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['emaiL' => $Email]);
    $Result = $stmt->rowcount();
    
    if($Result==1){
      return true;
    }else{
        return false;
    }
}

function Confirm_Login(){
    if(isset($_SESSION['UserId'])){
        return true;
    }else{
        $_SESSION['ErrorMessage'] = "Login required";
        Redirect_to("login.php");
    }
}