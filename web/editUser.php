<?php
require('layout/dbconnect.php');
require('layout/top.php');

$sql = "SELECT usr_BTCAdress, usr_ETHAdress, usr_LTCAdress FROM cry_users WHERE usr_name = '$nick'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

    <div class="container-fluid black-div underTopDiv">
        <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
            <h1>Edition de votre profil</h1>
        </div>
        <div class="pb-0">
            <p class="red">Pensez à vérifier vos adresses de wallets si vous en mettez !</p>
        </div>
        <div class="mb-0 pb-0 row justify-content-around">
            <form class="col-sm-6" action="/web/editedUser.php" method="post">
                <table class="table text-center">
                    <tr>
                        <td class="align-middle">
                            <label for="oldPwd" class="col-form-label">Ancien mot de passe</label>
                        </td>
                        <td class="align-middle">
                            <input class="text-center form-control" type="password" id="oldPwd" name="oldPwd" placeholder="Ancien mot de passe">
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <label for="newPwd" class="col-form-label">Nouveau mot de passe</label>
                        </td>
                        <td class="align-middle">
                            <input class="text-center form-control" type="password" id="newPwd" name="newPwd" placeholder="Nouveau mot de passe">
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <label for="newPwd2" class="col-form-label">Confirmation du <br> nouveau mot de passe</label>
                        </td>
                        <td class="align-middle">
                            <input class="text-center form-control" type="password" id="newPwd2" name="newPwd2" placeholder="Retapez votre nouveau mot de passe">
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <label for="BTCAdress" class="col-form-label">Adresse BTC</label>
                        </td>
                        <td class="align-middle">
                            <input class="text-center form-control" type="text" id="BTCAdress" name="BTCAdress" placeholder="Adresse BTC (optionnel)"
                                <?php
                                if(isset($row['usr_BTCAdress'])){
                                    echo 'value="'.$row['usr_BTCAdress'].'"';
                                };
                                ?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <label for="ETHAdress" class="col-form-label">Adresse ETH</label>
                        </td>
                        <td class="align-middle">
                            <input class="text-center form-control" type="text" id="ETHAdress" name="ETHAdress" placeholder="Adresse ETH (optionnel)"
                                <?php
                                if(isset($row['usr_ETHAdress'])){
                                echo 'value="'.$row['usr_ETHAdress'].'"';
                                };
                                ?>>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle">
                            <label for="LTCAdress" class="col-form-label">Adresse LTC</label>
                        </td>
                        <td class="align-middle">
                            <input class="text-center form-control" type="text" id="LTCAdress" name="LTCAdress" placeholder="Adresse LTC (optionnel)"
                                <?php
                                if(isset($row['usr_LTCAdress'])){
                                    echo 'value="'.$row['usr_BTCAdress'].'"';
                                };
                                ?>>
                        </td>
                    </tr>
                </table>
                <input id="submitEdit" class="btn btn-outline-success" type="submit" value="Envoyer">
            </form>
        </div>
    </div>

<?php
require('layout/bottom.php');
?>