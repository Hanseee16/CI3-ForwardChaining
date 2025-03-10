    <main id="main" class="main">
        <div class="pagetitle">
            <div>
                <h1>Tambah Relasi</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('pakar/relasi'); ?>">Relasi</a></li>
                        <li class="breadcrumb-item active">Tambah Relasi</li>
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
                            <?= form_open('pakar/tambah_relasi/' . $penyakit['kode_penyakit']); ?>
                            <h5 class="card-title"><?= $penyakit['kode_penyakit'] . ' - ' . $penyakit['nama_penyakit']; ?></h5>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center">kode gejala</th>
                                        <th class="text-center">nama gejala</th>
                                        <th class="text-center">keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($gejala as $g) : ?>
                                        <tr>
                                            <td class="text-center"><?= $g['kode_gejala']; ?></td>
                                            <td class="text-start"><?= ucwords($g['nama_gejala']); ?></td>
                                            <td class="text-center">
                                                <select id="keterangan_<?= $g['kode_gejala']; ?>" class="form-select" name="keterangan_<?= $g['kode_gejala']; ?>" required oninvalid="this.setCustomValidity('Silakan pilih keterangan')" oninput="this.setCustomValidity('')">
                                                    <option selected disabled value="">Pilih</option>
                                                    <option value="Ya">Ya</option>
                                                    <option value="Tidak">Tidak</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                            <a href="<?= base_url('pakar/relasi'); ?>" class="btn btn-sm btn-secondary">Kembali</a>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>