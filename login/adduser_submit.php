<?php
error_reporting(E_ALL);

/*** begin session ***/
session_start();

/*** include the header file ***/
include 'includes/header.php'; 

/*** an array to hold errors ***/
$errors = array();

/*** check the form has been posted and the session variable is set ***/
if(!isset($_SESSION['form_token']))
{
    $errors[] = 'Invalid Form Token';
}
/*** check all fields have been posted ***/
elseif(!isset($_POST['form_token'], $_POST['user_name'], $_POST['user_password'], $_POST['user_password2'], $_POST['user_email']))
{
    $errors[] = 'All fields must be completed';
}
/*** check the form token is valid ***/
elseif($_SESSION['form_token'] != $_POST['form_token'])
{
    $errors[] = 'You may only post once';
}
/*** check the length of the user name ***/
elseif(strlen($_POST['user_name']) < 2 || strlen($_POST['user_name']) > 25)
{
    $errors[] = 'Invalid User Name';
}
/*** check the length of the password ***/
elseif(strlen($_POST['user_password']) < 8 || strlen($_POST['user_password']) > 25)
{
    $errors[] = 'Invalid Password';
}
/*** check the length of the users email ***/
elseif(strlen($_POST['user_email']) < 4 || strlen($_POST['user_email']) > 254)
{
    $errors[] = 'Invalid Email';
}
/*** check for email valid email address ***/
elseif(!preg_match("/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU", $_POST['user_email']))
{
    $errors[] = 'Email Invalid';
}
else
{
	/*** if we are here, include the db connection ***/
	include 'includes/conn.php';
	
	/*** test for db connection ***/
	$con = mysqli_connect($hostname, $username, $password, $db);
	
    /*** escape all vars for database use ***/
    $user_name = mysqli_real_escape_string($con, $_POST['user_name']);
    
    /*** encrypt the password ***/
//     $td = mcrypt_module_open('tripledes', '', 'ecb', '');
//     $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
//     mcrypt_generic_init($td, $key, $iv);
//     $user_password = mcrypt_generic($td, $_POST['user_password']);
//     mcrypt_generic_deinit($td);
//     mcrypt_module_close($td);
    
    $user_password = mysqli_real_escape_string($con, $_POST['user_password']);
    
    /*** strip injection chars from email ***/
    $user_email =  preg_replace( '((?:\n|\r|\t|%0A|%0D|%08|%09)+)i' , '', $_POST['user_email'] );
    $user_email = mysqli_real_escape_string($con, $user_email);
    
        /*** check for existing username and email ***/
        $sql = "SELECT
		            user_name,
		            user_email
	            FROM
	            	users
	            WHERE
	            	user_name = '{$user_name}' OR user_email = '{$user_email}'";
       	$result = mysqli_query($con, $sql);
        $row = mysqli_fetch_row($result);
        if($row[0] == $user_name)
        {
            $errors[] = 'User name is already in use';
        }
        elseif($row[1] == $user_email)
        {
            $errors[] = 'Email address already subscribed';
        }
        else
        {

            /*** create a verification code ***/
            $verification_code = uniqid();

            /*** the sql query ***/
            $sql = "INSERT
                INTO users(
                	user_name,
                	user_password,
                	user_email,
                	user_access_level,
                	user_verification_code)
                VALUES (
	                '{$user_name}',
	                '{$user_password}',
	                '{$user_email}',
	                1,
	                '{$verification_code}')";

            /*** run the query ***/
            if(mysqli_query($con, $sql))
            {
                /*** unset the session token ***/
                unset($_SESSION['form_token']);

                /*** email subject ***/
                $subject = 'Verification code';

                /*** email from ***/
                $from = 'jsmall318@gmail.com';

                /*** the message ***/
                $path = dirname($_SERVER['REQUEST_URI']);
                $message = "Click the link below to verify your subscription\n\n";
                $message .= 'http://'.$_SERVER['HTTP_HOST'].$path.'/verify.php?vc='.$verification_code;

                /*** set some headers ***/
                $headers = 'From: jsmall318@gmail.com' . "\r\n" .
                'Reply-To: jsmall318@gmail.com';

                /*** send the email ***/
                if(!mail($user_email, $subject, $message, $headers))
                {
                    $errors = 'Unable to send verification';
                }

                /*** unset the form token ***/
                unset($_SESSION['form_token']);
            }
            else
            {
                $errors[] = 'User Not Added';
            }
        }
   
}

/*** check if there are any errors in the errors array ***/
if(sizeof($errors) > 0)
{
    foreach($errors as $err)
    {
        echo $err,'<br />';
    }
}
else
{
    echo 'Sign up complete<br />';
    echo 'A verification email has been sent to '.$user_email;
}

?>