<?php
include("connect.php");

$squadName = $_POST["squad"];

$collections = (new MongoDB\Client)->LB2secondS->gameChampions;

$filter = ['teams' => $squadName];

$cursor = $collections->find($filter);

echo "<h2>Список игр для команды $squadName:</h2>";
echo '<table style="border-collapse: collapse; width: 100%;">';
echo '<tr><th style="border: 1px solid black; padding: 8px;">Лига</th><th style="border: 1px solid black; padding: 8px;">Дата</th><th style="border: 1px solid black; padding: 8px;">Место</th><th style="border: 1px solid black; padding: 8px;">Команды</th><th style="border: 1px solid black; padding: 8px;">Победитель</th></tr>';

$result = [];

foreach ($cursor as $document) {
    echo "<tr>";
    echo '<td style="border: 1px solid black; padding: 8px;">' . $document['league'] . '</td>';
    echo '<td style="border: 1px solid black; padding: 8px;">' . $document['date'] . '</td>';
    echo '<td style="border: 1px solid black; padding: 8px;">' . $document['venue'] . '</td>';
    
    $teams = [];
    foreach ($document['teams'] as $team) {
        $teams[] = $team;
    }
    echo '<td style="border: 1px solid black; padding: 8px;">' . implode(", ", $teams) . '</td>';
    
    echo '<td style="border: 1px solid black; padding: 8px;">' . $document['winner'] . '</td>';
    echo "</tr>";
    
    $result[] =  $document['winner'];
}

echo '</table>';


echo "<script>localStorage.setItem('request', JSON.stringify(" . json_encode($result) . ")); </script>";
?>
