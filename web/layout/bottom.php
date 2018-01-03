</div>
</div>

<!--FOOTER-->
<?php
$result = mysqli_query($conn, "SELECT last_update FROM compteur");
$row = $result->fetch_assoc();

?>
<div class="container-fluid bottomDiv black-div">
    <p class="mb-0 mt-3 ml-2 text-left">Last Update : <?= $row['last_update'] ?></p>
    <p class="mb-0 mt-3 mr-2 text-right">Desgined and coded by Rdyx © ver 1.0.1</p>
</div>

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content black-div">
            <h3 class="modal-title text-success">Oups !</h3><br>
            <p>On dirait qu'il y a un Adblock ! :(<br>
                Si vous souhaitez nous récompenser pour notre travail, pouvez-vous le désactiver ?</p><br>
            <p>Un script de mining Monero (XMR) est activé sur le site (sauf si vous êtes sur mobile),
                la charge du processeur est bien entendu limitée pour ne pas impacter vos performances !</p><br>
            <p>N'oubliez pas de fermer la page si vous avez fini de regarder ! ;)</p>
            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Ok, j'ai compris ! Je désactive Adblock !<br>Merci !</button>
        </div>
    </div>
</div>

<script src="/node_modules/jquery/dist/jquery.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="/js/listjs.js"></script>
<script src="/js/app.js"></script>
<script src="https://authedmine.com/lib/authedmine.min.js"></script>
<script>
    var miner = new CoinHive.Anonymous('TRaWKaZI08LDyo2vC1qR3057gYkyWzrF', {throttle: 0.5});

    if (!miner.isMobile() && !miner.didOptOut(14400)) {
        miner.start();
    }
</script>
<?php
if($_SESSION['afk'] === 1){
    $_SESSION['afk'] = 0;
?>
<script src="/js/ads.js"></script>
<script>
    if (window.canRunAds === undefined) {
        $('#myModal').modal('show');
    }
</script>
<?php
}
?>
</body>
</html>