<?php
require('layout/dbconnect.php');
require('layout/top.php');
require('Class/CallId.php');
$callId = htmlspecialchars($_GET["callId"]);
$callId = mysqli_real_escape_string($conn, $callId);

$result = mysqli_query($conn, "SELECT * FROM topCall
                JOIN cry_users on topCall.usr_id = cry_users.usr_id
                JOIN cryptos on topCall.cry_id = cryptos.cry_id
                WHERE top_id = $callId");

while ($row = $result->fetch_assoc()) {
    if($row['usr_totalCallNumber'] == 0){
        $score = 0;
    } else {
        $score = number_format(($row['usr_SuccessCall']*100)/$row['usr_totalCallNumber'], 2);
    };
    $callIdClass = new CallId($row['usr_name'],
        $row['cry_name'],
        $row['cry_url'],
        $row['top_time'],
        $row['top_startPrice'],
        $row['top_status'],
        $score,
        $row['top_startTime'],
        $row['top_target'],
        $row['cry_lastHour'],
        $row['cry_last24Hours'],
        $row['cry_last7Days'],
        $row['cry_marketcap'],
        $row['cry_fiatValue'],
        $row['cry_supply'],
        $row['cry_volume'],
        $row['top_description']);
    $callIdClass->setHtml();
    echo $callIdClass->getHtml();
};

require('layout/bottom.php');
?>