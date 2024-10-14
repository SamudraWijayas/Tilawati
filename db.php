<?php
$servername = "localhost";
$username = "root";
$password = ""; // Ganti dengan password database Anda
$dbname = "tilawati"; // Ganti dengan nama database Anda

// Koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
