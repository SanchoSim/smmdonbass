<?php
require 'config.php';

$stmt = $pdo->query("SHOW VARIABLES LIKE 'character_set_connection'");
print_r($stmt->fetchAll());

echo "<br><br>";

$stmt = $pdo->query("SHOW VARIABLES LIKE 'collation_connection'");
print_r($stmt->fetchAll());