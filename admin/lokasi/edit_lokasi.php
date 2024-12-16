<?php
require_once '../../config/koneksi.php';

$id_lokasi = $_GET['id'];

$query = "SELECT l.*, s.nama_sekolah 
          FROM lokasi l 
          JOIN sekolah s ON l.id_sekolah = s.id_sekolah 
          WHERE l.id_lokasi = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id_lokasi);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$lokasi = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $latitude = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($conn, $_POST['longitude']);

    $query = "UPDATE lokasi SET latitude = ?, longitude = ? WHERE id_lokasi = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $latitude, $longitude, $id_lokasi);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>
                alert('Data lokasi berhasil diupdate!');
                window.location.href = 'lokasi.php';
              </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>SIPESDEK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php"><i class="bi bi-geo-alt-fill"></i>SIPESDEK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard.php">
                            <i class="bi bi-house-door me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../sekolah/sekolah.php">
                            <i class="bi bi-building me-2"></i>Data Sekolah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../fasilitas/fasilitas.php">
                            <i class="bi bi-box me-2"></i>Data Fasilitas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="lokasi.php">
                            <i class="bi bi-geo-alt-fill me-2"></i>Data Lokasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/user.php">
                            <i class="bi bi-people-fill me-2"></i>Data User
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-success" href="../logout.php">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Lokasi - <?= $lokasi['nama_sekolah'] ?></h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Latitude</label>
                    <input type="text" class="form-control" name="latitude" value="<?= $lokasi['latitude'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Longitude</label>
                    <input type="text" class="form-control" name="longitude" value="<?= $lokasi['longitude'] ?>" required>
                </div>
                <div class="mb-3">
                    <div id="map" style="height: 400px;"></div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-arrow-clockwise me-2"></i>Perbarui
                </button>
                <a href="lokasi.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </form>
        </div>
    </div>
</div>
</body>
</html> 

<!-- Leaflet JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([<?= $lokasi['latitude'] ?>, <?= $lokasi['longitude'] ?>], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
    
    var marker = L.marker([<?= $lokasi['latitude'] ?>, <?= $lokasi['longitude'] ?>]).addTo(map);
    
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.querySelector('input[name="latitude"]').value = e.latlng.lat;
        document.querySelector('input[name="longitude"]').value = e.latlng.lng;
    });
</script>

<?php require_once '../templates/footer.php'; ?> 