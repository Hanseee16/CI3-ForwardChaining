<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hasil Konsultasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    body {
        font-family: "Poppins", serif;
    }
</style>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-center">HASIL DIAGNOSA PENYAKIT DBD <br> MENGGUNAKAN METODE FORWARD CHAINING</h5>
                        <hr>
                        <table class="table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th scope="row" width="20%">Nama Lengkap</th>
                                    <td width="1%">:</td>
                                    <td><?= $detail_konsultasi[0]['nama_lengkap']; ?></td>
                                </tr>
                                <tr>
                                    <th scope="row" width="20%">Jawaban</th>
                                    <td width="1%">:</td>
                                    <td>
                                        <?php $no = 1; ?>
                                        <?php foreach ($detail_konsultasi as $detail) : ?>
                                            <?= $no . '. ' . $detail['kode_gejala'] . ' - ' . $detail['nama_gejala']; ?> <b>(<?= $detail['jawaban']; ?>)</b><br>
                                            <?php $no++; ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" width="20%">Hasil Diagnosa</th>
                                    <td width="1%">:</td>
                                    <td>
                                        <?php if (!empty($hasil_konsultasi)) : ?>
                                            <?php foreach ($hasil_konsultasi as $hasil) : ?>
                                                <?= $hasil['kode_penyakit'] . ' - ' . $hasil['nama_penyakit']; ?><br>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            Berdasarkan gejala yang dialami, kami tidak menemukan indikasi penyakit.
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" width="20%">Keterangan</th>
                                    <td width="1%">:</td>
                                    <td>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        window.print();
    </script>
</body>

</html>