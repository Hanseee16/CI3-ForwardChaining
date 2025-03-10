    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div>
                <h1>Data Konsultasi</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Konsultasi</li>
                    </ol>
                </nav>
            </div>
            <!-- <div>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div> -->
        </div>

        <?= $this->session->flashdata('pesan'); ?>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-3">
                            <table class="table table-striped table-hover datatable">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center">no.</th>
                                        <th class="text-center">nama lengkap</th>
                                        <th class="text-center">konsultasi ke</th>
                                        <th class="text-center">tanggal konsultasi</th>
                                        <th class="text-center" width="10%">aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($konsultasi as $key => $value) : ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1; ?>.</td>
                                            <td class="text-center"><?= ucwords($value['nama_lengkap']); ?></td>
                                            <td class="text-center"><?= $value['konsultasi_ke']; ?></td>
                                            <td class="text-center"><?= tanggalIndonesia($value['tanggal_konsultasi']); ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('admin/detail_konsultasi/' . $value['id_user'] . '/' . $value['konsultasi_ke']); ?>" class="btn btn-sm btn-secondary">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger" onclick="hapusData('<?= base_url('admin/hapus_konsultasi/' . $value['id_user'] . '/' . $value['konsultasi_ke']); ?>')">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
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