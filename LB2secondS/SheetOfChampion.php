<?php
include("connect.php");

$league = $_POST["champions"];

$collections = (new MongoDB\Client)->LB2secondS->gameChampions;

$filter = ['league' => $league];

$cursor = $collections->find($filter);

echo "<table>";
echo "<table style='border-collapse: collapse;'>";
echo "<tr><th style='border: 1px solid black;'>Дата</th><th style='border: 1px solid black;'>Місце</th><th style='border: 1px solid black;'>Команди</th><th style='border: 1px solid black;'>Переможець</th></tr>";


$result = [];

foreach ($cursor as $document) {
    echo "<tr>";
    echo "<td style='border: 1px solid black;'>" . $document['date'] . "</td>";
    echo "<td style='border: 1px solid black;'>" . $document['venue'] . "</td>";
    echo "<td style='border: 1px solid black;'>" . implode(", ", $document['teams']->getArrayCopy()) . "</td>";
    echo "<td style='border: 1px solid black;'>" . $document['winner'] . "</td>";
    echo "</tr>";
    
    $result[] = $document['teams'];
}

echo "</table>";

$unique_leagues = array_unique($result);
foreach ($unique_leagues as $league) {
    
}

echo "<script>localStorage.setItem('request', '" . json_encode($result)."'); </script>";
?>
