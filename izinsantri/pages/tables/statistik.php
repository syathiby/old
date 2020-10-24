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
    <title>Statistik Perizinan Santri - Kesantrian Apps | Ma'had Al Imam Asy Syathiby</title>
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

    <!-- Morris Chart Css-->
    <link href="../../plugins/morrisjs/morris.css" rel="stylesheet" />

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
                            <li>
                                <a href="laporan_izin.php">Izin Santri</a>
                            </li>
                            <li class="active">
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
                                STATISTIK PERIZINAN SANTRI
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
                        <!--Mulai Chart Pie-->
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <?php 
                                $sql_draft = mysqli_query($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
                                $draft = mysqli_fetch_array ($sql_draft); 
                                $thn_aktif = $draft['tahun_aktif']; ?>
                                <div class="card">
                                    <div class="header">
                                        <h2>PERBANDINGAN JENIS IZIN SANTRI TAHUN <b><?php echo $thn_aktif; ?></b> </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <canvas id="pie_chart2" height="100"></canvas>
                                        <h2 class="card-inside-title">LEGENDA DIAGRAM</h2>
                                        <div class="demo-checkbox">
                                            <input type="checkbox" id="md_checkbox_1" class="filled-in chk-col-red" checked />
                                            <label for="md_checkbox_1">Keluar Sekitar</label>
                                            <input type="checkbox" id="md_checkbox_2" class="filled-in chk-col-green" checked />
                                            <label for="md_checkbox_2">Pulang</label>
                                            <input type="checkbox" id="md_checkbox_3" class="filled-in chk-col-orange" checked />
                                            <label for="md_checkbox_3">Tajil</label>
                                            <input type="checkbox" id="md_checkbox_4" class="filled-in chk-col-purple" checked />
                                            <label for="md_checkbox_4">Kunjungan Keluar</label>
                                            <input type="checkbox" id="md_checkbox_5" class="filled-in chk-col-cyan" checked />
                                            <label for="md_checkbox_5">Berobat</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <div class="card">
                                    <div class="header">
                                        <h2>JUMLAH IZIN <b>"KELUAR SEKITAR"</b> BAGI SANTRI <b>SMP & SMA</b> TAHUN <b><?php echo $thn_aktif; ?></b></h2>
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
                                        <h2 class="card-inside-title">LEGENDA DIAGRAM</h2>
                                        <div class="demo-checkbox">
                                            <input type="checkbox" id="md_checkbox_21" class="filled-in chk-col-blue-grey" checked />
                                            <label for="md_checkbox_21">SMA</label>
                                            <input type="checkbox" id="md_checkbox_22" class="filled-in chk-col-blue" checked />
                                            <label for="md_checkbox_22">SMP</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <!--AKHIR CHAT PIE-->

                        <!--Mulai Chart LINE-->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php 
                                $sql_draft = mysqli_query($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
                                $draft = mysqli_fetch_array ($sql_draft); 
                                $thn_aktif = $draft['tahun_aktif']; ?>
                                <div class="card">
                                    <div class="header">
                                        <h2>PERKEMBANGAN JUMLAH IZIN SANTRI TAHUN <b><?php echo $thn_aktif; ?></b> </h2>
                                        <ul class="header-dropdown m-r--5">
                                            <li class="dropdown">
                                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="body">
                                        <canvas id="line_chart" height="100"></canvas>
                                        
                                        <h2 class="card-inside-title">LEGENDA DIAGRAM</h2>
                                        <div class="demo-checkbox">
                                            <input type="checkbox" id="md_checkbox_31" class="filled-in chk-col-red" checked />
                                            <label for="md_checkbox_31">Keluar Sekitar</label>
                                            <input type="checkbox" id="md_checkbox_32" class="filled-in chk-col-green" checked />
                                            <label for="md_checkbox_32">Pulang</label>
                                            <input type="checkbox" id="md_checkbox_33" class="filled-in chk-col-orange" checked />
                                            <label for="md_checkbox_33">Tajil</label>
                                            <input type="checkbox" id="md_checkbox_34" class="filled-in chk-col-purple" checked />
                                            <label for="md_checkbox_34">Kunjungan Keluar</label>
                                            <input type="checkbox" id="md_checkbox_35" class="filled-in chk-col-cyan" checked />
                                            <label for="md_checkbox_35">Berobat</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--AKHIR CHAT LINE-->

                        <!--AWAL BAR CHART-->
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php 
                                $sql_draft = mysqli_query($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
                                $draft = mysqli_fetch_array ($sql_draft); 
                                $thn_aktif = $draft['tahun_aktif']; ?>
                                <div class="card">
                                    <div class="header">
                                        <h2>DATA JUMLAH SANTRI YANG TERLAMBAT PERIZINAN TAHUN <b><?php echo $thn_aktif; ?></b> </h2>
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
                                        
                                        <h2 class="card-inside-title">LEGENDA DIAGRAM</h2>
                                        <div class="demo-checkbox">
                                            <input type="checkbox" id="md_checkbox_41" class="filled-in chk-col-light-blue" checked />
                                            <label for="md_checkbox_41">Terlambat Dan <b>Tidak</b> Mendapatkan Treatment</label>
                                            <br>
                                            <input type="checkbox" id="md_checkbox_42" class="filled-in chk-col-red" checked />
                                            <label for="md_checkbox_42">Terlambat Dan Mendapatkan Treatment</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--AKHIR BAR CHART-->
                                                   
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

    <!-- Chart Plugins Js -->
    <script src="../../plugins/chartjs/Chart.bundle.js"></script>

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

    <!--Chart Line-->
    

    <script>
    <?php 
    $sql_draft = mysqli_query($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
    $draft = mysqli_fetch_array ($sql_draft); 
    $thn_aktif = $draft['tahun_aktif']; ?>
        var ctx = document.getElementById("pie_chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                    <?php
                    $sql_smp = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE identitas.jenjang='SMP' AND izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif'");
                    $data_smp = mysqli_num_rows($sql_smp);
                    echo $data_smp;
                    ?>,  
                    <?php
                    $sql_sma = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE identitas.jenjang='SMA' AND izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif'");
                    $data_sma = mysqli_num_rows($sql_sma);
                    echo $data_sma;
                    ?>],
                    backgroundColor: [
                        "rgb(33, 150, 243)",
                        "rgb(96, 125, 139)"
                    ],
                }],
                labels: [
                    "SMP",
                    "SMA"
                ]
            },
            options: {
                responsive: true,
                legend: true
            }
        });
   </script>

   <script>
    <?php 
    $sql_draft = mysqli_query($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
    $draft = mysqli_fetch_array ($sql_draft); 
    $thn_aktif = $draft['tahun_aktif']; ?>
        var ctx = document.getElementById("pie_chart2").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                    <?php
                    $sql_keluar = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif'");
                    $data_keluar = mysqli_num_rows($sql_keluar);
                    echo $data_keluar;
                    ?>,  
                    <?php
                    $sql_pulang = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif'");
                    $data_pulang = mysqli_num_rows($sql_pulang);
                    echo $data_pulang;
                    ?>,
                    <?php
                    $sql_tajil = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif'");
                    $data_tajil = mysqli_num_rows($sql_tajil);
                    echo $data_tajil;
                    ?>,
                    <?php
                    $sql_kunjungan = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif'");
                    $data_kunjungan = mysqli_num_rows($sql_kunjungan);
                    echo $data_kunjungan;
                    ?>,
                    <?php
                    $sql_kunjungan = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif'");
                    $data_kunjungan = mysqli_num_rows($sql_kunjungan);
                    echo $data_kunjungan;
                    ?>],
                    backgroundColor: [
                        "rgb(244, 67, 54)",//RED
                        "rgb(76, 175, 80)",//GREEN
                        "rgb(255, 152, 0)",//ORANGE
                        "rgb(156, 39, 176)",//PURPLE
                        "rgb(0, 188, 212)"//CYAN
                    ],
                }],
                labels: [
                    "Keluar Sekitar",
                    "Pulang",
                    "Tajil",
                    "Kunjungan Keluar",
                    "Berobat"
                ]
            },
            options: {
                responsive: true,
                legend: true
            }
        });
   </script>

   <!--LINE CHART-->
   <script>
    <?php 
    $sql_draft = mysqli_query($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
    $draft = mysqli_fetch_array ($sql_draft); 
    $thn_aktif = $draft['tahun_aktif']; ?>
        var ctx = document.getElementById("line_chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"],
                datasets: [{
                    label: 'Izin Keluar Sekitar',
                    data: [
                    <?php 
                    $sql_keluar1 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Januari'");
                    echo mysqli_num_rows($sql_keluar1);
                    ?>, 
                    <?php 
                    $sql_keluar2 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Februari'");
                    echo mysqli_num_rows($sql_keluar2);
                    ?>,
                    <?php 
                    $sql_keluar3 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Maret'");
                    echo mysqli_num_rows($sql_keluar3);
                    ?>,
                    <?php 
                    $sql_keluar4 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='April'");
                    echo mysqli_num_rows($sql_keluar4);
                    ?>,
                    <?php 
                    $sql_keluar5 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Mei'");
                    echo mysqli_num_rows($sql_keluar5);
                    ?>,
                    <?php 
                    $sql_keluar6 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juni'");
                    echo mysqli_num_rows($sql_keluar6);
                    ?>,
                    <?php 
                    $sql_keluar7 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juli'");
                    echo mysqli_num_rows($sql_keluar7);
                    ?>,
                    <?php 
                    $sql_keluar8 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Agustus'");
                    echo mysqli_num_rows($sql_keluar8);
                    ?>,
                    <?php 
                    $sql_keluar9 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='September'");
                    echo mysqli_num_rows($sql_keluar9);
                    ?>,
                    <?php 
                    $sql_keluar10 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Oktober'");
                    echo mysqli_num_rows($sql_keluar10);
                    ?>,
                    <?php 
                    $sql_keluar11 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='November'");
                    echo mysqli_num_rows($sql_keluar11);
                    ?>,
                    <?php 
                    $sql_keluar12 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Desember'");
                    echo mysqli_num_rows($sql_keluar12);
                    ?>
                    ],
                    borderColor: 'rgba(244, 67, 54, 0.75)',
                    pointBorderColor: 'rgba(244, 67, 54, 0)',
                    pointBackgroundColor: 'rgba(244, 67, 54, 0.9)',
                    pointBorderWidth: 1
                }, {
                    label: 'Izin Pulang',
                    data: [
                    <?php 
                    $sql_pulang1 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Januari'");
                    echo mysqli_num_rows($sql_pulang1);
                    ?>, 
                    <?php 
                    $sql_pulang2 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Februari'");
                    echo mysqli_num_rows($sql_pulang2);
                    ?>,
                    <?php 
                    $sql_pulang3 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Maret'");
                    echo mysqli_num_rows($sql_pulang3);
                    ?>,
                    <?php 
                    $sql_pulang4 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='April'");
                    echo mysqli_num_rows($sql_pulang4);
                    ?>,
                    <?php 
                    $sql_pulang5 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Mei'");
                    echo mysqli_num_rows($sql_pulang5);
                    ?>,
                    <?php 
                    $sql_pulang6 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juni'");
                    echo mysqli_num_rows($sql_pulang6);
                    ?>,
                    <?php 
                    $sql_pulang7 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juli'");
                    echo mysqli_num_rows($sql_pulang7);
                    ?>,
                    <?php 
                    $sql_pulang8 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Agustus'");
                    echo mysqli_num_rows($sql_pulang8);
                    ?>,
                    <?php 
                    $sql_pulang9 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='September'");
                    echo mysqli_num_rows($sql_pulang9);
                    ?>,
                    <?php 
                    $sql_pulang10 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Oktober'");
                    echo mysqli_num_rows($sql_pulang10);
                    ?>,
                    <?php 
                    $sql_pulang11 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='November'");
                    echo mysqli_num_rows($sql_pulang11);
                    ?>,
                    <?php 
                    $sql_pulang12 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Pulang' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Desember'");
                    echo mysqli_num_rows($sql_pulang12);
                    ?>
                    ],
                    borderColor: 'rgba(76, 175, 80, 0.75)',
                    pointBorderColor: 'rgba(76, 175, 80, 0)',
                    pointBackgroundColor: 'rgba(76, 175, 80, 0.9)',
                    pointBorderWidth: 1
                }, {
                    label: 'Izin Tajil',
                    data: [
                    <?php 
                    $sql_tajil1 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Januari'");
                    echo mysqli_num_rows($sql_tajil1);
                    ?>, 
                    <?php 
                    $sql_tajil2 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Februari'");
                    echo mysqli_num_rows($sql_tajil2);
                    ?>,
                    <?php 
                    $sql_tajil3 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Maret'");
                    echo mysqli_num_rows($sql_tajil3);
                    ?>,
                    <?php 
                    $sql_tajil4 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='April'");
                    echo mysqli_num_rows($sql_tajil4);
                    ?>,
                    <?php 
                    $sql_tajil5 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Mei'");
                    echo mysqli_num_rows($sql_tajil5);
                    ?>,
                    <?php 
                    $sql_tajil6 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juni'");
                    echo mysqli_num_rows($sql_tajil6);
                    ?>,
                    <?php 
                    $sql_tajil7 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juli'");
                    echo mysqli_num_rows($sql_tajil7);
                    ?>,
                    <?php 
                    $sql_tajil8 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Agustus'");
                    echo mysqli_num_rows($sql_tajil8);
                    ?>,
                    <?php 
                    $sql_tajil9 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='September'");
                    echo mysqli_num_rows($sql_tajil9);
                    ?>,
                    <?php 
                    $sql_tajil10 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Oktober'");
                    echo mysqli_num_rows($sql_tajil10);
                    ?>,
                    <?php 
                    $sql_tajil11 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='November'");
                    echo mysqli_num_rows($sql_tajil11);
                    ?>,
                    <?php 
                    $sql_tajil12 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Tajil' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Desember'");
                    echo mysqli_num_rows($sql_tajil12);
                    ?>
                    ],
                    borderColor: 'rgba(255, 152, 0, 0.75)',
                    pointBorderColor: 'rgba(255, 152, 0, 0)',
                    pointBackgroundColor: 'rgba(255, 152, 0, 0.9)',
                    pointBorderWidth: 1
                }, {
                    label: 'Izin Kunjungan Keluar',
                    data: [
                    <?php 
                    $sql_kunjungan1 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Januari'");
                    echo mysqli_num_rows($sql_kunjungan1);
                    ?>, 
                    <?php 
                    $sql_kunjungan2 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Februari'");
                    echo mysqli_num_rows($sql_kunjungan2);
                    ?>,
                    <?php 
                    $sql_kunjungan3 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Maret'");
                    echo mysqli_num_rows($sql_kunjungan3);
                    ?>,
                    <?php 
                    $sql_kunjungan4 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='April'");
                    echo mysqli_num_rows($sql_kunjungan4);
                    ?>,
                    <?php 
                    $sql_kunjungan5 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Mei'");
                    echo mysqli_num_rows($sql_kunjungan5);
                    ?>,
                    <?php 
                    $sql_kunjungan6 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juni'");
                    echo mysqli_num_rows($sql_kunjungan6);
                    ?>,
                    <?php 
                    $sql_kunjungan7 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juli'");
                    echo mysqli_num_rows($sql_kunjungan7);
                    ?>,
                    <?php 
                    $sql_kunjungan8 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Agustus'");
                    echo mysqli_num_rows($sql_kunjungan8);
                    ?>,
                    <?php 
                    $sql_kunjungan9 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='September'");
                    echo mysqli_num_rows($sql_kunjungan9);
                    ?>,
                    <?php 
                    $sql_kunjungan10 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Oktober'");
                    echo mysqli_num_rows($sql_kunjungan10);
                    ?>,
                    <?php 
                    $sql_kunjungan11 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='November'");
                    echo mysqli_num_rows($sql_kunjungan11);
                    ?>,
                    <?php 
                    $sql_kunjungan12 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Desember'");
                    echo mysqli_num_rows($sql_kunjungan12);
                    ?>
                    ],
                    borderColor: 'rgba(156, 39, 176, 0.75)',
                    pointBorderColor: 'rgba(156, 39, 176, 0)',
                    pointBackgroundColor: 'rgba(156, 39, 176, 0.9)',
                    pointBorderWidth: 1
                }, {
                    label: 'Izin Berobat',
                    data: [
                    <?php 
                    $sql_kunjungan1 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Januari'");
                    echo mysqli_num_rows($sql_kunjungan1);
                    ?>, 
                    <?php 
                    $sql_kunjungan2 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Februari'");
                    echo mysqli_num_rows($sql_kunjungan2);
                    ?>,
                    <?php 
                    $sql_kunjungan3 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Maret'");
                    echo mysqli_num_rows($sql_kunjungan3);
                    ?>,
                    <?php 
                    $sql_kunjungan4 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='April'");
                    echo mysqli_num_rows($sql_kunjungan4);
                    ?>,
                    <?php 
                    $sql_kunjungan5 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Mei'");
                    echo mysqli_num_rows($sql_kunjungan5);
                    ?>,
                    <?php 
                    $sql_kunjungan6 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juni'");
                    echo mysqli_num_rows($sql_kunjungan6);
                    ?>,
                    <?php 
                    $sql_kunjungan7 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juli'");
                    echo mysqli_num_rows($sql_kunjungan7);
                    ?>,
                    <?php 
                    $sql_kunjungan8 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Agustus'");
                    echo mysqli_num_rows($sql_kunjungan8);
                    ?>,
                    <?php 
                    $sql_kunjungan9 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='September'");
                    echo mysqli_num_rows($sql_kunjungan9);
                    ?>,
                    <?php 
                    $sql_kunjungan10 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Oktober'");
                    echo mysqli_num_rows($sql_kunjungan10);
                    ?>,
                    <?php 
                    $sql_kunjungan11 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='November'");
                    echo mysqli_num_rows($sql_kunjungan11);
                    ?>,
                    <?php 
                    $sql_kunjungan12 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.kategori='Berobat' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Desember'");
                    echo mysqli_num_rows($sql_kunjungan12);
                    ?>
                    ],
                    borderColor: 'rgba(0, 188, 212, 0.75)',
                    pointBorderColor: 'rgba(0, 188, 212, 0)',
                    pointBackgroundColor: 'rgba(0, 188, 212, 0.9)',
                    pointBorderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: true
            }
        });

    </script>
    <!--END OF LINE CHART-->

   <script>
    <?php 
    $sql_draft = mysqli_query($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
    $draft = mysqli_fetch_array ($sql_draft); 
    $thn_aktif = $draft['tahun_aktif']; ?>
        var ctx = document.getElementById("bar_chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"],
                datasets: [{
                    label: 'Terlambat (Tanpa Treatment)',
                    data: [
                    <?php 
                    $sql_terlambat1 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Januari'");
                    echo mysqli_num_rows($sql_terlambat1);
                    ?>, 
                    <?php 
                    $sql_terlambat2 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Februari'");
                    echo mysqli_num_rows($sql_terlambat2);
                    ?>, 
                    <?php 
                    $sql_terlambat3 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Maret'");
                    echo mysqli_num_rows($sql_terlambat3);
                    ?>,
                    <?php 
                    $sql_terlambat4 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='April'");
                    echo mysqli_num_rows($sql_terlambat4);
                    ?>,
                    <?php 
                    $sql_terlambat5 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Mei'");
                    echo mysqli_num_rows($sql_terlambat5);
                    ?>,
                    <?php 
                    $sql_terlambat6 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juni'");
                    echo mysqli_num_rows($sql_terlambat6);
                    ?>,
                    <?php 
                    $sql_terlambat7 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juli'");
                    echo mysqli_num_rows($sql_terlambat7);
                    ?>,
                    <?php 
                    $sql_terlambat8 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Agustus'");
                    echo mysqli_num_rows($sql_terlambat8);
                    ?>,
                    <?php 
                    $sql_terlambat9 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='September'");
                    echo mysqli_num_rows($sql_terlambat9);
                    ?>,
                    <?php 
                    $sql_terlambat10 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Oktober'");
                    echo mysqli_num_rows($sql_terlambat10);
                    ?>,
                    <?php 
                    $sql_terlambat11 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='November'");
                    echo mysqli_num_rows($sql_terlambat11);
                    ?>,
                    <?php 
                    $sql_terlambat12 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat!=0 AND izin_santri.terlambat<15 AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Desember'");
                    echo mysqli_num_rows($sql_terlambat12);
                    ?>
                    ],
                    backgroundColor: 'rgba(3, 169, 244, 0.8)'
                }, {
                    label: 'Terlambat (Treatment)',
                    data: [
                    <?php 
                    $sql_treatment1 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Januari'");
                    echo mysqli_num_rows($sql_treatment1);
                    ?>, 
                    <?php 
                    $sql_treatment2 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Februari'");
                    echo mysqli_num_rows($sql_treatment2);
                    ?>,     
                    <?php 
                    $sql_treatment3 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Maret'");
                    echo mysqli_num_rows($sql_treatment3);
                    ?>,
                    <?php 
                    $sql_treatment4 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='April'");
                    echo mysqli_num_rows($sql_treatment4);
                    ?>,
                    <?php 
                    $sql_treatment5 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Mei'");
                    echo mysqli_num_rows($sql_treatment5);
                    ?>,
                    <?php 
                    $sql_treatment6 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juni'");
                    echo mysqli_num_rows($sql_treatment6);
                    ?>,
                    <?php 
                    $sql_treatment7 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Juli'");
                    echo mysqli_num_rows($sql_treatment7);
                    ?>,
                    <?php 
                    $sql_treatment8 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Agustus'");
                    echo mysqli_num_rows($sql_treatment8);
                    ?>,
                    <?php 
                    $sql_treatment9 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='September'");
                    echo mysqli_num_rows($sql_treatment9);
                    ?>,
                    <?php 
                    $sql_treatment10 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Oktober'");
                    echo mysqli_num_rows($sql_treatment10);
                    ?>,
                    <?php 
                    $sql_treatment11 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='November'");
                    echo mysqli_num_rows($sql_treatment11);
                    ?>,
                    <?php 
                    $sql_treatment12 = mysqli_query($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username
                    WHERE izin_santri.terlambat>15 AND izin_santri.eksekusi_treatment='Terlaksana' AND izin_santri.tahun='$thn_aktif' AND izin_santri.bulan='Desember'");
                    echo mysqli_num_rows($sql_treatment12);
                    ?>
                    ],
                    backgroundColor: 'rgba(244, 67, 54, 0.8)'
                }]
            },
            options: {
                responsive: true,
                legend: true,
                label: true

            }
        });
    </script>

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