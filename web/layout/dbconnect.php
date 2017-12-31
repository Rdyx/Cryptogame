<?php
session_start();

$servername = "mysql-cryptogame.alwaysdata.net";
$username = "150019";
$password = "topkek";
$dbname = "cryptogame_cryptogame";
$port = 3306;
$i = 0;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if(!isset($_SESSION['nick']) || $_SESSION['nick'] === 'Guest') {
    htmlspecialchars($_SESSION['nick'] = 'Guest');
    $sql = "UPDATE compteur SET com_visite = com_visite+1";
    $conn->query($sql);
};
$nick = htmlspecialchars($_SESSION['nick']);
