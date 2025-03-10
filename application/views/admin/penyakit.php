    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div>
                <h1>Penyakit</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Penyakit</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>
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
                                        <th class="text-center">kode</th>
                                        <th class="text-center">nama penyakit</th>
                                        <th class="text-center">keterangan</th>
                                        <th class="text-center" width="10%">aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($penyakit as $key => $value) : ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1; ?>.</td>
                                            <td class="text-center"><?= $value['kode_penyakit']; ?></td>
                                            <td class="text-start"><?= ucwords($value['nama_penyakit']); ?></td>
                                            <td class="text-start">
                                                <?php
                                                $isi = ucwords($value['keterangan']);
                                                $isi_dengan_br = nl2br($isi);
                                                $counter = 0;
                                                $isi_bernomor = preg_replace_callback(
                                                    '/(.+?)(<br\s*\/?>\s*|$)/i',
                                                    function ($matches) use (&$counter) {
                                                        $counter++;
                                                        return $counter . '. ' . $matches[1] . $matches[2];
                                                    },
                                                    $isi_dengan_br
                                                );
                                                echo $isi_bernomor;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['kode_penyakit']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="hapusData('<?= base_url('hapus_penyakit/' . $value['kode_penyakit']); ?>')">
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

    <!-- TAMBAH DATA -->
    <div class="modal fade" id="tambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('tambah_penyakit'); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="kode_penyakit" class="form-label">Kode Penyakit</label>
                            <input type="text" class="form-control" id="kode_penyakit" name="kode_penyakit" value="<?= $newKode; ?>" readonly>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="nama_penyakit" class="form-label">Nama Penyakit</label>
                            <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" placeholder="Masukkan nama penyakit" required oninvalid="this.setCustomValidity('Masukkan nama penyakit')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Masukkan keterangan" required oninvalid="this.setCustomValidity('Masukkan keterangan')" oninput="this.setCustomValidity('')"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT -->
    <?php foreach ($penyakit as $key => $value) : ?>
        <div class="modal fade" id="edit<?= $value['kode_penyakit']; ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?= form_open('edit_penyakit/' . $value['kode_penyakit']) ?>
                    <?= form_hidden('kode_penyakit', $value['kode_penyakit']) ?>
                    <div class="modal-body">
                        <div class="col-12 mb-3">
                            <label for="kode_penyakit" class="form-label">Kode Penyakit</label>
                            <input type="text" class="form-control" id="kode_penyakit" name="kode_penyakit" value="<?= $value['kode_penyakit']; ?>" readonly>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="nama_penyakit" class="form-label">Nama Penyakit</label>
                            <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" placeholder="Masukkan nama penyakit" required oninvalid="this.setCustomValidity('Masukkan nama penyakit')" oninput="this.setCustomValidity('')" value="<?= $value['nama_penyakit']; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="4" placeholder="Masukkan keterangan" required oninvalid="this.setCustomValidity('Masukkan keterangan')" oninput="this.setCustomValidity('')"><?= $value['keterangan']; ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>