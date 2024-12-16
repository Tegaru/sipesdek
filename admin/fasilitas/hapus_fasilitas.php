<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_fasilitas = $_GET['id'];
    
    $query = "DELETE FROM fasilitas WHERE id_fasilitas = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_fasilitas);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: fasilitas.php?success=hapus");
    } else {
        header("Location: fasilitas.php?error=hapus");
    }
} else {
    header("Location: fasilitas.php");
}
exit();
?> 