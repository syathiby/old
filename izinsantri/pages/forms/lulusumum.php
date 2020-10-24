<?php 

ob_start();
session_start();
//Membuat batasan waktu sesion untuk user di PHP 
$timeout = 1; // Set timeout menit
$logout_redirect_url = "../../index.php"; // Set logout URL
 
$timeout = $timeout * 1800; // Ubah menit ke detik
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Sesi Anda Telah Berakhir, Silahkan Login Kembali!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();


    if(!isset($_SESSION['akun_username'])) header("location: ../../login.php");
    include "../../inc/config.php"; 

    error_reporting(0);

 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Pengumuman Kelulusan Tes Masuk - PSB Online | Ma'had Al Imam Asy Syathiby</title>
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

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

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
        <input type="text" placeholder="Tulis Langsung Disini...">
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
                <a class="navbar-brand" href="../../index.php"><?php echo $data['judul_web']; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="profil.php"><i class="material-icons">account_circle</i></a></li>
                    <li><a href="../../logout.php"><i class="material-icons">open_in_new</i></a></li>
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
                    <img src="../../img/<?php echo $folder;?>/<?php echo $data_ubah['photodiri']; ?>" width="48" height="48" alt="User" />
                </div>
                <?php } ?>
                <div class="info-container">

                    <?php 
                    if($_SESSION['admin']){
                        $lagi_login = $_SESSION['admin'];
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
                            <li><a href="profil.php"><i class="material-icons">person</i>Profil</a></li>
                        
                          
                            <li><a href="../../logout.php"><i class="material-icons">input</i>Sign Out</a></li>
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
                    <li class="">
                        <a href="../../index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="profil.php">
                            <i class="material-icons">account_box</i>
                            <span>Profil</span>
                        </a>
                    </li>
                    
                    <li class="">
                        <a href="kartutes.php">
                            <i class="material-icons">print</i>
                            <span>Cetak Kartu Tes</span>
                        </a>
                    </li>
                    
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Hasil Tes Masuk</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="luluspribadi.php">Kelulusan Pribadi</a>
                            </li>
                            <li class="active">
                                <a href="#">Kelulusan Umum</a>
                            </li>
                        </ul>

                        <?php } ?>
                    </li>
                        <?php 
                        if ($_SESSION['admin'] || $_SESSION['santri']) {

                         ?>

                    </li>
                        <a href="../ui/panduan-aplikasi.php">
                            <i class="material-icons">video_library</i>
                            <span>Panduan Aplikasi</span>
                        </a>
                        
                    </li>
                    
                        <?php } ?>
                    <li>
                        <?php 
                        if ($_SESSION['santri'] || $_SESSION['admin']) {

                         ?>
                        <a href="../ui/hubungilogin.php">
                            <i class="material-icons">phone_in_talk</i>
                            <span>Hubungi Kami </span>
                        </a>
                         <?php } ?>
                    </li>
                    
                    <li>
                        <?php 
                        if ($_SESSION['santri'] || $_SESSION['admin']) {

                         ?>
                        <a href="../../logout.php">
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
                    &copy; 2018 <a href="javascript:void(0);"><?php echo $data['copyright']; ?></a>.
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
           
            <!-- Example -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                HASIL TES MASUK MA'HAD IMAM SYATHIBY 2019-2020
                            </h2>
                            <br>
                            <p>    
                                Berikut kami lampirkan data hasil <b>Tes Masuk Ma'had Tahfizh Al Quran Al Imam Asy Syathiby Tahun Ajaran 2019-2020.</b>
                                Kepada santri yang telah dinyatakan <b>LULUS</b> harap segera melakukan <b>Daftar Ulang</b> sesuai waktu yang telah ditentukan.
                                <br><br>
                                
                                <!--
                                <b>KRITERIA KELULUSAN :</b><br>
                                1. Total Nilai Tes lebih dari 70<br>
                                2. Termasuk ke dalam peringkat kuota yang tersedia:<br>
                                    Ikhwan : Peringkat 1-71<br>
                                    Akhwat : Peringkat 1-70
                                <br>
                                <br>
                                <b>PERHATIAN!</b> Sehubungan dengan jumlah santri yang LULUS memenuhi kuota, maka dengan ini kami informasikan bahwa 
                                <b>"Pendaftaran Santri Baru Tahun Ajaran 2019-2020 TUTUP - Tidak Ada Gelombang 2"</b>
                                -->
                            </p>
                        </div>
                        <div class="body">
                            
                            
                            <div class="alert alert-info">
                                <strong>DATA IKHWAN</strong>
                            </div>
                           
                            <!--HOLD
                            <div class="body">
                            <div class="alert alert-success">
                                <strong>MOHON MAAF!</strong> Belum Ada Data Yang Ditampilkan, Masih Menunggu Perhitungan Hasil Tes!
                            </div>
                            </div>
                            -->
                            
                            <div class="table-responsive">
                                <?php
                                    $sql = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level='admin'");
                                    $data_baru = mysqli_fetch_array ($sql);
                                ?> 
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">

                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jumlah Hafalan</th>
                                            <th>Asal Sekolah</th>
                                            <th>Total Nilai (100)</th>
                                            <th>Hasil Akhir</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                       <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username 
                                            WHERE identitas.level='Santri' AND identitas.jk='Laki-laki' AND hasil.seleksi_berkas='LULUS' ORDER BY hasil.nilai_akhir DESC") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {
                                            $status1 = $data_baru['publikasi'];

                                         ?>
                                        
                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td><?php echo $data['namalengkap']; ?></td>
                                            <td><?php echo $data['tgl_lahir']; ?></td>
                                            <td><?php echo $data['hafalan'];?></td>
                                            <td><?php echo $data['asal_sekolah']; ?></td>
                                            
                                            <!--HOLD
                                            <td>
                                                <?php 
                                                if($status1 == "Hold"){
                                                ?>Menunggu
                                                <?php
                                                }
                                                
                                                else {
                                                 echo $data['tes_tahfizh'];   
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($status1 == "Hold"){
                                                ?>Menunggu
                                                <?php
                                                }
                                                
                                                else {
                                                 echo $data['tes_psikologi'];   
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($status1 == "Hold"){
                                                ?>Menunggu
                                                <?php
                                                }
                                                
                                                else {
                                                 echo $data['tes_kesehatan'];   
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($status1 == "Hold"){
                                                ?>Menunggu
                                                <?php
                                                }
                                                
                                                else {
                                                 echo $data['tes_wawancara'];   
                                                }
                                                ?>
                                            </td>
                                            -->
                                            <td>
                                                <?php 
                                                if($status1 == "Hold"){
                                                ?>Diproses
                                                <?php
                                                }
                                                
                                                else {
                                                 echo $data['nilai_akhir'];   
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($status1 == "Hold"){
                                                ?>Diproses
                                                <?php
                                                }
                                                
                                                else {
                                                 if($data['hasil_akhir'] == "LULUS"){
                                                     ?>
                                                     <button class="btn bg-green btn-block btn-xs waves-effect">LULUS</button>
                                                 <?php     
                                                 }
                                                 else if($data['hasil_akhir'] == "GAGAL") {
                                                     ?>
                                                     <button class="btn bg-red btn-block btn-xs waves-effect">GAGAL</button>
                                                 <?php     
                                                 }
                                                 else {
                                                     ?>
                                                     <button class="btn bg-orange btn-block btn-xs waves-effect">Diproses</button>
                                                 <?php
                                                 }
                                                } 
                                                ?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <?php 
                                $sql_cek = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level='Santri' AND jk='Laki-laki'");
                                $status3 = $data_baru['publikasi']; 
                                ?>
                                <div class="row clearfix">
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">TOTAL Ikhwan <span class="badge">
                                    <?php echo mysqli_num_rows($sql_cek); ?> Santri</span></button>
                                    </div>
                                <?php
                                if($status3 == "Hold"){
                                        ?>
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">LULUS (Ikhwan)<span class="badge">
                                    0 Santri</span></button>
                                    </div>
                                    <?php
                                    }
                                    
                                    else {
          
                                    $sql_lulus1 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username
                                    WHERE hasil.hasil_akhir='LULUS' AND identitas.jk='Laki-laki'"); 
                                    ?>
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">LULUS (Ikhwan)<span class="badge">
                                    <?php echo mysqli_num_rows($sql_lulus1); ?> Santri</span></button>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                <?php
                                if($status3 == "Hold"){
                                        ?>
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">GAGAL (Ikhwan)<span class="badge">
                                    0 Santri</span></button>
                                    </div>
                                    <?php
                                    }
                                    
                                    else {
                                    $sql_gagal = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username
                                    WHERE hasil.hasil_akhir='GAGAL' AND identitas.jk='Laki-laki'"); 
                                    ?>
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">GAGAL (Ikhwan)<span class="badge">
                                    <?php echo mysqli_num_rows($sql_gagal); ?> Santri</span></button>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
                            
                            
                            
                            <div class="alert alert-danger">
                                <strong>DATA AKHWAT</strong>
                            </div>
                            
                            <!--HOLD
                            <div class="body">
                            <div class="alert alert-success">
                                <strong>MOHON MAAF!</strong> Belum Ada Data Yang Ditampilkan, Masih Menunggu Perhitungan Hasil Tes!
                            </div>
                            </div>
                            -->
                            
                           
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">

                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Jumlah Hafalan</th>
                                            <th>Asal Sekolah</th>
                                            <th>Total Nilai (100)</th>
                                            <th>Hasil Akhir</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                       <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username 
                                            WHERE identitas.level='Santri' AND identitas.jk='Perempuan' AND hasil.seleksi_berkas='LULUS' ORDER BY hasil.nilai_akhir DESC") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {
                                            $status = $data_baru['publikasi'];

                                         ?>
                                        
                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td><?php echo $data['namalengkap']; ?></td>
                                            <td><?php echo $data['tgl_lahir']; ?></td>
                                            <td><?php echo $data['hafalan'];?></td>
                                            <td><?php echo $data['asal_sekolah']; ?></td>
                                            <!--HOLD
                                            <td>
                                                <?php 
                                                if($status == "Hold"){
                                                ?>Menunggu
                                                <?php
                                                }
                                                
                                                else {
                                                 echo $data['tes_tahfizh'];   
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($status == "Hold"){
                                                ?>Menunggu
                                                <?php
                                                }
                                                
                                                else {
                                                 echo $data['tes_psikologi'];   
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($status == "Hold"){
                                                ?>Menunggu
                                                <?php
                                                }
                                                
                                                else {
                                                 echo $data['tes_kesehatan'];   
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($status == "Hold"){
                                                ?>Menunggu
                                                <?php
                                                }
                                                
                                                else {
                                                 echo $data['tes_wawancara'];   
                                                }
                                                ?>
                                            </td>
                                            -->
                                            
                                            <td>
                                                <?php 
                                                if($status == "Hold"){
                                                ?>Diproses
                                                <?php
                                                }
                                                
                                                else {
                                                 echo $data['nilai_akhir'];   
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                if($status == "Hold"){
                                                ?>Diproses
                                                <?php
                                                }
                                                
                                                else {
                                                 if($data['hasil_akhir'] == "LULUS"){
                                                     ?>
                                                     <button class="btn bg-green btn-block btn-xs waves-effect">LULUS</button>
                                                 <?php     
                                                 }
                                                 else if($data['hasil_akhir'] == "GAGAL") {
                                                     ?>
                                                     <button class="btn bg-red btn-block btn-xs waves-effect">GAGAL</button>
                                                 <?php     
                                                 }
                                                 else {
                                                     ?>
                                                     <button class="btn bg-orange btn-block btn-xs waves-effect">Diproses</button>
                                                 <?php
                                                 }
                                                } 
                                                ?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                                    $sql = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level='admin'");
                                    $data_baru = mysqli_fetch_array ($sql);
                                ?> 
                            <?php 
                                $sql_cek = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level='Santri' AND jk='Perempuan'");
                                $status4 = $data_baru['publikasi']; 
                                ?>
                                <div class="row clearfix">
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">TOTAL Akhwat <span class="badge">
                                    <?php echo mysqli_num_rows($sql_cek); ?> Santri</span></button>
                                    </div>
                                <?php
                                    if($status4 == "Hold"){
                                        ?>
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">LULUS (Akhwat)<span class="badge">
                                    0 Santri</span></button>
                                    </div>
                                    <?php
                                    }
                                    
                                    else {
                                    $sql_lulus = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username
                                    WHERE hasil.hasil_akhir='LULUS' AND identitas.jk='Perempuan'"); 
                                    ?>
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">LULUS (Akhwat)<span class="badge">
                                    <?php echo mysqli_num_rows($sql_lulus); ?> Santri</span></button>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($status4 == "Hold"){
                                        ?>
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">GAGAL (Akhwat)<span class="badge">
                                    0 Santri</span></button>
                                    </div>
                                    <?php
                                    }
                                    
                                    else {
                                    $sql_gagal = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username
                                    WHERE hasil.hasil_akhir='GAGAL' AND identitas.jk='Perempuan'"); 
                                    ?>
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">GAGAL (Akhwat)<span class="badge">
                                    <?php echo mysqli_num_rows($sql_gagal); ?> Santri</span></button>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    
                                </div>
 
                        </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- #END# Example -->
    </section>


    <!-- Chart Plugins Js -->
    <script src="../../plugins/chartjs/Chart.bundle.js"></script>

     <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>

     <!-- Jquery DataTable Plugin Js -->
    <script src="../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
    
     <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
    
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5dad0d7a78ab74187a5a9de0/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

</body>
</html>