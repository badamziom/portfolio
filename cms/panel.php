<?php
include('../init.php');
if($AdamCms->Auth->checkLoginStatus()){
    $AdamCms->Template->load('views/v_panel.php');
if(isset($_POST['insert'])){
    if($_POST['content'] == '' || $_POST['type'] == ''){
        $AdamCms->Template->setAlert('Musisz wypelnic wszystkie pola', 'error');
        $AdamCms->Template->redirect(SITE_PATH . 'cms/panel.php');  
    } else {
        $AdamCms->Cms->insertInformation($_POST['content'], $_POST['type']);
        $AdamCms->Template->setAlert('Informacja dodana', 'success');
        $AdamCms->Template->redirect(SITE_PATH . 'cms/panel.php');
    } 
    
}
} else {
    $AdamCms->Template->setAlert('Musisz się zalogować!', 'error');
    $AdamCms->Template->redirect(SITE_PATH . "cms/login.php");
}
