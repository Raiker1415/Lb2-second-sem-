<?php
include("connect.php");

$squadName = $_POST["squad"];

$collections = (new MongoDB\Client)->LB2secondS->gameCommands;

$filter = ['name' => $squadName];

$projection = ['squad' => 1];

$cursor = $collections->find($filter, $projection);

$result = array();
foreach ($cursor as $document) {
    foreach ($document['squad'] as $player) {
        $result[] = $player;
    }    
}

echo "<h2>Футболісти команди $squadName:</h2>";
foreach ($result as $player) {
    echo $player . "<br>";
}

echo "<script>localStorage.setItem('request', '" . json_encode($result) . "'); </script>";
?>
