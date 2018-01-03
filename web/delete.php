<?php
require('layout/dbconnect.php');
require('layout/top.php');
$callId = intval($_GET['callId']);
$callId = mysqli_real_escape_string($conn, $callId);

if(isset($_SESSION['nick']) || $_SESSION['nick'] !== 'Guest') {
    $nick = htmlspecialchars($_SESSION['nick']);
    $nick = mysqli_real_escape_string($conn, $nick);

    $result = mysqli_query($conn, "SELECT usr_name, usr_totalCallNumber FROM topCall
            JOIN cry_users on topCall.usr_id = cry_users.usr_id
            WHERE usr_name LIKE '$nick'");
    $row = $result->fetch_row();

    $number = $row[1];

    if ($row[0] === $nick) {
        mysqli_query($conn, "DELETE FROM topCall
            WHERE top_id = $callId");

        mysqli_query($conn, "UPDATE cry_users SET 
            usr_totalCallNumber = usr_totalCallNumber+1 WHERE usr_name = '$nick'");
        ?>
        <div class="container-fluid black-div underTopDiv">
            <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                <h1>Call supprimé !</h1>
            </div>
            <div>
                <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                <p>Si rien ne se passe, <a href="/index.php">vous pouvez cliquer ici.</a></p>
            </div>
        </div>
        <!-- Redirection automatique au bout de 3 secondes sur l'index -->
        <meta http-equiv="refresh" content="3; URL=/index.php">
        <?php
    } else {
        ?>
        <div class="container-fluid black-div underTopDiv">
            <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                <h1>Oups !</h1>
            </div>
            <div>
                <p class="mt-5">Comment êtes-vous arrivés ici ?!</p>
                <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                <p>Si rien ne se passe, <a href="/index.php">vous pouvez cliquer ici.</a></p>
            </div>
        </div>
        <!-- Redirection automatique au bout de 3 secondes sur l'index -->
        <meta http-equiv="refresh" content="3; URL=/index.php">
        <?php
    };
};

require('layout/bottom.php');
?>