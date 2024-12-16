<!DOCTYPE html>
<html>
<head>
    <title>SIPESDEK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                        url('assets/img/kelet.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 150px 0;
            margin-bottom: 50px;
        }
        
        #map { 
            height: 600px; 
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 2.5rem;
            color: #0d6efd;
            margin-bottom: 15px;
        }
        
        .filter-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .school-list {
            max-height: 500px;
            overflow-y: auto;
            padding: 15px;
        }
        
        .school-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .school-item:hover {
            transform: translateX(5px);
            background: #f8f9fa;
        }
        
        .custom-tooltip {
            background: white;
            border: none;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .progress {
    height: 25px;
    border-radius: 15px;
}

.progress-bar {
    line-height: 25px;
    font-size: 0.9rem;
}

.card {
    transition: transform 0.3s;
    border-radius: 15px;
}

.card:hover {
    transform: translateY(-5px);
}

footer {
    background: linear-gradient(45deg, #1a237e, #0d47a1);
}

footer a:hover {
    opacity: 0.8;
}

.img-fluid {
    transition: transform 0.3s;
}

.img-fluid:hover {
    transform: scale(1.02);
}

/* Animasi untuk statistik */
@keyframes countUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.stat-card {
    animation: countUp 0.5s ease-out forwards;
}

/* Custom scrollbar untuk daftar sekolah */
.school-list::-webkit-scrollbar {
    width: 8px;
}

.school-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.school-list::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.school-list::-webkit-scrollbar-thumb:hover {
    background: #555;
}
/* #beranda {
    background-image: url('assets/img/hero.jpeg'); /* Ganti dengan URL gambar Anda */
    /* background-size: cover; Mengatur gambar agar menutupi seluruh latar */
    /* background-position: center; Mengatur posisi gambar di tengah */
    /* background-repeat: no-repeat; Mencegah pengulangan gambar */
    /* height: 100vh; Mengatur tinggi elemen */
    /* display: flex; Membuat konten berpusat secara vertikal */
    /* align-items: center; Memusatkan konten secara vertikal */
    /* color: #fff; Memberikan warna teks agar kontras dengan latar */
/* }  */

#beranda {
    position: relative; 
    background-image: url('assets/img/hero.jpeg'); 
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    z-index: 1;
}

#beranda::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    z-index: -1; 
}

