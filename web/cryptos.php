<?php
require('layout/top.html');
require('layout/dbconnect.php');

echo '<div class="container-fluid black-div underTopDiv">
    <div class="container-fluid mb-2 mt-2 pb-1"><h1>Liste des cryptos</h1></div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 border">
                <table class="table table-bordered">
                    <tr>
                        <th class="text-center">Nom de la crypto</th>
                        <th class="text-center">Abréviation + URL</th>
                    </tr>';

$sql = "SELECT * FROM cryptos
        ORDER BY cry_fullName ASC";

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    echo '<tr>
            <td>' . $row['cry_fullName'] . '</td>
            <td><a href="'.$row['cry_url'].'">' . $row['cry_name'] . '</a></td>
          </tr>';
};

echo '</table>
     </div>
     </div>
     </div>';

require('layout/bottom.html');
?>