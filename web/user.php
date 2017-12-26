<?php
require('layout/top.html');
require('layout/dbconnect.php');
require('Class/Call.php');
require('Class/UserId.php');

$userId = htmlspecialchars($_GET["userId"]);

$sql = "SELECT * FROM topCall
        JOIN cry_users on topCall.usr_id = cry_users.usr_id
        JOIN cryptos on topCall.cry_id = cryptos.cry_id
        WHERE cry_users.usr_name LIKE '$userId'
        ORDER BY topCall.top_id DESC";

$result = $conn->query($sql);
while ($i < 1 && $row = $result->fetch_assoc()) {
    $userIdClass = new UserId($row['usr_name'],
        $row['usr_totalCallNumber'],
        $row['usr_SuccessCall'],
        number_format(($row['usr_totalCallNumber']*100)/$row['usr_SuccessCall'], 2));
    $userIdClass->setHtml();
    echo $userIdClass->getHtml();
    $i++;
};

echo '<div class="row">
        <div class="col-12 mb-2"><h1>Résumé des calls</h1></div>';

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

require('layout/bottom.html');
?>