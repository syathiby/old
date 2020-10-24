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
    <title>Database Santri - Kesantrian Apps | Ma'had Al Imam Asy Syathiby</title>
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

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Light Gallery Plugin Css -->
    <link href="../../plugins/light-gallery/css/lightgallery.css" rel="stylesheet">

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
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">library_add</i>
                            <span>Input Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="active">
                                <a href="../tables/datasantri.php">Data Santri</a>
                            </li>
                            <li>
                                <a href="../tables/perizinan.php">Perizinan</a>
                            </li>
                        </ul>
                    </li>

                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">timeline</i>
                            <span>Laporan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../tables/laporan_izin.php">Izin Santri</a>
                            </li>
                            <li>
                                <a href="../tables/statistik.php">Statistik</a>
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
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div id="aniimated-thumbnials" class="list-unstyled row clearfix">
                                        <a href="../../img/<?php echo $draft['photo'];?>" data-sub-html="Photo Santri">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $draft['photo'];?>" width="300px" height="500">
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
                                                <input type="hidden" name="username" class="form-control" 
                                                value="<?php echo $data['username'] ?>"/>
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

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Kuota Izin Sekitar</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="kuota" class="form-control" 
                                                value="<?php echo $data['kuota'] ?>" disabled/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Status Izin</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="status_izin" class="form-control" 
                                                value="<?php echo $data['status_izin'] ?>" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Status Santri</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="status" id="status" class="form-control">
                                                <option value="<?php echo $data['status'];?>"><?php echo $data['status'];?></option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Alumni">Alumni</option>
                                                <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                                                <option value="Dikeluarkan">Dikeluarkan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--#END BIODATA SANTRI-->
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                        <button type="submit" name="update" class="btn btn-primary m-t-15 waves-effect">Simpan Data</button>
                                    </div>
                                </div>
                                <?php 
                                if(isset($_POST['update'])){
                                    $username = $_POST['username'];
                                    $namalengkap = $_POST['namalengkap'];
                                    $angkatan = $_POST['angkatan'];
                                    $jenjang = $_POST['jenjang'];
                                    $kamar = $_POST['kamar'];
                                    $status = $_POST['status'];
                                    

                                    $update = mysqli_query($koneksi,"UPDATE identitas SET namalengkap='$namalengkap',
                                        angkatan='$angkatan', jenjang='$jenjang', kamar='$kamar', status='$status' 
                                        WHERE username='$username'");
                                    if($update == true) {
                                        ?>
                                        <script type="text/javascript">
                                        alert("Berhasil Update Data Santri");
                                        window.location.href="../tables/datasantri.php";
                                        </script>
                                <?php 
                                    } else {
                                        echo "GAGAL UPDATE";
                                    }
                                }
                                ?>

                            </form>

                            <div class="row clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">     
                            <a href="../tables/datasantri.php"><button class="btn bg-red waves-effect"><b>Batal</b></button></a> 
                            </div>
                            </div>
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

    <!-- Multi Select Plugin Js -->
    <script src="../../plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

     <!-- Bootstrap Notify Plugin Js -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Light Gallery Plugin Js -->
    <script src="../../plugins/light-gallery/js/lightgallery-all.js"></script>

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
     <script src="../../js/pages/medias/image-gallery.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
</body>

</html>

<?php 

    mysqli_close($koneksi);
    ob_end_flush();

?>