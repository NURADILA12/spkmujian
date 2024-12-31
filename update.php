<?php
include('db.php'); // Sambungkan ke pangkalan data

// Dapatkan data berdasarkan ID (contoh menggunakan 'id' daripada parameter GET)
$id = $_GET['id']; // Ambil ID daripada URL

// Dapatkan maklumat pekerja berdasarkan ID
$sql = "SELECT * FROM pekerja WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Simpan maklumat untuk digunakan dalam form
$nama_pekerja = $row['nama_pekerja'];
$no_kp = $row['no_kp'];
$no_hp = $row['no_hp'];
$jantina = $row['jantina'];
?>

<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pekerja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body style="background-color: black; color: white;">
  <div class="p-4 rounded mt-3" style="background-color: white; color: black; border-radius: 15px; width: 98%; margin: auto;">
    <button type="button" class="btn btn-primary mb-3" onclick="window.location.href='index.php';">
      BACK
    </button>
  </div>

  <div class="container mt-5">
    <div class="border p-4 rounded-3" style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: white; max-width: 900px; margin: auto;">
        <h3 style="color: black;">UPDATE MAKLUMAT <?php echo strtoupper($nama_pekerja); ?></h3>
        <!-- Form untuk update -->
        <form action="update_process.php" method="POST">
            <!-- ID tidak perlu ditunjukkan dalam form -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <!-- Nombor IC -->
            <div class="mt-3">
                <label for="no_kp" class="form-label" style="color: black;">NO IC</label>
                <input type="text" class="form-control" id="no_kp" name="no_kp" value="<?php echo $no_kp; ?>" required>
            </div>
            <!-- Nama Pekerja -->
            <div class="mt-3">
                <label for="nama_pekerja" class="form-label" style="color: black;">NAMA PEKERJA</label>
                <input type="text" class="form-control" id="nama_pekerja" name="nama_pekerja" value="<?php echo $nama_pekerja; ?>" required>
            </div>

            <!-- Nombor HP -->
            <div class="mt-3">
                <label for="no_hp" class="form-label" style="color: black;">NO HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $no_hp; ?>" required>
            </div>

            <!-- Jantina -->
            <div class="mt-3">
                <label for="jantina" class="form-label" style="color: black;">JANTINA</label>
                <select class="form-control" id="jantina" name="jantina" required>
                    <option value="Lelaki" <?php echo ($jantina == 'Lelaki') ? 'selected' : ''; ?>>Lelaki</option>
                    <option value="Perempuan" <?php echo ($jantina == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>

            <!-- Button untuk Update dan Clear -->
            <div class="mt-3 d-flex justify-content-between">
                <!-- Button Update -->
                <button type="submit" class="btn btn-warning">Update</button>
                <!-- Button Clear -->
                <button type="reset" class="btn btn-link">Clear</button>
            </div>
        </form>
    </div>
  </div>
</body>
</html>
