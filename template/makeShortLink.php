<?php
if (isset($_POST['link'])) {
    $link = $mysql->getOneQuery('SELECT * FROM `short` WHERE `link` = ?', 's', [$_POST['link']]);
    if (is_null($link)) {
        $short = generateRandomString();
        $mysql->executeQuery('INSERT INTO `short`(`link`, `shortLink`) VALUES (?, ?)', 'ss', [$_POST['link'], $short]);
        echo json_encode(['result'=> 'ok', 'short'=> $short]);
    }else{
        echo json_encode(['result'=> 'ok', 'short'=> $link['shortLink']]);
    }

}else{
    echo json_encode(['result'=> 'error', 'error'=> 'link no found']);
}
function generateRandomString($length = 5) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}