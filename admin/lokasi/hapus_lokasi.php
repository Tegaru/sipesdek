<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_lokasi = $_GET['id'];
    
    $query = "DELETE FROM lokasi WHERE id_lokasi = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_lokasi);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: lokasi.php?success=hapus");
    } else {
        header("Location: lokasi.php?error=hapus");
    }
}
exit();
?> 