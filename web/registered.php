<?php
require('layout/dbconnect.php');
require('layout/top.php');

if(!isset($_SESSION['nick']) || $_SESSION['nick'] === 'Guest') {
    $nickPost = htmlspecialchars($_POST['nick'], ENT_QUOTES);
    $nickPost = mysqli_real_escape_string($conn, $nickPost);

    $pwdPost = htmlspecialchars(password_hash($_POST['pwd'], PASSWORD_DEFAULT), ENT_QUOTES);
    $pwdPost = mysqli_real_escape_string($conn, $pwdPost);

    $pinCode = htmlspecialchars(password_hash($_POST['pinCode'], PASSWORD_DEFAULT));
    $pinCode = mysqli_real_escape_string($conn, $pinCode);

    $result = mysqli_query($conn, "SELECT usr_name FROM cry_users WHERE usr_name LIKE '$nickPost'");
    $row = $result->fetch_assoc();

    if ($row['usr_name'] === null) {
        $result = mysqli_query($conn, "INSERT INTO cry_users (usr_name, usr_password, usr_totalCallNumber, usr_SuccessCall, usr_pinCode)
                VALUES ('$nickPost', '$pwdPost', 0, 0, '$pinCode')");
        ?>
        <div class="container-fluid black-div underTopDiv">
            <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                <h1>Bienvenue <?= $nickPost ?> !</h1>
            </div>
            <div>
                <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                <p>Si rien ne se passe, <a href="/index.php">vous pouvez cliquer ici.</a></p>
            </div>
        </div>
<!--         Redirection automatique au bout de 3 secondes sur l'index-->
                <meta http-equiv="refresh" content="3; URL=/index.php">
        <?php $_SESSION['nick'] = $nickPost;
    } else {
        ?>
        <div class="container-fluid black-div underTopDiv">
            <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                <h1>Oups !</h1>
            </div>
            <div>
                <p class="mt-5">Ce pseudo est déjà pris ! Désolé !</p>
                <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                <p>Si rien ne se passe, <a href="/web/register.php">vous pouvez cliquer ici.</a></p>
            </div>
        </div>
        <!-- Redirection automatique au bout de 3 secondes sur l'index -->
        <meta http-equiv="refresh" content="3; URL=/web/register.php">
        <?php
    };
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
}

require('layout/bottom.php');
?>