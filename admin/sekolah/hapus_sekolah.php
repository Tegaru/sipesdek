<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_sekolah = $_GET['id'];
    
    $query = "DELETE FROM sekolah WHERE id_sekolah = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_sekolah);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: sekolah.php?success=hapus");
    } else {
        header("Location: sekolah.php?error=hapus");
    }
} else {
    header("Location: sekolah.php");
}
exit();
?> 