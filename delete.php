<?php
include('db.php'); // Sambungkan ke pangkalan data

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Minta padamkan rekod daripada pangkalan data
    $sql = "DELETE FROM pekerja WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Rekod berjaya dipadam";
    } else {
        echo "Ralat semasa memadam rekod";
    }

    $stmt->close();
}
$conn->close();
?>
