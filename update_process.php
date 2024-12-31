<?php
include('db.php'); // Sambungkan ke pangkalan data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data daripada borang
    $id = $_POST['id'];
    $nama_pekerja = $_POST['nama_pekerja'];
    $no_kp = $_POST['no_kp'];
    $no_hp = $_POST['no_hp'];
    $jantina = $_POST['jantina'];

    // Kemaskini data dalam pangkalan data
    $sql = "UPDATE pekerja SET nama_pekerja = ?, no_kp = ?, no_hp = ?, jantina = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $nama_pekerja, $no_kp, $no_hp, $jantina, $id);

    if ($stmt->execute()) {
        // Jika berjaya, redirect ke index.php dengan status berjaya
        header("Location: index.php?status=success");
    } else {
        // Jika gagal, redirect kembali dengan status gagal
        header("Location: index.php?status=failed");
    }
    exit;
}
?>
