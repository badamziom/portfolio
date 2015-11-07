<?php

include('../init.php');

if($AdamCms->Auth->checkLoginStatus()){
    $AdamCms->Auth->logout();
    $AdamCms->Template->setAlert('Zostałeś wylogowany', 'success');
    $AdamCms->Template->redirect(SITE_PATH . "index.php");
} else {
    $AdamCms->Template->redirect(SITE_PATH . "index.php");
}

