<?php
require_once(__DIR__."/vendor/autoload.php");

$client = new MongoDB\Client;
$collections = $client->LB2secondS->gameChampions;
$collections = $client->LB2secondS->gameCommands;
