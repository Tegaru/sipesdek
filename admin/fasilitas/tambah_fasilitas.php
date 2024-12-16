<?php
require_once '../../config/koneksi.php';

$query_sekolah = "SELECT id_sekolah, nama_sekolah FROM sekolah ORDER BY nama_sekolah";
$result_sekolah = mysqli_query($conn, $query_sekolah);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_sekolah = $_POST['id_sekolah'];
    $jenis_fasilitas = $_POST['jenis_fasilitas'];
    $kondisi_fasilitas = $_POST['kondisi_fasilitas'];
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    $query = "INSERT INTO fasilitas (id_sekolah, jenis_fasilitas, kondisi_fasilitas, keterangan) 
              VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "isss", $id_sekolah, $jenis_fasilitas, $kondisi_fasilitas, $keterangan);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: fasilitas.php?success=tambah");
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
                        <a class="nav-link active" href="fasilitas.php">
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
            <h5 class="card-title">Tambah Fasilitas</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Sekolah</label>
                    <select class="form-select" name="id_sekolah" required>
                        <option value="">Pilih Sekolah</option>
                        <?php while ($sekolah = mysqli_fetch_assoc($result_sekolah)): ?>
                            <option value="<?= $sekolah['id_sekolah'] ?>"><?= $sekolah['nama_sekolah'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jenis Fasilitas</label>
                    <select class="form-select" name="jenis_fasilitas" required>
                        <option value="Laboratorium">Laboratorium</option>
                        <option value="Perpustakaan">Perpustakaan</option>
                        <option value="Lapangan Olahraga">Lapangan Olahraga</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kondisi</label>
                    <select class="form-select" name="kondisi_fasilitas" required>
                        <option value="Baik">Baik</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Buruk">Buruk</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle me-2"></i>Simpan</button>
                <a href="fasilitas.php" class="btn btn-secondary"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
            </form>
        </div>
    </div>
</div>
</body>
</html> 

<?php require_once '../templates/footer.php'; ?> 