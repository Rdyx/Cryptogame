<?php
if(!isset($_SESSION['nick']) || $_SESSION['nick'] === 'Guest') {
    $boutons = '<div class="row mt-2 pr-0">
                    <form class="row text-center mt-1 topInput" action="/web/cryptos.php/" method="GET">
                        <input autocomplete="off" type="text" name="search" class="text-center btn btn-outline-success" id="searchCrypto" placeholder="BTC, XBY, ETH...">
                        <button class="mr-3 btn btn-outline-success">Rechercher</button>
                    </form>
                    <ul class="list-unstyled ml-3 mt-0 pt-0 mr-3 pr-3 borderRightTopDiv">
                        <li>
                        <a class="hovered" href="/web/connect.php">Se connecter</a>
                        </li>
                        <li>
                            <a class="hovered" href="/web/register.php">S\'enregistrer</a>
                        </li>
                    </ul>
                    <a class="listCallsClickable hovered" href="/web/index.php"><h4 class="mt-2 pr-3">All Calls</h4></a>
                </div>';
    $boutonsMobile = '<div id="dropMenuMobile" class="mt-5 fixed-top hidden">
                        <a class="dropdown-item" href="/web/connect.php">Se connecter</a>
                        <a class="dropdown-item" href="/web/register.php">S\'enregistrer</a>
                        <a class="listCallsClickable dropdown-item" href="/web/index.php">All Calls</a>
                        <form class="dropdown-item" action="/web/cryptos.php/" method="GET">
                            <input autocomplete="off" type="text" name="search" class="text-center btn btn-outline-success" id="searchCrypto" placeholder="BTC, XBY, ETH...">
                            <button class="mr-3 btn btn-outline-success">Rechercher</button>
                        </form>
                    </div>';
}  elseif($_SESSION['nick'] !== 'Guest'){
    $boutons = '<div class="row mt-2 pr-0">
                    <form class="row text-center mt-1 topInput" action="/web/cryptos.php/" method="GET">
                        <input autocomplete="off" type="text" name="search" class="text-center btn btn-outline-success" id="searchCrypto" placeholder="BTC, XBY, ETH...">
                        <button class="mr-3 btn btn-outline-success">Rechercher</button>
                    </form>
                    <ul class="list-unstyled ml-3 mt-0 pt-0 mr-3 pr-3 borderRightTopDiv">
                        <li>
                            <a class="hovered" href="/web/user.php/?userId='.$_SESSION['nick'].'">'.$_SESSION['nick'].'</a>
                        </li>
                        <li>
                            <a class="hovered" href="/web/logout.php">Se déconnecter</a>
                        </li>
                    </ul>
                    <a class="hovered" href="/web/createCall.php"><h4 class="mt-2 mr-3 pr-3 borderRightTopDiv ">Créer un Call</h4></a>
                    <a class="listCallsClickable hovered" href="/web/index.php"><h4 class="mt-2 pr-3">All Calls</h4></a>
                </div>';
    $boutonsMobile = '<div id="dropMenuMobileIndex" class="mt-5 fixed-top hidden">
                        <a class="dropdown-item" href="/web/user.php/?userId='.$_SESSION['nick'].'">'.$_SESSION['nick'].'</a>
                        <a class="dropdown-item" href="/web/logout.php">Se déconnecter</a>
                        <a class="dropdown-item" href="/web/createCall.php">Créer un Call</a>
                        <a class="listCallsClickable dropdown-item" href="/web/index.php">All Calls</a>
                        <form class="dropdown-item" action="/web/cryptos.php/" method="GET">
                            <input autocomplete="off" type="text" name="search" class="text-center btn btn-outline-success" id="searchCrypto" placeholder="BTC, XBY, ETH...">
                            <button class="mr-3 btn btn-outline-success">Rechercher</button>
                        </form>
                    </div>';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>
<body class="text-center">
<div class="container-fluid fixed-top hidden-md-down">
    <div class="row">
        <div class="col mt-3 pl-0 text-left"><h3><a href="/web/index.php">Cryptogame Calls</a></h3></div>
        <?= $boutons ?>
    </div>
</div>
<!--PETIT SCREEN hiddensmup-->
<div class="container-fluid fixed-top hidden-lg-up">
    <div class="row">
        <div class="col mt-3 pl-0 text-left"><h3><a href="/web/index.php">Cryptogame Calls</a></h3></div>
        <div class="row mt-3 pr-0 mr-0">
            <i id="dropdownMenuMobile" class="mt-2 fa fa-bars"></i>
        </div>
    </div>
    <?= $boutonsMobile ?>
</div>
<!--/PETIT SCREEN-->