.nav-link.active {
	font-size: 16px;
	font-weight: 700;
}
.nav-link {
	font-size: 16px;
	font-weight: 400;
	color: #FFFFFF;
}

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-geo-alt-fill"></i> SIPESDEK
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#statistik">Statistik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#peta">Peta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#fasilitas">Fasilitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success ms-5" href="admin/login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Sistem Informasi Geografis Sekolah</h1>
            <h2 class="h3 mb-4">Desa Kelet, Kecamatan Keling, Kabupaten Jepara</h2>
            <p class="lead mb-4">Temukan informasi lengkap tentang sekolah-sekolah di Desa Kelet</p>
            <a href="#peta" class="btn btn-primary btn-lg px-4">
                <i class="bi bi-map"></i> Lihat Peta
            </a>
        </div>
    </section>

    

    <!-- Statistik Section -->
    <section id="statistik" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Statistik Sekolah</h2>
            <div class="row">
                <?php
                require_once 'config/koneksi.php';
                
                $query = "SELECT kategori, COUNT(*) as jumlah FROM sekolah GROUP BY kategori";
                $result = mysqli_query($conn, $query);
                
                $icons = [
                    'SD/MI' => 'bi-book',
                    'SMP/MTS' => 'bi-journal-text',
                    'SMA/SMK' => 'bi-mortarboard'
                ];
                
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-md-4">
                            <div class="stat-card text-center">
                                <i class="bi '.$icons[$row['kategori']].' stat-icon"></i>
                                <h3>'.$row['jumlah'].'</h3>
                                <p class="mb-0">'.$row['kategori'].'</p>
                            </div>
                          </div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Peta Section -->
    <section id="peta" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Peta Persebaran Sekolah</h2>
            
            <div class="row">
                <div class="col-md-9">
                    <div class="filter-box mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <select class="form-select" id="filterKategori">
                                    <option value="">Semua Kategori</option>
                                    <option value="SD/MI">SD/MI</option>
                                    <option value="SMP/MTS">SMP/MTS</option>
                                    <option value="SMA/SMK">SMA/SMK</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" id="filterStatus">
                                    <option value="">Semua Status</option>
                                    <option value="Negeri">Negeri</option>
                                    <option value="Swasta">Swasta</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="searchSekolah" placeholder="Cari sekolah...">
                            </div>
                        </div>
                    </div>
                    <div id="map"></div>
                </div>
                <div class="col-md-3">
                    <div class="school-list" id="schoolList">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Desa Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="assets/img/desa-kelet.png" class="img-fluid rounded-3 shadow" alt="Desa Kelet">
            </div>
            <div class="col-md-6">
                <h2 class="mb-4">Desa Kelet</h2>
                <p class="lead mb-4">Desa Kelet merupakan salah satu desa di Kecamatan Keling, Kabupaten Jepara, Jawa Tengah.</p>
                <div class="row g-4">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill text-primary fs-3 me-3"></i>
                            <div>
                                <h6 class="mb-1">Lokasi</h6>
                                <p class="mb-0">Kecamatan Keling</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-people-fill text-primary fs-3 me-3"></i>
                            <div>
                                <h6 class="mb-1">Penduduk</h6>
                                <p class="mb-0">± 5.000 Jiwa</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-map-fill text-primary fs-3 me-3"></i>
                            <div>
                                <h6 class="mb-1">Luas Wilayah</h6>
                                <p class="mb-0">± 500 Ha</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-building text-primary fs-3 me-3"></i>
                            <div>
                                <h6 class="mb-1">Jumlah Sekolah</h6>
                                <p class="mb-0"><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sekolah")); ?> Sekolah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fasilitas Section -->
