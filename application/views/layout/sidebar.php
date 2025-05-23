<?php
if ($this->session->userdata('role_id') == 3) {
    //get notifikasi
    $skd = $this->M_notifikasi->nSkd();
    $sktm = $this->M_notifikasi->nSktm();
    $sku = $this->M_notifikasi->nSku();
    $skp = $this->M_notifikasi->nSkp();
    $spak = $this->M_notifikasi->nSpak();
    $skk = $this->M_notifikasi->nSkk();
    $skrm = $this->M_notifikasi->nSkrm();

    //jumlah data notifikasi surat users
    $all = $skd['jumlah'] + $sktm['jumlah'] + $sku['jumlah'] + $skp['jumlah'] + $spak['jumlah'] + $skk['jumlah'] + $skrm['jumlah'];
}

if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) {
    //get notifikasi admin
    $Skd = $this->M_notifikasi->aSkd();
    $Sktm = $this->M_notifikasi->aSktm();
    $Sku = $this->M_notifikasi->aSku();
    $Skp = $this->M_notifikasi->aSkp();
    $Spak = $this->M_notifikasi->aSpak();
    $Skk = $this->M_notifikasi->aSkk();
    $Skrm = $this->M_notifikasi->aSkrm();
    $adminAll = $Skd['jumlah'] + $Sktm['jumlah'] + $Sku['jumlah'] + $Skp['jumlah'] + $Spak['jumlah'] + $Skk['jumlah'] + $Skrm['jumlah'];
}

