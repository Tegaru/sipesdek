<?php
require_once '../../config/koneksi.php';

$query_sekolah = "SELECT s.id_sekolah, s.nama_sekolah, 
                         CASE WHEN l.id_lokasi IS NULL THEN 1 ELSE 0 END AS is_unlocated
                  FROM sekolah s
                  LEFT JOIN lokasi l ON s.id_sekolah = l.id_sekolah
                  ORDER BY is_unlocated DESC, s.nama_sekolah";
$result_sekolah = mysqli_query($conn, $query_sekolah);

if (!$result_sekolah) {
    die("Query gagal: " . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_sekolah = $_POST['id_sekolah'];
    $latitude = mysqli_real_escape_string($conn, $_POST['latitude']);
    $longitude = mysqli_real_escape_string($conn, $_POST['longitude']);

    $query = "INSERT INTO lokasi (id_sekolah, latitude, longitude) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "iss", $id_sekolah, $latitude, $longitude);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: lokasi.php?success=tambah");
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
            <h5 class="card-title">Tambah Lokasi Sekolah</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Sekolah</label>
                    <select class="form-select" name="id_sekolah" required>
                        <option value="">Pilih Sekolah</option>
                        <?php 
                        if (mysqli_num_rows($result_sekolah) > 0): 
                            while ($sekolah = mysqli_fetch_assoc($result_sekolah)): ?>
                                <option value="<?= $sekolah['id_sekolah'] ?>"><?= $sekolah['nama_sekolah'] ?></option>
                            <?php endwhile; 
                        else: ?>
                            <option value="">Tidak ada sekolah tersedia</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Latitude</label>
                    <input type="text" class="form-control" name="latitude" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Longitude</label>
                    <input type="text" class="form-control" name="longitude" required>
                </div>
                <div class="mb-3">
                    <div id="map" style="height: 400px;"></div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-2"></i>Simpan</button>
                <a href="lokasi.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                
            </form>
        </div>
    </div>
</div>
</body>
</html> 

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-6.2088, 106.8456], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var marker;

    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
        document.querySelector('input[name="latitude"]').value = e.latlng.lat;
        document.querySelector('input[name="longitude"]').value = e.latlng.lng;
    });
</script>

<?php require_once '../templates/footer.php'; ?>
