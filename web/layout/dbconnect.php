<?php
session_start();

$now = time();
if (isset($_SESSION['destroyAfter']) && $now > $_SESSION['destroyAfter']) {
    session_unset();
    session_destroy();
    session_start();
}

$_SESSION['destroyAfter'] = $now + 1200;

$servername = "mysql-cryptogame.alwaysdata.net";
$username = "*";
$password = "*";
$dbname = "cryptogame_cryptogame";
$port = 3306;
$i = 0;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if(!isset($_SESSION['nick'])) {
    $_SESSION['afk'] = 1;
    htmlspecialchars(mysqli_real_escape_string($conn, $_SESSION['nick'] = 'Guest'));
    mysqli_query($conn, "UPDATE compteur SET com_visites = com_visites+1");
};
$nick = htmlspecialchars($_SESSION['nick']);
$nick = mysqli_real_escape_string($conn, $nick);