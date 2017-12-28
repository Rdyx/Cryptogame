<?php
require('layout/dbconnect.php');
require('layout/top.php');
$callId = htmlspecialchars($_GET['callId']);

if(isset($_SESSION['nick']) || $_SESSION['nick'] !== 'Guest') {
    $nick = htmlspecialchars($_SESSION['nick']);
    $sql = "SELECT usr_name FROM topCall
            JOIN cry_users on topCall.usr_id = cry_users.usr_id
            WHERE usr_name LIKE '$nick'";
    $result = $conn->query($sql);
    $row = $result->fetch_row();

    if ($row[0] === $nick) {
        $sql = "DELETE FROM topCall
            WHERE top_id = $callId";
        $result = $conn->query($sql);
        ?>
        <div class="container-fluid black-div underTopDiv">
            <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                <h1>Call supprimé !</h1>
            </div>
            <div>
                <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                <p>Si rien ne se passe, <a href="/web/index.php">vous pouvez cliquer ici.</a></p>
            </div>
        </div>
        <!-- Redirection automatique au bout de 3 secondes sur l'index -->
        <meta http-equiv="refresh" content="3; URL=/web/index.php">
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
                <p>Si rien ne se passe, <a href="/web/index.php">vous pouvez cliquer ici.</a></p>
            </div>
        </div>
        <!-- Redirection automatique au bout de 3 secondes sur l'index -->
        <meta http-equiv="refresh" content="3; URL=/web/index.php">
        <?php
    };
};