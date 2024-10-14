<?php
header('Content-Type: application/json');
include 'db.php'; // Masukkan file koneksi database

// Mengambil jilid
if (isset($_GET['action']) && $_GET['action'] == 'getJilid') {
    $result = $conn->query("SELECT * FROM jilid");
    $jilid = [];
    while ($row = $result->fetch_assoc()) {
        $jilid[] = $row;
    }
    echo json_encode($jilid);
    exit;
}

// Mengambil halaman berdasarkan jilid
if (isset($_GET['action']) && $_GET['action'] == 'getHalaman' && isset($_GET['jilid_id'])) {
    $jilid_id = intval($_GET['jilid_id']); // Sanitasi input
    $result = $conn->query("SELECT * FROM halaman WHERE jilid_id = $jilid_id");
    $halaman = [];
    while ($row = $result->fetch_assoc()) {
        $halaman[] = $row;
    }
    echo json_encode($halaman);
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
?>
