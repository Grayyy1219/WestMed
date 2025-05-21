<?php
$configContent = file_get_contents('config/config.json');
$config = json_decode($configContent, true);

$serverName = $_SERVER['SERVER_NAME'] ?? 'localhost';

if ($serverName === 'localhost' || $serverName === '127.0.0.1') {
    $env = 'local';
} else {
    $env = 'production';
}

$dbHost = $config[$env]['db_host'];
$dbUser = $config[$env]['db_user'];
$dbPass = $config[$env]['db_pass'];
$dbName = $config[$env]['db_name'];

$con = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
