    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div>
                <h1>Detail Data Konsultasi</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('user/data_konsultasi'); ?>">Data Konsultasi</a></li>
                        <li class="breadcrumb-item active">Detail Data Konsultasi</li>
                    </ol>
                </nav>
            </div>
            <div>
                <a href="<?= base_url('user/print_konsultasi/' . $id_user . '/' . $konsultasi_ke); ?>" target="_blank" class="btn btn-sm btn-danger">Cetak Data</a>
                <a href="<?= base_url('user/data_konsultasi'); ?>" class="btn btn-sm btn-secondary">Kembali</a>
            </div>
        </div>
        <?= $this->session->flashdata('pesan'); ?>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <p class="text-center mb-0">HASIL DIAGNOSA PENYAKIT DBD MENGGUNAKAN METODE FORWARD CHAINING</p>
                                </div>
                            </h5>
                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr class="text-capitalize">
                                        <th class="text-start" width="17%">Nama Lengkap</th>
                                        <td width="1%">:</td>
                                        <td class="text-start"><?= $detail_konsultasi[0]['nama_lengkap']; ?></td>
                                    </tr>
                                    <tr class="text-capitalize">
                                        <th class="text-start" width="17%">Jawaban</th>
                                        <td width="1%">:</td>
                                        <td class="text-start">
                                            <?php $no = 1; ?>
                                            <?php foreach ($detail_konsultasi as $detail) : ?>
                                                <?= $no . '. ' . $detail['kode_gejala'] . ' - ' . $detail['nama_gejala']; ?> <?= '<b>(' . $detail['jawaban'] . ')</b>'; ?><br>
                                                <?php $no++; ?>
                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                    <tr class="text-capitalize">
                                        <th class="text-start" width="17%">Hasil Diagnosa</th>
                                        <td width="1%">:</td>
                                        <td class="text-start">
                                            <?php if (!empty($hasil_konsultasi)) : ?>
                                                <?php foreach ($hasil_konsultasi as $hasil) : ?>
                                                    <?= $hasil['kode_penyakit'] . ' - ' . $hasil['nama_penyakit']; ?><br>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                Berdasarkan gejala yang dialami, kami tidak menemukan indikasi penyakit.
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr class="text-capitalize">
                                        <th class="text-start" width="17%">Keterangan</th>
                                        <td width="1%">:</td>
                                        <td class="text-start">
                                            <?php if (!empty($hasil_konsultasi)) : ?>
                                                <?php foreach ($hasil_konsultasi as $hasil) : ?>
                                                    <?php
                                                    $isi = ucwords($hasil['keterangan']);
                                                    $isi_dengan_br = nl2br($isi);
                                                    $counter = 1;
                                                    $isi_bernomor = preg_replace_callback(
                                                        '/(.+?)(<br\s*\/?>\s*|$)/i',
                                                        function ($matches) use (&$counter) {
                                                            return $counter++ . '. ' . $matches[1] . $matches[2];
                                                        },
                                                        $isi_dengan_br
                                                    );
                                                    echo $isi_bernomor;
                                                    ?>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                Tidak ada keterangan lebih lanjut.
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>