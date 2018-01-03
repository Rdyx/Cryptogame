<?php
require('layout/dbconnect.php');
require('layout/top.php');

if(!isset($_SESSION['nick']) || $_SESSION['nick'] === 'Guest') {
    if (!empty($_POST['newPwd']) && !empty($_POST['newPwd2'])) {
        $nick = htmlspecialchars($_POST['nick']);
        $nick = mysqli_real_escape_string($conn, $nick);

        $newPwd = htmlspecialchars($_POST['newPwd'], ENT_QUOTES);
        $newPwd = mysqli_real_escape_string($conn, $newPwd);

        $newPwd2 = htmlspecialchars(($_POST['newPwd2']), ENT_QUOTES);
        $newPwd2 = mysqli_real_escape_string($conn, $newPwd2);

        if ($newPwd === $newPwd2) {
            $hashedNewPwd = password_hash($newPwd, PASSWORD_DEFAULT);
            $hashedNewPwd = mysqli_real_escape_string($conn, $hashedNewPwd);
            mysqli_query($conn, "UPDATE cry_users SET usr_password = '$hashedNewPwd' WHERE usr_name = '$nick'");
            ?>
            <div class="container-fluid black-div underTopDiv">
                <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                    <h1>Mot de passe changé !</h1>
                </div>
                <div>
                    <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                    <p>Si rien ne se passe, <a href="/web/connect.php">vous pouvez cliquer ici.</a></p>
                </div>
            </div>
            <!--         Redirection automatique au bout de 3 secondes sur l'index-->
            <meta http-equiv="refresh" content="3; URL=/web/connect.php">
            <?php
        } else {
            ?>
            <div class="container-fluid black-div underTopDiv">
                <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                    <h1>Oups !</h1>
                </div>
                <div>
                    <p class="mt-5">Les mots de passe ne sont pas identiques !</p>
                    <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                    <p>Si rien ne se passe, <a href="/web/forgotPassword.php">vous pouvez cliquer ici.</a></p>
                </div>
            </div>
            <!-- Redirection automatique au bout de 3 secondes sur l'index -->
            <meta http-equiv="refresh" content="3; URL=/web/forgotPassword.php">
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
                <p>Si rien ne se passe, <a href="/web/forgotPassword.php">vous pouvez cliquer ici.</a></p>
            </div>
        </div>
        <!-- Redirection automatique au bout de 3 secondes sur l'index -->
        <meta http-equiv="refresh" content="3; URL=/web/forgotPassword.php">
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
            <p>Si rien ne se passe, <a href="/web/forgotPassword.php">vous pouvez cliquer ici.</a></p>
        </div>
    </div>
    <!-- Redirection automatique au bout de 3 secondes sur l'index -->
    <meta http-equiv="refresh" content="3; URL=/web/forgotPassword.php">
    <?php
}
require('layout/bottom.php');
?>