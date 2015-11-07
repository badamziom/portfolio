<?php
include('init.php');

if(isset($_POST['submit'])){
    $AdamCms->Template->setData('title', $_POST['tytul']);
    $AdamCms->Template->setData('email', $_POST['email']);
    $AdamCms->Template->setData('text', $_POST['text']);
    
    if($_POST['tytul'] == '' || $_POST['email'] == '' || $_POST['text'] == ''){
        $AdamCms->Template->setAlert('Uzupełnij wymagane pola', 'error');
        $AdamCms->Template->load('core/views/v_contact.php');
    } else {
        $AdamCms->Template->sendMail($AdamCms->Template->getData('title'), $AdamCms->Template->getData('email'), $AdamCms->Template->getData('text'));
        $AdamCms->Template->redirect('kontakt.php');
    }
} else {
    $AdamCms->Template->load('core/views/v_contact.php');
}