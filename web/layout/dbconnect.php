<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "cryptogame";
$i = 0;

$conn = new mysqli($servername, $username, $password, $dbname);

if(!isset($_SESSION['nick']) || $_SESSION['nick'] === 'Guest') {
    htmlspecialchars($_SESSION['nick'] = 'Guest');
    $sql = "UPDATE compteur SET com_visite = com_visite+1";
    $conn->query($sql);
};
$nick = htmlspecialchars($_SESSION['nick']);
