<?php
@session_start();

//unset($_SESSION['webrk']['user']);
 $_SESSION = array();

    if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
    }

session_destroy();

$url='login.php';

if (!empty($url)){
    header('location: '.$url);
    exit();
}

?>
