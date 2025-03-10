<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/chart.js/chart.umd.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/echarts/echarts.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/quill/quill.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/php-email-form/validate.js'); ?>"></script>
<script src="<?= base_url('assets/js/main.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- SWEET ALERT -->
<script>
    function hapusData(url) {
        Swal.fire({
            title: 'Anda yakin ingin menghapus?',
            text: "Data yang dihapus tidak dapat dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Tidak, batalkan',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function keluar(url) {
        Swal.fire({
            title: 'Anda yakin ingin keluar?',
            text: "Setelah keluar, Anda harus masuk kembali untuk mengakses akun Anda.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar',
            cancelButtonText: 'Tidak, tetap di sini',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

</body>

</html>