<?php
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "cryptogame";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

$conn = new mysqli($servername, $username, $password, $dbname);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body class="text-center">
<div class="container-fluid fixed-top hidden-xs-down">
    <div class="row">
        <div class="col mt-3 pl-0 text-left"><h3>Cryptogame Calls</h3></div>
        <div class="row mt-3 pr-0">
            <a class="topCallsClickable hovered" href="#"><h4 class="mt-1 mr-3 pr-3 borderRightTopDiv ">Top Calls</h4></a>
            <a class="listCallsClickable hovered" href="#"><h4 class="mt-1 pr-3">All Calls</h4></a>
        </div>
    </div>
</div>
<!--PETIT SCREEN hiddensmup-->
<div class="container-fluid fixed-top hidden-sm-up">
    <div class="row">
        <div class="col mt-3 pl-0 text-left"><h3>Cryptogame Calls</h3></div>
        <div class="row mt-3 pr-0 mr-0">
            <i id="dropdownMenuMobile" class="mt-2 fa fa-bars"></i>
        </div>
    </div>
    <div id="dropMenuMobile" class="mt-5 fixed-top hidden">
        <a class="topCallsClickable dropdown-item" href="#">Top Calls</a>
        <a class="listCallsClickable dropdown-item" href="#">All Calls</a>
    </div>
</div>
<!--/PETIT SCREEN-->
<div id="topCalls" class="container-fluid black-div hidden">
    <div class="container-fluid knowMore mb-3 mt-1 pb-1"><h1>Top Calls du moment</h1></div>
    <div class="row">
        <?php
        require_once('Class/Call.php');
        $i = 0;
        $sql = "SELECT * FROM topCall
        JOIN cry_users on topCall.usr_id = cry_users.usr_id
        JOIN cryptos on topCall.cry_id = cryptos.cry_id
        ORDER BY cry_users.usr_score DESC";
        $result = $conn->query($sql);
        while ($i < 6 && $row = $result->fetch_assoc()) {
            $class = new Call($row['usr_name'], $row['cry_name'], $row['cry_url'], $row['top_time'], $row['top_startPrice'].' sats', $row['top_status']);
            $class->setHtml();
            echo $class->getHtml();
            $i++;
        };
        ?>
    </div>
</div>

<div id="listCalls" class="container-fluid black-div">
    <div class="container-fluid knowMore mb-3 mt-1 pb-1"><h1>Liste des Calls</h1></div>
    <div class="row">
        <?php
        $sql = "SELECT * FROM topCall
                JOIN cry_users on topCall.usr_id = cry_users.usr_id
                JOIN cryptos on topCall.cry_id = cryptos.cry_id
                ORDER BY topCall.top_id DESC";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $class = new Call($row['usr_name'], $row['cry_name'], $row['cry_url'], $row['top_time'], $row['top_startPrice'].' sats', $row['top_status']);
            $class->setHtml();
            echo $class->getHtml();
        };
        ?>
    </div>
</div>

<!--FOOTER-->
<div class="container-fluid bottomDiv black-div">
    <p class="mb-0 mt-3 mr-2 text-right">Desgined by Rdyx</p>
</div>

<script src="../node_modules/jquery/dist/jquery.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="../js/app.js"></script>
</body>
</html>