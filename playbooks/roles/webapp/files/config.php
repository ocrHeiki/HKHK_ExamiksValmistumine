<?php
$host = '10.0.24.50';
$user = 'kasutaja';
$pass = 'parool';
$db = 'kasutajatugi_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Ühendus ebaõnnestus: " . $conn->connect_error);
}
?>
