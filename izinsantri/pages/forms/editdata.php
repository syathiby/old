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


    if(!isset($_SESSION['akun_id'])) header("location: ../../login.php");
    include "../../inc/config.php"; 

    error_reporting(0);

 ?>


<!DOCTYPE html>
<html>



<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Ubah Data Santri - PSB Online | Ma'had Al Imam Asy Syathiby</title>
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

     <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
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
                <a class="navbar-brand" href="../../index.php">PSB Online - Ma'had Al Imam Asy Syathiby</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="profil.php" class="js-search" data-close="true"><i class="material-icons">account_circle</i></a></li>
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
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$usern' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);

                            ?>
                <div class="image">
                    <img src="../../img/<?php echo $data_ubah['photodiri']; ?>" width="48" height="48" alt="User" />
                </div>
                <?php } ?>
                <div class="info-container">

                    <?php 
                    if($_SESSION['admin']){
                        $lagi_login = $_SESSION['admin'];
                    }
                    else if($_SESSION['namadepan']){
                        $lagi_login = $_SESSION['namadepan'];
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
                    <li class="active">
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
                    
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Hasil Tes Masuk</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="luluspribadi.php">Kelulusan Pribadi</a>
                            </li>
                            <li>
                                <a href="lulusumum.php">Kelulusan Umum</a>
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
                            <span>Hubungi Kami </span>
                        </a>
                         <?php } ?>
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
        
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>UBAH DATA PRIBADI</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BIODATA DIRI
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
                            
                            if($_SESSION['username']){
                                $usern=$_SESSION['username'];
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$usern' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);

                            ?>
                            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Username</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="username" class="form-control" 
                                                value="<?php echo $data_ubah['username'] ?>" disabled />
                                            </div>
                                            
                                                <input type="hidden" name="id" class="form-control" 
                                                value="<?php echo $data_ubah['id'] ?>" />
                                            
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="password" class="form-control" value="<?php echo $data_ubah['password']?>" />
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="email_address_2">Nama</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="namadepan" class="form-control" value="<?php echo $data_ubah['namadepan'] ?>"/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="email_address_2">Nama Belakang</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="namabelakang" class="form-control" value="<?php echo $data_ubah['namabelakang'] ?>"/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="tempat_lahir">Tempat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo $data_ubah['tempat_lahir'] ?>"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="tempat_lahir">Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_lahir" class="form-control" value="<?php echo $data_ubah['tgl_lahir'] ?>"/>
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
                                            
                                            <select name="jk" class="form-control">
                                                <option><?php echo $data_ubah['jk']?></option>
                                                <option value="LAKI-LAKI">LAKI-LAKI</option>
                                                <option value="LAKI-LAKI">PEREMPUAN</option>
                                            </select>    
                                        
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
                                                <input type="text" name="asal_sekolah" class="form-control" value="<?php echo $data_ubah['asal_sekolah'] ?>"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="tempat_lahir">NISN</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nisn" class="form-control" value="<?php echo $data_ubah['nisn'] ?>"/>
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
                                            <select name="program_pilihan" class="form-control">
                                                <option><?php echo $data_ubah['program_pilihan']?></option>
                                                <option value="Intensif Putra">Intensif Putra</option>
                                                <option value="Intensif Putri">Intensif Putri</option>
                                                <option value="Murojaah Putra">Muroja'ah Putra</option>
                                                <option value="Murojaah Putri">Muroja'ah Putri</option>
                                                <option value="Sanad Putra">Sanad Putra</option>
                                                <option value="Sanad Putri">Sanad Putri</option>
                                            </select>    
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
                                                <input type="text" name="nama_ayah" value="<?php echo $data_ubah['nama_ayah'] ?>" class="form-control"/>
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
                                                <input type="text" name="tmp_ayah" value="<?php echo $data_ubah['tmp_ayah'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ayah" class="form-control" value="<?php echo $data_ubah['tgl_ayah'] ?>" />
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
                                                <input type="text" name="hp_ayah" class="form-control" value="<?php echo $data_ubah['hp_ayah'] ?>" />
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
                                            <select name="pekerjaan_ayah" class="form-control">
                                                <option><?php echo $data_ubah['pekerjaan_ayah'] ?></option>
                                                <option value="----">----</option>
                                                <option value="PNS">PNS</option>
                                                <option value="KARYAWAN">Karyawan Swasta</option>
                                                <option value="PEDAGANG">Pedagang</option>
                                                <option value="PENGUSAHA">Pengusaha</option>
                                                <option value="GURU">Guru</option>
                                                <option value="POLISI">Polisi</option>
                                                <option value="TNI">TNI</option>
                                                <option value="PILOT">Pilot</option>
                                                <option value="MASINIS">Masinis</option>
                                                <option value="NAHKODA">Nahkoda</option>
                                                <option value="DOKTER">Dokter</option>
                                                <option value="APOTEKER">Apoteker</option>
                                                <option value="FREELANCER">Freelancer</option>
                                                <option value="LAINNYA">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                         <div class="form-group">
                                            <select name="pendidikan_ayah" class="form-control">
                                                <option><?php echo $data_ubah['pendidikan_ayah'] ?></option>
                                                <option value="----">----</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="DIPLOMA">Diploma</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="ACADEMY">Academy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="penghasilan_ayah" class="form-control">
                                                <option><?php echo $data_ubah['penghasilan_ayah']?></option>
                                                <option value="----">----</option>
                                                <option value=">20 JUTA">>20.000.000</option>
                                                <option value="15-20 JUTA">15.000.000 - 20.000.000</option>
                                                <option value="10-15 JUTA">10.000.000 - 15.000.000</option>
                                                <option value="5-9 JUTA">5.000.000 - 9.000.000</option>
                                                <option value="3-5 JUTA">3.000.000 - 5.000.000</option>
                                                <option value="2-3 JUTA">2.000.000 - 3.000.000</option>
                                                <option value="1-2 JUTA">1.000.000 - 2.000.000</option>
                                                <option value="<1 JUTA">Di bawah 1.000.000</option>
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
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nama Ibu</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_ibu" value="<?php echo $data_ubah['nama_ibu'] ?>" class="form-control"/>
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
                                                <input type="text" name="tmp_ibu" value="<?php echo $data_ubah['tmp_ibu'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ibu" class="form-control" value="<?php echo $data_ubah['tgl_ibu'] ?>" />
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
                                        <label>No.HP Ayah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_ibu" class="form-control" value="<?php echo $data_ubah['hp_ibu'] ?>" />
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
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
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
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
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
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nama Wali</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_wali" value="<?php echo $data_ubah['nama_wali'] ?>" class="form-control"/>
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
                                                <input type="text" name="tmp_wali" value="<?php echo $data_ubah['tmp_wali'] ?>" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_wali" class="form-control" value="<?php echo $data_ubah['tgl_wali'] ?>" />
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
                                            <textarea rows="4" name="alamat_wali" class="form-control no-resize"><?php echo $data_ubah['alamat_wali'] ?> </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>No.HP Wali</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_wali" class="form-control" value="<?php echo $data_ubah['hp_wali'] ?>" />
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

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
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
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
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
                                
                                <!--UPLOAD BERKAS-->
                                 <div class="row clearfix jsdemo-notification-button">
                            		 <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        REVISI BERKAS
                                    </button>
                                </div>
                            	</div>
                                <label>Hanya Menerima File Dalam Format (.jpg .jpeg .png) TIDAK Menerima Dalam Format (.pdf)</label>
                                <label>PERHATIAN! Ukuran Maksimal Masing-Masing File Adalah <b>1 MB</b>, Lebih Dari Itu akan GAGAL!</label>
                            	<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Photo</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            
                                            <div class="form-line">
                                                <input type="file"  accept="image/*" name="photodiri" class="form-control">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row clearfix">    
                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Transkrip Nilai</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file"  accept="image/*" name="transkrip" class="form-control">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Kartu Keluarga</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" accept="image/*" name="kartu_kel" class="form-control"/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
      
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>KTP Orang Tua</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" accept="image/*"  name="ktp_ortu" class="form-control">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Surat Keterangan Sehat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" accept="image/*" name="surat_sehat" class="form-control">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" name="update" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                                    </div>
                                </div>

                                <?php

                                if(isset($_POST['update'])){
                                $id= $_POST['id'];
                                $password = $_POST['password'];
                                $namadepan = addslashes($_POST['namadepan']);
                                $namabelakang = addslashes($_POST['namabelakang']);
                                $tempat_lahir = $_POST['tempat_lahir'];
                                $tgl_lahir = $_POST['tgl_lahir'];
                                $jk = $_POST['jk'];
                                $asal_sekolah = addslashes($_POST['asal_sekolah']);
                                $nisn = $_POST['nisn'];
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
                                
                                $namaphoto=$_FILES['photodiri']['name'];
                                $namatranskrip=$_FILES['transkrip']['name'];
                                $namakartu_kel=$_FILES['kartu_kel']['name'];
                                $namaktp_ortu=$_FILES['ktp_ortu']['name'];
                                $namasurat_sehat=$_FILES['surat_sehat']['name'];
                                
                                $ukuranphoto = $_FILES['photodiri']['size'];
                                $ukurantranskrip = $_FILES['transkrip']['size'];
                                $ukurankartu_kel = $_FILES['kartu_kel']['size'];
                                $ukuranktp_ortu = $_FILES['ktp_ortu']['size'];
                                $ukuransurat_sehat = $_FILES['surat_sehat']['size'];
                                
                                $tipephoto = exif_imagetype($_FILES['photodiri']['tmp_name']);
                                $tipetranskrip = exif_imagetype($_FILES['transkrip']['tmp_name']);
                                $tipekartu_kel = exif_imagetype($_FILES['kartu_kel']['tmp_name']);
                                $tipektp_ortu = exif_imagetype($_FILES['ktp_ortu']['tmp_name']);
                                $tipesurat_sehat = exif_imagetype($_FILES['surat_sehat']['tmp_name']);
                                $allowed = array(IMAGETYPE_JPG, IMAGETYPE_JPEG, IMAGETYPE_PNG);
                                ?>
                    
                    <?php
                if($namaphoto !== "" or $namatranskrip !== "" or $namakartu_kel !=="" or $namaktp_ortu !=="" or $namasurat_sehat !==""){
                    
                    if(in_array($tipephoto,$allowed) or in_array($tipetranskrip,$allowed) or in_array($tipekartu_kel,$allowed) 
                     or in_array($tipektp_ortu,$allowed) or in_array($tipesurat_sehat,$allowed)){
                         
                        if($ukuranphoto < 1044070 or $ukurantranskrip < 1044070 or $ukurankartu_kel < 1044070 or $ukuranktp_ortu < 1044070 
                         or $ukuransurat_sehat < 1044070){
                                    $photodiri=$_FILES['photodiri']['tmp_name'];
                                    $transkrip=$_FILES['transkrip']['tmp_name'];
                                    $kartu_kel=$_FILES['kartu_kel']['tmp_name'];
                                    $ktp_ortu=$_FILES['ktp_ortu']['tmp_name'];
                                    $surat_sehat=$_FILES['surat_sehat']['tmp_name'];
                
                    $time = time();
                    $acak = rand(10000, 99999);
                    
                    $simpanphoto = "../../img/".$time."-".$acak."-".$namaphoto;
                    $simpantranskrip = "../../img/".$time."-".$acak."-".$namatranskrip;
                    $simpankartu_kel = "../../img/".$time."-".$acak."-".$namakartu_kel;
                    $simpanktp_ortu = "../../img/".$time."-".$acak."-".$namaktp_ortu;
                    $simpansurat_sehat = "../../img/".$time."-".$acak."-".$namasurat_sehat;
                
                $photobaru = $time."-".$acak."-".$namaphoto;
                $transkripbaru = $time."-".$acak."-".$namatranskrip;
                $kartu_kelbaru = $time."-".$acak."-".$namakartu_kel;
                $ktp_ortubaru = $time."-".$acak."-".$namaktp_ortu;
                $surat_sehatbaru = $time."-".$acak."-".$namasurat_sehat;
                
                if($namaphoto !== ""){
                   $upphoto = move_uploaded_file($photodiri, $simpanphoto);
                   if($upphoto == true){
                       $editphoto = mysqli_query($koneksi, "UPDATE akun SET photodiri='$photobaru' WHERE id='$id'");
                       if($editphoto == true){
                       ?>
                       <script type="text/javascript">
                        alert("Berhasil Revisi Berkas!");
                        window.location.href="profil.php";
                       </script>
                       <?php
                       }
                       else{
                    ?>
                       <script type="text/javascript">
                        alert("GAGAL Upload Berkas, Periksa Koneksi Anda!");
                       </script> 
                    <?php
                       }
                   }
                }
                
                if($namatranskrip !== ""){
                   $uptranskrip = move_uploaded_file($transkrip, $simpantranskrip);
                   if($uptranskrip == true){
                       $edittranskrip = mysqli_query($koneksi, "UPDATE akun SET transkrip='$transkripbaru' WHERE id='$id'");
                       if($edittranskrip == true){
                       ?>
                       <script type="text/javascript">
                        alert("Berhasil Revisi Berkas!");
                        window.location.href="profil.php";
                       </script>
                       <?php
                       }
                       else{
                    ?>
                       <script type="text/javascript">
                        alert("GAGAL Upload Berkas, Periksa Koneksi Anda!");
                       </script> 
                    <?php
                       }
                   }
                }
                
                if($namakartu_kel !== ""){
                   $upkk = move_uploaded_file($kartu_kel, $simpankartu_kel);
                   if($upkk == true){
                       $editkk = mysqli_query($koneksi, "UPDATE akun SET kartu_kel='$kartu_kelbaru' WHERE id='$id'");
                       if($editkk== true){
                       ?>
                       <script type="text/javascript">
                        alert("Berhasil Revisi Berkas!");
                        window.location.href="profil.php";
                       </script>
                       <?php
                       }
                       else{
                    ?>
                       <script type="text/javascript">
                        alert("GAGAL Upload Berkas, Periksa Koneksi Anda!");
                       </script> 
                    <?php
                       }
                   }
                }
                
                 if($namaktp_ortu !== ""){
                   $upktp = move_uploaded_file($ktp_ortu, $simpanktp_ortu);
                   if($upktp == true){
                       $editktp = mysqli_query($koneksi, "UPDATE akun SET ktp_ortu='$ktp_ortubaru' WHERE id='$id'");
                       if($editktp == true){
                       ?>
                       <script type="text/javascript">
                        alert("Berhasil Revisi Berkas!");
                        window.location.href="profil.php";
                       </script>
                       <?php
                       }
                       else{
                    ?>
                       <script type="text/javascript">
                        alert("GAGAL Upload Berkas, Periksa Koneksi Anda!");
                       </script> 
                    <?php
                       }
                   }
                }
                
                if($namasurat_sehat !== ""){
                   $upsurat = move_uploaded_file($surat_sehat, $simpansurat_sehat);
                   if($upsurat == true){
                       $editsurat = mysqli_query($koneksi, "UPDATE akun SET surat_sehat='$surat_sehatbaru' WHERE id='$id'");
                       if($editsurat == true){
                       ?>
                       <script type="text/javascript">
                        alert("Berhasil Revisi Berkas!");
                        window.location.href="profil.php";
                       </script>
                       <?php
                       }
                       else{
                    ?>
                       <script type="text/javascript">
                        alert("GAGAL Upload Berkas, Periksa Koneksi Anda!");
                       </script> 
                    <?php
                       }
                   }
                }
                
                        }
                        else{
                        ?>
                            <script type="text/javascript">
        	                alert("UPLOAD BERKAS GAGAL, Ukuran file terlalu besar!");
                            </script>
                        <?php
                            }
                            
                    }
                    
                    else{ // else validasi format
                    ?>
                        <script type="text/javascript">
        	            alert("UPLOAD GAGAL! Format File Upload Harus JPG/JPEG/PNG, Silahkan Coba Lagi");
                        </script>
        	        <?php
                    }
                }
                
                
                // Validasi upload (hasil true jika upload berhasil)
                    if(($upphoto == false) and ($uptranskrip == false) and ($upkk == false) and ($upktp == false) and ($upsurat == false)) {
                        
                                $update= mysqli_query($koneksi, "UPDATE akun SET password='$password', namadepan='$namadepan', 
                                        namabelakang='$namabelakang', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', jk='$jk',
                                        asal_sekolah='$asal_sekolah', nisn='$nisn', program_pilihan='$program_pilihan', nama_ayah='$nama_ayah', 
                                        tmp_ayah='$tmp_ayah', tgl_ayah='$tgl_ayah', alamat_ayah='$alamat_ayah', hp_ayah='$hp_ayah', 
                                        pendidikan_ayah='$pendidikan_ayah', pekerjaan_ayah='$pekerjaan_ayah', penghasilan_ayah='$penghasilan_ayah',
                                        nama_ibu='$nama_ibu', tmp_ibu='$tmp_ibu', tgl_ibu='$tgl_ibu', alamat_ibu='$alamat_ibu', hp_ibu='$hp_ibu',
                                        pendidikan_ibu='$pendidikan_ibu', pekerjaan_ibu='$pekerjaan_ibu', penghasilan_ibu='$penghasilan_ibu',
                                        nama_wali='$nama_wali', tmp_wali='$tmp_wali', tgl_wali='$tgl_wali', alamat_wali='$alamat_wali', 
                                        hp_wali='$hp_wali', pendidikan_wali='$pendidikan_wali', pekerjaan_wali='$pekerjaan_wali', 
                                        penghasilan_wali='$penghasilan_wali'
                                        WHERE id='$id'");
                                if($update == true){
                                        ?>
                                        <script type="text/javascript">
                                        alert("Berhasil Ubah Data Pribadi!");
                                        window.location.href="profil.php";
                                        </script>

                                <?php        
                                }
                                else {
                                    echo "Gagal UPDATE! Periksa kembali kolom isian anda";
                                }
                            
                            }
                            
                    }
                                ?>
                            </form>

                        <?php } ?>
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
    <script src="../../js/pages/ui/notifications.js"></script>
    <script src="../../js/pages/examples/sign-in.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

    <!-- Moment Plugin Js -->
    <script src="../../plugins/momentjs/moment.js"></script>

      <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>
</body>
</html>