<?php
include('db.php'); // Sambungkan ke pangkalan data

// Dapatkan semua data daripada jadual pekerja
$sql = "SELECT * FROM pekerja";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Maklumat Pekerja</title>
  </head>
  <body style="background-color: black; color: white;">
    <div class="p-4 rounded mt-3" style="background-color: white; color: black; border-radius: 15px; width: 98%; margin: auto;">
      <h5>ANISHOLDINGS SDN.BHD.</h5>
      <a href="add.php" class="btn btn-success mb-3">ADD</a>
    </div>

    <div class="mt-3">
      <h3 class="text-center">SENARAI PEKERJA</h3>
    </div>

    <table class="table table-hover text-center mt-3" style="border-radius: 15px; overflow: hidden; width: 98%; margin: auto; border: none;">
      <thead class="table-dark">
        <tr>
          <th>NO</th>
          <th>NAMA PEKERJA</th>
          <th>NO KP</th>
          <th>NO HP</th>
          <th>JANTINA</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr style='background-color: grey; color: white;' id='row" . $row['id'] . "'>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['nama_pekerja'] . "</td>
                        <td>" . $row['no_kp'] . "</td>
                        <td>" . $row['no_hp'] . "</td>
                        <td>" . $row['jantina'] . "</td>
                        <td>
                            <a href='update.php?id=" . $row['id'] . "' class='btn btn-warning'>UPDATE</a>
                            <button class='btn btn-danger' onclick='openDeleteModal(" . $row['id'] . ")'>DELETE</button>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Tiada data pekerja.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <!-- Modal Delete -->
    <div id="deleteModal" style="display:none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.4);">
      <div style="background-color:white; margin: 15% auto; padding: 20px; border-radius: 10px; width: 80%; max-width: 500px;">
      <div style="font-size: 20px; font-weight: bold; color: black; display: flex; justify-content: space-between; align-items: center;">
                <span>DELETE!</span>
                <!-- Butang Tutup (×) -->
                <button type="button" style="background: none; border: none; font-size: 25px; color: black;" onclick="closeModal()">×</button>
            </div>
            <hr style="border: 1px solid black; margin-top: 5px; margin-bottom: 15px;">
        <div style="font-size: 20px; font-weight: bold; color: black; text-align: center;">Adakah anda pasti untuk menghapuskan rekod ini?</div>
        <div style="color: black; text-align: center;">Sila Pastikan dengan betul!</div>
        <hr style="border: 1px solid black; margin-top: 5px; margin-bottom: 15px;">
        <div style="text-align: center;">
            <button type="button" class="btn btn-danger" id="confirmDeleteBtn">YES DELETE!</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
        </div>
      </div>
    </div>

    <script>
        var deleteId = null;

        function openDeleteModal(id) {
            deleteId = id;  // Simpan id rekod yang akan dipadam
            document.getElementById("deleteModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("deleteModal").style.display = "none";
        }

        // Fungsi untuk hapuskan data apabila butang 'YES DELETE!' diklik
        document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
            if (deleteId) {
                // Hantar permintaan untuk memadamkan data
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (xhr.status == 200) {
                        // Padamkan baris dari paparan
                        var row = document.getElementById("row" + deleteId);
                        row.remove();

                        // Tutup modal
                        closeModal();
                    }
                };
                xhr.send("id=" + deleteId);
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