<section id="fasilitas" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Fasilitas Sekolah</h2>
        <div class="row">
            <?php
            $query_fasilitas = "SELECT jenis_fasilitas, COUNT(*) as jumlah, 
                               COUNT(CASE WHEN kondisi_fasilitas = 'Baik' THEN 1 END) as kondisi_baik
                               FROM fasilitas 
                               GROUP BY jenis_fasilitas";
            $result_fasilitas = mysqli_query($conn, $query_fasilitas);
            
            $icons = [
                'Laboratorium' => 'bi-laptop',
                'Perpustakaan' => 'bi-book',
                'Lapangan Olahraga' => 'bi-trophy'
            ];
            
            while ($fasilitas = mysqli_fetch_assoc($result_fasilitas)) {
                $icon = $icons[$fasilitas['jenis_fasilitas']] ?? 'bi-building';
                $persentase = round(($fasilitas['kondisi_baik'] / $fasilitas['jumlah']) * 100);
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi <?= $icon ?> text-primary fs-1 mb-3"></i>
                            <h4><?= $fasilitas['jenis_fasilitas'] ?></h4>
                            <p class="text-muted mb-3">Total: <?= $fasilitas['jumlah'] ?></p>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" 
                                     style="width: <?= $persentase ?>%">
                                    <?= $persentase ?>% Kondisi Baik
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">SIG Sekolah Desa Kelet</h5>
                <p>Sistem informasi geografis untuk pemetaan dan informasi sekolah di wilayah Desa Kelet, Kecamatan Keling, Kabupaten Jepara.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Kontak</h5>
                <p class="mb-1"><i class="bi bi-geo-alt-fill me-2"></i> Desa Kelet, Kec. Keling</p>
                <p class="mb-1"><i class="bi bi-envelope-fill me-2"></i> info@desakelet.com</p>
                <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i> (0291) 123456</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Link Terkait</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="https://jepara.go.id" class="text-white text-decoration-none">
                            <i class="bi bi-link-45deg me-2"></i>Portal Kab. Jepara
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="bi bi-link-45deg me-2"></i>Website Desa Kelet
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="text-white text-decoration-none">
                            <i class="bi bi-link-45deg me-2"></i>Data Sekolah
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p class="mb-0">&copy; <?= date('Y') ?> SIPESDEK. All rights reserved.</p>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.49939, 110.9053], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var markers = [];
        
        function loadSchools() {
            fetch('admin/sekolah/get_sekolah.php')
                .then(response => response.json())
                .then(data => {

                    markers.forEach(marker => map.removeLayer(marker));
                    markers = [];
                    
                    const schoolList = document.getElementById('schoolList');
                    schoolList.innerHTML = '';
                    
                    const kategori = document.getElementById('filterKategori').value;
                    const status = document.getElementById('filterStatus').value;
                    const search = document.getElementById('searchSekolah').value.toLowerCase();
                    
                    data.forEach(school => {
                        if ((kategori === '' || school.kategori === kategori) &&
                            (status === '' || school.status === status) &&
                            (search === '' || school.nama_sekolah.toLowerCase().includes(search))) {
                            
                            const marker = L.marker([school.latitude, school.longitude])
                                .bindPopup(`
                                <div class="d-flex justify-content-center">
                                <img class="mb-1" src="assets/img/upload/${school.gambar}" width="150" weight="50">
                                </div>
                                    <div class="custom-tooltip">
                                        <h6>${school.nama_sekolah}</h6>
                                        <p class="mb-1">Kategori: ${school.kategori}</p>
                                        
                                        <p class="mb-1">Status: ${school.status}</p>
                                        <p class="mb-0">Alamat: ${school.alamat}</p>
                                        <p class="mb-0">No Telp: ${school.no_telp}</p>
                                        <p class="mb-0">Jumlah Siswa: ${school.jumlah_siswa}</p>
                                        <p class="mb-0">Jumlah Kelas: ${school.jumlah_kelas}</p>
                                    </div>
                                `);
                            marker.addTo(map);
                            markers.push(marker);
                            
                            const schoolItem = document.createElement('div');
                            schoolItem.className = 'school-item';
                            schoolItem.innerHTML = `
                                <h6 class="mb-1">${school.nama_sekolah}</h6>
                                <small class="text-muted d-block">Kategori: ${school.kategori}</small>
                                <small class="text-muted">Status: ${school.status}</small>
                            `;
                            schoolItem.onclick = () => {
                                map.setView([school.latitude, school.longitude], 17);
                                marker.openPopup();
                            };
                            schoolList.appendChild(schoolItem);
                        }
                    });
                });
        }

        document.getElementById('filterKategori').addEventListener('change', loadSchools);
        document.getElementById('filterStatus').addEventListener('change', loadSchools);
        document.getElementById('searchSekolah').addEventListener('input', loadSchools);
        
        loadSchools();

        fetch('assets/data/batas_kelet.geojson')
            .then(response => response.json())
            .then(data => {
                L.geoJSON(data, {
                    style: {
                        color: '#0d6efd',
                        weight: 2,
                        opacity: 0.6,
                        fillOpacity: 0.1
                    }
                }).addTo(map);
            });
    </script>

 </body>
<script>
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Animasi untuk angka statistik
function animateValue(obj, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        obj.innerHTML = Math.floor(progress * (end - start) + start);
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const target = entry.target.querySelector('h3');
            if (target) {
                animateValue(target, 0, parseInt(target.innerText), 1000);
            }
        }
    });
}, { threshold: 0.5 });

document.querySelectorAll('.stat-card').forEach(card => observer.observe(card));
</script>
</body>
</html> 