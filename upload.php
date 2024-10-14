<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jilid_id = $_POST['jilid_id'];
    $nomor_halaman = $_POST['nomor_halaman'];
    $teks_bacaan_1 = $_POST['teks_bacaan_1'];
    $teks_bacaan_2 = $_POST['teks_bacaan_2'];
    $teks_arab_1 = $_POST['teks_arab_1'];
    $teks_arab_2 = $_POST['teks_arab_2'];

    // Unggah file audio 1
    $target_dir = "uploads/";
    $file_audio_1 = $target_dir . basename($_FILES["file_audio_1"]["name"]);
    move_uploaded_file($_FILES["file_audio_1"]["tmp_name"], $file_audio_1);

    // Unggah file audio 2
    $file_audio_2 = isset($_FILES["file_audio_2"]) ? $target_dir . basename($_FILES["file_audio_2"]["name"]) : NULL;
    if ($file_audio_2) {
        move_uploaded_file($_FILES["file_audio_2"]["tmp_name"], $file_audio_2);
    }

    $sql = "INSERT INTO halaman (jilid_id, nomor_halaman, teks_bacaan_1, teks_bacaan_2, teks_arab_1, teks_arab_2, file_audio_1, file_audio_2) VALUES ('$jilid_id', '$nomor_halaman', '$teks_bacaan_1', '$teks_bacaan_2', '$teks_arab_1', '$teks_arab_2', '$file_audio_1', '$file_audio_2')";

    if ($conn->query($sql) === TRUE) {
        echo "Halaman berhasil diunggah!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unggah Halaman</title>
</head>
<body>
    <h1>Unggah Halaman Tilawati</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="jilid_id">Pilih Jilid:</label>
        <select name="jilid_id" id="jilid_id" required>
            <?php
            $jilid_query = "SELECT * FROM jilid";
            $jilid_result = $conn->query($jilid_query);
            while ($jilid = $jilid_result->fetch_assoc()) {
                echo "<option value='" . $jilid['id'] . "'>" . $jilid['deskripsi'] . "</option>";
            }
            ?>
        </select>

        <label for="nomor_halaman">Nomor Halaman:</label>
        <input type="number" name="nomor_halaman" required>

        <label for="teks_bacaan_1">Teks Bacaan 1:</label>
        <textarea name="teks_bacaan_1" required></textarea>

        <label for="teks_bacaan_2">Teks Bacaan 2:</label>
        <textarea name="teks_bacaan_2"></textarea>

        <label for="teks_arab_1">Teks Arab 1:</label>
        <textarea name="teks_arab_1" required></textarea>

        <label for="teks_arab_2">Teks Arab 2:</label>
        <textarea name="teks_arab_2"></textarea>

        <label for="file_audio_1">File Audio 1:</label>
        <input type="file" name="file_audio_1" required>

        <label for="file_audio_2">File Audio 2:</label>
        <input type="file" name="file_audio_2">

        <input type="submit" value="Unggah">
    </form>
</body>
</html>
