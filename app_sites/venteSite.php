<?php
$title="Vente des sites";
require_once('includes/functions.php');
require_once('config/database.php');

if (isset($_GET['site'])) {
    $site = intval($_GET['site']);

    $query = $db->prepare("SELECT * FROM sites WHERE idSite=:idSite");
    $query->execute(
        [
            'idSite' => $_GET['site']
        ]
    );

    while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
        echo "<table>
    <tr>
    <th>ID du site</th>
    <th>Nom du site</th>
    <th>Ville du site</th>
    <th>Latitude</th>
    <th>Longitude</th>
    </tr>";
        echo "<tr>";
        echo "<td>" . $result['idSite'] . "</td>";
        echo "<td>" . $result['nom'] . "</td>";
        echo "<td>" . $result['ville'] . "</td>";
        echo "<td>" . $result['latitude'] . "</td>";
        echo "<td>" . $result['longitude'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    $query->closeCursor();
}

require_once('views/venteSite.view.php');