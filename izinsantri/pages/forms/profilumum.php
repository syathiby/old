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
    <title>Ubah Data Calon Santri - PPDB Online | Ma'had Imam Syathiby</title>
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

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Light Gallery Plugin Css -->
    <link href="../../plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

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
        <input type="text" placeholder="Langsung Tulis Disini...">
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
                <a class="navbar-brand" href="../../index.php">PPDB Online - Ma'had Imam Syathiby</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
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
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$usern' ");
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
                    <div class="email">Selamat Datang di PPDB Online</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                      
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

                    <?php }?>

                     <?php 
                        if ($_SESSION['admin']) {

                         ?>
                     <li class="active">
                        <a href="../tables/tabelsantri.php">
                            <i class="material-icons">account_box</i>
                            <span>Seleksi Berkas</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="../tables/tabellulus.php">
                            <i class="material-icons">assignment</i>
                            <span>Pengumuman Kelulusan</span>
                        </a>
                    </li>
                    <?php } ?>

                    <?php 
                        if ($_SESSION['santri']) {

                         ?>
                    <li class="">
                        <a href="pages/form.php">
                            <i class="material-icons">content_paste</i>
                            <span>Profil</span>
                        </a>
                    </li>
                    
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>Pengumuman</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/ui/alerts.html">Kelulusan Pribadi</a>
                            </li>
                            <li>
                                <a href="pages/ui/animations.html">Kelulusan Umum</a>
                            </li>
                            <li>
                                <a href="pages/ui/badges.html">Cetak Kartu</a>
                            </li>
                        </ul>

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
                            <span>Hubungi Kami</span>
                        </a>
                         <?php } ?>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);">PPDB Online - Mahad Syathiby</a>.
                </div>
                <div class="version">
                   Dibuat oleh: <a href="https://facebook.com/Alendia.Desta" target="_blank"><b>ADS Dev</b></a>
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

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BIODATA SANTRI
                            </h2>
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
                            <?php 
                            
                            $idsantri=$_GET['id']; asdf
                               
                                $show = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username 
                                WHERE identitas.id='$idsantri'");
                                $data_ubah = mysqli_fetch_array ($show);

                            ?>
                            <form class="form-horizontal" method="POST" action="">
                                <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA SANTRI
                                    </button>
                                </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="email_address_2">Nama Lengkap</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="namalengkap" class="form-control" value="<?php echo $data_ubah['namalengkap'] ?>"/>
                                            </div>
                                            <input type="hidden" name="username" class="form-control" value="<?php echo $data_ubah['username'] ?>"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $data_ubah['tempat_lahir'] ?>"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="tempat_lahir">Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_lahir" class="form-control" value="<?php echo $data_ubah['tgl_lahir'] ?>"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="tempat_lahir">Jenis Kelamin</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="jk" class="form-control" value="<?php echo $data_ubah['jk'] ?>"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>    

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="tempat_lahir">Asal Sekolah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="asal_sekolah" class="form-control" value="<?php echo $data_ubah['asal_sekolah'] ?>"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="tempat_lahir">Jumlah Hafalan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nisn" class="form-control" value="<?php echo $data_ubah['hafalan'] ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="tempat_lahir">Program Pilihan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="program_pilihan" class="form-control" value="<?php echo $data_ubah['program_pilihan']?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <!--#AKHIR DATA SANTRI-->

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
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Nama Ayah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_ayah" value="<?php echo $data_ubah['nama_ayah'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Tempat Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ayah" value="<?php echo $data_ubah['tmp_ayah'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ayah" class="form-control" value="<?php echo $data_ubah['tgl_ayah'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Alamat Tinggal</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <textarea rows="4" name="alamat_ayah" class="form-control no-resize"><?php echo $data_ubah['alamat_ayah'] ?> </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>No.HP Ayah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_ayah" class="form-control" value="<?php echo $data_ubah['hp_ayah'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Pekerjaan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <select name="pekerjaan_ayah" class="form-control">
                                                <option><?php echo $data_ubah['pekerjaan_ayah'] ?></option>
                                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                                <option value="PNS">PNS</option>
                                                <option value="Karyawan">Karyawan Swasta</option>
                                                <option value="Pedagang">Pedagang</option>
                                                <option value="Pengusaha">Pengusaha</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Polisi">Polisi</option>
                                                <option value="TNI">TNI</option>
                                                <option value="Dokter">Dokter</option>
                                                <option value="Freelancer">Freelancer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                         <div class="form-group">
                                            <select name="pendidikan_ayah" class="form-control">
                                                <option><?php echo $data_ubah['pendidikan_ayah'] ?></option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="Academy">Academy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <select name="penghasilan_ayah" class="form-control">
                                                <option><?php echo $data_ubah['penghasilan_ayah']?></option>
                                                <option value=">20 Juta">>20.000.000</option>
                                                <option value="15-20 Juta">15.000.000 - 20.000.000</option>
                                                <option value="10-15 Juta">10.000.000 - 15.000.000</option>
                                                <option value="5-9 Juta">5.000.000 - 9.000.000</option>
                                                <option value="3-5 Juta">3.000.000 - 5.000.000</option>
                                                <option value="2-3 Juta">2.000.000 - 3.000.000</option>
                                                <option value="1-2 Juta">1.000.000 - 2.000.000</option>
                                                <option value="<1 Juta">Di bawah 1.000.000</option>
                                            </select>    
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
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Nama Ibu</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_ibu" value="<?php echo $data_ubah['nama_ibu'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Tempat Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ibu" value="<?php echo $data_ubah['tmp_ibu'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ibu" class="form-control" value="<?php echo $data_ubah['tgl_ibu'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Alamat Tinggal</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <textarea rows="4" name="alamat_ibu" class="form-control no-resize"><?php echo $data_ubah['alamat_ibu'] ?> </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>No.HP Ibu</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_ibu" class="form-control" value="<?php echo $data_ubah['hp_ibu'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Pekerjaan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <select name="pekerjaan_ibu" class="form-control">
                                                <option><?php echo $data_ubah['pekerjaan_ibu'] ?></option>
                                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                                <option value="PNS">PNS</option>
                                                <option value="Karyawan">Karyawan Swasta</option>
                                                <option value="Pedagang">Pedagang</option>
                                                <option value="Pengusaha">Pengusaha</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Polisi">Polisi</option>
                                                <option value="TNI">TNI</option>
                                                <option value="Dokter">Dokter</option>
                                                <option value="Freelancer">Freelancer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                         <div class="form-group">
                                            <select name="pendidikan_ibu" class="form-control">
                                                <option><?php echo $data_ubah['pendidikan_ibu'] ?></option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="Academy">Academy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <select name="penghasilan_ibu" class="form-control">
                                                <option><?php echo $data_ubah['penghasilan_ibu']?></option>
                                                <option value=">20 Juta">>20.000.000</option>
                                                <option value="15-20 Juta">15.000.000 - 20.000.000</option>
                                                <option value="10-15 Juta">10.000.000 - 15.000.000</option>
                                                <option value="5-9 Juta">5.000.000 - 9.000.000</option>
                                                <option value="3-5 Juta">3.000.000 - 5.000.000</option>
                                                <option value="2-3 Juta">2.000.000 - 3.000.000</option>
                                                <option value="1-2 Juta">1.000.000 - 2.000.000</option>
                                                <option value="<1 Juta">Di bawah 1.000.000</option>
                                            </select>    
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
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Nama Wali</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_wali" value="<?php echo $data_ubah['nama_wali'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Tempat Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_wali" value="<?php echo $data_ubah['tmp_wali'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_wali" class="form-control" value="<?php echo $data_ubah['tgl_wali'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Alamat Tinggal</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <textarea rows="4" name="alamat_wali" class="form-control no-resize"><?php echo $data_ubah['alamat_wali'] ?> </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>No.HP Wali</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_wali" class="form-control" value="<?php echo $data_ubah['hp_wali'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Pekerjaan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <select name="pekerjaan_wali" class="form-control">
                                                <option><?php echo $data_ubah['pekerjaan_wali'] ?></option>
                                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                                <option value="PNS">PNS</option>
                                                <option value="Karyawan">Karyawan Swasta</option>
                                                <option value="Pedagang">Pedagang</option>
                                                <option value="Pengusaha">Pengusaha</option>
                                                <option value="Guru">Guru</option>
                                                <option value="Polisi">Polisi</option>
                                                <option value="TNI">TNI</option>
                                                <option value="Dokter">Dokter</option>
                                                <option value="Freelancer">Freelancer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                         <div class="form-group">
                                            <select name="pendidikan_wali" class="form-control">
                                                <option><?php echo $data_ubah['pendidikan_wali'] ?></option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="Academy">Academy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <select name="penghasilan_wali" class="form-control">
                                                <option><?php echo $data_ubah['penghasilan_wali']?></option>
                                                <option value=">20 Juta">>20.000.000</option>
                                                <option value="15-20 Juta">15.000.000 - 20.000.000</option>
                                                <option value="10-15 Juta">10.000.000 - 15.000.000</option>
                                                <option value="5-9 Juta">5.000.000 - 9.000.000</option>
                                                <option value="3-5 Juta">3.000.000 - 5.000.000</option>
                                                <option value="2-3 Juta">2.000.000 - 3.000.000</option>
                                                <option value="1-2 Juta">1.000.000 - 2.000.000</option>
                                                <option value="<1 Juta">Di bawah 1.000.000</option>
                                            </select>    
                                        </div>
                                    </div>
                                </div>
                                <!--#AKHIR DATA WALI-->
                                
                                 <!--HASIL SELEKSI BERKAS-->
                                <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        HASIL SELEKSI
                                    </button>
                                </div>
                                </div>
                                
                                <div class="row clearfix">
                                 <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Seleksi Berkas</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <select name="seleksi_berkas" class="form-control">
                                                <option><?php echo $data_ubah['seleksi_berkas']?></option>
                                                <option value="Diproses">Diproses</option>
                                                <option value="LULUS">LULUS</option>
                                                <option value="GAGAL">GAGAL</option>
                                            </select>    
                                        </div>
                                    </div>
                                </div>
                            

                                 <!--BERKAS PENTING-->
                                <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        BERKAS PENTING
                                    </button>
                                </div>
                                </div>
                                
                                <?php
                                if($_SESSION['username']){
                                
                                $usern=$_SESSION['username'];
                                $thn_ajaran = $_SESSION['thn_ajaran'];
                                
                                $sql_draft = mysqli_query($koneksi, "SELECT * FROM draft WHERE thn_ajaran='$thn_ajaran'");
                                $draft = mysqli_fetch_array ($sql_draft); ?>
                                <div class="body" align="center">
                                    <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <a href="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['photodiri']; ?>" data-sub-html="Photo Santri">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['photodiri']; ?>" width="200px">
                                        </a>
                                    </div>
                                
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <a href="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['transkrip']; ?>" data-sub-html="Transkrip Nilai">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['transkrip']; ?>" width="200px">
                                        </a>
                                    </div>
  
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <a href="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['ktp_ortu']; ?>" data-sub-html="KTP Orang Tua">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['ktp_ortu']; ?>" width="200px">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <a href="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['surat_sehat']; ?>" data-sub-html="Surat Keterangan Sehat Santri">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['surat_sehat']; ?>" width="200px">
                                        </a>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <a href="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['kartu_kel']; ?>" data-sub-html="Kartu Keluarga">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['kartu_kel']; ?>" width="200px">
                                        </a>
                                    </div>
                                    </div>
                                
                                </div>
                                <?php } ?>
                                <!--#AKHIR BERKAS PENTING-->
                                
                                <div class="row clearfix">
                                    <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" name="update" class="btn btn-primary m-t-15 waves-effect">Simpan Data</button>
                                    </div>
                                </div>

                                <?php

                                if(isset($_POST['update'])){
                                
                                $id= $_POST['id'];
                                $username = $_POST['username'];
                                $password = $_POST['password'];
                                $namadepan = addslashes($_POST['namalengkap']);
                                $tempat_lahir = $_POST['tempat_lahir'];
                                $tgl_lahir = $_POST['tgl_lahir'];
                                $jk = $_POST['jk'];
                                $asal_sekolah = addslashes($_POST['asal_sekolah']);
                                $hafalan = $_POST['hafalan'];
                                $program_pilihan = $_POST['program_pilihan'];

                                $nama_ayah= addslashes($_POST['nama_ayah']);
                                $tmp_ayah= $_POST['tmp_ayah'];
                                $tgl_ayah= $_POST['tgl_ayah'];
                                $alamat_ayah= $_POST['alamat_ayah'];
                                $hp_ayah= $_POST['hp_ayah'];
                                $pendidikan_ayah= $_POST['pendidikan_ayah'];
                                $pekerjaan_ayah= $_POST['pekerjaan_ayah'];
                                $penghasilan_ayah= $_POST['penghasilan_ayah'];

                                $nama_ibu= addslashes($_POST['nama_ibu']);
                                $tmp_ibu= $_POST['tmp_ibu'];
                                $tgl_ibu = $_POST['tgl_ibu'];
                                $alamat_ibu = $_POST['alamat_ibu'];
                                $hp_ibu = $_POST['hp_ibu'];
                                $pendidikan_ibu = $_POST['pendidikan_ibu'];
                                $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
                                $penghasilan_ibu = $_POST['penghasilan_ibu'];

                                $nama_wali = $_POST['nama_wali'];
                                $tmp_wali = $_POST['tmp_wali'];
                                $tgl_wali = $_POST['tgl_wali'];
                                $alamat_wali = $_POST['alamat_wali'];
                                $hp_wali = $_POST['hp_wali'];
                                $pendidikan_wali = $_POST['pendidikan_wali'];
                                $pekerjaan_wali = $_POST['pekerjaan_wali'];
                                $penghasilan_wali = $_POST['penghasilan_wali'];
                                $seleksi_berkas= $_POST['seleksi_berkas'];

                                
                                $update = mysqli_query($koneksi, "UPDATE hasil SET seleksi_berkas='$seleksi_berkas' 
                                        WHERE username='$username'");
                                if($update){
                                        ?>
                                        <script type="text/javascript">
                                        alert("Berhasil Update!");
                                        window.location.href="../tables/tabelsantri.php";
                                        </script>

                                <?php        
                                }
                                else {
                                    echo "Gagal!";
                                }
                            }
                            
                                ?>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
           
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

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/medias/image-gallery.js"></script>

    <!-- Light Gallery Plugin Js -->
    <script src="../../plugins/light-gallery/js/lightgallery-all.js"></script>
    
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/ui/notifications.js"></script>
    <script src="../../js/pages/examples/sign-in.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

    <!-- Moment Plugin Js -->
    <script src="../../plugins/momentjs/moment.js"></script>


</body>
</html>