?>
<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header " style='padding:0; margin:0;'>
            <img class='d-flex '
                style="margin:0 auto; align-items : center; justify-content: center; width:90%; height: 95%; text-align: center; "
                src="<?= base_url() ?>./assets/logo/logo_sidebar.png">
        </div>
        <div class="sidebar-menu" style='margin:0; padding:0;'>
            <ul class="menu">
                <!-- <li class='sidebar-title'>Main Menu</li> -->
                <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2 || $this->session->userdata('role_id') == 3) { ?>
                    <li class="sidebar-item <?= $this->uri->segment(1) == 'dashboard' ? 'active ' : '' ?>">
                        <a href="<?= base_url('dashboard') ?>" class='sidebar-link'>
                            <i class="bi bi-speedometer"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                <?php } ?>
            
                <?php if ($this->session->userdata('role_id') == 1) { ?>
                     <li class="sidebar-item  <?= $this->uri->segment(1) == 'data-users' ? 'active ' : '' ?>">
                        <a href="<?= base_url('data-users') ?>" class='sidebar-link'>
                            <i class="bi bi-person-lines-fill"></i>
                            <span>Kelola Data User</span>
                        </a>
                    </li>
                     <li
                        class="sidebar-item  <?= $this->uri->segment(1) == 'data-warga' || $this->uri->segment(1) == 'tambah-data-warga' || $this->uri->segment(1) == 'edit-warga' || $this->uri->segment(1) == 'detail-warga' ? 'active ' : '' ?>">
                        <a href="<?= base_url('data-warga') ?>" class='sidebar-link'>
                            <i class="bi bi-people-fill"></i>
                            <span>Kelola Data Warga</span>
                        </a>
                    </li>

                   
                   
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-envelope-check-fill"></i>
                            <span>Verifikasi Surat</span>
                            <span class="badge badge bg-danger text-white"><?= $adminAll; ?></span>
                        </a>
                        <ul class="submenu
                        <?=
                            $this->uri->segment(1) == 'verifikasi-surat-domisili' ||
                            $this->uri->segment(1) == 'verifikasi-surat-usaha' ||
                            $this->uri->segment(1) == 'verifikasi-surat-tidak-mampu' ||
                            $this->uri->segment(1) == 'verifikasi-surat-keterangan-pengantar' ||
                            $this->uri->segment(1) == 'verifikasi-surat-kelahiran' ||
                            $this->uri->segment(1) == 'verifikasi-surat-kematian' ||
                            $this->uri->segment(1) == 'verifikasi-surat-keramaian'
                            ? 'active ' : ''
                            ?>">
                            <li>
                                <a href="<?= base_url('verifikasi-surat-tidak-mampu') ?>">Surat Tidak Mampu
                                    <span class="badge badge bg-danger text-white"><?= $Sktm['jumlah'] ?></span></a>
                            </li>
                            <li>
                                <a href="<?= base_url('verifikasi-surat-usaha') ?>">Surat Usaha
                                    <span class="badge badge bg-danger text-white"><?= $Sku['jumlah'] ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('verifikasi-surat-domisili') ?>">Surat Domisili
                                    <span class="badge badge bg-danger text-white"><?= $Skd['jumlah'] ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('verifikasi-surat-keterangan-pengantar') ?>">Keterangan Pengantar
                                    <span class="badge badge bg-danger text-white"><?= $Skp['jumlah'] ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('verifikasi-surat-kelahiran') ?>">Surat Kelahiran
                                    <span class="badge badge bg-danger text-white"><?= $Spak['jumlah'] ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('verifikasi-surat-kematian') ?>">Surat Kematian
                                    <span class="badge badge bg-danger text-white"><?= $Skk['jumlah'] ?></span></a>
                            </li>
                            <li>
                                <a href="<?= base_url('verifikasi-surat-keramaian') ?>">Surat Keramaian
                                    <span class="badge badge bg-danger text-white"><?= $Skrm['jumlah'] ?></span></a>
                            </li>
                        </ul>
                    </li>


                      <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-printer"></i>
                            <span>Cetak Surat</span>
                            <!-- <span class="badge badge bg-danger text-white"><?= $adminAll; ?></span> -->
                        </a>
                        <ul class="submenu
                        <?=
                            $this->uri->segment(1) == 'cetak-surat-domisili' ||
                            $this->uri->segment(1) == 'cetak-surat-usaha' ||
                            $this->uri->segment(1) == 'cetak-surat-tidak-mampu' ||
                            $this->uri->segment(1) == 'cetak-surat-keterangan-pengantar' ||
                            $this->uri->segment(1) == 'cetak-surat-kelahiran' ||
                            $this->uri->segment(1) == 'cetak-surat-kematian' ||
                            $this->uri->segment(1) == 'cetak-surat-keramaian'
                            ? 'active ' : ''
                            ?>">
                            <li>
                                <a href="<?= base_url('cetak-surat-tidak-mampu') ?>">Surat Tidak Mampu
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Sktm['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-usaha') ?>">Surat Usaha
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Sku['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-domisili') ?>">Surat Domisili
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skd['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-keterangan-pengantar') ?>">Keterangan Pengantar
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skp['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-kelahiran') ?>">Surat Kelahiran
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Spak['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-kematian') ?>">Surat Kematian
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skk['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-keramaian') ?>">Surat Keramaian
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skrm['jumlah'] ?></span> -->
                                </a>
                            </li>
                        </ul>
                    </li>

                  
                    <!-- <li class="sidebar-item  <?= $this->uri->segment(1) == 'data-administrator' ? 'active ' : '' ?>">
                        <a href="<?= base_url('data-administrator') ?>" class='sidebar-link'>
                            <i class="bi bi-person-circle"></i>
                            <span>Administrator</span>
                        </a>
                    </li> -->

                <?php } else if ($this->session->userdata('role_id') == 2) { ?>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-envelope-check-fill"></i>
                                <span>Konfirmasi Pengajuan Surat</span>
                                <span class="badge badge bg-danger text-white"><?= $adminAll; ?></span>
                            </a>
                            <ul class="submenu
                        <?=
                            $this->uri->segment(1) == 'verifikasi-surat-domisili' ||
                            $this->uri->segment(1) == 'verifikasi-surat-usaha' ||
                            $this->uri->segment(1) == 'verifikasi-surat-tidak-mampu' ||
                            $this->uri->segment(1) == 'verifikasi-surat-keterangan-pengantar' ||
                            $this->uri->segment(1) == 'verifikasi-surat-kelahiran' ||
                            $this->uri->segment(1) == 'verifikasi-surat-kematian' ||
                            $this->uri->segment(1) == 'verifikasi-surat-keramaian'
                            ? 'active ' : ''
                            ?>">
                                <li>
                                    <a href="<?= base_url('verifikasi-surat-tidak-mampu') ?>">Surat Tidak Mampu
                                        <span class="badge badge bg-danger text-white"><?= $Sktm['jumlah'] ?></span></a>
                                </li>
                                <li>
                                    <a href="<?= base_url('verifikasi-surat-usaha') ?>">Surat Usaha
                                        <span class="badge badge bg-danger text-white"><?= $Sku['jumlah'] ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('verifikasi-surat-domisili') ?>">Surat Domisili
                                        <span class="badge badge bg-danger text-white"><?= $Skd['jumlah'] ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('verifikasi-surat-keterangan-pengantar') ?>">Keterangan Pengantar
                                        <span class="badge badge bg-danger text-white"><?= $Skp['jumlah'] ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('verifikasi-surat-kelahiran') ?>">Surat Kelahiran
                                        <span class="badge badge bg-danger text-white"><?= $Spak['jumlah'] ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('verifikasi-surat-kematian') ?>">Surat Kematian
                                        <span class="badge badge bg-danger text-white"><?= $Skk['jumlah'] ?></span></a>
                                </li>
                                <li>
                                    <a href="<?= base_url('verifikasi-surat-keramaian') ?>">Surat Keramaian
                                        <span class="badge badge bg-danger text-white"><?= $Skrm['jumlah'] ?></span></a>
                                </li>
                            </ul>
                        </li>
                            <?php if ( $this->session->userdata('role_id') == '2') { ?>
                    <li
                        class="sidebar-item  <?= $this->uri->segment(1) == 'data-signature' || $this->uri->segment(1) == 'data-signature' || $this->uri->segment(1) == 'edit-data-signature' || $this->uri->segment(1) == 'detail-signature' ? 'active ' : '' ?>">
                        <a href="<?= base_url('signature') ?>" class='sidebar-link'>
                            <i class="bi bi-pencil"></i>
                            <span>Kelola Data Signature</span>
                        </a>
                    </li>
                     <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-printer"></i>
                            <span>Cetak Surat</span>
                            <!-- <span class="badge badge bg-danger text-white"><?= $adminAll; ?></span> -->
                        </a>
                        <ul class="submenu
                        <?=
                            $this->uri->segment(1) == 'cetak-surat-domisili' ||
                            $this->uri->segment(1) == 'cetak-surat-usaha' ||
                            $this->uri->segment(1) == 'cetak-surat-tidak-mampu' ||
                            $this->uri->segment(1) == 'cetak-surat-keterangan-pengantar' ||
                            $this->uri->segment(1) == 'cetak-surat-kelahiran' ||
                            $this->uri->segment(1) == 'cetak-surat-kematian' ||
                            $this->uri->segment(1) == 'cetak-surat-keramaian'
                            ? 'active ' : ''
                            ?>">
                            <li>
                                <a href="<?= base_url('cetak-surat-tidak-mampu') ?>">Surat Tidak Mampu
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Sktm['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-usaha') ?>">Surat Usaha
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Sku['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-domisili') ?>">Surat Domisili
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skd['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-keterangan-pengantar') ?>">Keterangan Pengantar
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skp['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-kelahiran') ?>">Surat Kelahiran
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Spak['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-kematian') ?>">Surat Kematian
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skk['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('cetak-surat-keramaian') ?>">Surat Keramaian
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skrm['jumlah'] ?></span> -->
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php } else if ($this->session->userdata('role_id') == 3) { ?>
                            <li class="sidebar-item  <?= $this->uri->segment(1) == 'list-surat' ? 'active' : '' ?>">
                                <a href="<?= base_url('list-surat') ?>" class='sidebar-link'>
                                    <i class="bi bi-envelope-plus-fill"></i>
                                    <span>Pengajuan Surat</span>
                                </a>
                            </li>
                            <li class="sidebar-item  <?= $this->uri->segment(1) == 'histori-surat' ? 'active' : '' ?>">
                                <a href="<?= base_url('histori-surat') ?>" class='sidebar-link'>
                                    <i class="bi bi-clock-history"></i>
                                    <span>Riwayat Pengajuan Surat</span>
                                    <span class="badge badge bg-danger text-white"><?= $all ?></span>
                                </a>
                            </li>
                            <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-printer"></i>
                            <span>Cetak Surat</span>
                            <!-- <span class="badge badge bg-danger text-white"><?= $adminAll; ?></span> -->
                        </a>
                        <ul class="submenu
                        <?=
                            $this->uri->segment(1) == 'listcetak-surat-domisili' ||
                            $this->uri->segment(1) == 'listcetak-surat-usaha' ||
                            $this->uri->segment(1) == 'listcetak-surat-tidak-mampu' ||
                            $this->uri->segment(1) == 'listcetak-surat-keterangan-pengantar' ||
                            $this->uri->segment(1) == 'listcetak-surat-kelahiran' ||
                            $this->uri->segment(1) == 'listcetak-surat-kematian' ||
                            $this->uri->segment(1) == 'listcetak-surat-keramaian'
                            ? 'active ' : ''
                            ?>">
                            <li>
                                <a href="<?= base_url('listcetak-surat-tidak-mampu') ?>">Surat Tidak Mampu
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Sktm['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('listcetak-surat-usaha') ?>">Surat Usaha
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Sku['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('listcetak-surat-domisili') ?>">Surat Domisili
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skd['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('listcetak-surat-keterangan-pengantar') ?>">Keterangan Pengantar
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skp['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('listcetak-surat-kelahiran') ?>">Surat Kelahiran
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Spak['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('listcetak-surat-kematian') ?>">Surat Kematian
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skk['jumlah'] ?></span> -->
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('listcetak-surat-keramaian') ?>">Surat Keramaian
                                    <!-- <span class="badge badge bg-danger text-white"><?= $Skrm['jumlah'] ?></span> -->
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                 <li
                        class="sidebar-item  <?= $this->uri->segment(1) == 'data-warga' || $this->uri->segment(1) == 'tambah-data-warga' || $this->uri->segment(1) == 'edit-warga' || $this->uri->segment(1) == 'detail-warga' ? 'active ' : '' ?>">
                        <a href="<?= base_url('logout') ?>" class='sidebar-link'>
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>

<div id="main">
    <nav class="navbar navbar-header navbar-expand navbar-light">
        <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
        <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <h4 style="margin-left:10px; margin-top:15px;">Aplikasi Pelayanan Surat</h4>
            <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <div class="avatar mr-1">
                            <img src="<?= base_url(); ?>./assets/images/avatar/avatar-s-1.png" alt="" srcset="">
                        </div>
                        <div class="d-none d-md-block d-lg-inline-block">Hi, <?= $this->session->userdata('nama') ?>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                        <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                        <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="<?= base_url('logout') ?>"><i data-feather="log-out"></i>
                            Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>