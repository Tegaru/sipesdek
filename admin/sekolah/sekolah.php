<?php
require_once '../../config/koneksi.php';

$query = "SELECT * FROM sekolah ORDER BY id_sekolah DESC";
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
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-building me-2"></i>Data Sekolah</h2>
        <a href="tambah_sekolah.php" class="btn btn-primary">
            <i class="bi bi-plus"></i> Tambah Sekolah
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
                            <th>Foto</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Tahun</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>J_Siswa</th>
                            <th>J_Kelas</th>
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
                            <td><img src="../../assets/img/upload/<?= $row['gambar'] ?>" alt="Foto" width="50"></td>
                            <td><?= $row['kategori'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td><?= $row['tahun_berdiri'] ?></td>
                            <td><?= $row['no_telp'] ?></td>
                            <td><?= $row['alamat'] ?></td>
                            <td><?= $row['jumlah_siswa'] ?></td>
                            <td><?= $row['jumlah_kelas'] ?></td>
                            <td>
                                <a href="edit_sekolah.php?id=<?= $row['id_sekolah'] ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="detail_sekolah.php?id=<?= $row['id_sekolah'] ?>" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="hapus_sekolah.php?id=<?= $row['id_sekolah'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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