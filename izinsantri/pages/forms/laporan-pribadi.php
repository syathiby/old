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


    if(!isset($_SESSION['nis'])) header("location: ../../login.php");
    include "../../inc/config.php"; 

    error_reporting(0);

 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Laporan Akademis Santri - Syathiby Academy 2.0 | Ma'had Al Imam Asy Syathiby</title>
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

    <!-- Light Gallery Plugin Css -->
    <link href="../../plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

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
        <input type="text" placeholder="Ketik Langsung Disini...">
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
                $sql = mysqli_query ($koneksi, "SELECT * FROM identitas") or die (mysqli_error());
                $data = mysqli_fetch_array ($sql)
                ?>
                <a class="navbar-brand" href="index.php"><?php echo $data['judul_web']; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true">Cari<i class="material-icons">search</i></a></li>
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
                if($_SESSION['nis']){
                  $nis=$_SESSION['nis'];
                  
                  $sql_cek=mysqli_query($koneksi, "SELECT * FROM data_diri WHERE nis='$nis'");
                  $data = mysqli_fetch_array ($sql_cek);
                ?>
                <div class="image">
                    <img src="../../photo/<?php echo $data['photodiri']; ?>" width="48" height="48" alt="User" />
                </div>
                <?php } ?>
                <div class="info-container">
                    <?php 
                    if($_SESSION['namadepan']){
                        $lagi_login = $_SESSION['namadepan'];
                    }

                     ?>
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ahlan, <?php echo $lagi_login; ?></div>
                    <?php
                    $sql = mysqli_query ($koneksi, "SELECT * FROM identitas") or die (mysqli_error());
                    $data = mysqli_fetch_array ($sql)
                    ?>
                    <div class="email">Selamat Datang di <?php echo $data['welcome'];?> </div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                            <li role="separator" class="divider"></li>
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
                        if ($_SESSION['santri'] || $_SESSION['admin'] || $_SESSION['pengampu']) {

                         ?>
                    <li class="active">
                        <a href="#">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    <?php }?>

                     <?php 
                        if ($_SESSION['admin']) {

                         ?>
                     <li class="">
                        <a href="pages/tables/tabelsantri.php">
                            <i class="material-icons">account_box</i>
                            <span>Data Santri</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="lulusumum.php">
                            <i class="material-icons">assignment</i>
                            <span>Pengumuman Kelulusan</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php 
                        if ($_SESSION['santri']) {

                         ?>
                    <li>
                        <a href="#">
                            <i class="material-icons">account_box</i>
                            <span>Profil</span>
                        </a>
                    </li>
                    
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Laporan</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="active">
                                <a href="#">Laporan Pribadi</a>
                            </li>
                            <li>
                                <a href="lulusumum.php">Laporan Umum</a>
                            </li>
                        </ul>
                    </li>
                        <?php } ?>

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

                        <?php 
                        if ($_SESSION['santri'] || $_SESSION['admin']) {

                         ?>
                        <a href="../ui/hubungilogin.php">
                            <i class="material-icons">phone_in_talk</i>
                            <span>Hubungi Kami </span>
                        </a>
                         <?php } ?>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
               <?php
                $sql = mysqli_query ($koneksi, "SELECT * FROM identitas") or die (mysqli_error());
                $data = mysqli_fetch_array ($sql)
                ?>
                <div class="copyright">
                    &copy; 2019 <a href="#"><?php echo $data['copyright']; ?></a>
                </div>
                <div class="version">
                    Dikembangkan Oleh: <b><a href="#"><?php echo $data['developer']; ?></a></b>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>HALAMAN SANTRI</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                LAPORAN TAHFIZH PRIBADI
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

                            <?php 
                            
                            if($_SESSION['nis']){
                                
                                $login=$_SESSION['nis'];
                               
                                $sql_kode=mysqli_query($koneksi, "SELECT * FROM pribadi WHERE nis='$login' ");
                                $data_dapat = mysqli_fetch_array ($sql_kode);

                            ?>
                            <form class="form-horizontal">

                                <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        SABAQ
                                    </button>
                                </div>
                                </div>

				                <label>Sabaq : Hafalan Baru Yang Disetorkan</label>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nomor Surat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="surat_sabaq" class="form-control" 
                                                value="<?php echo $data_dapat['surat_sabaq'] ?>" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Halaman</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hal_sabaq" class="form-control" value="<?php echo $data_dapat['hal_sabaq']?> Halaman" disabled/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="email_address_2">Juz</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="juz_sabaq" class="form-control" value="Juz <?php echo $data_dapat['juz_sabaq'] ?>" disabled/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="email_address_2">Target Setoran</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="target_sabaq" class="form-control" value="<?php echo $data_dapat['target_sabaq']?> Halaman" disabled/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="tempat_lahir">Nilai</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nilai_sabaq" class="form-control" value="<?php echo $data_dapat['nilai_sabaq'] ?>" disabled/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="tempat_lahir">Taqdir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="taqdir_sabaq" class="form-control" value="<?php echo $data_dapat['taqdir_sabaq'] ?>" disabled/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="tempat_lahir">Jenis Kelamin</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="jk" class="form-control" value="<?php echo $data_ubah['jk'] ?>" disabled/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>    

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="tempat_lahir">Sekolah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="asal_sekolah" class="form-control" value="<?php echo $data_ubah['asal_sekolah'] ?>" disabled/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="tempat_lahir">NISN</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nisn" class="form-control" value="<?php echo $data_ubah['nisn'] ?>" disabled/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="tempat_lahir">Program Pilihan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="program_pilihan" class="form-control" value="<?php echo $data_ubah['program_pilihan'] ?>" disabled/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>  

                                <!--AWAL DATA AYAH-->
                                <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA AYAH
                                    </button>
                                </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nama Ayah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_ayah" value="<?php echo $data_ubah['nama_ayah'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tempat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ayah" value="<?php echo $data_ubah['tmp_ayah'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ayah" class="form-control" value="<?php echo $data_ubah['tgl_ayah'] ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Alamat Tinggal</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <textarea rows="4" name="alamat_ayah" class="form-control no-resize"><?php echo $data_ubah['alamat_ayah'] ?> </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>No.HP Ayah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_ayah" class="form-control" value="<?php echo $data_ubah['hp_ayah'] ?>" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pekerjaan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ayah" value="<?php echo $data_ubah['pekerjaan_ayah'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ayah" class="form-control" value="<?php echo $data_ubah['pendidikan_ayah'] ?>" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ayah" value="<?php echo $data_ubah['penghasilan_ayah'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--#AKHIR DATA AYAH-->

                                <!--AWAL DATA IBU-->
                                <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA IBU
                                    </button>
                                </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nama Ibu</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_ibu" value="<?php echo $data_ubah['nama_ibu'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tempat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ibu" value="<?php echo $data_ubah['tmp_ibu'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ibu" class="form-control" value="<?php echo $data_ubah['tgl_ibu'] ?>" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Alamat Tinggal</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <textarea rows="4" name="alamat_ibu" class="form-control no-resize"><?php echo $data_ubah['alamat_ibu'] ?> </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>No.HP Ibu</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_ibu" class="form-control" value="<?php echo $data_ubah['hp_ibu'] ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pekerjaan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="pekerjaan_ibu" value="<?php echo $data_ubah['pekerjaan_ibu'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="pendidikan_ibu" class="form-control" value="<?php echo $data_ubah['pendidikan_ibu'] ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="penghasilan_ibu" value="<?php echo $data_ubah['penghasilan_ibu'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--#AKHIR DATA IBU-->

                                <!--AWAL DATA WALI-->
                                <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA WALI
                                    </button>
                                </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nama Wali</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_ayah" value="<?php echo $data_ubah['nama_wali'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tempat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ayah" value="<?php echo $data_ubah['tmp_wali'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ayah" class="form-control" value="<?php echo $data_ubah['tgl_wali'] ?>" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Alamat Tinggal</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <textarea rows="4" name="alamat_ayah" class="form-control no-resize"><?php echo $data_ubah['alamat_wali'] ?> </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>No.HP Wali</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_ayah" class="form-control" value="<?php echo $data_ubah['hp_wali'] ?>"disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pekerjaan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ayah" value="<?php echo $data_ubah['pekerjaan_wali'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ayah" class="form-control" value="<?php echo $data_ubah['pendidikan_wali'] ?>" disabled />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ayah" value="<?php echo $data_ubah['penghasilan_wali'] ?>" class="form-control" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--#AKHIR DATA IBU-->

                                <!--BERKAS PENTING-->
                                <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        BERKAS PENTING
                                    </button>
                                </div>
                                </div>

                                <div class="body" align="center">
                                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a href="../../img/<?php echo $data_ubah['transkrip']; ?>" data-sub-html="Transkrip Nilai">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $data_ubah['transkrip']; ?>" width="200px">
                                        </a>
                                    </div>
                                    
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a href="../../img/<?php echo $data_ubah['ktp_ortu']; ?>" data-sub-html="KTP Orang Tua">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $data_ubah['ktp_ortu']; ?>" width="200px">
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a href="../../img/<?php echo $data_ubah['surat_sehat']; ?>" data-sub-html="Surat Keterangan Sehat Santri">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $data_ubah['surat_sehat']; ?>" width="200px">
                                        </a>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a href="../../img/<?php echo $data_ubah['kartu_kel']; ?>" data-sub-html="Kartu Keluarga">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $data_ubah['kartu_kel']; ?>" width="200px">
                                        </a>
                                    </div>
                                    </div>
                                
                                </div>
                                <!--#AKHIR BERKAS PENTING-->
                               
                                <?php } ?>

                            </form>

                        <div class="row clearfix">
                                    <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-2 col-xs-offset-4">
                                        <a href="editdata.php"><button class="btn btn-primary m-t-15 waves-effect">Ubah Data Pribadi</button></a>
                                    </div>
                                </div>
                        </div>
                          

                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
        
            </div>
        </div>
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
    <script src="../../js/pages/medias/image-gallery.js"></script>

    <!-- Light Gallery Plugin Js -->
    <script src="../../plugins/light-gallery/js/lightgallery-all.js"></script>
    
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

</body>
</html>