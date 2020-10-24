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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Profil Santri - Kesantrian Apps | Ma'had Al Imam Asy Syathiby</title>
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
    
    <!-- Bootstrap DatePicker Css -->
    <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    
     <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    
    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Light Gallery Plugin Css -->
    <link href="../../plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    
    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

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
                <a class="navbar-brand" href="index.html"><?php echo $data['judul_web']; ?></a>
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
                        if ($_SESSION['admin']) {

                         ?>
                    <li >
                        <a href="../../index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    <?php }?>

                    <?php 
                        if ($_SESSION['security']) {

                         ?>
                    <li>
                        <a href="../tables/monitor_izin.php">
                            <i class="material-icons">desktop_windows</i>
                            <span>Monitoring Izin</span>
                        </a>
                    </li>   

                    <li class="active">
                        <a href="../tables/status_perizinan.php">
                            <i class="material-icons">people</i>
                            <span>Status Perizinan</span>
                        </a>
                    </li>

                    <?php }?>

                    <?php 
                    if ($_SESSION['admin']) {

                         ?>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Input Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li >
                                <a href="datasantri.php">Data Santri</a>
                            </li>
                            <li class="active">
                                <a href="#">Perizinan</a>
                            </li>
                        </ul>
                    </li>

                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Laporan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../forms/izinsantri.php">Izin Santri</a>
                            </li>
                            <li>
                                <a href="../forms/statistik.php">Statistik</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    
                    <li>
                        <?php 
                        if ($_SESSION['security'] || $_SESSION['admin']) {

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
    
    <!-- #PROFIL BARU-->
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-3">
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <?php           
                                $kode=$_GET['username'];                    
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$kode' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);

                                $sql_draft = mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$kode'");
                                $draft = mysqli_fetch_array ($sql_draft);
                            ?>

                            <div class="image-area">
                                <img src="../../img/<?php echo $draft['photo'];?>" width="100" height="100" alt="AdminBSB - Profile Image" />
                            </div>
                            <div class="content-area">
                                <h4><?php echo $data_ubah['namalengkap'] ?></h4>
                                <h4><?php echo $data_ubah['username'] ?></h4>
                            </div>
                        </div>

                    </div>

                    <div class="card card-about-me">
                    <?php 
                    $username=$_GET['username'];

                    $sql_tajil=mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username=izin_santri.username
                        WHERE identitas.level='Santri' AND izin_santri.posisi='Di Mahad' AND izin_santri.kategori='Tajil' AND izin_santri.username='$username'");
                    $data_tajil=mysqli_num_rows($sql_tajil);

                    $sql_keluar=mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username=izin_santri.username
                        WHERE identitas.level='Santri' AND izin_santri.posisi='Di Mahad' AND izin_santri.kategori='Keluar Sekitar' AND izin_santri.username='$username'");
                    $data_keluar=mysqli_num_rows($sql_keluar);

                    $sql_kunjungan=mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username=izin_santri.username
                        WHERE identitas.level='Santri' AND izin_santri.posisi='Di Mahad' AND izin_santri.kategori='Kunjungan Keluar' AND izin_santri.username='$username'");
                    $data_kunjungan=mysqli_num_rows($sql_kunjungan);

                    $sql_pulang=mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username=izin_santri.username
                        WHERE identitas.level='Santri' AND izin_santri.posisi='Di Mahad' AND izin_santri.kategori='Pulang' AND izin_santri.username='$username'");
                    $data_pulang=mysqli_num_rows($sql_pulang);
                    ?>
                        <div class="header">
                            <h2>STATISTIK RIWAYAT IZIN SANTRI</h2>
                        </div>
                        <div class="body">
                            <ul>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">favorite</i>
                                        Izin Tajil
                                    </div>
                                    <div class="content">
                                    Jumlah Izin = <?php echo $data_tajil;?>x
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">history</i>
                                        Izin Keluar Sekitar
                                    </div>
                                    <div class="content">
                                    Jumlah Izin = <?php echo $data_keluar;?>x
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">record_voice_over</i>
                                        Izin Kunjungan Keluar
                                    </div>
                                    <div class="content">
                                    Jumlah Izin = <?php echo $data_kunjungan;?>x
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <i class="material-icons">work</i>
                                        Izin Pulang
                                    </div>
                                    <div class="content">
                                    Jumlah Izin = <?php echo $data_pulang;?>x
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-9">
                    <div class="card">
                        <div class="body">
                            <div>

                                <?php 
                                
                                $kode=$_GET['username'];

                                $sql=mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$kode'");
                                $data = mysqli_fetch_array ($sql);

                                ?>
                                <form class="form-horizontal" action="" method="POST">

                                <!-- PHOTO SANTRI-->
                                <div class="body center-block" align="center">
                                <?php
                                $sql_draft = mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$kode'");
                                $draft = mysqli_fetch_array ($sql_draft); ?>
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                        <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                        <a href="../../img/<?php echo $draft['photo'];?>" data-sub-html="Photo Santri">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $draft['photo'];?>" width="200px">
                                        </a>
                                        </div>
                                    </div>     
                                </div>
                                <!-- #END PHOTO SANTRI-->

                                <!--BIODATA SANTRI-->
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Nama Lengkap</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="namalengkap" class="form-control" 
                                                value="<?php echo $data['namalengkap'] ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Angkatan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="angkatan" class="form-control" 
                                                value="<?php echo $data['angkatan'] ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Jenjang</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="jenjang" class="form-control" 
                                                value="<?php echo $data['jenjang'] ?>"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Kamar</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="kamar" class="form-control" 
                                                value="<?php echo $data['kamar'] ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--#END BIODATA SANTRI-->
                                <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Kategori</th>
                                            <th style="text-align: center;">Keterangan Izin</th>
                                            <th style="text-align: center;">Jadwal Keluar</th>
                                            <th style="text-align: center;">Jadwal Kembali</th>
                                            <th style="text-align: center;">Status Izin Santri</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                        $kode=$_GET['username'];
                                        $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                        identitas.username = izin_santri.username WHERE identitas.username='$kode' AND izin_santri.posisi!='Di Mahad' 
                                        ORDER BY izin_santri.id DESC LIMIT 1") or die (mysqli_error());
                                        $data = mysqli_fetch_array($sql);
                                        $cekdata = mysqli_num_rows($sql);

                                        if($cekdata == 0){
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td colspan="6" align="center"><b style="color: red">TIDAK ADA DATA IZIN</b></td>
                                            </tr>
                                        </tbody>
                                        <?php } else {
                                        ?>
                                        <tbody>
                                          <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                            identitas.username = izin_santri.username WHERE identitas.username='$kode' 
                                            AND izin_santri.posisi!='Di Mahad'") or die (mysqli_error());
                                            $no=1;
                                            
                                            while ($data = mysqli_fetch_array ($sql)) {
                                         ?>
                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td align="center"><?php echo $data['kategori'];?></td>
                                            <td align="center"><?php echo $data['keterangan']; ?></td>
                                            <td align="center"><?php echo $data['waktu_keluar'];?></td>
                                            <td align="center"><?php echo $data['waktu_kembali'];?></td>
                                            <td align="center">
                                               <?php 
                                                 if($data['posisi'] == "Pulang"){
                                                 ?>
                                                    <button type="button" class="btn bg-red waves-effect"><b>Pulang</b></button>
                                                 <?php } 
                                                 else if ($data['posisi'] == "Keluar") {
                                                 ?>
                                                    <button type="button" class="btn bg-orange waves-effect"><b>Keluar</b></button>
                                                 <?php }
                                                 else if($data['posisi'] == "Diproses"){
                                                 ?>
                                                 <button type="button" class="btn bg-blue waves-effect"><b>Diproses</b></button>
                                                 <?php } 
                                                 else {
                                                 ?>
                                                    <button type="button" class="btn bg-green waves-effect"><b>Ma'had</b></button>
                                                 <?php }
                                               ?>
                                            </td>
                                        </tr>
                                        <?php 
                                        } } 
                                        ?>
                                </table>
                            </div>

                                    <?php
                                    $kode=$_GET['username'];
                                    $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                        identitas.username = izin_santri.username WHERE identitas.username='$kode' 
                                        AND izin_santri.posisi!='Di Mahad'") or die (mysqli_error());

                                    date_default_timezone_set('Asia/Jakarta');
                                    $data=mysqli_fetch_array($sql);
                                    $cekdata=mysqli_num_rows($sql);
                                    $waktu_sekarang = date('Y-m-d G:i:s');
                                    $status = $data['posisi'];


                                    if($cekdata!==0){
                                    if($status == "Diproses"){
                                    ?>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                            <label for="username">Waktu Keluar</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="asli_waktu_keluar" class="form-control" 
                                                    value="<?php echo $waktu_sekarang; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    } else {
                                    ?>
                                    <div class="row clearfix">
                                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                            <label for="username">Waktu Kembali</label>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="asli_waktu_kembali" class="form-control" 
                                                    value="<?php echo $waktu_sekarang; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <button type="submit" name="konfirmasi" class="btn bg-blue waves-effect"><b>Konfirmasi</b></button>    
                                    </div>
                                    <?php } 
                                    else {
                                    ?>
                                    <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                    <button type="button" class="btn bg-green waves-effect"><b>Konfirmasi</b></button>    
                                    </div>  
                                    <?php
                                    }                               
                                    ?>
                            
                                    <?php 
                                    $kode=$_GET['username'];

                                    $sql1 = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                            identitas.username = izin_santri.username WHERE identitas.username='$kode' 
                                            AND izin_santri.posisi!='Di Mahad'") or die (mysqli_error());
                                    $data1 = mysqli_fetch_array ($sql1);
                                    $posisi_santri = $data1['posisi'];
                                    $nomor = $data1['id'];
                                    $kategori_izin = $data1['kategori'];
                                    $jadwal_keluar = $data1['waktu_keluar'];
                                    $jadwal_kembali = $data1['waktu_kembali'];
                                  
                                    //Logika Posisi Santri
                                    if($kategori_izin=="Pulang"){
                                        $posisi_baru ="Pulang";
                                    } else {
                                        $posisi_baru ="Keluar";
                                    }

                                    if(isset($_POST['konfirmasi'])){
                                        $waktu_keluar = $_POST['asli_waktu_keluar'];
                                        $waktu_kembali = $_POST['asli_waktu_kembali'];

                                        if($posisi_santri == "Diproses") {
                                        if($waktu_keluar < $jadwal_keluar){
                                        ?>
                                        <script type="text/javascript">
                                            alert("Mohon Maaf, Belum Waktunya Santri Keluar. Silahkan Tunggu!");
                                            window.location.href="../tables/status_perizinan.php";
                                        </script>
                                        <?php
                                        } else {
                                        $data_keluar = mysqli_query($koneksi,"UPDATE izin_santri SET asli_waktu_keluar='$waktu_keluar', posisi='$posisi_baru' WHERE id='$nomor'"); 

                                        if($data_keluar == true) {
                                        ?>
                                        <script type="text/javascript">
                                            alert("Syukron, Data Sudah Kami Simpan");
                                            window.location.href="../tables/monitor_izin.php";
                                        </script>
                                        <?php
                                        } else{
                                        ?>
                                        <script type="text/javascript">
                                            alert("Afwan, ada yang salah. Coba deh cek lagi!");
                                            window.location.href="../tables/status_perizinan.php";
                                        </script>
                                        <?php
                                        } }

                                        } else {
                                        $waktu1 = strtotime($jadwal_kembali);
                                        $waktu2 = strtotime($waktu_kembali);
                                        $selisih = $waktu2 - $waktu1;
                                        $terlambat = floor($selisih/60);

                                        if($terlambat>0){   
                                        $terlambat = $terlambat;
                                        } else {
                                        $terlambat = 0;
                                        }

                                        if($terlambat>=60){
                                        $treatment = "Dilarang Izin 2 Pekan"; 
                                        } else if($terlambat>30){
                                        $treatment = "Jalan Mundur 10x + Push Up 30x";
                                        } else if($terlambat>15){
                                        $treatment = "Jalan Mundur 10x";
                                        } else {
                                        $treatment = "Tidak Ada";
                                        }

                                        if($terlambat>15){
                                        $status_treatment = "Belum";
                                        } else {
                                        $status_treatment = "Tidak Ada";
                                        }
                                        $data_kembali = mysqli_query($koneksi,"UPDATE izin_santri SET asli_waktu_kembali='$waktu_kembali', posisi='Di Mahad',
                                        terlambat='$terlambat', treatment='$treatment', eksekusi_treatment='$status_treatment' WHERE id='$nomor'");   
                                        }

                                        if($data_kembali == true){
                                        ?>
                                        <script type="text/javascript">
                                            alert("Syukron, Data Sudah Kami Simpan");
                                            window.location.href="../tables/monitor_izin.php";
                                        </script>
                                        <?php
                                        } else {
                                        ?>
                                        <script type="text/javascript">
                                            alert("Afwan, ada yang salah. Coba deh cek lagi!");
                                            window.location.href="../tables/status_perizinan.php";
                                        </script>
                                        <?php                                    
                                        }

                                    }

                                    ?>
                                </div>
                            </form> 
                            <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">     
                            <a href="../tables/status_perizinan.php"><button class="btn bg-red waves-effect"><b>Batal</b></button></a> 
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <script>
        function myFunction() {
            var x = document.getElementById("sandiku");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>
     <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    
    <!-- Multi Select Plugin Js -->
    <script src="../../plugins/multi-select/js/jquery.multi-select.js"></script>
    
    <!-- Bootstrap Notify Plugin Js -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>
    
    <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>
    
    <!-- Moment Plugin Js -->
    <script src="../../plugins/momentjs/moment.js"></script>
    
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    
    <!-- Bootstrap Datepicker Plugin Js -->
    <script src="../../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/medias/image-gallery.js"></script>
    <script src="../../js/pages/examples/profile.js"></script>
    <script src="../../js/pages/ui/notifications.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>

    <!-- Light Gallery Plugin Js -->
    <script src="../../plugins/light-gallery/js/lightgallery-all.js"></script>
    
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
    <script src="../../js/kapital.js"></script>
    
    
</body>
</html>