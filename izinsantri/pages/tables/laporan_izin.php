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


    if(!isset($_SESSION['akun_username'])) header("location: login.php");
    include "../../inc/config.php"; 

    error_reporting(0);

 ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Laporan Perizinan Santri - Kesantrian Apps | Ma'had Al Imam Asy Syathiby</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    
     <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

     <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

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
                <a class="navbar-brand" href="../../index.php"><?php echo $data['judul_web']; ?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <?php 
                        if ($_SESSION['santri']) {

                         ?>
                    <li><a href="pages/forms/profil.php"><i class="material-icons">account_circle</i></a></li>
                    <?php } ?>
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
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$usern' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);

                            ?>
                <div class="image">
                    <img src="../../img/<?php echo $data_ubah['photo']; ?>" width="48" height="48" alt="User" />
                </div>
                <?php } ?>
                <div class="info-container">

                    <?php 
                    if($_SESSION['namalengkap']){
                        $lagi_login = $_SESSION['namalengkap'];
                    }

                     ?>
                  
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ahlan, <?php echo $lagi_login; ?> </div>
                    <div class="email">Selamat Datang di Kesantrian Apps</div>
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
                    <li >
                        <a href="../../index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    <?php }?>

                    <?php 
                    if ($_SESSION['admin']) {

                         ?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">library_add</i>
                            <span>Input Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li >
                                <a href="datasantri.php">Data Santri</a>
                            </li>
                            <li>
                                <a href="perizinan.php">Perizinan</a>
                            </li>
                        </ul>
                    </li>

                     <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">timeline</i>
                            <span>Laporan</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="active">
                                <a href="laporan_izin.php">Izin Santri</a>
                            </li>
                            <li>
                                <a href="statistik.php">Statistik</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    
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
                    &copy; 2020 <a href="javascript:void(0);"><?php echo $data['copyright']; ?></a>.
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
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                LAPORAN PERIZINAN SANTRI
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
                            $cek = mysqli_query($koneksi, "SELECT * FROM aplikasi WHERE id='1'") or die (mysqli_error());
                            $tahun = mysqli_fetch_array($cek);
                            $tahun_sekarang = $tahun['tahun_aktif'];
                            ?>
                            <div class="alert alert-danger">
                                <center><strong>DATA SANTRI YANG TERLAMBAT DAN MENDAPATKAN TREATMENT <?php echo $tahun['tahun_aktif']; ?></strong></center>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Nama Lengkap</th>
                                            <th style="text-align: center;">Jenjang</th>
                                            <th style="text-align: center;">Kamar</th>
                                            <th style="text-align: center;">Terlambat</th>
                                            <th style="text-align: center;">Keterangan Udzur</th>
                                            <th style="text-align: center;">Treatment</th>
                                            <th style="text-align: center;">Eksekusi Streatment</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                            identitas.username = izin_santri.username WHERE identitas.level='Santri' AND izin_santri.eksekusi_treatment!='Tidak Ada' ORDER BY izin_santri.id DESC") 
                                            or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {
                                            $status_udzur = $data['status_udzur'];
                                            $keterangan_udzur = $data['deskripsi_udzur'];
                                            $eksekusi_treatment = $data['eksekusi_treatment'];
                                         ?>

                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td align="center"><?php echo $data['namalengkap']; ?></td>
                                            <td align="center"><?php echo $data['jenjang']; ?></td>
                                            <td align="center"><?php echo $data['kamar']; ?></td>
                                            <td align="center"><?php echo $data['terlambat'];?> Menit</td>
                                            <?php 
                                            if($keterangan_udzur==""){
                                            ?>
                                            <td align="center">Kosong</td>
                                            <?php
                                            } else {
                                            ?>
                                            <td align="center"><?php echo $data['deskripsi_udzur'];?></td>
                                            <?php
                                            }
                                            ?>
                                            <td align="center"><?php echo $data['treatment']; ?></td>
                                            <?php 
                                            if($eksekusi_treatment=="Belum"){
                                            ?>
                                            <td align="center"><font color="red"><b><?php echo $data['eksekusi_treatment']; ?></b></font></td>
                                            <?php
                                            } else {
                                            ?>
                                            <td align="center"><?php echo $data['eksekusi_treatment']; ?></td> 
                                            <?php
                                            }
                                            ?>
                                             
                                            <td align="center">
                                                <button id="update" class="btn bg-blue waves-effect"
                                                data-toggle="modal" data-target="#updatemodal"
                                                data-id="<?php echo $data['id'];?>" 
                                                data-username="<?php echo $data['username'];?>" 
                                                data-namalengkap="<?php echo $data['namalengkap'];?>"
                                                data-jenjang="<?php echo $data['jenjang'];?>"
                                                data-kamar="<?php echo $data['kamar'];?>"
                                                data-deskripsi_udzur="<?php echo $data['deskripsi_udzur'];?>"
                                                data-treatment="<?php echo $data['treatment'];?>"
                                                data-eksekusi_treatment="<?php echo $data['eksekusi_treatment'];?>"><span><b>Update</b></span> <i class="material-icons">verified_user</i></button>
                                            </td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!--RIWAYAT IZIN SANTRI-->
                            <?php 
                            $cek = mysqli_query($koneksi, "SELECT * FROM aplikasi WHERE id='1'") or die (mysqli_error());
                            $tahun = mysqli_fetch_array($cek);
                            $tahun_sekarang = $tahun['tahun_aktif'];
                            ?>
                            <br>
                            <div class="alert alert-success">
                                <center><strong>RIWAYAT PERIZINAN SANTRI TAHUN <?php echo $tahun['tahun_aktif']; ?></strong></center>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="santri_lengkap">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Nama Lengkap</th>
                                            <th style="text-align: center;">Jenjang</th>
                                            <th style="text-align: center;">Kamar</th>
                                            <th style="text-align: center;">Bulan</th>
                                            <th style="text-align: center;">Kategori</th>
                                            <th style="text-align: center;">Keterangan Izin</th>
                                            <th style="text-align: center;">Terlambat</th>
                                            <th style="text-align: center;">Keterangan Udzur</th>
                                            <th style="text-align: center;">Treatment</th>
                                            <th style="text-align: center;">Eksekusi Streatment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                            identitas.username = izin_santri.username WHERE identitas.level='Santri' AND izin_santri.posisi='Di Mahad' ORDER BY izin_santri.id DESC") 
                                            or die (mysqli_error());
                                            
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {
                                            $status_udzur = $data['status_udzur'];
                                            $keterangan_udzur = $data['deskripsi_udzur'];
                                            $terlambat = $data['terlambat'];
                                            $treatment = $data['treatment'];
                                         ?>

                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td align="center"><?php echo $data['namalengkap']; ?></td>
                                            <td align="center"><?php echo $data['jenjang']; ?></td>
                                            <td align="center"><?php echo $data['kamar']; ?></td>
                                            <td align="center"><?php echo $data['bulan']; ?></td>
                                            <td align="center"><?php echo $data['kategori']; ?></td>
                                            <td align="center"><?php echo $data['keterangan']; ?></td>
                                            <?php 
                                            if($terlambat==0){
                                            ?>
                                            <td align="center">Tepat Waktu</td> 
                                            <?php
                                            } else{
                                            ?>
                                            <td align="center"><font color="red"><b><?php echo $data['terlambat'];?> Menit</b></font></td> 
                                            <?php
                                            }
                                            ?>
                                            
                                            <?php 
                                            if($keterangan_udzur==""){
                                            ?>
                                            <td align="center">Kosong</td>
                                            <?php
                                            } else {
                                            ?>
                                            <td align="center"><?php echo $data['deskripsi_udzur'];?></td>
                                            <?php
                                            }
                                            ?>

                                            <?php 
                                            if($treatment==""){
                                            ?>
                                            <td align="center">Kosong</td>
                                            <?php
                                            } else {
                                            ?>
                                            <td align="center"><?php echo $data['treatment']; ?></td>
                                            <?php
                                            }
                                            ?>
                                            
                                            <td align="center"><?php echo $data['eksekusi_treatment']; ?></td>  

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- SANTRI TERBANYAK IZIN-->
                            <?php 
                            $cek = mysqli_query($koneksi, "SELECT * FROM aplikasi WHERE id='1'") or die (mysqli_error());
                            $tahun = mysqli_fetch_array($cek);
                            $tahun_sekarang = $tahun['tahun_aktif'];
                            ?>
                            <br>
                            <div class="alert alert-info">
                                <center><strong>JUMLAH PERIZINAN SANTRI TAHUN <?php echo $tahun['tahun_aktif']; ?></strong></center>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="santri_lengkap">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Nama Lengkap</th>
                                            <th style="text-align: center;">Jenjang</th>
                                            <th style="text-align: center;">Kamar</th>
                                            <th style="text-align: center;">Izin Tajil</th>
                                            <th style="text-align: center;">Izin Keluar Sekitar</th>
                                            <th style="text-align: center;">Izin Kunjungan Keluar</th>
                                            <th style="text-align: center;">Izin Pulang</th>
                                            <th style="text-align: center;">Total Izin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas WHERE level='Santri' ORDER BY total_izin DESC") 
                                            or die (mysqli_error());
                                            
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {
                                         ?>

                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td align="center"><?php echo $data['namalengkap']; ?></td>
                                            <td align="center"><?php echo $data['jenjang']; ?></td>
                                            <td align="center"><?php echo $data['kamar']; ?></td>
                                            <td align="center"><?php echo $data['jml_tajil']; ?>x</td>
                                            <td align="center"><?php echo $data['jml_keluar_sekitar']; ?>x</td>
                                            <td align="center"><?php echo $data['jml_kunjungan_keluar']; ?>x</td> 
                                            <td align="center"><?php echo $data['jml_pulang']; ?>x</td> 
                                            <td align="center"><?php echo $data['total_izin']; ?>x</td> 
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                                                   
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!--MODAL BOOTSTRAP UPDATE TREATMENT-->
                            <div class="modal fade" id="updatemodal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="defaultModalLabel">Update Status Treatment Santri</h4>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="" method="POST">
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                        <label>ID Izin</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="id" name="id" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <br>
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                        <label>Username</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="username" name="username" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label>Nama Lengkap</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="namalengkap" name="namalengkap" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label>Jenjang</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="jenjang" name="jenjang" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                    <label>Kamar</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="kamar" name="kamar" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                        <label>Keterangan Udzur</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea rows="4" name="deskripsi_udzur" id="deskripsi_udzur" class="form-control no-resize"></textarea>
                                                            </div>
                                                        </div>
                                                    </div> 

                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                        <label>Treatment</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <textarea rows="4" name="treatment" id="treatment" class="form-control no-resize"></textarea>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <br>

                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label>Eksekusi Treatment</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <select name="eksekusi_treatment" id="eksekusi_treatment" class="form-control">
                                                                <option value="Kosong">Pilih Satu</option>
                                                                <option value="Terlaksana">Terlaksana</option>
                                                                <option value="Batal">Batal</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="update" class="btn btn-link waves-effect">Simpan Data</button>
                                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                                                </div>
                                                <?php 
                                                    if(isset($_POST['update'])){
                                                        $id = $_POST['id'];
                                                        $deskripsi_udzur = $_POST['deskripsi_udzur'];
                                                        $treatment = $_POST['treatment'];
                                                        $eksekusi_treatment = $_POST['eksekusi_treatment'];

                                                        $updatedata = mysqli_query($koneksi, "UPDATE izin_santri SET deskripsi_udzur='$deskripsi_udzur', treatment='$treatment',
                                                        eksekusi_treatment='$eksekusi_treatment' WHERE id='$id'");    
    
                                                    if($updatedata == true) {
                                                        ?>
                                                            <script type="text/javascript">
                                                            alert("Syukron, Data Berhasil Diupdate");
                                                            window.location.href="laporan_izin.php";
                                                            </script>
                                                    <?php    
                                                    }
                                                    else {
                                                       ?>
                                                            <script type="text/javascript">
                                                            alert("Afwan! Ada data yang salah, coba deh cek lagi!");
                                                            window.location.href="laporan_izin.php";
                                                            </script>
                                                    <?php    
                                                    }
                                                    }
                                                ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--END MODAL BOOTSTRAP-->
                 
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

     <!-- Bootstrap Notify Plugin Js -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="../../plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Jquery CountTo Plugin Js -->
    <script src="../../plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>
    
     <!-- Moment Plugin Js -->
    <script src="../../plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

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

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/tables/jquery-datatable.js"></script>
    <script src="../../js/pages/ui/notifications.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
    <!--<script src="../../js/pages/ui/modals.js"></script>-->

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
    <!--<script>
        $(document).ready(function(){
            $(.editbtn).on('click',function(){

                $('#editmodal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function(){
                        return $(this).text();
                    }).get();

                    console.log(data);

                    $('#username').val(data[0]);
                    $('#namalengkap').val(data[1]);

            });
        });
    </script>-->

    <script type="text/javascript">
        $(document).on("click", "#update", function(){
        var id_santri = $(this).data('id');
        var username_santri = $(this).data('username');
        var namalengkap_santri = $(this).data('namalengkap');
        var jenjang_santri = $(this).data('jenjang');
        var kamar_santri = $(this).data('kamar');
        var deskripsi_udzur_santri = $(this).data('deskripsi_udzur');
        var treatment_santri = $(this).data('treatment');
        var eksekusi_treatment_santri = $(this).data('eksekusi_treatment');
        var waktu_keluar_santri = $(this).data('waktu_keluar');
        var waktu_kembali_santri = $(this).data('waktu_kembali');

        $(".modal-body #id").val(id_santri);
        $(".modal-body #username").val(username_santri);
        $(".modal-body #namalengkap").val(namalengkap_santri);
        $(".modal-body #jenjang").val(jenjang_santri);
        $(".modal-body #kamar").val(kamar_santri);
        $(".modal-body #deskripsi_udzur").val(deskripsi_udzur_santri);
        $(".modal-body #treatment").val(treatment_santri);
        $(".modal-body #eksekusi_treatment").val(eksekusi_treatment_santri);
        })
    </script>

    
</body>

</html>

<?php 

    mysqli_close($koneksi);
    ob_end_flush();

?>