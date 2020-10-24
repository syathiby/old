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
    <title>Tabel Calon Santri | PPDB Online - Mahad Imam Syathiby</title>
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

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

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
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$usern' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);
                                
                                $sql_draft = mysqli_query($koneksi, "SELECT * FROM draft WHERE thn_ajaran='$thn_ajaran'");
                                $draft = mysqli_fetch_array ($sql_draft);

                            ?>
                <div class="image">
                    <img src="../../img/<?php echo $draft['folder_photo'];?>/<?php echo $data_ubah['photodiri']; ?>" width="48" height="48" alt="User" />
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
                        <a href="tabelsantri.php">
                            <i class="material-icons">account_box</i>
                            <span>Seleksi Berkas</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="tabellulus.php">
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
                $sql = mysqli_query ($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
                $data = mysqli_fetch_array ($sql)
                ?>
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);"><?php echo $data['copyright']; ?></a>.
                </div>
                <div class="version">
                   Dibuat oleh: <a href="https://facebook.com/Alendia.Desta" target="_blank"><b><?php echo $data['developer']; ?></b></a>
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

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATA CALON SANTRI
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
                            <div class="alert alert-info">
                                <strong>DATA IKHWAN</strong>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th align="center">Nomor</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Asal Sekolah</th>
                                            <th>Seleksi Berkas</th>
                                            <th>Bukti Transfer</th>
                                            <th>Kartu Tes</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th align="center">Nomor</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Asal Sekolah</th>
                                            <th>Seleksi Berkas</th>
                                            <th>Bukti Transfer</th>
                                            <th>Kartu Tes</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username 
                                            WHERE identitas.level='Santri' AND identitas.jk='Laki-laki' ORDER BY identitas.id DESC") or die (mysqli_error());
                                            $no=1;

                                            while ($data = mysqli_fetch_array ($sql)) {
                                            $seleksi= $data['seleksi_berkas'];
                                            $transfer= $data['transfer'];
                                            $kode= $data['id'];
                                         ?>
                                        <input type="hidden" name="id" class="form-control" value="<?php echo $data['id'] ?>" />
                                         
                                        <?php
                                        
                                        if($_SESSION['username']){
                                        $thn_ajaran = $_SESSION['thn_ajaran'];
                                        
                                        $sql_draft = mysqli_query($koneksi, "SELECT * FROM draft WHERE thn_ajaran='$thn_ajaran'");
                                        $draft = mysqli_fetch_array ($sql_draft); 
                                        $folder = $draft['folder_photo']; ?>
                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td><?php echo $data['namalengkap']; ?></td>
                                            <td><?php echo $data['tgl_lahir'];?></td>
                                            <td><?php echo $data['asal_sekolah']; ?></td>
                                            <td><?php echo $data['seleksi_berkas']; ?></td>
                                            <td>
                                            <?php
                                            if($seleksi == "LULUS"){
                                                if($transfer==""){
                                                    ?>
                                                    Belum Upload
                                                <?php 
                                                }
                                                else {
                                                ?>
                                                <a href="../../img/<?php echo $folder;?>/<?php echo $data['transfer']; ?>" target="_blank">
                                                Lihat Gambar
                                                </a>
                                                <?php
                                                }
                                                ?>
                                                
                                            <?php 
                                             }
                                             else {
                                                 ?>
                                            Menunggu Upload
                                             <?php
                                             }
                                            ?>
                                            </td>
                                             <td><a href="../../printkartu.php?kode=<?php echo $kode; ?>" target=_blank><button class="btn bg-red btn-block btn-xs waves-effect">Cetak F2</button></a></td>
                                            <td><a href="../forms/profilumum.php?id=<?php echo $data['id']; ?>"><button class="btn bg-red btn-block btn-xs waves-effect">Detail</button></a></td>
                                        </tr>
                                        <?php }?>
                                    <?php }?>
                                    </tbody>
                                </table>
                             </div>

                                <?php 
                                $sql_cek = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level='Santri' AND jk='Laki-laki'");

                                ?>
                                <div class="row clearfix">
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">TOTAL IKHWAN <span class="badge">
                                    <?php echo mysqli_num_rows($sql_cek); ?> Santri</span></button>
                                    </div>
                                 </div>

                        
                            <div class="alert alert-danger">
                                <strong>DATA AKHWAT</strong>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th align="center">Nomor</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Asal Sekolah</th>
                                            <th>Seleksi Berkas</th>
                                            <th>Bukti Transfer</th>
                                            <th>Kartu Tes</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th align="center">Nomor</th>
                                            <th>Nama Lengkap</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Asal Sekolah</th>
                                            <th>Seleksi Berkas</th>
                                            <th>Bukti Transfer</th>
                                            <th>Kartu Tes</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN hasil ON identitas.username = hasil.username 
                                            WHERE identitas.level='Santri' AND identitas.jk='Perempuan' ORDER BY identitas.id DESC") or die (mysqli_error());
                                            $no=1;
                                            
                                            while ($data = mysqli_fetch_array ($sql)) {
                                            $seleksi= $data['seleksi_berkas'];
                                            $transfer= $data['transfer'];
                                            $kode1= $data['id'];

                                         ?>
                                         <input type="hidden" name="id" class="form-control" value="<?php echo $data['id'] ?>" />
                                         
                                         <?php
                                        
                                        if($_SESSION['username']){
                                        $thn_ajaran = $_SESSION['thn_ajaran'];
                                        
                                        $sql_draft = mysqli_query($koneksi, "SELECT * FROM draft WHERE thn_ajaran='$thn_ajaran'");
                                        $draft = mysqli_fetch_array ($sql_draft); 
                                        $folder = $draft['folder_photo']; ?>
                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td><?php echo $data['namalengkap']; ?></td>
                                            <td><?php echo $data['tgl_lahir'];?></td>
                                            <td><?php echo $data['asal_sekolah']; ?></td>
                                            <td><?php echo $data['seleksi_berkas']; ?></td>
                                            <td>
                                            <?php
                                            if($seleksi == "LULUS"){
                                                if($transfer ==""){
                                                    ?>
                                                    Belum Upload
                                                <?php 
                                                }
                                                else {
                                                ?>
                                                <a href="../../img/<?php echo $folder;?>/<?php echo $data['transfer']; ?>" target="_blank">
                                                Lihat Gambar
                                                </a>
                                                <?php
                                                }
                                                ?>
                                                
                                            <?php 
                                             }
                                             else {
                                                 ?>
                                            Menunggu Upload
                                             <?php
                                             }
                                            ?>
                                            </td>
                                            <td><a href="../../printkartu.php?kode=<?php echo $kode1; ?>" target=_blank><button class="btn bg-red btn-block btn-xs waves-effect">Cetak F2</button></a></td>
                                            <td>
                                            <a href="../forms/profilumum.php?id=<?php echo $data['id']; ?>"><button class="btn bg-red btn-block btn-xs waves-effect">Detail</button></a></td>
                                        </tr>
                                        <?php }?>
                                    <?php }?>
                                    </tbody>
                                </table>
                             </div>

                                <?php 
                                $sql_cek = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level='Santri' AND jk='Perempuan'");

                                ?>
                                <div class="row clearfix">
                                    <div class="col-xs-10 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">TOTAL AKHWAT <span class="badge">
                                    <?php echo mysqli_num_rows($sql_cek); ?> Santri</span></button>
                                    </div>
                                 </div>

                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

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
    
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

</body>
</html>