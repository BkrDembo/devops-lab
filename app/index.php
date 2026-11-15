<?php
$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'appuser';
$pass = getenv('DB_PASS') ?: 'apppass';
$name = getenv('DB_NAME') ?: 'appdb';

echo "<h1>Projet DevOps - Paul</h1>";
$conn = @new mysqli($host, $user, $pass, $name);
echo $conn->connect_error
    ? "<p style='color:red'>Base de données : KO</p>"
    : "<p style='color:green'>Base de données : OK</p>";
