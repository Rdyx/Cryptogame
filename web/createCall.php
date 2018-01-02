<?php
require('layout/dbconnect.php');
require('layout/top.php');

for($i = 1; $i < 61; $i++){
    $callTimerNumber [] = $i;
}

$callTimerValue = ['Minute', 'Heure', 'Jour', 'Semaine', 'Mois', 'Année', 'Décennie', 'Siècle', 'Millénaire', 'OVER 9000'];

$result = mysqli_query($conn, "SELECT cry_id, cry_name, cry_fullName FROM cryptos ORDER BY cry_name ASC");

while($row = $result->fetch_array()){
    $resultat [] = $row['cry_id'];
};

if(!isset($nick) || $nick === 'Guest'){
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
} else {
    ?>
    <div class="container-fluid black-div underTopDiv">
        <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
            <h1>Créer un call</h1>
        </div>
        <div class="pb-0">
            <p class="red">Tout call créé sera considéré comme "perdant" si annulé ! <br>
                Vérifiez bien ce que vous entrez !<br>
                Les calls de moins de 15 minutes ne sont pas acceptés !</p>
        </div>
        <div class="mb-0 pb-0 row justify-content-around">
            <form class="col-sm-6" action="/web/createdCall.php" method="post">
                <table class="table text-center">
                    <tr>
                        <td class="align-middle">
                            <label class="col-form-label">Crypto</label>
                        </td>
                        <td class="align-middle">
                            <select name="crypto" class="custom-select">
                                <?php
                                foreach ($result as $row) {
                                    echo '<option value="' . $row['cry_id'] . '">' . $row['cry_name'] . ' - ' . $row['cry_fullName'] . '</option>';
                                };
                                ?>
                            </select>
                        </td>
                    </tr>
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
                            <label for="targetPrice" class="col-form-label">Target (BTC)</label>
                        </td>
                        <td class="align-middle">
                            <input autocomplete="off" step="0.000000001" class="text-center form-control" type="number"
                                   id="targetPrice" name="targetPrice" placeholder="Prix visé" required>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <label for="description" class="col-form-label">Commentaire</label>
                        </td>
                        <td class="align-middle">
                            <textarea class="text-center form-control" type="text" id="description" name="description"
                                      rows="5" placeholder="Infos supplémentaires sur le call (optionnel)"></textarea>
                        </td>
                    </tr>
                </table>
                <input id="submitEdit" class="btn btn-outline-success" type="submit" value="Envoyer">
            </form>
        </div>
    </div>

    <?php
}
require('layout/bottom.php');
?>
