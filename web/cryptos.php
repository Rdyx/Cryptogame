<?php
require('layout/dbconnect.php');
require('layout/top.php');

echo '<div class="container-fluid black-div underTopDiv">
        <div class="container-fluid mb-3 mt-2 pb-1 knowMore">
                <h1>Liste des cryptos</h1>
        </div>
        <div class="row">';

if(isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search']);
    $sql = "SELECT * FROM cryptos
            WHERE cry_name LIKE '%$search%'
            ORDER BY cry_fullName ASC";
    $result = $conn->query($sql);
    if($result) {
        while ($row = $result->fetch_assoc()) {
            if ($row['cry_lastHour'] <= 0) {
                $lastHour = 'red';
            } else {
                $lastHour = 'green';
            }

            if ($row['cry_last24Hours'] <= 0) {
                $last24Hours = 'red';
            } else {
                $last24Hours = 'green';
            }

            if ($row['cry_last7Days'] <= 0) {
                $last7days = 'red';
            } else {
                $last7days = 'green';
            }

            echo '<div class="col-sm-4 border">
              <table class="table table-bordered text-center">
                  <tr>
                    <td>' . $row['cry_fullName'] . '</td>
                    <td><a class="crypto-short-name" href="' . $row['cry_url'] . '">' . $row['cry_name'] . '</a></td>
                  </tr>
                  <tr>
                    <td colspan="2"><strong>Marketcap : </strong>' . $row['cry_marketcap'] . '</td>
                  </tr>
                  <tr>
                    <td><strong>Valeur</strong><br>' . $row['cry_fiatValue'] . '</td>
                    <td><strong>Volume</strong><br>' . $row['cry_volume'] . '</td>
                  </tr>
                  <tr>
                    <td class="' . $lastHour . '">1h : ' . $row['cry_lastHour'] . '</td>
                    <td class="' . $last24Hours . '">24h : ' . $row['cry_last24Hours'] . '</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="' . $last7days . '">7 jours : ' . $row['cry_last7Days'] . '</td>
                  </tr>
              </table>
          </div>';
        };
    }
};

echo '</div>
     </div>';

require('layout/bottom.html');
?>