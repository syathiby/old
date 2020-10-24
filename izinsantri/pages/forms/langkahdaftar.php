<?php 

    global $koneksi;

    $nameserver ='localhost';
    $username ='u4486592_alen';
    $password ='r3dh41r3d';
    $namadb ='u4486592_ppdb';

    $koneksi = mysqli_connect($nameserver, $username, $password, $namadb); 

    if(!$koneksi) {
        die("Koneksi Gagal".mysqli_connect_error());
    }

 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Langkah Pendaftaran Santri Baru - PSB Online | Ma'had Al Imam Asy Syathiby</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

   <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />
</head>


<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Mohon Ditunggu...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="#">PSB Online - Ma'had Al Imam Asy Syathiby</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                   
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->

   <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU UTAMA</li>
                    <li class="">
                        <a href="../../../index.html">
                            <i class="material-icons">home</i>
                            <span>Halaman Depan</span>
                        </a>
                    </li>

                    <li class="active">
                        <a href="#">
                            <i class="material-icons">book</i>
                            <span>Isi Formulir</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="../../login.php">
                            <i class="material-icons">account_circle</i>
                            <span>Login</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">subject</i>
                            <span>Program Pilihan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../ui/program_asrama.php">Tahfizh Asrama</a>
                            </li>
                            <li>
                                <a href="../ui/non_asrama.php">Tahfizh Non Asrama</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="../ui/hubungi.php">
                            <i class="material-icons">phone_in_talk</i>
                            <span>Hubungi Kami</span>
                        </a>
                        
                    </li>
                    <li class="">
                        <a href="../ui/video-panduan.php">
                            <i class="material-icons">video_library</i>
                            <span>Video Panduan</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);">Ma'had Al Imam Asy Syathiby</a>.
                </div>
                <div class="version">
                    Dikembangkan oleh: <a href="https://facebook.com/Alendia.Desta" target="_blank"><b>ADS Dev</b></a>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

  <section class="content">
      <div class="container-fluid">
            <!-- Widgets -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                LANGKAH PENDAFTARAN SANTRI BARU <b>PROGRAM ASRAMA</b>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                           <div id="wizard_horizontal">
                                <h2>Langkah 1</h2>
                                <section>
                                    <p>
                                        <H4>SIAPKAN BERKAS</H4>
                                        Pastikan anda sudah mempersiapkan seluruh berkas yang dibutuhkan, sebagai berikut: <br>
                                        <b>1. Pas Photo Santri</b> <br>
                                        <b>2. Transkrip Nilai 2 Semester Terakhir</b><br>
                                        <b>3. KTP Orang Tua</b><br>
                                        <b>4. Kartu Keluarga</b><br>
                                        <b>5. Surat Keterangan Sehat Dokter</b><br>
                                        Semua berkas di atas dalam bentuk <b>Scan (Soft Copy)</b> dan ukuran untuk masing-masing file <b>Maksimal 1 MB</b>. Jika ukuran file
                                        lebih dari 1 MB maka pendaftaran akan GAGAL
                                    </p>
                                </section>
                                
                                <h2>Langkah 2</h2>
                                <section>
                                    <p>
                                    <H4>MENGISI FORMULIR PENDAFTARAN ONLINE</H4>
                                    Isilah formulir dengan lengkap dan benar, pastikan anda mengupload semua berkas yang dibutuhkan. Apabila anda gagal mengisi formulir, maka
                                    perhatikan <b>kolom isian dan ukuran file yang diupload</b>. Jika terjadi kesalahan sistem akan otomatis menolak pendaftaran anda.
                                    </p>
                                </section>

                                <h2>Langkah 3</h2>
                                <section>
                                    
                                    <p>
                                    <H4>SELEKSI BERKAS</H4>
                                    Setelah anda berhasil mengisi form online, lalu Login ke Aplikasi silahkan tunggu proses "Seleksi Berkas". <BR><BR>Pada tahap ini, anda diberi waktu <b>3 Hari</b> untuk memperbaiki
                                    berkas jika ada kekurangan/kesalahan. Apabila berkas tidak segera diperbaiki, maka anda akan dianggap <b>GUGUR.</b> <br>
                                    Apabila anda dinyatakan LULUS Seleksi Berkas, silahkan langsung melakukan pembayaran biaya pendaftaran sesuai dengan ketentuan.
            
                                    </p>
                                </section>

                                <h2>Langkah 4</h2>
                                <section>
                                    
                                    <p>
                                        <H4>CETAK KARTU TES</H4>
                                        Untuk mengikuti Tes Seleksi Masuk maka calon santri wajib untuk membawa kartu tes, kartu ini dapat anda print/cetak dari menu yang
                                        tersedia di Aplikasi. Proses Cetak Kartu Tes ini hanya bisa dilakukan jika anda sudah <b>LULUS SELEKSI BERKAS & MELAKUKAN UPLOAD BUKTI
                                        TRANSFER BIAYA PENDAFTARAN</b>. <br<br>
                                        Simpan kartu ini dengan baik, dan jangan lupa membawanya saat pelaksanaan tes masuk.
                                    </p>
                                </section>

                                <h2>Langkah 5</h2>
                                <section>
                                    <p>
                                        <H4>CETAK BUKTI KELULUSAN</H4>
                                        Apabila anda dinyakan LULUS tes seleksi masuk, silahkan untuk mencetak/print <b>Bukti Kelulusan</b> <br><br>
                                        <a href="inputdata.php"><button name="daftar" class="btn btn-primary m-t-15 waves-effect">DAFTAR</button></a>
                                        
                                    </p>
                                </section>
                            </div>
                            <p align="center"><img src="../../img/Alur-Pendaftaran-Online-Syathiby.jpg" width="80%" height="auto"></p>
                            <p align="center"><a href="../../img/Alur-Pendaftaran-Online-Syathiby.jpg" download><strong>DOWNLOAD GAMBAR</strong></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Jquery Validation Plugin Css -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- JQuery Steps Plugin Js -->
    <script src="../../plugins/jquery-steps/jquery.steps.js"></script>

    <!-- Sweet Alert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/form-wizard.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>


</body>
</html>