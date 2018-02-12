<?php

$domain =  $_SERVER['SERVER_NAME'];
// 'www.example.com'
// echo $domain; 
// '/account'
$sub_domain =  '/LAYOUT';

$path_login_ok = 'login_cookies_ok.php';

/* These are our valid username and passwords */
$user = 'toto';
$pass = 'toto';



if (isset($_POST['username']) && isset($_POST['password'])) {
    
    if (($_POST['username'] == $user) && ($_POST['password'] == $pass)) {    
        
        if (isset($_POST['rememberme'])) {
            /* Set cookie to last 1 year */
            setcookie('username', $_POST['username'], time()+60*60*24*365, $sub_domain, $domain);
            setcookie('password', md5($_POST['password']), time()+60*60*24*365, $sub_domain, $domain);
        
        } else {
            /* Cookie expires when browser closes */
            setcookie('username', $_POST['username'], false, $sub_domain, $domain);
            setcookie('password', md5($_POST['password']), false, $sub_domain, $domain);
        }
        header('Location: '.$path_login_ok);
        
    } else {
            echo 'Username/Password Invalid';
            echo '<br><br>';
            echo '<button onclick="goBack()">Go Back</button>';

            echo '<script>';
            echo 'function goBack() {';
                echo 'window.history.back();';
            echo '}';
            echo '</script> ';
    }
    
} else {
    echo 'You must supply a username and password.';
}
?>