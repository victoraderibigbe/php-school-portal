<?php
$username = 'root';
$hostname = 'localhost';
$password = '';
$database = 'captain_college';

$db_connection = new mysqli($hostname, $username, $password, $database);
if ($db_connection->connect_error) {
    echo'not connected'. $db_connection->connect_error;
}
else {
    echo 'connected';
};