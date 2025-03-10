<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'pakar' && $this->uri->segment(2) == 'dashboard' ? 'active' : 'collapsed'; ?>" href="<?= base_url('pakar/dashboard'); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= in_array($this->uri->segment(2), ['penyakit', 'gejala', 'relasi', 'tambah_relasi', 'edit_relasi']) ? '' : 'collapsed'; ?>" data-bs-target="#dataMaster" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="dataMaster" class="nav-content collapse <?= in_array($this->uri->segment(2), ['penyakit', 'gejala', 'relasi', 'tambah_relasi', 'edit_relasi']) ? 'show' : ''; ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url('pakar/gejala'); ?>" class="<?= $this->uri->segment(2) == 'gejala' ? 'active' : 'collapsed'; ?>">
                        <i class="bi bi-circle"></i><span>Gejala</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('pakar/penyakit'); ?>" class="<?= $this->uri->segment(2) == 'penyakit' ? 'active' : 'collapsed'; ?>">
                        <i class="bi bi-circle"></i><span>Penyakit</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('pakar/relasi'); ?>" class="<?= $this->uri->segment(2) == 'relasi' || $this->uri->segment(2) == 'tambah_relasi' || $this->uri->segment(2) == 'edit_relasi' ? 'active' : 'collapsed'; ?>">
                        <i class="bi bi-circle"></i><span>Relasi</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'pakar' && $this->uri->segment(2) == 'profile' ? 'active' : 'collapsed'; ?>" href="<?= base_url('pakar/profile'); ?>">
                <i class="bi bi-person-fill-gear"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a onclick="keluar('<?= base_url('logout'); ?>')" class="nav-link collapsed" style="cursor: pointer;">
                <i class="bi bi-box-arrow-in-left"></i>
                <span>Keluar</span>
            </a>
        </li>

    </ul>

</aside>