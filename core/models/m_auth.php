<?php

class Auth {
    private $AdamCms;
    
    function __construct(){
        global $AdamCms;
        $this->AdamCms =& $AdamCms;
    }
    function validateLogin($user, $pass){
        
        
        if($stmt = $this->AdamCms->Database->prepare("SELECT * FROM users WHERE username = ? AND password = ?")){
            $stmt->bind_param("ss", $user, $pass);
            $stmt->execute();
            $stmt->store_result();
            
            if($stmt->num_rows > 0){
                $stmt->close();
                return TRUE;
            } else {
                $stmt->close();
                return FALSE;
            }
        } else {
            die("Bład w wysłaniu zapytania do bazy");
        }
    }
    function checkLoginStatus(){
        if(isset($_SESSION['loggedin'])){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function logout(){
        session_destroy();
        session_start();
    }
    function checkAuthorization(){
        if($this->checkLoginStatus() == FALSE){
            $this->AdamCms->Template->error('unathorized');
            exit;
        }
    }
    
    function getCurrentUserName(){
        return $_SESSION['username'];
    }
}

