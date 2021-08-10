<?php 
include "class/mysql.php";
$url = explode('/', $_SERVER['REQUEST_URI']); 
$mysql = new mysql('root', 'password', 'short');
// setcookie('id', '', time()-31536000); 
// setcookie('hash', '', time()-31536000); 
// print_r($_COOKIE);
if (isset($url[2]) and $url[2] != '') {
    if ($url[2] == 'makeShortLink') {
        include "template/makeShortLink.php";
        exit();
    }else if ($url[2] == 'index') {
        include "template/main.php";
        exit();
    }else{
        include "template/redirect.php";
    }
}else{
    header('Location: /short/index');
}

