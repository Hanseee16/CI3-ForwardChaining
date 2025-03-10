    <main id="main" class="main">
        <div class="pagetitle">
            <div>
                <h1>Kosultasi</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Kosultasi</li>
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
                            <h5 class="card-title">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <p class="text-center mb-0">Jawablah pertanyaan berikut sesuai dengan gejala yang Anda rasakan.</p>
                                </div>
                            </h5>
                            <?= form_open('tambah_konsultasi/'); ?>
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center">no.</th>
                                        <th class="text-center">pertanyaan</th>
                                        <th class="text-center">jawaban</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($gejala as $key => $value) : ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1; ?>.</td>
                                            <td class="text-start">Apakah <?= $value['nama_gejala']; ?>?</td>
                                            <td class="text-center">
                                                <select id="<?= $value['kode_gejala']; ?>" class="form-select" name="jawaban[<?= $value['kode_gejala']; ?>]" required oninvalid="this.setCustomValidity('Silakan pilih jawaban')" oninput="this.setCustomValidity('')">
                                                    <option selected disabled value="">Pilih</option>
                                                    <option value="Ya">Ya</option>
                                                    <option value="Tidak">Tidak</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-sm btn-secondary">Reset</button>
                            <?= form_close() ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>