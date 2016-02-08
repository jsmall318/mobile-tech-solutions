<?php

    /*** begin our session ***/
    session_start();

    /*** set a form token ***/
    $form_token = md5(rand(time(), true));

    /*** set the session form token ***/
    $_SESSION['form_token'] = $form_token;

    /*** set the form action ***/
    $form_action = 'adduser_submit.php';

    /*** set the form submit button value ***/
    $submit_value = 'Add User';

    /*** include the header.php file ***/
    include 'includes/header.php';

    /*** include the user form ***/
    include 'user_form.php'; 

?>
