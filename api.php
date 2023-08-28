<?php
 
$neo4jUri = "neo4j+s://d23e285f.databases.neo4j.io";
$neo4jUsername = "neo4j";
$neo4jPassword = "i8-YwK-zrafll8WVYGCO-3flZYjq5yjTvxEOAuzFrIk";

header('Content-Type: application/json');
echo json_encode([
    'uri' => $neo4jUri,
    'username' => $neo4jUsername,
    'password' => $neo4jPassword
]);
?>
