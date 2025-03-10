    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div>
                <h1>User</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
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
                                        <th class="text-center">nama lengkap</th>
                                        <th class="text-center">username</th>
                                        <th class="text-center">role</th>
                                        <th class="text-center" width="10%">aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user as $key => $value) : ?>
                                        <tr>
                                            <td class="text-center"><?= $key + 1; ?>.</td>
                                            <td class="text-center"><?= ucwords($value['nama_lengkap']); ?></td>
                                            <td class="text-center"><?= $value['username']; ?></td>
                                            <td class="text-center"><?= ucwords($value['role']); ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_user']; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="hapusData('<?= base_url('admin/hapus_user/' . $value['id_user']); ?>')">
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('admin/tambah_user'); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama lengkap" required oninvalid="this.setCustomValidity('Masukkan nama lengkap')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required oninvalid="this.setCustomValidity('Masukkan username')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required oninvalid="this.setCustomValidity('Masukkan password')" oninput="this.setCustomValidity('')">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="id_role" class="form-label">Role</label>
                            <select id="id_role" class="form-select" name="id_role" required oninvalid="this.setCustomValidity('Silakan pilih role')" oninput="this.setCustomValidity('')">
                                <option selected disabled value="">Pilih</option>
                                <?php foreach ($role as $value) : ?>
                                    <option value="<?= $value['id_role']; ?>">
                                        <?= ucwords($value['role']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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
    <?php foreach ($user as $key => $value) : ?>
        <div class="modal fade" id="edit<?= $value['id_user']; ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?= form_open('admin/edit_user/' . $value['id_user']) ?>
                    <?= form_hidden('id_user', $value['id_user']) ?>
                    <div class="modal-body">
                        <div class="col-12 mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama_lengkap" required oninvalid="this.setCustomValidity('Masukkan nama penyakit')" oninput="this.setCustomValidity('')" value="<?= ucwords($value['nama_lengkap']); ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required oninvalid="this.setCustomValidity('Masukkan username')" oninput="this.setCustomValidity('')" value="<?= $value['username']; ?>">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
                            <small class="form-text text-muted">*Kosongkan jika tidak ingin mengubah password.</small>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="id_role" class="form-label">Role</label>
                            <select id="id_role" class="form-select" name="id_role" required oninvalid="this.setCustomValidity('Silakan pilih role')" oninput="this.setCustomValidity('')">
                                <option selected disabled value="">Pilih</option>
                                <?php foreach ($role as $data) : ?>
                                    <option value="<?= $data['id_role']; ?>" <?= ($data['id_role'] == $value['id_role']) ? 'selected' : '' ?>>
                                        <?= ucwords($data['role']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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