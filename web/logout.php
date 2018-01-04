<?php
require('layout/dbconnect.php');
require('layout/top.php');
$_SESSION = array();
session_destroy();
$_SESSION['afk'] = 1;
?>
    <div class="container-fluid black-div underTopDiv">
        <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
            <h1>Déconnecté !</h1>
        </div>
        <div>
            <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
            <p>Si rien ne se passe, <a href="/index.php">vous pouvez cliquer ici.</a></p>
        </div>
    </div>
    <!-- Redirection automatique au bout de 3 secondes sur l\'index -->
<!--    <meta http-equiv="refresh" content="3; URL=/index.php">-->
<?php
require('layout/bottom.php');
?>