<?php
require('layout/dbconnect.php');
require('layout/top.php');

$oldPwd = htmlspecialchars($_POST['oldPwd']);
$newPwd = htmlspecialchars($_POST['newPwd']);
$newPwd2 = htmlspecialchars($_POST['newPwd2']);
$BTCAdress = htmlspecialchars($_POST['BTCAdress']);
$ETHAdress = htmlspecialchars($_POST['ETHAdress']);
$LTCAdress = htmlspecialchars($_POST['LTCAdress']);

function sqlAdress($arg1, $arg2, $arg3){
    return "UPDATE cry_users SET usr_$arg3 = '$arg1' WHERE usr_name LIKE '$arg2'";
};

if($BTCAdress !== ''){
    var_dump($BTCAdress);
    $sql = sqlAdress($BTCAdress, $nick, 'BTCAdress');
    var_dump($conn->query($sql));
    $conn->query($sql);
};
if($ETHAdress !== ''){
    var_dump($ETHAdress);
    $sql = sqlAdress($ETHAdress, $nick, 'ETHAdress');
    var_dump($conn->query($sql));
    $conn->query($sql);
};
if($LTCAdress !== ''){
    var_dump($LTCAdress);
    $sql = sqlAdress($LTCAdress, $nick, 'LTCAdress');
    var_dump($conn->query($sql));
    $conn->query($sql);
};


?>

<div class="container-fluid black-div underTopDiv">
    <div class="container-fluid mb-3 mt-2 pb-1 knowMore">