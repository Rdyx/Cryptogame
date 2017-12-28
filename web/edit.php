<?php
require('layout/dbconnect.php');
require('layout/top.php');
for($i = 1; $i < 61; $i++){
    $callTimerNumber [] = $i;
}

$callId = htmlspecialchars($_GET['callId']);
$sql = "SELECT * FROM topCall
        JOIN cry_users ON topCall.usr_id = cry_users.usr_id
        WHERE usr_name = '$nick' AND top_id = $callId";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

var_dump($row['usr_name'] . $callId);

if($row['usr_name'] === $nick) {
    $callTimerValue = ['Minute', 'Heure', 'Semaine', 'Mois', 'Année', 'Décennie', 'Siècle', 'Millénaire', 'OVER 9000'];
    ?>
    <div class="container-fluid black-div underTopDiv">
        <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
            <h1>Modifier un call</h1>
        </div>
        <div class="pb-0">
            <p class="red">Tout call modifié sera considéré comme "perdant" si annulé !<br>
                Vérifiez bien ce que vous entrez !<br>
                Les calls de moins de 15 minutes ne sont pas acceptés !
                La fin du call est calculée à partir du moment de l'édition !</p>
        </div>
        <div class="mb-0 pb-0 row justify-content-around">
            <form class="col-sm-6" action="/web/editedCall.php/?callId=<?= $callId ?>" method="post">
                <table class="table text-center">
                    <tr>
                        <td class="align-middle">
                            <label class="col-form-label">Durée du call</label>
                        </td>
                        <td>
                            <select name="timerNumber" class="custom-select">
                                <?php
                                $i = 0;
                                foreach ($callTimerNumber as $row) {
                                    echo '<option value="' . $row . '">' . $row . '</option>';
                                };
                                ?>
                            </select>
                            <select name="timerValue" class="custom-select">
                                <?php
                                $i = 0;
                                foreach ($callTimerValue as $row) {
                                    echo '<option value="' . $row . '">' . $row . '</option>';
                                };
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <label for="targetPrice" class="col-form-label">Target</label>
                        </td>
                        <td class="align-middle">
                            <input autocomplete="off" step="0.000000001" class="text-center form-control" type="number"
                                   id="targetPrice" name="targetPrice" placeholder="Prix visé" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <label for="description" class="col-form-label">Target</label>
                        </td>
                        <td class="align-middle">
                            <textarea class="text-center form-control" type="text" id="description" name="description"
                                      rows="5" placeholder="Infos supplémentaires sur le call (Laissez vide pour garder l'ancien commentaire)"></textarea>
                        </td>
                    </tr>
                </table>
                <input id="submitEdit" class="btn btn-outline-success" type="submit" value="Envoyer">
            </form>
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
            <p>Si rien ne se passe, <a href="/web/index.php">vous pouvez cliquer ici.</a></p>
        </div>
    </div>
    <!-- Redirection automatique au bout de 3 secondes sur l'index -->
    <meta http-equiv="refresh" content="3; URL=/web/index.php">
    <?php
}
require('layout/bottom.html');
?>