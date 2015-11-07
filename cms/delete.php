<?php
include('../init.php');

if($AdamCms->Auth->checkLoginStatus()){
    if(isset($_POST['cancel'])){
        $AdamCms->Template->redirect(SITE_PATH . 'cms/panel.php');
    }
    if(isset($_POST['delete'])){
        $AdamCms->Cms->deleteInformation($_POST['id']);
        $AdamCms->Template->setAlert('Wpis został usunięty', 'success');
        $AdamCms->Template->redirect(SITE_PATH . 'cms/panel.php');
    }else {
if(isset($_GET['id'])){
    
    if(is_numeric($_GET['id'])){
    
    if($_GET['id'] == ''){
        $AdamCms->Template->setAlert('Nie ma wybranego rekordu','error');
        $AdamCms->Template->redirect(SITE_PATH . "cms/panel.php");
    }  else {
        $AdamCms->Template->load(APP_PATH . "cms/views/v_delete.php");
    }
    
    } else {
    $AdamCms->Template->setAlert('Zły format identyfikatora','error');
    $AdamCms->Template->redirect(SITE_PATH . "cms/panel.php");
}
} else {
    $AdamCms->Template->redirect(SITE_PATH . "cms/panel.php");
}
    }
    
} else {
    $AdamCms->Template->setAlert('Musisz się zalogować!', 'error');
    $AdamCms->Template->redirect(SITE_PATH . "cms/login.php");
}