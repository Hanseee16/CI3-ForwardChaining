    <main id="main" class="main">
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div>
                <h1>Profile</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('pakar/dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div>
            <div>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?= $user['id_user']; ?>">
                    Edit Profile
                </button>
            </div>
        </div>
        <?= $this->session->flashdata('pesan'); ?>
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-3">
                            <table class="table table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th width="20%">Nama Lengkap</th>
                                        <td width="1%">:</td>
                                        <td><?= ucwords($user['nama_lengkap']); ?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Username</th>
                                        <td width="1%">:</td>
                                        <td><?= $user['username']; ?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Role</th>
                                        <td width="1%">:</td>
                                        <td><?= ucwords($user['role']); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- MODAL EDIT -->
    <div class="modal fade" id="edit<?= $user['id_user']; ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('pakar/edit_profile/' . $user['id_user']) ?>
                <?= form_hidden('id_user', $user['id_user']) ?>
                <div class="modal-body">
                    <div class="col-12 mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan nama_lengkap" required oninvalid="this.setCustomValidity('Masukkan nama penyakit')" oninput="this.setCustomValidity('')" value="<?= ucwords($user['nama_lengkap']); ?>">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required oninvalid="this.setCustomValidity('Masukkan username')" oninput="this.setCustomValidity('')" value="<?= $user['username']; ?>">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru">
                        <small class="form-text text-muted">*Kosongkan jika tidak ingin mengubah password.</small>
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