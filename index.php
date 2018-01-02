<?php
require('web/layout/dbconnect.php');
require('web/layout/topIndex.php');
require('web/Class/Call.php');

echo '<div id="topCalls" class="container-fluid black-div hidden">
        <div class="container-fluid knowMore mb-3 mt-1 pb-1"><h1>Top Calls du moment</h1></div>
        <div class="row">';

$sql = 'SELECT * FROM topCall
        JOIN cry_users on topCall.usr_id = cry_users.usr_id
        JOIN cryptos on topCall.cry_id = cryptos.cry_id
        WHERE top_status LIKE "En cours"
        ORDER BY (cry_users.usr_totalCallNumber * 100)/usr_SuccessCall DESC';
$result = $conn->query($sql);
while ($i < 6 && $row = $result->fetch_assoc()) {
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
    $i++;
};
// Modif middle content
echo '</div>
    </div>
    <div id="listCalls" class="container-fluid black-div">
        <div class="container-fluid knowMore mb-3 mt-1 pb-1"><h1>Liste des Calls</h1></div>
        <div class="row justify-content-around pb-1">
            <ul class="pagination"></ul>
        </div>
        <div class="row list">';

$sql = "SELECT * FROM topCall
                JOIN cry_users on topCall.usr_id = cry_users.usr_id
                JOIN cryptos on topCall.cry_id = cryptos.cry_id
                ORDER BY topCall.top_id DESC";
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

require('web/layout/bottom.php');
?>