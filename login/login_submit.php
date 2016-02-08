<?php

    /*** begin output buffering ***/
    ob_start();

    /*** begin session ***/
    session_start();
    
    /*** check the form has been posted and the session variable is set ***/
    if(!isset($_SESSION['form_token']))
    {
        $location = 'login.php?error=No Session';
    }
    /*** check all fields have been posted ***/
    elseif(!isset($_POST['form_token'], $_POST['user_name'], $_POST['user_password']))
    {
      $location = 'login.php?error=Need to Fill in User Name and Password';
    }
    /*** check the form token is valid ***/
    elseif($_SESSION['form_token'] != $_POST['form_token'])
    {
        $location = 'login.php?error=Form Not Valid';
    }
    /*** check the length of the user name ***/
    elseif(strlen($_POST['user_name']) < 2 || strlen($_POST['user_name']) > 25)
    {
        $location = 'login.php?error=User Name Must Be Between 2 and 25 Characters';
    }
    /*** check the length of the password ***/
    elseif(strlen($_POST['user_password']) < 8 || strlen($_POST['user_password']) > 25)
    {
        $location = 'login.php?error=Password Must Be Between 8 and 25 Characters';
    }
    else
    {
    	/*** if we are here, include the db connection ***/
        include 'includes/conn.php';
        
        /*** escape all vars for database use ***/
        $blog_user_name = mysqli_real_escape_string($link, $_POST['user_name']);

        /*** encrypt the password ***/
        
//         $td = mcrypt_module_open('tripledes', '', 'ecb', '');
//         $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
//         mcrypt_generic_init($td, $key, $iv);
//         $blog_user_password = mcrypt_generic($td, $_POST['user_password']);
//         mcrypt_generic_deinit($td);
//         mcrypt_module_close($td);
        
        $blog_user_password = mysqli_real_escape_string($link, $user_password);

        /*** connect to the database ***/
		$con = mysqli_connect($hostname, $username, $password, $db);
		
            /*** check for existing username and password ***/
            $sql = "SELECT
            user_name,
            user_password,
            user_access_level,
            user_id
            FROM
            db1.users
            WHERE
            user_name = '{$user_name}'
            AND
            user_password = '{$user_password}'";
            
            $result = mysqli_query($con, $sql);
            if($result->num_rows != 1)
            {
                $location = 'login.php?error=User Name or Password Incorrect';
            }
            else
            {
                /*** fetch result row ***/
                $row = mysqli_fetch_row($result);

                /*** set the access level ***/
                $_SESSION['access_level'] = $row[2];
                
                /*** set the access level ***/
                $_SESSION['blog_user_id'] = $row[3];

                /*** unset the form token ***/
                unset($_SESSION['form_token']);

                /*** send user to index page ***/
                $location = 'index.php';
            }
        
    }

    /*** redirect ***/
    header("Location: $location");

    /*** flush the buffer ***/
    ob_end_flush();

?>