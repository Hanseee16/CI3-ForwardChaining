<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pakar | Forward Chaining</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="#hero"><span>Forward</span>Chaining</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto d-flex gap-2 gap-md-4">
                    <li class="nav-item">
                        <a class="nav-link <?= ($this->uri->segment(1) == '') ? 'active' : ''; ?>" aria-current="page" href="#hero">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang-kami">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#artikel">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-biru text-white shadow-sm rounded-5 px-4" href="<?= base_url('login'); ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- hero -->
    <section id="hero" class="hero">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-11 text-center">
                    <h1 class="display-3 text-capitalize mb-4">
                        Diagnosa Penyakit Demam Berdarah (DBD) Menggunakan Metode Forward Chaining
                    </h1>
                    <p class="lead mb-4">
                        Konsultasi ini menggunakan metode forward chaining untuk mendiagnosa penyakit demam berdarah (DBD).
                        Ikuti langkah-langkah yang diberikan untuk mendapatkan hasil diagnosa yang akurat.
                    </p>
                    <a href="<?= base_url('user/dashboard'); ?>" class="btn btn-primary text-white shadow-sm rounded-5 px-4 py-2">
                        Mulai Konsultasi
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- end hero -->

    <!-- tentang kami -->
    <section id="tentang-kami" class="tentang-kami">
        <div class="container px-4 px-md-0">
            <div class="row d-flex justify-content-center align-items-center gap-4 gap-md-0">
                <div class="mb-5">
                    <h2 class="text-center text-capitalize fw-bold">tentang kami</h2>
                    <div class="bg-biru rounded-5 mx-auto pt-1 mt-2" style="width: 90px;"></div>
                </div>
                <div class="col-12 col-md-6">
                    <img src="<?= base_url('assets/img/bg.jpg'); ?>" alt="" class="img-fluid">
                </div>
                <div class="col-12 col-md-6 text-justify">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus aliquid velit alias fuga dolore explicabo eos. Ad, et at perferendis vel expedita facilis perspiciatis. Quia quod quasi perferendis magni sequi?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus aliquid velit alias fuga dolore explicabo eos. Ad, et at perferendis vel expedita facilis perspiciatis. Quia quod quasi perferendis magni sequi?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus aliquid velit alias fuga dolore explicabo eos. Ad, et at perferendis vel expedita facilis perspiciatis. Quia quod quasi perferendis magni sequi?</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end tentang kami -->

    <!-- artikel -->
    <section id="artikel" class="artikel">
        <div class="container px-4 px-md-0">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="text-capitalize fw-bold">Artikel Terkait DBD</h2>
                    <div class="bg-biru rounded-5 mx-auto pt-1 mt-2" style="width: 90px;"></div>
                    <p class="text-muted mt-3">Informasi terbaru dan menarik seputar demam berdarah untuk meningkatkan pemahaman Anda.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <div class="card h-100 rounded border shadow-sm overflow-hidden">
                        <img src="<?= base_url('assets/img/bg.jpg'); ?>" alt="Artikel DBD" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Cara Mencegah DBD di Musim Hujan</h5>
                            <p class="card-text text-muted">Tips efektif untuk melindungi keluarga Anda dari risiko demam berdarah saat musim hujan tiba.</p>
                            <a href="#" class="btn btn-biru text-white rounded-pill px-4">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card h-100 rounded border shadow-sm overflow-hidden">
                        <img src="<?= base_url('assets/img/bg.jpg'); ?>" alt="Artikel DBD" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Gejala Awal DBD yang Harus Diwaspadai</h5>
                            <p class="card-text text-muted">Kenali tanda-tanda awal demam berdarah untuk pencegahan lebih dini dan penanganan tepat waktu.</p>
                            <a href="#" class="btn btn-biru text-white rounded-pill px-4">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card h-100 rounded border shadow-sm overflow-hidden">
                        <img src="<?= base_url('assets/img/bg.jpg'); ?>" alt="Artikel DBD" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Fakta Menarik Tentang Nyamuk Aedes Aegypti</h5>
                            <p class="card-text text-muted">Pelajari fakta unik tentang nyamuk pembawa virus DBD yang jarang diketahui banyak orang.</p>
                            <a href="#" class="btn btn-biru text-white rounded-pill px-4">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end artikel -->

    <!-- footer -->
    <footer class="footer bg-biru text-white py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <h5 class="fw-bold mb-1">ForwardChaining</h5>
                    <p class="small mb-0">© 2024 Semua Hak Dilindungi.</p>
                </div>

                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white mx-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white mx-2"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script src="<?= base_url('assets/js/script.js'); ?>"></script>
</body>

</html>