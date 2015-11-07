<?php
include('../init.php');

if($AdamCms->Auth->checkLoginStatus()==FALSE){
if(isset($_POST['username'])){
    
    $AdamCms->Template->setData('input_user', $_POST['username']);
    $AdamCms->Template->setData('input_pass', $_POST['password']);
    
    if($_POST['username'] == '' || $_POST['password'] == ''){
        $AdamCms->Template->setAlert('Uzupełnij wymagane pola','error');
        $AdamCms->Template->load(APP_PATH . "cms/views/v_login.php");
    } else if ($AdamCms->Auth->validateLogin($AdamCms->Template->getData('input_user'), $AdamCms->Template->getData('input_pass')) == FALSE){
        $AdamCms->Template->setAlert('Nieprawidłowy login lub hasło','error');
        $AdamCms->Template->load(APP_PATH . "cms/views/v_login.php");
    } else {
        $_SESSION['username'] = $AdamCms->Template->getData('input_user');
        $_SESSION['loggedin'] = TRUE;
       
        $AdamCms->Template->redirect(SITE_PATH . "cms/panel.php");
    }
    
} else {
    $AdamCms->Template->load(APP_PATH . "cms/views/v_login.php");
}
} else {
    $AdamCms->Template->redirect(SITE_PATH . "cms/panel.php");
}
