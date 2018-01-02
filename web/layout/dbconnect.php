<?php
session_start();

$servername = "*";
$username = "*";
$password = "*";
$dbname = "*";
$port = '*';
$i = 0;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if(!isset($_SESSION['nick']) || $_SESSION['nick'] === 'Guest') {
    htmlspecialchars($_SESSION['nick'] = 'Guest');
    $sql = "UPDATE compteur SET com_visites = com_visites+1";
    $conn->query($sql);
};
$nick = htmlspecialchars($_SESSION['nick']);
