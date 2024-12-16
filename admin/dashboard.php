<?php
session_start();
require_once '../config/koneksi.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
} 

$query_total_sekolah = mysqli_query($conn, "SELECT COUNT(*) as total FROM sekolah");
$total_sekolah = mysqli_fetch_assoc($query_total_sekolah)['total'];

$query_kategori = mysqli_query($conn, "SELECT kategori, COUNT(*) as jumlah FROM sekolah GROUP BY kategori");
$statistik_kategori = mysqli_fetch_all($query_kategori, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard SIPESDEK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-geo-alt-fill"></i>SIPESDEK</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <i class="bi bi-house-door me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sekolah/sekolah.php">
                            <i class="bi bi-building me-2"></i>Data Sekolah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fasilitas/fasilitas.php">
                            <i class="bi bi-box me-2"></i>Data Fasilitas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lokasi/lokasi.php">
                            <i class="bi bi-geo-alt-fill me-2"></i>Data Lokasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="user/user.php">
                            <i class="bi bi-people-fill me-2"></i>Data User
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-success" href="logout.php">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
 
    <div class="container mt-4">
        <h2><i class="bi bi-house-door me-2"></i>Dashboard</h2>
        
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-container bg-white text-primary rounded-circle d-flex justify-content-center align-items-center me-3" 
                            style="width: 50px; height: 50px;">
                            <i class="bi bi-building" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5 class="card-title m-0">Total Sekolah</h5>
                            <h2 class="m-0"><?php echo $total_sekolah; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <?php foreach($statistik_kategori as $stat): ?>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-container bg-white text-success rounded-circle d-flex justify-content-center align-items-center me-3" 
                            style="width: 50px; height: 50px;">
                            <i class="bi bi-bar-chart-line" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5 class="card-title m-0"><?php echo $stat['kategori']; ?></h5>
                            <h2 class="m-0"><?php echo $stat['jumlah']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div id="map" style="height: 400px; margin-top: 20px;"></div>
        <div class="card mt-4">
            <div class="card-header">
                Data Sekolah Terbaru
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Sekolah</th>
                            <th>Foto Sekolah</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query_sekolah = mysqli_query($conn, "SELECT * FROM sekolah ORDER BY id_sekolah DESC LIMIT 5");
                        while($sekolah = mysqli_fetch_assoc($query_sekolah)):
                        ?>
                        <tr>
                            <td><?php echo $sekolah['nama_sekolah']; ?></td>
                            <td><img src="../assets/img/upload/<?= $sekolah['gambar'] ?>" alt="Foto" width="60"></td>
                            <td><?php echo $sekolah['kategori']; ?></td>
                            <td><?php echo $sekolah['status']; ?></td>
                            <td><?php echo $sekolah['alamat']; ?></td>
                            <td>
                                <a href="sekolah/detail_sekolah.php?id=<?php echo $sekolah['id_sekolah']; ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.49939, 110.9053], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

var markers = [];

function loadSchools() {
    fetch('sekolah/get_sekolah.php')
        .then(response => response.json())
        .then(data => {

            markers.forEach(marker => map.removeLayer(marker));
            markers = [];

            data.forEach(school => {
                if (school.latitude && school.longitude) {
                    const marker = L.marker([school.latitude, school.longitude])
                        .bindPopup(`
                            <img class="mb-1" src="../assets/img/upload/${school.gambar}" width="150" height="85" ><br>
                            <b>${school.nama_sekolah}</b><br>
                            Kategori: ${school.kategori}<br>
                            Latitude: ${school.latitude}<br>
                            Longitude: ${school.longitude}
                        `);
                    
                    marker.addTo(map);
                    markers.push(marker);
                }
            });
        })
        .catch(error => {
            console.error('Error loading school data:', error);
        });
}

loadSchools();
    </script>
</body>
</html>
