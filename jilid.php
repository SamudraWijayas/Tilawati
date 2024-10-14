<?php
// Koneksi ke database
include 'db.php';


// Ambil jilid_id dari parameter URL
$jilid_id = isset($_GET['jilid_id']) ? (int)$_GET['jilid_id'] : 1;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Query untuk mengambil halaman berdasarkan jilid dan nomor halaman
$query = "SELECT * FROM halaman WHERE jilid_id = $jilid_id AND nomor_halaman = $current_page";
$result = $conn->query($query);

// Cek apakah halaman ditemukan
if ($result->num_rows == 0) {
    echo "<h2>Halaman tidak ditemukan!</h2>";
    exit;
}

$halaman = $result->fetch_assoc();

// Query untuk mendapatkan total halaman dari jilid yang dipilih
$total_query = "SELECT COUNT(*) as total FROM halaman WHERE jilid_id = $jilid_id";
$total_result = $conn->query($total_query);
$total_halaman = $total_result->fetch_assoc()['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jilid <?php echo $jilid_id; ?> - Halaman <?php echo $halaman['nomor_halaman']; ?></title>
    <style>
        h1 {
            color: #d32f2f;
        }
        .content {
            margin: 20px 0;
        }
        audio {
            margin: 10px 0;
        }
        .kolom {
            margin: 20px 0;
        }
        .pagination {
            margin: 20px 0;
        }
        .pagination a {
            padding: 10px;
            text-decoration: none;
            background-color: #d32f2f;
            color: white;
            border-radius: 5px;
            margin: 5px;
        }
        .pagination a.disabled {
            background-color: grey;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <h1>Jilid <?php echo $jilid_id; ?> - Halaman <?php echo $halaman['nomor_halaman']; ?></h1>

    <div class="content">
        <!-- Kolom 1 -->
        <div class="kolom">
            <strong>Teks Bacaan Kolom 1:</strong> <?php echo $halaman['teks_bacaan_1']; ?><br>
            <strong>Teks Arab Kolom 1:</strong> <?php echo $halaman['teks_arab_1']; ?><br>
            <audio controls>
                <source src="audio/<?php echo $halaman['file_audio_1']; ?>" type="audio/mpeg">
                Browser Anda tidak mendukung elemen audio.
            </audio>
        </div>

        <!-- Kolom 2 (jika ada) -->
        <?php if (!empty($halaman['teks_bacaan_2'])): ?>
        <div class="kolom">
            <strong>Teks Bacaan Kolom 2:</strong> <?php echo $halaman['teks_bacaan_2']; ?><br>
            <strong>Teks Arab Kolom 2:</strong> <?php echo $halaman['teks_arab_2']; ?><br>
            <audio controls>
                <source src="audio/<?php echo $halaman['file_audio_2']; ?>" type="audio/mpeg">
                Browser Anda tidak mendukung elemen audio.
            </audio>
        </div>
        <?php endif; ?>

        <!-- Kolom 3 (jika ada) -->
        <?php if (!empty($halaman['teks_bacaan_3'])): ?>
        <div class="kolom">
            <strong>Teks Bacaan Kolom 3:</strong> <?php echo $halaman['teks_bacaan_3']; ?><br>
            <strong>Teks Arab Kolom 3:</strong> <?php echo $halaman['teks_arab_3']; ?><br>
            <audio controls>
                <source src="audio/<?php echo $halaman['file_audio_3']; ?>" type="audio/mpeg">
                Browser Anda tidak mendukung elemen audio.
            </audio>
        </div>
        <?php endif; ?>
    </div>

    <!-- Navigasi Halaman -->
    <div class="pagination">
        <a href="?jilid_id=<?php echo $jilid_id; ?>&page=<?php echo $current_page - 1; ?>" class="<?php echo ($current_page <= 1) ? 'disabled' : ''; ?>">Previous</a>
        <a href="?jilid_id=<?php echo $jilid_id; ?>&page=<?php echo $current_page + 1; ?>" class="<?php echo ($current_page >= $total_halaman) ? 'disabled' : ''; ?>">Next</a>
    </div>
</body>
</html>
