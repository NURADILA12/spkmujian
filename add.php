<?php
include('db.php'); // Sambungkan ke pangkalan data

// Semak jika borang dihantar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pekerja = $_POST['nama_pekerja'];
    $no_kp = $_POST['no_kp'];
    $no_hp = $_POST['no_hp'];
    $jantina = $_POST['jantina'];

    // Sediakan SQL untuk memasukkan data ke dalam pangkalan data
    $sql = "INSERT INTO pekerja (nama_pekerja, no_kp, no_hp, jantina) VALUES ('$nama_pekerja', '$no_kp', '$no_hp', '$jantina')";

    // Laksanakan SQL
    if ($conn->query($sql) === TRUE) {
        // Jika berjaya, redirect ke halaman index.php
        header("Location: index.php");
        exit(); // Pastikan tiada kod lain yang diproses selepas redirect
    } else {
        echo "Ralat: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pekerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body style="background-color: black; color: white;">
  <div class="p-4 rounded mt-3" style="background-color: white; color: black; border-radius: 15px; width: 98%; margin: auto;">
    <button type="button" class="btn btn-primary mb-3" onclick="window.location.href='index.php';">
      BACK
    </button>
  </div>

  <div class="container mt-5">
    <div class="border p-4 rounded-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: white; max-width: 600px; margin: auto;">
        <h2 style="color: black;">ADD MAKLUMAT</h2>
        <form action="add.php" method="POST">
            <div class="mt-3">
                <label for="no_kp" class="form-label" style="color: black;">NO KP</label>
                <input type="text" class="form-control" id="no_kp" name="no_kp" required>
            </div>

            <div class="mt-3">
                <label for="nama_pekerja" class="form-label" style="color: black;">NAMA PEKERJA</label>
                <input type="text" class="form-control" id="nama_pekerja" name="nama_pekerja" required>
            </div>

            <div class="mt-3">
                <label for="no_hp" class="form-label" style="color: black;">NO HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
            </div>

            <div class="mt-3">
                <label for="jantina" class="form-label" style="color: black;">JANTINA</label>
                <select class="form-control" id="jantina" name="jantina" required>
                    <option value="Lelaki">Lelaki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <!-- Container for buttons -->
            <div class="mt-3 d-flex justify-content-between">
                <!-- Add button on the left -->
                <button type="submit" class="btn btn-success">Add</button>
                <!-- Clear button on the right -->
                <button type="reset" class="btn btn-link">Clear</button>
            </div>
        </form>
    </div>
  </div>
</body>
</html>
