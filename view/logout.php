<?php

        /*** begin output buffering ***/
        ob_start();

        /*** begin session ***/
        session_start();

        /*** check the form has been posted and the session variable is set ***/
        if(isset($_SESSION['access_level']))
        {
                unset($_SESSION['access_level']);
        }

        /*** redirect ***/
        header("Location: index.php");

        /*** flush the buffer ***/
        ob_end_flush();
?>