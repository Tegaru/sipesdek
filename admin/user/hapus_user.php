<?php
session_start();
require_once '../../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_user = $_GET['id'];
    
    $query = "DELETE FROM user WHERE id_user = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_user);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: user.php?success=hapus");
    } else {
        header("Location: user.php?error=hapus");
    }
} else {
    header("Location: user.php");
}
exit();
?> 