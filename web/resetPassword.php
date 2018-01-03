<?php
require('layout/dbconnect.php');
require('layout/top.php');

if(!isset($_SESSION['nick']) || $_SESSION['nick'] === 'Guest') {
    if (!empty($_POST['nick']) && !empty($_POST['pinCode'])) {
        $nickPost = htmlspecialchars($_POST['nick'], ENT_QUOTES);
        $nickPost = mysqli_real_escape_string($conn, $nickPost);

        $pinCode = htmlspecialchars($_POST['pinCode']);
        $pinCode = mysqli_real_escape_string($conn, $pinCode);

        $result = mysqli_query($conn, "SELECT usr_name, usr_pinCode FROM cry_users WHERE usr_name LIKE '$nickPost'");
        $row = $result->fetch_assoc();
        if ($row['usr_name'] === $nickPost && password_verify($pinCode, $row['usr_pinCode'])) {
            ?>
            <div class="container-fluid black-div underTopDiv">
                <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                    <h1>Mot de passe oublié</h1>
                </div>
                <div class="row justify-content-around mt-5">
                    <div class="col-sm-3">
                        <form action="/web/resetedPassword.php" method="post">
                            <label for="nick">Confirmer le pseudo</label>
                            <input class="form-control" type="text" name="nick" id="nick" required>
                            <label class="mt-2" for="newPwd">Nouveau mot de passe</label>
                            <input class="form-control" type="password" name="newPwd" id="newPwd" required>
                            <label class="mt-2" for="newPwd2">Confirmation du <br> nouveau mot de passe</label>
                            <input class="form-control" type="password" name="newPwd2" id="newPwd2" required>
                            <button class="btn btn-outline-success mt-3" type="submit">Se connecter</button>
                        </form>
                    </div>
                </div>
            </div>
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
    }
}
require('layout/bottom.php');
?>