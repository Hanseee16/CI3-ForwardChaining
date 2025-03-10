<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Menu</li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'dashboard' ? 'active' : 'collapsed'; ?>" href="<?= base_url('user/dashboard'); ?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'konsultasi' || $this->uri->segment(2) == 'hasil_konsultasi' ? 'active' : 'collapsed'; ?>" href="<?= base_url('user/konsultasi'); ?>">
                <i class="bi bi-people-fill"></i>
                <span>Mulai Konsultasi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'data_konsultasi' || $this->uri->segment(2) == 'detail_data_konsultasi' ? 'active' : 'collapsed'; ?>" href="<?= base_url('user/data_konsultasi'); ?>">
                <i class="bi bi-people-fill"></i>
                <span>Data Konsultasi</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'profile' ? 'active' : 'collapsed'; ?>" href="<?= base_url('user/profile'); ?>">
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