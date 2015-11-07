<?php

include('../init.php');

if ($AdamCms->Auth->checkLoginStatus()) {
    if (isset($_POST['cancel'])) {
        $AdamCms->Template->redirect(SITE_PATH . 'cms/works.php');
    }
    if (isset($_POST['save'])) {
        if (($_POST['content'] == '' || $_POST['address'] == '') || $_POST['imagename'] == '') {
            $AdamCms->Template->setAlert('Musisz wypelnic wszystkie pola', 'error');
            $AdamCms->Template->redirect(SITE_PATH . 'cms/works.php');
        } else {
            $AdamCms->Cms->updateWork($_POST['id'], $_POST['content'], $_POST['address'], $_FILES['image']['name'], $_FILES['image']['tmp_name'], $_POST['lastimage'], $_POST['imagename']);
            $AdamCms->Template->setAlert('Wpis został zmieniony ', 'success');
            $AdamCms->Template->redirect(SITE_PATH . 'cms/works.php');
        }
    } else {
        if (isset($_GET['id'])) {

            if (is_numeric($_GET['id'])) {

                if ($_GET['id'] == '') {
                    $AdamCms->Template->setAlert('Nie ma wybranego rekordu', 'error');
                    $AdamCms->Template->redirect(SITE_PATH . "cms/works.php");
                } else {
                    $AdamCms->Template->load(APP_PATH . "cms/views/v_workedit.php");
                }
            } else {
                $AdamCms->Template->setAlert('Zły format identyfikatora', 'error');
                $AdamCms->Template->redirect(SITE_PATH . "cms/works.php");
            }
        } else {
            $AdamCms->Template->redirect(SITE_PATH . "cms/works.php");
        }
    }
} else {
    $AdamCms->Template->setAlert('Musisz się zalogować!', 'error');
    $AdamCms->Template->redirect(SITE_PATH . "cms/login.php");
}