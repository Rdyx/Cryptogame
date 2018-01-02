<?php
session_start();

$servername = "*";
$username = "*";
$password = "*";
$dbname = "cryptogame_cryptogame";
$port = 3306;
$i = 0;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if(!isset($_SESSION['nick'])) {
    htmlspecialchars($_SESSION['nick'] = 'Guest');
    $sql = "UPDATE compteur SET com_visites = com_visites+1";
    $conn->query($sql);
};
$nick = htmlspecialchars($_SESSION['nick']);
