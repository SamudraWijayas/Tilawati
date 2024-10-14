<?php
// Koneksi ke database
include 'db.php';


// Ambil data jilid dari database
$query = "SELECT * FROM jilid";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tilawati - Daftar Jilid</title>
    <style>
        .card {
            display: inline-block;
            width: 150px;
            padding: 20px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            text-align: center;
            background-color: #f4f4f4;
            transition: 0.3s;
        }
        .card:hover {
            background-color: #d32f2f;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Daftar Jilid Tilawati</h1>

    <?php while($row = $result->fetch_assoc()): ?>
        <div class="card" onclick="window.location.href='jilid.php?jilid_id=<?php echo $row['id']; ?>'">
            <h2><?php echo $row['nama_jilid']; ?></h2>
        </div>
    <?php endwhile; ?>

</body>
</html>
