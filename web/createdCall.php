<?php
require('layout/dbconnect.php');
require('layout/top.php');

date_default_timezone_set('Europe/Paris');
setlocale(LC_ALL, 'fr_FR');
$date = strftime("%H:%M %e %B %Y");
$nick = $_SESSION['nick'];
$sql = "SELECT usr_id FROM cry_users WHERE usr_name = '$nick'";
$result = $conn->query($sql);
$userId = $result->fetch_assoc();

$crypto = htmlspecialchars($_POST['crypto']);
$sql = "SELECT cry_btcValue FROM cryptos WHERE cry_id = '$crypto'";
$result = $conn->query($sql);
$cryId = $result->fetch_assoc();

$usrId = htmlspecialchars($userId['usr_id'], ENT_QUOTES);
$startPrice = htmlspecialchars($cryId['cry_btcValue'], ENT_QUOTES);
$timerNumber = htmlspecialchars($_POST['timerNumber'], ENT_QUOTES);
$timerValue = htmlspecialchars($_POST['timerValue'], ENT_QUOTES);
$targetPrice = htmlspecialchars($_POST['targetPrice'], ENT_QUOTES);
$description = htmlspecialchars($_POST['description'], ENT_QUOTES);

//var_dump($userId['usr_id']);
//var_dump($startPrice);
//var_dump($_POST['crypto']);
//var_dump($_POST['timerNumber']);
//var_dump($_POST['timerValue']);
//var_dump($_POST['targetPrice']);
//var_dump($_POST['description']);
//var_dump($date);

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
}

if(floatval($targetPrice) > floatval($startPrice) || floatval($targetPrice) === '' || floatval($targetPrice) === null) {
    if ($timerValue === 'Minute') {
        if ($timerNumber < 15) {
            echo erreur('La durée du call est trop courte ! 15 Minutes minimum !', 'Oups !', '/web/createCall.php');
        } else {
            $callStopDate = strftime("%H:%M %e %B %Y", strtotime('+' . $timerNumber . ' minute'));
            pushCall($conn, $usrId, $crypto, $callStopDate, $startPrice, 'En cours', $targetPrice, $date, $description);
            echo erreur('Call ajouté avec succès !', 'Call créé !', '/web/index.php');
        };
    } elseif ($timerValue === 'Heure') {
        $callStopDate = strftime("%H:%M %e %B %Y", strtotime('+' . $timerNumber . ' hour'));
        pushCall($conn, $usrId, $crypto, $callStopDate, $startPrice, 'En cours', $targetPrice, $date, $description);
        echo erreur('Call ajouté avec succès !', 'Call créé !', '/web/index.php');
    } elseif ($timerValue === 'Jour') {
        $callStopDate = strftime("%H:%M %e %B %Y", strtotime('+' . $timerNumber . ' day'));
        pushCall($conn, $usrId, $crypto, $callStopDate, $startPrice, 'En cours', $targetPrice, $date, $description);
        echo erreur('Call ajouté avec succès !', 'Call créé !', '/web/index.php');
    } elseif ($timerValue === 'Semaine') {
        $callStopDate = strftime("%H:%M %e %B %Y", strtotime('+' . $timerNumber . ' week'));
        pushCall($conn, $usrId, $crypto, $callStopDate, $startPrice, 'En cours', $targetPrice, $date, $description);
        echo erreur('Call ajouté avec succès !', 'Call créé !', '/web/index.php');
    } elseif ($timerValue === 'Année') {
        $callStopDate = strftime("%H:%M %e %B %Y", strtotime('+' . $timerNumber . ' year'));
        pushCall($conn, $usrId, $crypto, $callStopDate, $startPrice, 'En cours', $targetPrice, $date, $description);
        echo erreur('Call ajouté avec succès !', 'Call créé !', '/web/index.php');
    } elseif ($timerValue === 'Décennie') {
        $callStopDate = strftime("%H:%M %e %B %Y", strtotime('+' . ($timerNumber * 10) . ' year'));
        pushCall($conn, $usrId, $crypto, $callStopDate, $startPrice, 'En cours', $targetPrice, $date, $description);
        echo erreur('Call ajouté avec succès !', 'Call créé !', '/web/index.php');
    } elseif ($timerValue === 'Siècle') {
        $callStopDate = strftime("%H:%M %e %B %Y", strtotime('+' . ($timerNumber * 100) . ' year'));
        pushCall($conn, $usrId, $crypto, $callStopDate, $startPrice, 'En cours', $targetPrice, $date, $description);
        echo erreur('Call ajouté avec succès !', 'Call créé !', '/web/index.php');
    } elseif ($timerValue === 'Millénaire') {
        $callStopDate = strftime("%H:%M %e %B %Y", strtotime('+' . ($timerNumber * 1000) . ' year'));
        pushCall($conn, $usrId, $crypto, $callStopDate, $startPrice, 'En cours', $targetPrice, $date, $description);
        echo erreur('Call ajouté avec succès !', 'Call créé !', '/web/index.php');
    } elseif ($timerValue === 'OVER 9000') {
        $callStopDate = strftime("%H:%M %e %B %Y", strtotime('+' . ($timerNumber * 10000) . ' year'));
        pushCall($conn, $usrId, $crypto, $callStopDate, $startPrice, 'En cours', $targetPrice, $date, $description);
        echo erreur('Call ajouté avec succès !', 'Call créé !', '/web/index.php');
    } else {
        echo erreur('Tu n\'as pas bien suivi le formulaire coquinou ! Recommence !', 'Oups !', '/web/createCall.php');
    }
} else {
    echo erreur('La target est inférieure au prix actuel ! ('.$startPrice.' BTC)', 'Oups !', '/web/createCall.php');
}

function pushCall($conn, $usrId, $crypto, $callStopDate, $startPrice, $statut, $targetPrice, $date, $description){
    if($description === ''){
        $sql = "INSERT INTO topCall (usr_id, cry_id, top_time, top_startPrice, top_status, top_target, top_startTime) 
        VALUES ('$usrId', '$crypto', '$callStopDate', '$startPrice BTC', 'En cours', '$targetPrice BTC', '$date')";
        $conn->query($sql);
    } else {
        $sql = "INSERT INTO topCall (usr_id, cry_id, top_time, top_startPrice, top_status, top_target, top_startTime, top_description) 
        VALUES ('$usrId', '$crypto', '$callStopDate', '$startPrice BTC', 'En cours', '$targetPrice BTC', '$date', '$description')";
        $conn->query($sql);
    }
};

require('layout/bottom.html');
?>

