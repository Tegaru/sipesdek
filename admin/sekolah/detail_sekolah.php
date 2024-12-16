<?php
require_once '../../config/koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<div class='alert alert-danger'>ID sekolah tidak ditemukan!</div>";
    require_once '../templates/footer.php';
    exit();
}

$id_sekolah = intval($_GET['id']);

$query_sekolah = "
    SELECT 
        sekolah.*, 
        GROUP_CONCAT(CONCAT(fasilitas.jenis_fasilitas, ' (', fasilitas.kondisi_fasilitas, ')') SEPARATOR ', ') AS fasilitas_dan_kondisi
    FROM sekolah
    LEFT JOIN fasilitas ON fasilitas.id_sekolah = sekolah.id_sekolah
    WHERE sekolah.id_sekolah = $id_sekolah
    GROUP BY sekolah.id_sekolah
";
$result = mysqli_query($conn, $query_sekolah);

if (mysqli_num_rows($result) === 0) {
    echo "<div class='alert alert-danger'>Data sekolah tidak ditemukan!</div>";
    require_once 'templates/footer.php';
    exit();
}

$sekolah = mysqli_fetch_assoc($result); 

?>

<!DOCTYPE html>
<html>
<head>
    <title>SIPESDEK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    @media print {
        .no-print {
            display: none;
        }
    }
</style>
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
                        <a class="nav-link active" href="sekolah.php">
                            <i class="bi bi-building me-2"></i>Data Sekolah
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../fasilitas/fasilitas.php">
                            <i class="bi bi-box me-2"></i>Data Fasilitas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../lokasi/lokasi.php">
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
                Detail Data Sekolah
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>Nama Sekolah</th>
                    <td><?php echo htmlspecialchars($sekolah['nama_sekolah']); ?></td>
                </tr>
                <tr>
                    <th>Foto</th>
                    <td>
                        <?php if (!empty($sekolah['gambar']) && file_exists("../../assets/img/upload/" . $sekolah['gambar'])): ?>
                            <img src="../../assets/img/upload/<?php echo htmlspecialchars($sekolah['gambar']); ?>" alt="Foto Sekolah" style="max-width: 200px;">
                        <?php else: ?>
                            <img src="../../assets/img/default.png" alt="Foto Default" style="max-width: 200px;">
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td><?php echo htmlspecialchars($sekolah['kategori']); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php echo htmlspecialchars($sekolah['status']); ?></td>
                </tr>
                <tr>
                    <th>Tahun Berdiri</th>
                    <td><?php echo htmlspecialchars($sekolah['tahun_berdiri']); ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?php echo htmlspecialchars($sekolah['alamat']); ?></td>
                </tr>
                <tr>
                    <th>Jumlah Siswa</th>
                    <td><?php echo htmlspecialchars($sekolah['jumlah_siswa']); ?></td>
                </tr>
                <tr>
                    <th>Jumlah Kelas</th>
                    <td><?php echo htmlspecialchars($sekolah['jumlah_kelas']); ?></td>
                </tr>
                <tr>
                    <th>Fasilitas</th>
                    <td><?php echo htmlspecialchars($sekolah['fasilitas_dan_kondisi'] ?: 'Tidak ada fasilitas'); ?></td>
                </tr>
            </table>
        </div>

        <button class="btn btn-primary mt-3 mb-3 no-print" onclick="window.print()">
            <i class="bi bi-printer"></i> Cetak
        </button> 
        <a href="../dashboard.php" class="btn btn-secondary mt-3 mb-3 no-print"><i class="bi bi-house-door me-2"></i>Kembali</a>
    </div>
</body>
</html> 

<?php require_once '../templates/footer.php'; ?>
