<?php
require_once '../../config/koneksi.php';

$query = "SELECT l.*, s.nama_sekolah 
          FROM lokasi l 
          JOIN sekolah s ON l.id_sekolah = s.id_sekolah 
          ORDER BY l.id_lokasi DESC";
$result = mysqli_query($conn, $query);
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-geo-alt-fill me-2"></i>Data Lokasi</h2>
        <a href="tambah_lokasi.php" class="btn btn-primary">
            <i class="bi bi-plus"></i> Tambah Lokasi
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sekolah</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while($row = mysqli_fetch_assoc($result)): 
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nama_sekolah'] ?></td>
                            <td><?= $row['latitude'] ?></td>
                            <td><?= $row['longitude'] ?></td>
                            <td>
                                <a href="edit_lokasi.php?id=<?= $row['id_lokasi'] ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="hapus_lokasi.php?id=<?= $row['id_lokasi'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html> 

<?php require_once '../templates/footer.php'; ?> 