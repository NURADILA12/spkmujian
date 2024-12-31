<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maklumat_pekerja"; // Gantikan dengan nama pangkalan data anda

// Buat sambungan
$conn = new mysqli($servername, $username, $password, $dbname);

// Semak sambungan
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
