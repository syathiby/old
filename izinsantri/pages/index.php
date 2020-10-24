<?php 


session_start();
//Membuat batasan waktu sesion untuk user di PHP 
$timeout = 1; // Set timeout menit
$logout_redirect_url = "index.php"; // Set logout URL
 
$timeout = $timeout * 1800; // Ubah menit ke detik
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Sesi Anda Telah Berakhir, Silahkan Login Kembali!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();


    if(!isset($_SESSION['akun_username'])) header("location: login.php");
    include "inc/config.php"; 

    error_reporting(0);

 ?>

<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Halaman Utama - PSB Online | Ma'had Al Imam Asy Syathiby</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />
    
     <!-- Sweet Alert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-lime">
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
        <input type="text" placeholder="Tulis yang anda cari...">
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
                <?php
                $sql = mysqli_query ($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
                $data = mysqli_fetch_array ($sql)
                ?>
                <a class="navbar-brand"><?php echo $data['judul_web']; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <?php 
                        if ($_SESSION['santri']) {

                         ?>
                    <li><a href="pages/forms/profil.php"><i class="material-icons">account_circle</i></a></li>
                    <?php } ?>
                    <li><a href="logout.php"><i class="material-icons">open_in_new</i></a></li>
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
            <div class="user-info">
                <?php 
                            
                            if($_SESSION['username']){
                                
                                $usern=$_SESSION['username'];
                                $thn_ajaran = $_SESSION['thn_ajaran'];
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$usern' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);
                                
                                $sql_draft = mysqli_query($koneksi, "SELECT * FROM draft WHERE thn_ajaran='$thn_ajaran'");
                                $draft = mysqli_fetch_array ($sql_draft);
                                $folder = $draft['folder_photo'];

                            ?>
                <div class="image">
                    <img src="img/<?php echo $folder;?>/<?php echo $data_ubah['photodiri']; ?>" width="48" height="48" alt="User" />
                </div>
                <?php } ?>
                <div class="info-container">

                    <?php 
                    if($_SESSION['namalengkap']){
                        $lagi_login = $_SESSION['namalengkap'];
                    }
                    else if($_SESSION['namalengkap']){
                        $lagi_login = $_SESSION['namalengkap'];
                    }

                     ?>
                  
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ahlan, <?php echo $lagi_login; ?> </div>
                    <div class="email">Selamat Datang di PSB Online</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                        <?php 
                        if ($_SESSION['santri']) {
                         ?>
                            <li><a href="pages/forms/profil.php"><i class="material-icons">person</i>Profil</a></li>
                        <?php } ?>
                          
                            <li><a href="logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
           <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU UTAMA</li>

                     <?php 
                        if ($_SESSION['santri'] || $_SESSION['admin']) {

                         ?>
                    <li class="active">
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    <?php }?>

                     <?php 
                        if ($_SESSION['admin']) {

                         ?>
                    <li>
                        <a href="pages/tables/admin.php">
                            <i class="material-icons">speaker_notes</i>
                            <span>Administrasi</span>
                        </a>
                    </li>
                     <li class="">
                        <a href="pages/tables/admin_seleksi_berkas.php">
                            <i class="material-icons">account_box</i>
                            <span>Seleksi Berkas</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="pages/tables/admin_kelulusan.php">
                            <i class="material-icons">assignment</i>
                            <span>Pengumuman Kelulusan</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php 
                        if ($_SESSION['santri']) {

                         ?>
                    <li class="">
                        <a href="pages/forms/profil.php">
                            <i class="material-icons">account_box</i>
                            <span>Profil</span>
                        </a>
                    </li>
                    
                    <li class="">
                        <a href="pages/forms/kartutes.php">
                            <i class="material-icons">print</i>
                            <span>Cetak Kartu Tes</span>
                        </a>
                    </li>
                    
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Hasil Tes Masuk</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/forms/luluspribadi.php">Kelulusan Pribadi</a>
                            </li>
                            <li>
                                <a href="pages/forms/lulusumum.php">Kelulusan Umum</a>
                            </li>
                        </ul>

                        <?php } ?>

                    <li>
                        <?php 
                        if ($_SESSION['santri'] || $_SESSION['admin']) {

                         ?>
                        <a href="pages/ui/hubungilogin.php">
                            <i class="material-icons">phone_in_talk</i>
                            <span>Hubungi Kami </span>
                        </a>
                         <?php } ?>
                    </li>
                    
                    <li>
                        <?php 
                        if ($_SESSION['santri'] || $_SESSION['admin']) {

                         ?>
                        <a href="logout.php">
                            <i class="material-icons">highlight_off</i>
                            <span>Logout </span>
                        </a>
                         <?php } ?>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <?php
                $sql = mysqli_query ($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
                $data = mysqli_fetch_array ($sql)
                ?>
                <div class="copyright">
                    &copy; 2019 <a href="javascript:void(0);"><?php echo $data['copyright']; ?></a>.
                </div>
                <div class="version">
                   Dikembangkan oleh: <a href="https://facebook.com/Alendia.Desta" target="_blank"><b><?php echo $data['developer']; ?></b></a>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>HALAMAN UTAMA</h2>
            </div>
            
            <?php 
            if($_SESSION['username']){
                $hasil_berkas = $_SESSION['seleksi_berkas'];
                $level = $_SESSION['santri'];
                $usern = $_SESSION['username'];
                }
            ?>
            
            <?php 
                 $sqltransfer = mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$usern'");
                 $datatransfer = mysqli_fetch_array($sqltransfer);
                 $statustransfer = $datatransfer['transfer'];
            ?>
 
             <?php 
             if (($level == "Santri") and ($statustransfer=="")) {
                
             if($hasil_berkas == "Diproses") {
                 ?>
                 <div class="alert alert-danger">
                    <strong>PERHATIAN!</strong> Kami sedang melakukan proses seleksi berkas anda, mohon ditunggu! </strong>
                 </div>
             <?php
             }else if($hasil_berkas == "LULUS") {
                 ?>
                 <div class="alert alert-warning">
                    <strong>SELAMAT!</strong> Anda telah LULUS Seleksi Berkas, silahkan Cetak Kartu Tes Disini! <a href="pages/forms/kartutes.php"><b>Cetak Kartu</b></a> </strong>
                 </div>
             <?php }
             else {
                 ?>
                 <div class="alert alert-warning">
                    <strong>PERHATIAN!</strong> Anda GAGAL Seleksi Berkas, silahkan perbaiki berkas anda disini <a href="pages/forms/profil.php"><b>Revisi Berkas</b></a> </strong>
                 </div>
             <?php }
             }
             ?>
             
             <?php 
            if($_SESSION['hasil_akhir']){
                $kelulusan = $_SESSION['hasil_akhir'];
                }
            ?>
             
             <?php 
             $cekdata = mysqli_query ($koneksi, "SELECT * FROM identitas WHERE level='Admin'");
             $data = mysqli_fetch_array ($cekdata);
             $publikasi = $data['publikasi'];
             if(($kelulusan == "LULUS" || $kelulusan == "GAGAL") and ($publikasi == "Release")){
                 ?>
                 <div class="alert alert-warning">
                    <strong>PERHATIAN!</strong> Hasil Akhir Tes Masuk Ma'had Imam Syathiby telah diumumkan, lihat <a href="pages/forms/luluspribadi.php">Disini!</a></strong>
                 </div>
             <?php
             }
             ?>
            
            
            <?php
                $sql = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level='admin'");
                $data_baru = mysqli_fetch_array ($sql);
            ?> 
             
            <?php
            if ($_SESSION['santri']) {
            ?>
            
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">SELEKSI BERKAS</div>
                            
                            <div>
                             <?php 
                                if($_SESSION['seleksi_berkas']){
                                   $berkas_saya = $_SESSION['seleksi_berkas'];
                                
                            ?>
                            <h4><?php echo $berkas_saya; ?></h4>
                            <?php }?>                                 
                            </div>
                        </div>
                    </div>
                </div>
                
                 <div class="col-lg-6-offset col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">assessment</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL NILAI TES MASUK</div>
                            
                            <div>
                                 <?php 
                                if($_SESSION['nilai_akhir']){
                                   $total = $_SESSION['nilai_akhir'];
                                   $hasilseleksi = $_SESSION['seleksi_berkas'];
                                   $publikasi = $data_baru['publikasi'];
                                   
                                   if($hasilseleksi == "GAGAL"){
                                       ?>
                                       <h4>TIDAK TES</h4>
                                   <?php
                                   } 
                                   else { 
                                    if ($publikasi == "Hold"){
                                       ?>
                                       <h4>Menunggu</h4>
                                    <?php   
                                    }
                                   
                                   else {
                                    ?>
                                    <h4><?php echo $total; ?></h4>
                                    <?php 
                                    }
                                    
                                   }
                            }
                            ?> 
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <!--HOLD
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">book</i>
                        </div>
                        
                        
                        <div class="content">
                            <div class="text">TES TAHFIZH (60)</div>

                            <div>
                                <?php 
                                if($_SESSION['tes_tahfizh']){
                                   $tes_taj = $_SESSION['tes_tahfizh'];
                                   $hasilseleksi = $_SESSION['seleksi_berkas'];
                                   $publikasi = $data_baru['publikasi'];
                                   
                                   if($hasilseleksi == "GAGAL"){
                                       ?>
                                       <h4>TIDAK TES</h4>
                                   <?php
                                   } 
                                   
                                   else {
                                   if ($publikasi == "Hold"){
                                       ?>
                                       <h4>Menunggu</h4>
                                    <?php   
                                    }
                                   
                                   else {
                                    ?>
                                    <h4><?php echo $tes_taj; ?></h4>
                                    <?php 
                                    }
                                   
                                   }
                               }
                            ?>    
                            </div>
                            
                        </div>
                        
                        
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">translate</i>
                        </div>
                        
                        
                        <div class="content">
                            <div class="text">TES PSIKOLOGI (20)</div>
                            
                            <div>
                                 <?php 
                                if($_SESSION['tes_psikologi']){
                                   $tes_psi = $_SESSION['tes_psikologi'];
                                   $hasilseleksi = $_SESSION['seleksi_berkas'];
                                   $publikasi = $data_baru['publikasi'];
                                   
                                   if($hasilseleksi == "GAGAL"){
                                       ?>
                                       <h4>TIDAK TES</h4>
                                   <?php
                                   }
                                   
                                   else { 
                                   if ($publikasi == "Hold"){
                                       ?>
                                       <h4>Menunggu</h4>
                                    <?php   
                                    }
                                   
                                   else {
                                    ?>
                                    <h4><?php echo $tes_psi; ?></h4>
                                    <?php 
                                    }
                                    
                                   }
                                }
                            ?>    
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                -->
                
            </div>
            
            <!--ROW 2-->
            <!--HOLD
            <div class="row clearfix">
                
                 <div class="col-lg-4-offset col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-brown hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">verified_user</i>
                        </div>
                        <div class="content">
                            <div class="text">TES KESEHATAN (20)</div>
                            
                            <div>
                                 <?php 
                                if($_SESSION['tes_kesehatan']){
                                   $tes_kes = $_SESSION['tes_kesehatan'];
                                   $hasilseleksi = $_SESSION['seleksi_berkas'];
                                   $publikasi = $data_baru['publikasi'];
                                   
                                   if($hasilseleksi == "GAGAL"){
                                       ?>
                                       <h4>TIDAK TES</h4>
                                   <?php
                                   } 
                                   else { 
                                    if ($publikasi == "Hold"){
                                       ?>
                                       <h4>Menunggu</h4>
                                    <?php   
                                    }
                                   
                                   else {
                                    ?>
                                    <h4><?php echo $tes_kes; ?></h4>
                                    <?php 
                                    }
                                    
                                   }
                            }
                            ?> 
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4-offset col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">TES WAWANCARA</div>
                            
                            <div>
                                 <?php 
                                if($_SESSION['tes_wawancara']){
                                   $tes_wan = $_SESSION['tes_wawancara'];
                                   $hasilseleksi = $_SESSION['seleksi_berkas'];
                                   $publikasi = $data_baru['publikasi'];
                                   
                                   if($hasilseleksi == "GAGAL"){
                                       ?>
                                       <h4>TIDAK TES</h4>
                                   <?php
                                   } 
                                   else { 
                                    if ($publikasi == "Hold"){
                                       ?>
                                       <h4>Menunggu</h4>
                                    <?php   
                                    }
                                   
                                   else {
                                    ?>
                                    <h4><?php echo $tes_wan; ?></h4>
                                    <?php 
                                    }
                                    
                                   }
                            }
                            ?> 
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            -->
            <?php } ?>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <?php 
                if ($_SESSION['santri']) {

                         ?>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2><strong>INFORMASI PENTING!</strong></h2>
                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <p><b>SELAMAT!</b> Anda telah berhasil mendaftar dan telah resmi menjadi <strong>Calon Santri</strong> Pesantren Tahkimussunnah Al Islamy. Aplikasi ini akan membantu anda selama proses <strong>Tes Seleksi Masuk Tahun Ajaran 2020/2021</strong>
                            <br>
                            <br>
                            Untuk itu perhatikan hal berikut ini:
                            <br>
                            1. Pastikan semua data anda sudah diisi dengan <b>lengkap dan benar</b>
                            <br>
                            2. Jika <strong>Seleksi Berkas</strong> anda dinyatakan <b>LULUS</b>, maka silahkan download <b>Kartu Tes</b> disini 
                            <a href="pages/forms/kartutes.php" target="_blank"><b>DOWNLOAD!</b></a>
                            <br>
                            3. Jika sudah mendapatkan <b>Kartu Tes</b> silahkan langsung datang ke Ma'had untuk pelaksanana tes masuk sesuai dengan waktu yang telah ditentukan
                            <br>
                            4. <b>Pengumuman Kelulusan</b> akan diinfokan melalui aplikasi ini, untuk itu pastikan anda selalu terhubung dan tidak kehilangan <b>username atau password</b> untuk login
                            <br>
                            <br>
                            Jika ada hal yang ingin ditanyakan mengenai <b>Teknis Aplikasi</b> silahkan langsung menghubungi <b>Admin Aplikasi</b> disini <a href="pages/ui/hubungilogin.php" target="_blank"><b>Hubungi!</b></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
            <!-- #END# CPU Usage -->
            <!-- Bar Chart -->
                <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>GRAFIK SELEKSI BERKAS</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <canvas id="bar_chart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                

                
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>STATISTIK JENJANG PENDIDIKAN</h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <canvas id="pie_chart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                </div>
                <!-- #END# Bar Chart -->
                
                <!-- DATA IKHWAN -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PESERTA TES TERBAIK (Ikhwan)
                            </h2>
                        </div>

                       <!--
                        <div class="body">
                            <div class="alert alert-success">
                                <strong>MOHON MAAF!</strong> Belum Ada Data Yang Ditampilkan, Masih Menunggu Perhitungan Hasil Tes!
                            </div>
                        </div>
                        -->
                        
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Nama Lengkap</th>
                                            <th>Program</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Total Nilai</th>
                                            <th>Hasil Akhir</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                       <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username 
                                            WHERE identitas.jk='Laki-laki' ORDER BY hasil.nilai_akhir DESC LIMIT 5") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {

                                         ?>
                                        
                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td><?php echo $data['namalengkap']; ?></td>
                                            <td><?php echo $data['program_pilihan'];?></td>
                                            <td><?php echo $data['jk']; ?></td>
                                            <td><?php echo $data['nilai_akhir'];?></td>
                                            <td><?php echo $data['hasil_akhir'];?></td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            <?php 
                                $sql_cek = mysqli_query($koneksi, "SELECT * FROM identitas WHERE jk='Laki-laki'");

                                ?>
                                <div class="row clearfix">
                                    <div class="col-xs-10 col-sm-10 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">TOTAL IKHWAN <span class="badge">
                                    <?php echo mysqli_num_rows($sql_cek); ?> Santri</span></button>
                                    </div>
                                 </div>

                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            
               <!-- TABEL AKHWAT -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PESERTA TES TERBAIK (Akhwat)
                            </h2>
                        </div>

                        <!--
                        <div class="body">
                            <div class="alert alert-success">
                                <strong>MOHON MAAF!</strong> Belum Ada Data Yang Ditampilkan, Masih Menunggu Perhitungan Hasil Tes!
                            </div>
                        </div>
                       -->
                        
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Nama Lengkap</th>
                                            <th>Program</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Total Nilai</th>
                                            <th>Hasil Akhir</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                       <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username 
                                            WHERE identitas.jk='Perempuan' ORDER BY hasil.nilai_akhir DESC LIMIT 5") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {

                                         ?>
                                        
                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td><?php echo $data['namalengkap']; ?></td>
                                            <td><?php echo $data['program_pilihan'];?></td>
                                            <td><?php echo $data['jk']; ?></td>
                                            <td><?php echo $data['nilai_akhir'];?></td>
                                            <td><?php echo $data['hasil_akhir'];?></td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            <?php 
                                $sql_cek = mysqli_query($koneksi, "SELECT * FROM identitas WHERE jk='Perempuan'");

                                ?>
                                <div class="row clearfix">
                                    <div class="col-xs-10 col-sm-10 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">TOTAL AKHWAT <span class="badge">
                                    <?php echo mysqli_num_rows($sql_cek); ?> Santri</span></button>
                                    </div>
                                 </div>

                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>PENDAFTAR TERBARU (Ikhwan)</h2>
                            <ul class="header-dropdown m-r--5">
                                
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Program Pilihan</th>
                                            <th>Seleksi Berkas</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username 
                                            WHERE identitas.jk='Laki-Laki' ORDER BY identitas.id DESC LIMIT 5") or die (mysqli_error());
                                            while ($data = mysqli_fetch_array ($sql)) {

                                         ?>
                                        <tr>
                                            <td><?php echo $data['namalengkap']; ?></td>
                                            <td><?php echo $data['program_pilihan']; ?></td>
                                            <td><?php echo $data['seleksi_berkas'];?></td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>PENDAFTAR TERBARU (Akhwat)</h2>
                            <ul class="header-dropdown m-r--5">
                                
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Program Pilihan</th>
                                            <th>Seleksi Berkas</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username
                                            WHERE identitas.jk='perempuan' ORDER BY identitas.id DESC limit 5") or die (mysqli_error());
                                            while ($data = mysqli_fetch_array ($sql)) {

                                         ?>
                                        <tr>
                                            <td><?php echo $data['namalengkap']; ?></td>
                                            <td><?php echo $data['program_pilihan']; ?></td>
                                            <td><?php echo $data['seleksi_berkas'];?></td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Demo Js -->
    <script src="js/demo.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Chart Plugins Js -->
    <script src="plugins/chartjs/Chart.bundle.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>

    <!-- Chart Batang -->
    
    <script>
    <?php 
    $sql_draft = mysqli_query($koneksi, "SELECT * FROM draft WHERE status='BUKA' ORDER BY id DESC LIMIT 1");
    $draft = mysqli_fetch_array ($sql_draft); 
    $thn_ajaran = $draft['thn_ajaran'];
    ?>
        var ctx = document.getElementById("bar_chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["LULUS", "Diproses", "GAGAL"],
                datasets: [{
                    label: 'Ikhwan',
                    data: [
                    <?php
                    $jumlah_lulus1 = mysqli_query($koneksi,"SELECT * FROM identitas INNER join hasil ON identitas.username = hasil.username 
                    WHERE hasil.seleksi_berkas='LULUS' AND identitas.jk='Laki-Laki' AND identitas.thn_ajaran='$thn_ajaran'");
                    echo mysqli_num_rows($jumlah_lulus1);
                    ?>, 
                    <?php 
                    $jumlah_diproses1 = mysqli_query($koneksi,"SELECT * FROM identitas INNER join hasil ON identitas.username = hasil.username 
                    WHERE hasil.seleksi_berkas='Diproses' AND identitas.jk='Laki-Laki' AND identitas.thn_ajaran='$thn_ajaran'");
                    echo mysqli_num_rows($jumlah_diproses1);
                    ?>, 
                    <?php 
                    $jumlah_ditolak1 = mysqli_query($koneksi,"SELECT * FROM identitas INNER join hasil ON identitas.username = hasil.username 
                    WHERE hasil.seleksi_berkas='Gagal' AND identitas.jk='Laki-Laki' AND identitas.thn_ajaran='$thn_ajaran'");
                    echo mysqli_num_rows($jumlah_ditolak1);
                    ?>
                    ],
                    backgroundColor: 'rgba(0, 188, 212, 0.8)'
                }, {
                    label: 'Akhwat',
                    data: [
                    <?php 
                    $jumlah_lulus2 = mysqli_query($koneksi,"SELECT * FROM identitas INNER join hasil ON identitas.username = hasil.username 
                    WHERE hasil.seleksi_berkas='LULUS' AND identitas.jk='Perempuan' AND identitas.thn_ajaran='$thn_ajaran'");
                    echo mysqli_num_rows($jumlah_lulus2);
                    ?>, 
                    <?php 
                    $jumlah_diproses2 = mysqli_query($koneksi,"SELECT * FROM identitas INNER join hasil ON identitas.username = hasil.username 
                    WHERE hasil.seleksi_berkas='Diproses' AND identitas.jk='Perempuan' AND identitas.thn_ajaran='$thn_ajaran'");
                    echo mysqli_num_rows($jumlah_diproses2);
                    ?>, 
                    <?php 
                    $jumlah_ditolak2 = mysqli_query($koneksi,"SELECT * FROM identitas INNER join hasil ON identitas.username = hasil.username 
                    WHERE hasil.seleksi_berkas='Gagal' AND identitas.jk='Perempuan' AND identitas.thn_ajaran='$thn_ajaran'");
                    echo mysqli_num_rows($jumlah_ditolak2);
                    ?>
                    ],
                    backgroundColor: 'rgba(233, 30, 99, 0.8)'
                }]
            },
            options: {
                responsive: true,
                legend: true,
                label: true

            }
        });
    </script>

    <!--Chart Line-->
     <script>
     <?php 
    $sql_draft = mysqli_query($koneksi, "SELECT * FROM draft WHERE status='BUKA' ORDER BY id DESC LIMIT 1");
    $draft = mysqli_fetch_array ($sql_draft); 
    $thn_ajaran = $draft['thn_ajaran']; ?>
        var ctx = document.getElementById("pie_chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                    <?php
                    $sql_sdit = mysqli_query($koneksi, "SELECT * FROM identitas WHERE program_pilihan = 'SDIT AL-QUDWAH' AND thn_ajaran='$thn_ajaran'");
                    $data_sdit = mysqli_num_rows($sql_sdit);
                    echo $data_sdit;
                    ?>, 
                    <?php
                    $sql_smpit = mysqli_query($koneksi, "SELECT * FROM identitas WHERE program_pilihan = 'SMPIT AL-QUDWAH' AND thn_ajaran='$thn_ajaran'");
                    $data_smpit = mysqli_num_rows($sql_smpit);
                    echo $data_smpit;
                    ?>, 
                    <?php
                    $sql_sma = mysqli_query($koneksi, "SELECT * FROM identitas WHERE program_pilihan = 'SMA Paket C' AND thn_ajaran='$thn_ajaran'");
                    $data_sma = mysqli_num_rows($sql_sma);
                    echo $data_sma;
                    ?>,
                    <?php
                    $sql_tk = mysqli_query($koneksi, "SELECT * FROM identitas WHERE program_pilihan = 'TK/PAUD' AND thn_ajaran='$thn_ajaran'");
                    $data_tk = mysqli_num_rows($sql_tk);
                    echo $data_tk;
                    ?>],
                    backgroundColor: [
                        "rgb(233, 30, 99)",
                        "rgb(255, 193, 7)",
                        "rgb(0, 188, 212)",
                        "rgb(139, 195, 74)"
                    ],
                }],
                labels: [
                    "SDIT",
                    "SMPIT",
                    "SMA Paket C",
                    "TK/PAUD"
                ]
            },
            options: {
                responsive: true,
                legend: true
            }
        });

    </script>
    
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5dda9d39d96992700fc8fc63/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    
</body>
</html>

