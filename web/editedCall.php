<?php
require('layout/dbconnect.php');
require('layout/top.php');
$callId = htmlspecialchars($_GET['callId']);
$callId = mysqli_real_escape_string($conn, $callId);

date_default_timezone_set('Europe/Paris');
setlocale(LC_ALL, 'fr_FR');
$date = strftime("%H:%M").' le '.strftime("%d/%m/%Y");
$endDate = strftime("%Y%m%d%H%M");

$result = mysqli_query($conn, "SELECT usr_name, top_startPrice FROM topCall
        JOIN cry_users ON topCall.usr_id = cry_users.usr_id
        WHERE usr_name = '$nick' AND top_id = $callId");
$callInfos = $result->fetch_assoc();

$userName = htmlspecialchars($callInfos['usr_name'], ENT_QUOTES);
$userName = mysqli_real_escape_string($conn, $userName);

$startPrice = htmlspecialchars($callInfos['top_startPrice'], ENT_QUOTES);
$startPrice = mysqli_real_escape_string($conn, $startPrice);

$timerNumber = htmlspecialchars($_POST['timerNumber'], ENT_QUOTES);
$timerNumber = mysqli_real_escape_string($conn, $timerNumber);

$timerValue = htmlspecialchars($_POST['timerValue'], ENT_QUOTES);
$timerValue = mysqli_real_escape_string($conn, $timerValue);

$targetPrice = htmlspecialchars($_POST['targetPrice'], ENT_QUOTES);
$targetPrice = mysqli_real_escape_string($conn, $targetPrice);

$description = htmlspecialchars($_POST['description'], ENT_QUOTES);
$description = mysqli_real_escape_string($conn, $description);

//var_dump($userName['usr_name']);
//var_dump($_POST['timerNumber']);
//var_dump($_POST['timerValue']);
//var_dump($_POST['targetPrice']);
//var_dump($_POST['description']);
//var_dump($usrName)

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

if($userName === $nick) {
    if (floatval($targetPrice) > $startPrice || floatval($targetPrice) === '' || floatval($targetPrice) === null) {
        if ($timerValue === 'Minute') {
            if ($timerNumber < 15) {
                echo erreur('La durée du call est trop courte ! 15 Minutes minimum !', 'Oups !', '/web/edit.php/?callId=' . $callId);
            } else {
                $callStopDate = strftime("%H:%M le %d/%m/%Y", strtotime('+ '.$timerNumber.' minute'));
                $endDate = strftime("%Y%m%d%H%M", strtotime('+ '.$timerNumber.' minute'));
                pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate);
                echo erreur('Call modifié avec succès !', 'Call modifié !', '/index.php');
            };
        } elseif ($timerValue === 'Heure') {
            $callStopDate = strftime("%H:%M le %d/%m/%Y", strtotime('+ '.$timerNumber.' hour'));
            $endDate = strftime("%Y%m%d%H%M", strtotime('+ '.$timerNumber.' hour'));
            pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate);
            echo erreur('Call modifié avec succès !', 'Call modifié !', '/index.php');
        } elseif ($timerValue === 'Jour') {
            $callStopDate = strftime("%H:%M le %d/%m/%Y", strtotime('+ '.$timerNumber.' day'));
            $endDate = strftime("%Y%m%d%H%M", strtotime('+ '.$timerNumber.' day'));
            pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate);
            echo erreur('Call modifié avec succès !', 'Call modifié !', '/index.php');
        } elseif ($timerValue === 'Semaine') {
            $callStopDate = strftime("%H:%M le %d/%m/%Y", strtotime('+ '.$timerNumber.' week'));
            $endDate = strftime("%Y%m%d%H%M", strtotime('+ '.$timerNumber.' week'));
            pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate);
            echo erreur('Call modifié avec succès !', 'Call modifié !', '/index.php');
        } elseif ($timerValue === 'Mois') {
            $callStopDate = strftime("%H:%M le %d/%m/%Y", strtotime('+ '.$timerNumber.' month'));
            $endDate = strftime("%Y%m%d%H%M", strtotime('+ '.$timerNumber.' month'));
            pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate);
            echo erreur('Call modifié avec succès !', 'Call modifié !', '/index.php');
        } elseif ($timerValue === 'Année') {
            $callStopDate = strftime("%H:%M le %d/%m/%Y", strtotime('+ '.$timerNumber.' year'));
            $endDate = strftime("%Y%m%d%H%M", strtotime('+ '.$timerNumber.' year'));
            pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate);
            echo erreur('Call modifié avec succès !', 'Call modifié !', '/index.php');
        } elseif ($timerValue === 'Décennie') {
            $callStopDate = strftime("%H:%M le %d/%m/%Y", strtotime('+ '.($timerNumber * 10).' year'));
            $endDate = strftime("%Y%m%d%H%M", strtotime('+ '.($timerNumber * 10).' year'));
            pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate);
            echo erreur('Call modifié avec succès !', 'Call modifié !', '/index.php');
        } elseif ($timerValue === 'Siècle') {
            $callStopDate = strftime("%H:%M le %d/%m/%Y", strtotime('+ '.($timerNumber * 100).' year'));
            $endDate = strftime("%Y%m%d%H%M", strtotime('+ '.($timerNumber * 100).' year'));
            pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate);
            echo erreur('Call modifié avec succès !', 'Call modifié !', '/index.php');
        } elseif ($timerValue === 'Millénaire') {
            $callStopDate = strftime("%H:%M le %d/%m/%Y", strtotime('+ '.($timerNumber * 1000).' year'));
            $endDate = strftime("%Y%m%d%H%M", strtotime('+ '.($timerNumber * 1000).' year'));
            pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate);
            echo erreur('Call modifié avec succès !', 'Call modifié !', '/index.php');
        } elseif ($timerValue === 'OVER 9000') {
            $callStopDate = strftime("%H:%M le %d/%m/%Y", strtotime('+ '.($timerNumber * 10000).' year'));
            $endDate = strftime("%Y%m%d%H%M", strtotime('+ '.($timerNumber * 10000).' year'));
            pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate);
            echo erreur('Call modifié avec succès !', 'Call modifié !', '/index.php');
        } else {
            echo erreur('Tu n\'as pas bien suivi le formulaire coquinou ! Recommence !', 'Oups !', '/web/edit.php/?callId=' . $callId);
        }
    } else {
        echo erreur('La target est inférieure au prix de départ du call ! ('.$startPrice.')', 'Oups !', '/web/edit.php/?callId=' . $callId);
    }
} else {
    echo erreur('Comment êtes-vous arrivés ici ?!', 'Oups !', '/web/edit.php/?callId=' . $callId);
}

function pushCall($conn, $callId, $nick, $callStopDate, $targetPrice, $description, $endDate){
    if($description === ''){
        mysqli_query($conn, "UPDATE topCall INNER JOIN cry_users ON topCall.usr_id = cry_users.usr_id 
            SET top_time = '$callStopDate', top_target = '$targetPrice', top_endDate = '$endDate' 
            WHERE top_id = $callId AND usr_name = '$nick'");
    } else {
        mysqli_query($conn, "UPDATE topCall INNER JOIN cry_users ON topCall.usr_id = cry_users.usr_id 
                        SET top_time = '$callStopDate', top_target = '$targetPrice', top_description = '$description', top_endDate = '$endDate' 
                        WHERE top_id = $callId AND usr_name = '$nick'");
    }
};

require('layout/bottom.php');
?>