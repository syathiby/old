<?php 

ob_start();
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

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Beranda Perizinan Santri - Kesantrian Apps | Ma'had Al Imam Asy Syathiby</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

     <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="css/themes/all-themes.css" rel="stylesheet" />
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
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$usern' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);

                            ?>
                <div class="image">
                    <img src="img/<?php echo $data_ubah['photo']; ?>" width="48" height="48" alt="User" />
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
                        if ($_SESSION['security'] || $_SESSION['admin']) {

                         ?>
                    <li class="active">
                        <a href="index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    <?php }?>

                    <?php 
                        if ($_SESSION['security']) {

                         ?>

                    <li>
                        <a href="pages/tables/monitor_izin.php">
                            <i class="material-icons">desktop_windows</i>
                            <span>Monitoring Izin</span>
                        </a>
                    </li>

                    <li>
                        <a href="pages/tables/status_perizinan.php">
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
                            <i class="material-icons">library_add</i>
                            <span>Input Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/tables/datasantri.php">Data Santri</a>
                            </li>
                            <li>
                                <a href="pages/tables/perizinan.php">Perizinan</a>
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
                                <a href="pages/tables/laporan_izin.php">Izin Santri</a>
                            </li>
                            <li>
                                <a href="pages/tables/statistik.php">Statistik</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    
                    <li>
                        <?php 
                        if ($_SESSION['security'] || $_SESSION['admin']) {

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
            <div class="block-header">
                <h2>HALAMAN UTAMA</h2>
            </div>
    
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">SANTRI PULANG</div>
                            
                            <div>
                            <?php 
                            $sql_pulang = mysqli_query($koneksi,"SELECT * FROM izin_santri WHERE posisi='Pulang'");
                            $data_pulang = mysqli_num_rows($sql_pulang);
                            ?>
                            <h4><?php echo $data_pulang; ?> Orang</h4>                               
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
                            <div class="text">SANTRI KELUAR</div>
                            <div>
                            <?php 
                            $sql_keluar = mysqli_query($koneksi,"SELECT * FROM izin_santri WHERE posisi='Keluar'");
                            $data_keluar = mysqli_num_rows($sql_keluar);
                            ?>
                            <h4><?php echo $data_keluar; ?> Orang</h4>                               
                            </div>    
                        </div>
                    </div>
                </div>


                            <!-- DATA IKHWAN -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATA STATUS PERIZINAN SANTRI
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
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Nama Lengkap</th>
                                            <th style="text-align: center;">Kamar</th>
                                            <th style="text-align: center;">Jenjang</th>
                                            <th style="text-align: center;">Kategori</th>
                                            <th style="text-align: center;">Keterangan</th>
                                            <th style="text-align: center;">Jadwal Keluar</th>
                                            <th style="text-align: center;">Jadwal Kembali</th>
                                            <th style="text-align: center;">Sisa Waktu Kembali</th>
                                            <th style="text-align: center;">Status Santri</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                            identitas.username = izin_santri.username WHERE identitas.level='Santri' AND izin_santri.posisi!='Di Mahad'
                                            ORDER BY izin_santri.id DESC") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {
                                            $kembali = $data['waktu_kembali'];
                                            $user = $data['username'];
                                         ?>
                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td align="center"><?php echo $data['namalengkap']; ?></td>
                                            <td align="center">Kamar <?php echo $data['kamar']; ?></td>
                                            <td align="center"><?php echo $data['jenjang'];?></td>
                                            <td align="center"><?php echo $data['kategori']; ?></td>
                                            <td align="center"><?php echo $data['keterangan']; ?></td>
                                            <td align="center"><?php echo $data['waktu_keluar']; ?></td>
                                            <td align="center"><?php echo $kembali; ?></td>
                                            <td align="center"><h5 id=<?php echo $user;?>></h5></td>       
                                            <td align="center" style="text-align: justify-all;">
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

                                        <?php }  ?>
                                    </tbody>
                                    <script type="text/javascript">
                                    function createCountDown(elementId, date) {
                                    // Set the date we're counting down to
                                    var countDownDate = new Date(date).getTime();

                                    // Update the count down every 1 second
                                    var x = setInterval(function()  {
                                                                                    
                                    // Get today's date and time
                                    var now = new Date().getTime();
                                                                                        
                                     // Find the distance between now and the count down date
                                    var distance = countDownDate - now;
                                                                               
                                    // Time calculations for days, hours, minutes and seconds
                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                    // Output the result in an element with id="demo"
                                    document.getElementById(elementId).innerHTML = days + " Hari " + hours + " Jam " + minutes + " Menit " + seconds + " Detik ";
                                                                                        
                                    // If the count down is over, write some text 
                                    if (distance < 0) {
                                    clearInterval(x);
                                    document.getElementById(elementId).innerHTML = "Terlambat";
                                                                                        
                                    }
                                    } , 1000);
                                    }
                                    </script>

                                    <?php 
                                    $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                    identitas.username = izin_santri.username WHERE identitas.level='Santri' AND izin_santri.posisi!='Di Mahad'") or die (mysqli_error());
                                    while ($data = mysqli_fetch_array ($sql)) {
                                    $user = $data['username'];
                                    $kembali = $data['waktu_kembali'];
                                    $id = $data['id'];
                                    ?>
                                    <script type="text/javascript">
                                    do{
                                      createCountDown('<?php echo $user;?>', "<?php echo $kembali;?>");
                                    }
                                    while($id > 0);
                                    </script>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- #END# Widgets -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <?php 
                            $cek = mysqli_query($koneksi, "SELECT * FROM aplikasi WHERE id='1'") or die (mysqli_error());
                            $tahun = mysqli_fetch_array($cek);
                            $tahun_sekarang = $tahun['tahun_aktif'];
                            ?>
                            <h2>RIWAYAT IZIN SANTRI (SMA) TAHUN <b><?php echo $tahun['tahun_aktif']; ?></b></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Nama Lengkap</th>
                                            <th style="text-align: center;">Kamar</th>
                                            <th style="text-align: center;">Waktu Keluar</th>
                                            <th style="text-align: center;">Keterangan</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                       <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username 
                                            WHERE izin_santri.tahun='$tahun_sekarang' AND identitas.jenjang='SMA' ORDER BY izin_santri.id DESC") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {

                                         ?>
                                        
                                        <tr>
                                            <td style="text-align: center;"><?php echo $no++ ?></td>
                                            <td style="text-align: center;"><?php echo $data['namalengkap']; ?></td>
                                            <td style="text-align: center;"><?php echo $data['kamar'];?></td>
                                            <td style="text-align: center;"><?php echo $data['waktu_keluar']; ?></td>
                                            <td style="text-align: center;"><?php echo $data['keterangan']; ?></td>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>     
                        </div>
                    </div>
                </div>
                

                
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>RIWAYAT IZIN SANTRI (SMP) TAHUN <b><?php echo $tahun['tahun_aktif']; ?></b></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Nama Lengkap</th>
                                            <th style="text-align: center;">Kamar</th>
                                            <th style="text-align: center;">Waktu Keluar</th>
                                            <th style="text-align: center;">Keterangan</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                       <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username 
                                            WHERE izin_santri.tahun='$tahun_sekarang' AND identitas.jenjang='SMP' ORDER BY izin_santri.id DESC") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {

                                         ?>
                                        
                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td align="center"><?php echo $data['namalengkap']; ?></td>
                                            <td align="center"><?php echo $data['kamar'];?></td>
                                            <td align="center"><?php echo $data['waktu_keluar']; ?></td>
                                            <td align="center"><?php echo $data['keterangan']; ?></td>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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

     <!-- Bootstrap Notify Plugin Js -->
    <script src="plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Sweet Alert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Jquery DataTable Plugin Js -->
    <script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/tables/jquery-datatable.js"></script>
    <!--<script src="../../js/pages/ui/modals.js"></script>-->

    <!-- Demo Js -->
    <script src="js/demo.js"></script>

    <!-- Chart Batang -->
    
    
</body>
</html>

<?php 

    mysqli_close($koneksi);
    ob_end_flush();

 ?>

