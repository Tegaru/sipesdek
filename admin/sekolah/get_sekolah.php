<?php
require_once '../../config/koneksi.php';

$query = "SELECT s.*, l.latitude, l.longitude 
          FROM sekolah s 
          JOIN lokasi l ON s.id_sekolah = l.id_sekolah";
$result = mysqli_query($conn, $query);

$schools = [];
while ($row = mysqli_fetch_assoc($result)) {
    $schools[] = $row;
}

header('Content-Type: application/json');
echo json_encode($schools);
?> 