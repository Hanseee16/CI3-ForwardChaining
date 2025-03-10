    <main id="main" class="main">
        <div class="pagetitle">
            <div>
                <h1>Relasi</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Relasi</li>
                    </ol>
                </nav>
            </div>
        </div>

        <?= $this->session->flashdata('pesan'); ?>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <!-- penyakit -->
                            <h5 class="card-title">Daftar Penyakit</h5>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center" witdh="10%">kode</th>
                                        <th class="text-center" width="90%">nama penyakit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penyakit as $p) : ?>
                                        <tr>
                                            <td class="text-center"><?= $p['kode_penyakit']; ?></td>
                                            <td class="text-start"><?= ucwords($p['nama_penyakit']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <!-- gejala -->
                            <h5 class="card-title">Daftar Gejala</h5>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center" witdh="10%">kode</th>
                                        <th class="text-center" witdh="90%">nama gejala</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($gejala as $g) : ?>
                                        <tr>
                                            <td class="text-center"><?= $g['kode_gejala']; ?></td>
                                            <td class="text-start"><?= ucwords($g['nama_gejala']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <!-- relasi -->
                            <h5 class="card-title">Daftar Relasi</h5>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center">nama penyakit</th>
                                        <?php foreach ($gejala as $g) : ?>
                                            <th class="text-center"><?= $g['kode_gejala']; ?></th>
                                        <?php endforeach; ?>
                                        <th class="text-center">aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penyakit as $p) : ?>
                                        <tr>
                                            <td class="text-start"><?= ucwords($p['nama_penyakit']); ?></td>

                                            <?php
                                            // Flag untuk mendeteksi apakah ada keterangan_relasi yang tidak null
                                            $has_relasi = false;
                                            ?>

                                            <?php foreach ($gejala as $g) : ?>
                                                <?php
                                                // Mencari data relasi berdasarkan kode penyakit dan kode gejala
                                                $relasi_found = null;
                                                foreach ($relasi as $r) {
                                                    if ($r['kode_penyakit'] === $p['kode_penyakit'] && $r['kode_gejala'] === $g['kode_gejala']) {
                                                        $relasi_found = $r['keterangan_relasi'];
                                                        if ($relasi_found !== null) {
                                                            $has_relasi = true;
                                                        }
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <td class="text-center">
                                                    <?= $relasi_found === null ? '-' : ($relasi_found === 'Ya' ? '<i class="bi bi-check-lg text-success"></i>' :
                                                        '<i class="bi bi-x-lg text-danger"></i>'); ?>
                                                </td>
                                            <?php endforeach; ?>

                                            <!-- Tombol tambah/edit relasi -->
                                            <td class="text-center">
                                                <?php if ($has_relasi): ?>
                                                    <a href="<?= base_url('admin/edit_relasi/' . $p['kode_penyakit']); ?>" class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <a href="<?= base_url('admin/tambah_relasi/' . $p['kode_penyakit']); ?>" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-plus"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>