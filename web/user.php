<?php
require('layout/dbconnect.php');
require('layout/top.php');
require('Class/Call.php');
require('Class/UserId.php');

$userId = htmlspecialchars($_GET["userId"]);

$sql = "SELECT * FROM topCall
        JOIN cry_users on topCall.usr_id = cry_users.usr_id
        JOIN cryptos on topCall.cry_id = cryptos.cry_id
        WHERE cry_users.usr_name LIKE '$userId'
        ORDER BY topCall.top_id DESC";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($row['usr_totalCallNumber'] === null) {
    $sql = "SELECT usr_name, usr_BTCAdress, usr_ETHAdress, usr_LTCAdress FROM cry_users WHERE usr_name LIKE '$userId'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(isset($row['usr_name'])){
        $userIdClass = new UserId($row['usr_name'],
            0,
            0,
            0,
            $row['usr_BTCAdress'],
            $row['usr_ETHAdress'],
            $row['usr_LTCAdress']);
        $userIdClass->setHtml();
        echo $userIdClass->getHtml();
    } else {
        echo '<div class="container-fluid black-div underTopDiv">
                <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                    <h1>Oups !</h1>
                </div>
                <div>
                    <p class="mt-5">Comment êtes-vous arrivés ici ?!</p>
                    <p class="mt-5">Vous allez être redirigé automatiquement dans 3 secondes.</p>
                    <p>Si rien ne se passe, <a href="/web/index.php">vous pouvez cliquer ici.</a></p>
                </div>
            </div>
            <!-- Redirection automatique au bout de 3 secondes sur l\'index -->
            <meta http-equiv="refresh" content="3; URL=/web/index.php">';
    }
} else {
    $userIdClass = new UserId($row['usr_name'],
        $row['usr_totalCallNumber'],
        $row['usr_SuccessCall'],
        number_format(($row['usr_SuccessCall']*100)/$row['usr_totalCallNumber'], 2),
        $row['usr_BTCAdress'],
        $row['usr_ETHAdress'],
        $row['usr_LTCAdress']);

    $userIdClass->setHtml();
    echo $userIdClass->getHtml();

    echo '<div id="listCalls" class="container-fluid">
        <div class="col-12 mb-2"><h1>Résumé des calls</h1></div>
        <div class="row justify-content-around pb-1">
            <ul class="pagination"></ul>
        </div>
        <div class="row list">';

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $call = new Call($row['top_id'],
            $row['usr_name'],
            $row['cry_name'],
            $row['cry_url'],
            $row['top_time'],
            $row['top_startPrice'],
            $row['top_status'],
            $row['top_target'],
            $row['top_startTime']);
        $call->setHtml();
        echo $call->getHtml();
    };

    echo '</div>';
}

require('layout/bottom.html');
?>