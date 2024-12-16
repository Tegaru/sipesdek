<?php
require_once '../../config/koneksi.php';

$id_sekolah = $_GET['id'];
$query = "SELECT * FROM sekolah WHERE id_sekolah = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id_sekolah);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$sekolah = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_sekolah = mysqli_real_escape_string($conn, $_POST['nama_sekolah']);
    $kategori = $_POST['kategori'];
    $status = $_POST['status'];
    $tahun_berdiri = $_POST['tahun_berdiri'];
    $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jumlah_siswa = $_POST['jumlah_siswa'];
    $jumlah_kelas = $_POST['jumlah_kelas'];

    $gambar_name = $sekolah['gambar']; 
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = $_FILES['gambar'];
        $gambar_name = time() . "_" . basename($gambar['name']); 
        $target_dir = "../../assets/img/upload/";
        $target_file = $target_dir . $gambar_name;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            die("Tipe file tidak diizinkan. Harap upload file JPG, JPEG, PNG, atau GIF.");
        }

        if (move_uploaded_file($gambar['tmp_name'], $target_file)) {
            if ($sekolah['gambar'] && file_exists("../../assets/img/upload/" . $sekolah['gambar'])) {
                unlink("../../assets/img/upload/" . $sekolah['gambar']);
            }
        } else {
            die("Gagal mengunggah gambar.");
        }
    }

    $query = "UPDATE sekolah SET 
              nama_sekolah = ?, 
              kategori = ?, 
              status = ?, 
              tahun_berdiri = ?, 
              no_telp = ?, 
              alamat = ?, 
              jumlah_siswa = ?, 
              jumlah_kelas = ?, 
              gambar = ? 
              WHERE id_sekolah = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssssissi", 
        $nama_sekolah, $kategori, $status, $tahun_berdiri, 
        $no_telp, $alamat, $jumlah_siswa, $jumlah_kelas, 
        $gambar_name, $id_sekolah);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: sekolah.php?success=edit");
        exit();
    } else {
        echo "Gagal menyimpan data.";
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
            <h5 class="card-title">Edit Data Sekolah</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nama Sekolah</label>
                    <input type="text" class="form-control" name="nama_sekolah" value="<?= $sekolah['nama_sekolah'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Ganti Foto</label>
                    <input type="file" class="form-control" name="gambar" accept="image/*">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select class="form-select" name="kategori" required>
                        <option value="SD/MI" <?= $sekolah['kategori'] == 'SD/MI' ? 'selected' : '' ?>>SD/MI</option>
                        <option value="SMP/MTS" <?= $sekolah['kategori'] == 'SMP/MTS' ? 'selected' : '' ?>>SMP/MTS</option>
                        <option value="SMA/SMK" <?= $sekolah['kategori'] == 'SMA/SMK' ? 'selected' : '' ?>>SMA/SMK</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Sekolah</label>
                    <select class="form-select" name="status" required>
                        <option value="Negeri" <?= $sekolah['status'] == 'Negeri' ? 'selected' : '' ?>>Negeri</option>
                        <option value="Swasta" <?= $sekolah['status'] == 'Swasta' ? 'selected' : '' ?>>Swasta</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahun Berdiri</label>
                    <input type="number" class="form-control" name="tahun_berdiri" value="<?= $sekolah['tahun_berdiri'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No Telp</label>
                    <input type="text" class="form-control" name="no_telp" value="<?= $sekolah['no_telp'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat Sekolah</label>
                    <input type="text" class="form-control" name="alamat" value="<?= $sekolah['alamat'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Siswa</label>
                    <input type="number" class="form-control" name="jumlah_siswa" value="<?= $sekolah['jumlah_siswa'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Kelas</label>
                    <input type="number" class="form-control" name="jumlah_kelas" value="<?= $sekolah['jumlah_kelas'] ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-arrow-clockwise me-2"></i>Perbarui
                </button>
                <a href="sekolah.php" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </form>
        </div>
    </div>
</div>

</body>
</html> 

<?php require_once '../templates/footer.php'; ?>
