<?php
require('layout/dbconnect.php');
require('layout/top.php');

if(!isset($_SESSION['nick']) || $_SESSION['nick'] === 'Guest') {
    $nickPost = htmlspecialchars($_POST['nick'], ENT_QUOTES);
    $nickPost = mysqli_real_escape_string($conn, $nickPost);

    $pwdPost = htmlspecialchars($_POST['pwd'], ENT_QUOTES);
    $pwdPost = mysqli_real_escape_string($conn, $pwdPost);

    $result = mysqli_query($conn, "SELECT usr_name, usr_password FROM cry_users WHERE usr_name LIKE '$nickPost'");
    $row = $result->fetch_row();

    $nick = htmlspecialchars($row[0], ENT_QUOTES);
    $nick = mysqli_real_escape_string($conn, $nick);

    $pwd = htmlspecialchars($row[1], ENT_QUOTES);
    $pwd = mysqli_real_escape_string($conn, $pwd);

//Comparaison des inputs et des logs dans la DB
//Pwd vérifié via password_verify (méthode BCRYPT)
    if (strtoupper($nickPost) === strtoupper($nick) && password_verify($pwdPost, $pwd)) {
        ?>
        <div class="container-fluid black-div underTopDiv">
            <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                <h1>Bienvenue <?= $nick ?> !</h1>
            </div>
            <div>
                <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                <p>Si rien ne se passe, <a href="/index.php">vous pouvez cliquer ici.</a></p>
            </div>
        </div>
        <!-- Redirection automatique au bout de 3 secondes sur l'index -->
        <meta http-equiv="refresh" content="3; URL=/index.php">
        <?php $_SESSION['nick'] = $nick;
    } else {
        ?>
        <div class="container-fluid black-div underTopDiv">
            <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                <h1>Erreur !</h1>
            </div>
            <div>
                <h3 class="mt-5">Mauvais identifiant/mot de passe !</h3>
                <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                <p>Si rien ne se passe, <a href="/web/connect.php">vous pouvez cliquer ici.</a></p>
            </div>
        </div>
        <!-- Redirection automatique au bout de 3 secondes sur la page de connexion -->
        <meta http-equiv="refresh" content="3; URL=/web/connect.php">
        <?php
    }
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

require('layout/bottom.php');
?>
