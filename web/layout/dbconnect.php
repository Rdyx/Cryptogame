<?php
session_start();

$servername = "mysql-cryptogame.alwaysdata.net";
$username = "*";
$password = "*";
$dbname = "cryptogame_cryptogame";
$port = 3306;
$i = 0;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if(!isset($_SESSION['nick'])) {
    htmlspecialchars(mysqli_real_escape_string($conn, $_SESSION['nick'] = 'Guest'));
    mysqli_query($conn, "UPDATE compteur SET com_visites = com_visites+1");
};
$nick = htmlspecialchars($_SESSION['nick']);
$nick = mysqli_real_escape_string($conn, $nick);
