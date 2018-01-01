</div>
</div>

<!--FOOTER-->
<?php
$sql = "SELECT last_update FROM compteur";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<div class="container-fluid bottomDiv black-div">
    <p class="mb-0 mt-3 ml-2 text-left">Last Update : <?= $row['last_update'] ?></p>
    <p class="mb-0 mt-3 mr-2 text-right">Desgined and coded by Rdyx © ver 1.0</p>
</div>

<script src="/node_modules/jquery/dist/jquery.js"></script>
<script src="/node_modules/bootstrap/dist/js/bootstrap.js"></script>
<script src="/js/listjs.js"></script>
<script src="/js/app.js"></script>
</body>
</html>