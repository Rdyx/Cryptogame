<?php
require('layout/dbconnect.php');
require('layout/top.php');

$oldPwd = htmlspecialchars($_POST['oldPwd'], ENT_QUOTES);
$oldPwd = mysqli_real_escape_string($conn, $oldPwd);

$newPwd = htmlspecialchars($_POST['newPwd']);
$newPwd= mysqli_real_escape_string($conn, $newPwd);

$newPwd2 = htmlspecialchars($_POST['newPwd2']);
$newPwd2 = mysqli_real_escape_string($conn, $newPwd2);

$BTCAdress = htmlspecialchars($_POST['BTCAdress']);
$BTCAdress = mysqli_real_escape_string($conn, $BTCAdress);

$ETHAdress = htmlspecialchars($_POST['ETHAdress']);
$ETHAdress = mysqli_real_escape_string($conn, $ETHAdress);

$LTCAdress = htmlspecialchars($_POST['LTCAdress']);
$LTCAdress = mysqli_real_escape_string($conn, $LTCAdress);


function sqlAdress($conn, $arg1, $arg2, $arg3){
    return mysqli_query($conn,"UPDATE cry_users SET usr_$arg3 = '$arg1' WHERE usr_name LIKE '$arg2'");
};

function erreur($arg1, $arg2, $arg3){
    return '<div class="container-fluid black-div underTopDiv">
            <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                <h1>'.$arg2.'</h1>
            </div>
            <div>
                <p class="mt-5">'.$arg1.'</p>
                <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                <p>Si rien ne se passe, <a href="'.$arg3.'">vous pouvez cliquer ici.</a></p>
            </div>
        </div>
        <!-- Redirection automatique au bout de 3 secondes sur l\'index -->
        <meta http-equiv="refresh" content="3; URL='.$arg3.'">';
};

if($BTCAdress !== ''){
    $sql = sqlAdress($conn, $BTCAdress, $nick, 'BTCAdress');
};
if($ETHAdress !== ''){
    $sql = sqlAdress($conn, $ETHAdress, $nick, 'ETHAdress');
};
if($LTCAdress !== ''){
    $sql = sqlAdress($conn, $LTCAdress, $nick, 'LTCAdress');
};

$result = mysqli_query($conn, "SELECT usr_password FROM cry_users WHERE usr_name = '$nick'");
$row = $result->fetch_assoc();

if(isset($oldPwd) && $oldPwd !== ''){
    if(password_verify($oldPwd, $row['usr_password'])){
        if($newPwd === $newPwd2){
            $hashedNewPwd = password_hash($newPwd, PASSWORD_DEFAULT);
            $hashedNewPwd = mysqli_real_escape_string($conn, $hashedNewPwd);
            mysqli_query($conn,"UPDATE cry_users SET usr_password = '$hashedNewPwd' WHERE usr_name = '$nick'");
            echo erreur('Données mises à jour !', 'Ok !', '/index.php/');
        } else {
            echo erreur('Votre nouveau mot de passe n\'est pas identique dans les deux champs !', 'Oups !', '/web/editUser.php/');
        }
    } else {
        echo erreur('Votre ancien mot de passe n\'est pas bon !', 'Oups !', '/web/editUser.php/');
    }
} else {
    echo erreur('Données mises à jour !', 'Ok !', '/index.php/');
}

require('layout/bottom.php');
?>
