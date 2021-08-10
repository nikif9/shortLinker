<?php
$link = $mysql->getOneQuery('SELECT * FROM `short` WHERE `shortLink` = ?', 's', [$url[2]]);
if (!is_null($link)) {
    header('Location: '. $link['link']);
}else{
    echo "такой ссылки не существует";
}