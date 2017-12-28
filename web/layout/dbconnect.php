<?php
session_start();
if(!isset($_SESSION['nick']) || $_SESSION['nick'] === 'Guest') {
    htmlspecialchars($_SESSION['nick'] = 'Guest');
    $test = $_SESSION['nick'];
};

$nick = htmlspecialchars($_SESSION['nick']);
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "cryptogame";
$i = 0;

$conn = new mysqli($servername, $username, $password, $dbname);