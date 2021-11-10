<div class="content-body content-body-profile">
    <div class="profile-sidebar">
        <div class="profile-sidebar-header">
            <div class="avatar">
                <img src="<?=$_SESSION['foto'];?>" class="rounded-circle" alt="">
            </div>
            <h5><?=$_SESSION['username'];?></h5>
            <p><?=$_SESSION['nip'];?></p>
            <span><?=$_SESSION['group_nama'];?></span>
        </div>
        <!-- profile-sidebar-header -->
        <div class="profile-sidebar-body">
            <hr class="mg-y-25">
            <label class="content-label">Contact Information</label>
            <ul class="list-unstyled profile-info-list mg-b-0">
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-smartphone">
                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                        <line x1="12" y1="18" x2="12" y2="18"></line>
                    </svg>
                    <a href=""><?=$_SESSION['kontak'];?></a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                    </svg>
                    <a href=""><?=$_SESSION['kontak_2'];?></a>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    <a href=""><?=$_SESSION['email'];?></a>
                </li>
            </ul>
        </div>
        <!-- profile-sidebar-body -->
    </div>
    <!-- profile-sidebar -->
    <div class="profile-body">
        <div class="profile-body-header">
            <div class="nav-wrapper">
                <ul class="nav nav-line" id="profileTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                </ul>
            </div>
            <!-- nav-wrapper -->
        </div>
        <!-- profile-body-header -->
        <div class="tab-content pd-15 pd-sm-20">
            <div id="overview" class="tab-pane show active">
                <!-- stat-profile -->
                <label class="content-label content-label-lg mg-b-15 tx-color-01">Tentang OSS BKPPD</label>
                <p class="tx-color-03">Sistem OSS (One Stop Service) ini merupakan inovasi berbasis teknologi informasi yang mengakomodir keperluan seputar pelayanan kepegawaian di BKPPD Pemerintah Kabupaten Magelang. Satu pintu layanan kepegawaian nantinya akan menggunakan aplikasi sistem informasi berbasis website ini. Membantu mempermudah Anda dalam mendapatkan layanan kepegawaian dari BKPPD</p>
                <hr class="mg-y-15 op-0">
                <label class="content-label content-label-lg mg-b-15 tx-color-01">Timeline</label>
                <ul class="list-unstyled media-list-profile">
                    <li class="media">
                        <div class="wd-40 ht-40 bg-teal op-5"></div>
                        <div class="media-body">
                            <h6 class="mg-b-5 tx-semibold">Data Diklat</h6>
                            <p class="tx-color-03 tx-13">03 November 2021 - 12 November 2021</p>
                            <p>Entri dan pembaharuan data terkait dengan riwayat keikutsertaan diklat. Diprioritaskan untuk keikutsertaan diklat dalam rentang waktu mulai dari tahun 2019 sampai 2021. </p>
                        </div>
                    </li>
                </ul>
                <!-- media-list-profile -->
                <hr class="mg-y-15 op-0">
                <label class="content-label content-label-lg mg-b-15 tx-color-01">Next Project</label>
                <ul class="list-unstyled media-list-profile">
                    <li class="media">
                        <div class="wd-40 ht-40 bg-gray-400"></div>
                        <div class="media-body">
                            <h6 class="mg-b-5 tx-semibold">Manajemen TPP</h6>
                            <p class="tx-color-03 tx-13">Fitur pengelolaan TPP mulai dari alokasi pendataan, pengajuan dan pelaporan.</p>
                        </div>
                    </li>
                    <li class="media">
                        <div class="wd-40 ht-40 bg-gray-400"></div>
                        <div class="media-body">
                            <h6 class="mg-b-5 tx-semibold">Integrasi Gaji</h6>
                            <p class="tx-color-03 tx-13">Fitur pengelolaan yang tersinkronisasi dengan SIM Gaji Taspen dan data kepegawaian (SIMPEG). Mempermudah dalam pemutakhiran data kepegawaian di SIM Gaji Taspen serta pegawai juga dapat langsung mengecek jumlah nominal pendapatannya.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- tab-content -->
    </div>
    <!-- profile-body -->
</div>