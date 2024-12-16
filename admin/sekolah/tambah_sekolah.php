<?php
require_once '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_sekolah = mysqli_real_escape_string($conn, $_POST['nama_sekolah']);
    $kategori = $_POST['kategori'];
    $status = $_POST['status'];
    $tahun_berdiri = $_POST['tahun_berdiri'];
    $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jumlah_siswa = $_POST['jumlah_siswa'];
    $jumlah_kelas = $_POST['jumlah_kelas'];

    // Proses upload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = $_FILES['gambar'];
        $gambar_name = time() . "_" . basename($gambar['name']); // Nama file unik
        $target_dir = "../../assets/img/upload/"; // Folder tujuan
        $target_file = $target_dir . $gambar_name;

        // Validasi tipe file gambar
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            die("Tipe file tidak diizinkan. Harap upload file JPG, JPEG, PNG, atau GIF.");
        }

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($gambar['tmp_name'], $target_file)) {
            // Simpan data ke database
            $query = "INSERT INTO sekolah (nama_sekolah, kategori, status, tahun_berdiri, no_telp, alamat, jumlah_siswa, jumlah_kelas, gambar) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "ssssssiss", $nama_sekolah, $kategori, $status, $tahun_berdiri, $no_telp, $alamat, $jumlah_siswa, $jumlah_kelas, $gambar_name);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: sekolah.php?success=tambah");
                exit();
            } else {
                echo "Gagal menyimpan data.";
            }
        } else {
            echo "Gagal mengunggah gambar.";
        }
    } else {
        die("Tidak ada file yang diunggah atau terjadi kesalahan.");
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
            <h5 class="card-title">Tambah Data Sekolah</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nama Sekolah</label>
                    <input type="text" class="form-control" name="nama_sekolah" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Sekolah</label>
                    <input type="file" class="form-control" name="gambar" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select class="form-select" name="kategori" required>
                        <option value="SD/MI">SD/MI</option>
                        <option value="SMP/MTS">SMP/MTS</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status" required>
                        <option value="Negeri">Negeri</option>
                        <option value="Swasta">Swasta</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tahun Berdiri</label>
                    <input type="number" class="form-control" name="tahun_berdiri" min="1900" max="<?= date('Y') ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No Telepon</label>
                    <input type="text" class="form-control" name="no_telp" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Siswa</label>
                    <input type="number" class="form-control" name="jumlah_siswa" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah Kelas</label>
                    <input type="number" class="form-control" name="jumlah_kelas" required>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle me-2"></i>Simpan
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