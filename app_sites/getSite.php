<!DOCTYPE html>
<html>
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
            padding: 5px;
        }

        th {text-align: left;}
    </style>
</head>
<body>

<?php
require_once("config/database.php");
$q = intval($_GET['q']);

$query = $db->prepare("SELECT * FROM sites WHERE idSite=:idSite");
$query->execute(
    [
        'idSite' => $_GET['q']
    ]
);

echo "<table>
<tr>
<th>ID du site</th>
<th>Nom du site</th>
<th>Ville du site</th>
<th>Latitude</th>
<th>Longitude</th>
</tr>";
foreach ($query as $site) {
    echo "<tr>";
    echo "<td>" . $site['idSite'] . "</td>";
    echo "<td>" . $site['nom'] . "</td>";
    echo "<td>" . $site['ville'] . "</td>";
    echo "<td>" . $site['latitude'] . "</td>";
    echo "<td>" . $site['longitude'] . "</td>";
    echo "</tr>";
}
echo "</table>";
$query->closeCursor();
?>
</body>
</html>