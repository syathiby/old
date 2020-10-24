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
    <title>Tabel Data Perizinan Santri - Kesantrian Apps | Ma'had Al Imam Asy Syathiby</title>
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
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">library_add</i>
                            <span>Input Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li >
                                <a href="datasantri.php">Data Santri</a>
                            </li>
                            <li class="active">
                                <a href="perizinan.php">Perizinan</a>
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
                                INPUT DATA PERIZINAN SANTRI
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
                            <div class="alert alert-success">
                                <strong>DATA SELURUH SANTRI</strong>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable" id="santri_lengkap">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Username</th>
                                            <th style="text-align: center;">Nama Lengkap</th>
                                            <th style="text-align: center;">Angkatan</th>
                                            <th style="text-align: center;">Jenjang</th>
                                            <th style="text-align: center;">Kamar</th>
                                            <th style="text-align: center;">Kuota Izin Sekitar</th>
                                            <th style="text-align: center;">Status Izin</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas WHERE level='Santri' AND status='Aktif' ORDER BY status_izin ASC") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {
                                         ?>
                                            <input type="hidden" name="id" class="form-control" value="<?php echo $data['id'] ?>" />

                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td align="center"><?php echo $data['username']; ?></td>
                                            <td align="center"><?php echo $data['namalengkap']; ?></td>
                                            <td align="center"><?php echo $data['angkatan']; ?></td>
                                            <td align="center"><?php echo $data['jenjang'];?></td>
                                            <td align="center">Kamar <?php echo $data['kamar']; ?></td>
                                            <td align="center"><?php echo $data['kuota'];?></td>
                                            <td align="center">
                                                <?php 
                                                 if($data['status_izin'] == "Diperbolehkan"){
                                                 ?>
                                                    <button type="button" class="btn bg-green waves-effect"><b>Diperbolehkan</b></button>
                                                 <?php }  
                                                 else {
                                                 ?>
                                                    <button type="button" class="btn bg-red waves-effect"><b>Dilarang</b></button>
                                                 <?php }
                                               ?>
                                            </td>
                                            <td align="center">
                                                <?php 
                                                 if($data['status_izin'] == "Diperbolehkan"){
                                                 ?>
                                                <button id="tambah_izin" class="btn bg-blue waves-effect"
                                                data-toggle="modal" data-target="#tambahmodal" 
                                                data-username="<?php echo $data['username'];?>"
                                                data-kuota="<?php echo $data['kuota'];?>" 
                                                data-namalengkap="<?php echo $data['namalengkap'];?>"><span><b>Tambah Izin</b></span> <i class="material-icons">note_add</i></button>
                                            <?php }
                                            else {
                                                ?>
                                                <button type="button" class="btn bg-red waves-effect"><span><b>Tidak Bisa Izin</b></span>
                                                <i class="material-icons">block</i></button>
                                            <?php } ?>
                                                <button id="edit_izin" class="btn bg-green waves-effect"
                                                data-toggle="modal" data-target="#editmodal" 
                                                data-username="<?php echo $data['username'];?>" 
                                                data-namalengkap="<?php echo $data['namalengkap'];?>"
                                                data-catatan_dilarang="<?php echo $data['catatan_dilarang'];?>"
                                                data-tgl_dilarang="<?php echo $data['tgl_dilarang'];?>"><span><b>Detail</b></span> <i class="material-icons">search</i></button>
                                            </td>

                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="alert alert-success">
                                <strong>DATA SANTRI YANG SEDANG IZIN</strong>
                            </div>
                                           
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
                                            <th style="text-align: center;">Action</th>
                                            <!--<th style="text-align: center;">Status Kembali</th>-->
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
                                            <td align="center">
                                                <button id="revisi_izin" class="btn bg-brown waves-effect"
                                                data-toggle="modal" data-target="#revisimodal"
                                                data-id="<?php echo $data['id'];?>" 
                                                data-username="<?php echo $data['username'];?>" 
                                                data-namalengkap="<?php echo $data['namalengkap'];?>"
                                                data-kuota="<?php echo $data['kuota'];?>"
                                                data-keterangan="<?php echo $data['keterangan'];?>"
                                                data-bulan="<?php echo $data['bulan'];?>"
                                                data-tahun="<?php echo $data['tahun'];?>"
                                                data-waktu_keluar="<?php echo $data['waktu_keluar'];?>"
                                                data-waktu_kembali="<?php echo $data['waktu_kembali'];?>"><span><b>Revisi</b></span> <i class="material-icons">mode_edit</i></button>

                                                <a href="hapus_izin.php?id=<?php echo $data['id'];?>" onclick="return confirm('Yakin datanya mau dihapus?')">
                                                <button type="button" class="btn btn-danger waves-effect" >
                                                    <span><b>Hapus</b></span> <i class="material-icons">delete</i>
                                                </button></a>
                                            </td>

                                            <!--<td>
                                               <?php 
                                                 if($data['status_kembali'] == "Menunggu"){
                                                 ?>
                                                    <button type="button" class="btn bg-blue btn-block btn-sm waves-effect" offset><b>Menunggu Data</b></button>
                                                 <?php } 
                                                 else if ($data['status_kembali'] == "Terlambat") {
                                                 ?>
                                                    <button type="button" class="btn bg-red btn-block btn-sm waves-effect"><b>Terlambat</b></button>
                                                 <?php } 
                                                 else {
                                                 ?>
                                                    <button type="button" class="btn bg-green btn-block btn-sm waves-effect"><b>Tepat Waktu</b></button>
                                                 <?php }
                                               ?>
                                            </td>-->
                                          
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

        </div>
                 <!--MODAL BOOTSTRAP TAMBAH IZIN-->
                            <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="defaultModalLabel">Form Permohonan Izin Santri</h4>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <form class="form-horizontal" id="form" action="" method="POST">
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
                                                        <label>Kategori Izin</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <select name="kategori" id="kategori" class="form-control">
                                                                <option value="Kosong">Pilih Satu</option>
                                                                <option value="Tajil">Tajil</option>
                                                                <option value="Keluar Sekitar">Keluar Sekitar</option>
                                                                <option value="Pulang">Pulang</option>
                                                                <option value="Kunjungan Keluar">Kunjungan Keluar</option>
                                                                <option value="Berobat">Berobat</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label>Kuota Izin (per Semester)</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="number" id="kuota" name="kuota" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <br>
                                                <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                    <label>Keterangan</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                        <textarea rows="4" name="keterangan" id="keterangan" class="form-control no-resize" placeholder="Tulis dengan detail perizinan santri"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <br>

                                                <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                    <label>Bulan</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                    <div class="form-group">
                                                        <select name="bulan" id="bulan" class="form-control">
                                                            <option value="Kosong">Pilih Satu</option>
                                                            <option value="Januari">Januari</option>
                                                            <option value="Februari">Februari</option>
                                                            <option value="Februari">Maret</option>
                                                            <option value="Februari">April</option>
                                                            <option value="Februari">Mei</option>
                                                            <option value="Februari">Juni</option>
                                                            <option value="Februari">Juli</option>
                                                            <option value="Februari">Agustus</option>
                                                            <option value="Februari">September</option>
                                                            <option value="Februari">Oktober</option>
                                                            <option value="Februari">November</option>
                                                            <option value="Februari">Desember</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                    <label>Tahun</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="tahun" name="tahun" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                        <label>Jadwal Keluar</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="tgl_keluar" name="waktu_keluar" class="form-control" placeholder="Contoh : 2020-02-31 16:30:10" />
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                        <label>Jadwal Kembali</label>   
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" name="waktu_kembali" placeholder="Contoh : 2020-02-31 16:30:10"/>
                                                                </div>  
                                                            </div>
                                                    </div>   
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <button type="submit" name="tambah" class="btn btn-link waves-effect">Simpan Data</button>
                                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                                                </div>
                                                <?php 
                                                    if(isset($_POST['tambah'])){
                                                        $username = $_POST['username'];
                                                        $kategori = $_POST['kategori'];
                                                        $keterangan = $_POST['keterangan'];
                                                        $pemberi_izin = $_POST['pemberi_izin'];
                                                        $bulan = $_POST['bulan'];
                                                        $tahun = $_POST['tahun'];
                                                        $waktu_keluar = $_POST['waktu_keluar'];
                                                        $waktu_kembali = $_POST['waktu_kembali'];
                                                        $kuota = $_POST['kuota'];

                                                        //LOGIKA JUMLAH IZIN
                                                        $sql_tajil = mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = 
                                                        izin_santri.username WHERE izin_santri.kategori='Tajil' AND izin_santri.username='$username'");
                                                        $hitung_tajil = mysqli_num_rows($sql_tajil);

                                                        $sql_keluar_sekitar = mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = 
                                                        izin_santri.username WHERE izin_santri.kategori='Keluar Sekitar' AND izin_santri.username='$username'");
                                                        $hitung_keluar_sekitar = mysqli_num_rows($sql_keluar_sekitar);

                                                        $sql_kunjungan_keluar = mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = 
                                                        izin_santri.username WHERE izin_santri.kategori='Kunjungan Keluar' AND izin_santri.username='$username'");
                                                        $hitung_kunjungan_keluar = mysqli_num_rows($sql_kunjungan_keluar);

                                                        $sql_pulang = mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = 
                                                        izin_santri.username WHERE izin_santri.kategori='Pulang' AND izin_santri.username='$username'");
                                                        $hitung_pulang = mysqli_num_rows($sql_pulang);

                                                        $hitung_izin = $hitung_tajil + $hitung_keluar_sekitar + $hitung_kunjungan_keluar + $hitung_pulang;

                                                        //LOGIKA KUOTA IZIN SANTRI
                                                        if($kategori == "Keluar Sekitar"){
                                                        $minkuota = 1;
                                                        $sisakuota = $kuota - $minkuota; 
                                                        } else {
                                                        $sisakuota = $kuota;
                                                        }
                                                        
                                                        $tambahdata = mysqli_query($koneksi, "INSERT INTO izin_santri VALUES(DEFAULT,'$username','$kategori','$keterangan',
                                                        '$waktu_keluar','$waktu_kembali',NULL,NULL,'$bulan','$tahun','Diproses',NULL,NULL,NULL,NULL,NULL)");

                                                        if($kategori=="Tajil"){
                                                        $total_izin = $hitung_izin + 1;
                                                        $total_tajil = $hitung_tajil + 1;
                                                        $editkuota = mysqli_query($koneksi, "UPDATE identitas SET kuota='$sisakuota', jml_tajil='$total_tajil', 
                                                        jml_keluar_sekitar='$hitung_keluar_sekitar', jml_kunjungan_keluar='$hitung_kunjungan_keluar', jml_pulang='$hitung_pulang',
                                                        total_izin = '$total_izin' WHERE username='$username'");
                                                        } 
                                                        else if($kategori=="Keluar Sekitar"){
                                                        $total_izin = $hitung_izin + 1;
                                                        $total_keluar_sekitar = $hitung_keluar_sekitar + 1;
                                                        $editkuota = mysqli_query($koneksi, "UPDATE identitas SET kuota='$sisakuota', jml_tajil='$hitung_tajil', 
                                                        jml_keluar_sekitar='$total_keluar_sekitar', jml_kunjungan_keluar='$hitung_kunjungan_keluar', jml_pulang='$hitung_pulang',
                                                        total_izin = '$total_izin' WHERE username='$username'");
                                                        } 
                                                        else if($kategori=="Kunjungan Keluar"){
                                                        $total_izin = $hitung_izin + 1;
                                                        $total_kunjungan_keluar = $hitung_kunjungan_keluar + 1;
                                                        $editkuota = mysqli_query($koneksi, "UPDATE identitas SET kuota='$sisakuota', jml_tajil='$hitung_tajil', 
                                                        jml_keluar_sekitar='$hitung_keluar_sekitar', jml_kunjungan_keluar='$total_kunjungan_keluar', jml_pulang='$hitung_pulang',
                                                        total_izin = '$total_izin' WHERE username='$username'");
                                                        } 
                                                        else {
                                                        $total_izin = $hitung_izin + 1;
                                                        $total_pulang = $hitung_pulang + 1;
                                                        $editkuota = mysqli_query($koneksi, "UPDATE identitas SET kuota='$sisakuota', jml_tajil='$hitung_tajil', 
                                                        jml_keluar_sekitar='$hitung_keluar_sekitar', jml_kunjungan_keluar='$hitung_kunjungan_keluar', jml_pulang='$total_pulang',
                                                        total_izin = '$total_izin' WHERE username='$username'");
                                                        }

                                                    if($tambahdata == true AND $editkuota == true) {
                                                        ?>
                                                            <script type="text/javascript">
                                                            alert("Syukron, Data telah disimpan");
                                                            window.location.href="perizinan.php";
                                                            </script>
                                                    <?php    
                                                    }
                                                    else {
                                                       ?>
                                                            <script type="text/javascript">
                                                            alert("Afwan! Ada data yang salah, coba deh cek lagi!");
                                                            window.location.href="perizinan.php";
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

                            <!--MODAL BOOTSTRAP DETAIL STATUS IZIN-->
                            <div class="modal fade" id="editmodal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="defaultModalLabel">Edit Status Izin Santri</h4>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <form class="form-horizontal" action="" method="POST">
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

                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                        <label>Alasan Dilarang</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                            <textarea rows="4" id="catatan_dilarang" name="catatan_dilarang"  class="form-control no-resize" placeholder="Tulis dengan detail kenapa santri dilarang izin"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label>Batas Waktu Dilarang</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="tgl_dilarang" name="tgl_dilarang" class="form-control" placeholder="Contoh : 2020-02-29 17:00:00">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                        <label>Status Izin</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <select name="status_izin" id="status_izin" class="form-control">
                                                                <option value="Kosong">Pilih Satu</option>
                                                                <option value="Diperbolehkan">Diperbolehkan</option>
                                                                <option value="Dilarang">Dilarang</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <button type="submit" name="edit" class="btn btn-link waves-effect">Simpan Data</button>
                                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                                                </div>
                                                <?php 
                                                    if(isset($_POST['edit'])){
                                                        $username = $_POST['username'];
                                                        $status_izin = $_POST['status_izin'];
                                                        $catatan_dilarang = $_POST['catatan_dilarang'];
                                                        $tgl_dilarang = $_POST['tgl_dilarang'];

                                                        if(($catatan_dilarang == NULL) AND ($tgl_dilarang == NULL)){
                                                        $ubahdata = mysqli_query($koneksi, "UPDATE identitas SET status_izin='$status_izin', catatan_dilarang=NULL,
                                                        tgl_dilarang=NULL WHERE username='$username'");    
                                                        } else {
                                                        $ubahdata = mysqli_query($koneksi, "UPDATE identitas SET status_izin='$status_izin', catatan_dilarang='$catatan_dilarang',
                                                        tgl_dilarang='$tgl_dilarang' WHERE username='$username'");    
                                                        }
                                                        

                                                    if($ubahdata == true) {
                                                        ?>
                                                            <script type="text/javascript">
                                                            alert("Syukron, Data Sudah Kami Simpan");
                                                            window.location.href="perizinan.php";
                                                            </script>
                                                    <?php    
                                                    }
                                                    else {
                                                       ?>
                                                            <script type="text/javascript">
                                                            alert("Afwan! Ada data yang salah, coba deh cek lagi!");
                                                            window.location.href="perizinan.php";
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

                            <!--MODAL BOOTSTRAP REVISI IZIN-->
                            <div class="modal fade" id="revisimodal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="defaultModalLabel">Revisi Perizinan Santri</h4>
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
                                                        <label>Kuota Izin (per Semester)</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="number" id="kuota" name="kuota" class="form-control" disabled="Tidak bisa diubah">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <br>
                                                <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                    <label>Keterangan</label>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                        <textarea rows="4" name="keterangan" id="keterangan" class="form-control no-resize" placeholder="Tulis dengan detail perizinan santri"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <br>

                                                <div class="row clearfix">
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                        <label>Jadwal Keluar</label>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <input type="text" id="waktu_keluar" name="waktu_keluar" class="form-control" />
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                                        <label>Jadwal Kembali</label>   
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                                            <div class="form-group">
                                                                <div class="form-line">
                                                                    <input type="text" id="waktu_kembali" class="form-control" name="waktu_kembali"/>
                                                                </div>  
                                                            </div>
                                                    </div>   
                                                </div>
                                                <br>
                                                <div class="modal-footer">
                                                    <button type="submit" name="revisi" class="btn btn-link waves-effect">Simpan Data</button>
                                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                                                </div>
                                                <?php 
                                                    if(isset($_POST['revisi'])){
                                                        $id = $_POST['id'];
                                                        $kategori = $_POST['kategori'];
                                                        $keterangan = $_POST['keterangan'];
                                                        $bulan = $_POST['bulan'];
                                                        $tahun = $_POST['tahun'];
                                                        $waktu_keluar= $_POST['waktu_keluar'];
                                                        $waktu_kembali = $_POST['waktu_kembali'];

                                                        $revisidata = mysqli_query($koneksi, "UPDATE izin_santri SET keterangan='$keterangan', waktu_keluar='$waktu_keluar', waktu_kembali='$waktu_kembali' WHERE id='$id'");    
    
                                                    if($revisidata == true) {
                                                        ?>
                                                            <script type="text/javascript">
                                                            alert("Syukron, Data Sudah Kami Simpan");
                                                            window.location.href="perizinan.php";
                                                            </script>
                                                    <?php    
                                                    }
                                                    else {
                                                       ?>
                                                            <script type="text/javascript">
                                                            alert("Afwan! Ada data yang salah, coba deh cek lagi!");
                                                            window.location.href="perizinan.php";
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
        $(document).on("click", "#tambah_izin", function(){
        var username_santri = $(this).data('username');
        var kuota_santri = $(this).data('kuota');
        var namalengkap_santri = $(this).data('namalengkap');


        $(".modal-body #username").val(username_santri);
        $(".modal-body #kuota").val(kuota_santri);
        $(".modal-body #namalengkap").val(namalengkap_santri);
        })
    </script>

    <script type="text/javascript">
        $(document).on("click", "#edit_izin", function(){
        var username_santri = $(this).data('username');
        var namalengkap_santri = $(this).data('namalengkap');
        var catatan_dilarang_santri = $(this).data('catatan_dilarang');
        var tgl_dilarang_santri = $(this).data('tgl_dilarang');

        $(".modal-body #username").val(username_santri);
        $(".modal-body #namalengkap").val(namalengkap_santri);
        $(".modal-body #catatan_dilarang").val(catatan_dilarang_santri);
        $(".modal-body #tgl_dilarang").val(tgl_dilarang_santri);
        })
    </script>

    <script type="text/javascript">
        $(document).on("click", "#revisi_izin", function(){
        var id_santri = $(this).data('id');
        var username_santri = $(this).data('username');
        var namalengkap_santri = $(this).data('namalengkap');
        var kategori_santri = $(this).data('kategori');
        var kuota_santri = $(this).data('kuota');
        var keterangan_santri = $(this).data('keterangan');
        var bulan_santri = $(this).data('bulan');
        var tahun_santri = $(this).data('tahun');
        var waktu_keluar_santri = $(this).data('waktu_keluar');
        var waktu_kembali_santri = $(this).data('waktu_kembali');

        $(".modal-body #id").val(id_santri);
        $(".modal-body #username").val(username_santri);
        $(".modal-body #namalengkap").val(namalengkap_santri);
        $(".modal-body #kategori").val(kategori_santri);
        $(".modal-body #kuota").val(kuota_santri);
        $(".modal-body #keterangan").val(keterangan_santri);
        $(".modal-body #bulan").val(bulan_santri);
        $(".modal-body #tahun").val(tahun_santri);
        $(".modal-body #waktu_keluar").val(waktu_keluar_santri);
        $(".modal-body #waktu_kembali").val(waktu_kembali_santri);
        })
    </script>
</body>

</html>

<?php 

    mysqli_close($koneksi);
    ob_end_flush();

?>