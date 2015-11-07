<?php

include('../init.php');

if ($AdamCms->Auth->checkLoginStatus()) {
    $AdamCms->Template->load(APP_PATH . 'cms/views/v_works.php');
    if (isset($_POST['insert'])) {
        if ((($_POST['content'] == '' || $_POST['address'] == '') || ($_FILES['image']['name'] == '' || $_FILES['image']['tmp_name'] == '')) || $_POST['imagename'] == '') {
            $AdamCms->Template->setAlert('Musisz wypelnic wszystkie pola', 'error');
            $AdamCms->Template->redirect(SITE_PATH . 'cms/works.php');
        } else {
            $AdamCms->Cms->insertWork($_POST['content'], $_POST['address'], $_FILES['image']['name'], $_FILES['image']['tmp_name'], $_POST['imagename']);
            $AdamCms->Template->setAlert('Praca została dodana', 'success');
            $AdamCms->Template->redirect(SITE_PATH . 'cms/works.php');
        }
    }
    if (isset($_POST['cancel'])) {
        $AdamCms->Template->redirect(SITE_PATH . 'cms/panel.php');
    }
} else {
    $AdamCms->Template->setAlert('Musisz się zalogować!', 'error');
    $AdamCms->Template->redirect(SITE_PATH . "cms/login.php");
}