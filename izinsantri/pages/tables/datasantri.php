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

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

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
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$usern'");
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
                                <a href="#">Data Santri</a>
                            </li>
                            <li>
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
                                DATA ADMINISTRASI SANTRI
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
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <form action="" method="POST">
                                            <?php 
                                            $data=mysqli_query($koneksi,"SELECT * FROM aplikasi");
                                            $cek = mysqli_fetch_array($data);
                                            $tahun_aktif = $cek['tahun_aktif'];
                                            ?>
                                            <h4>Tentukan Tahun Aktif Disini</h4>
                                            <br>
                                            <div class="row clearfix">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                                    <div class="form-group">
                                                        <select name="tahun" id="tahun" class="form-control">
                                                            <option value="<?php echo $tahun_aktif;?>"><?php echo $tahun_aktif;?></option>
                                                            <option value="2020">2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                            <option value="2026">2026</option>
                                                            <option value="2027">2027</option>
                                                            <option value="2028">2028</option>
                                                            <option value="2029">2029</option>
                                                            <option value="2030">2030</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <button type="submit" name="aktif" class="btn btn-primary btn-lg m-l-15 waves-effect">Aktifkan</button>
                                                </div>
                                            </div>

                                            <?php 
                                            if(isset($_POST['aktif'])){
                                            $tahun=$_POST['tahun'];
                                            $aktif = mysqli_query($koneksi, "UPDATE aplikasi SET tahun_aktif='$tahun' WHERE id='1'");
                                            
                                            if($aktif == true){
                                            ?>
                                            <script type="text/javascript">
                                                alert("Data Berhasil Diupdate");
                                                window.location.href="datasantri.php";
                                            </script>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </form>             
                            </div>
                        </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <button class="btn bg-green waves-effect" data-toggle="modal" data-target="#defaultModal">
                                    <span><b>Tambah Santri</b></span> <i class="material-icons">account_circle</i></button>
                                </div>
                            </div>
                            <div class="alert alert-success">
                                <strong>DATA SELURUH SANTRI (AKTIF)</strong>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Username</th>
                                            <th style="text-align: center;">Nama Lengkap</th>
                                            <th style="text-align: center;">Angkatan</th>
                                            <th style="text-align: center;">Jenjang</th>
                                            <th style="text-align: center;">Kamar</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas WHERE level='Santri' AND status='Aktif'") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {
                                         ?>
                                            <input type="hidden" name="id" class="form-control" value="<?php echo $data['id'] ?>" />

                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td align="center" style="text-align: justify-all;"><?php echo $data['username']; ?></td>
                                            <td align="center"><?php echo $data['namalengkap']; ?></td>
                                            <td align="center"><?php echo $data['angkatan'];?></td>
                                            <td align="center"><?php echo $data['jenjang']; ?></td>
                                            <td align="center"><?php echo $data['kamar']; ?></td>
                                            <td align="center"><?php echo $data['status'];?></td>
                                            <td align="center" style="text-align: justify-all;">
                                                <a href="hapus_santri.php?username=<?php echo $data['username'];?>" onclick="return confirm('Yakin datanya mau dihapus?')">
                                                <button type="button" class="btn btn-danger waves-effect" >
                                                    <span><b>Hapus</b></span> <i class="material-icons">delete</i>
                                                </button></a>

                                                <a href="../forms/profilsantri.php?username=<?php echo $data['username']; ?>" target="_blank">
                                                <button type="button" class="btn btn-primary waves-effect" >
                                                    <span><b>Edit</b></span> <i class="material-icons">mode_edit</i>
                                                </button></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="alert alert-danger">
                                <strong>DATA SELURUH SANTRI (TIDAK AKTIF)</strong>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Username</th>
                                            <th style="text-align: center;">Nama Lengkap</th>
                                            <th style="text-align: center;">Angkatan</th>
                                            <th style="text-align: center;">Jenjang</th>
                                            <th style="text-align: center;">Kamar</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas WHERE level='Santri' AND status!='Aktif'") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {
                                         ?>
                                            <input type="hidden" name="id" class="form-control" value="<?php echo $data['id'] ?>" />

                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td align="center" style="text-align: justify-all;"><?php echo $data['username']; ?></td>
                                            <td align="center"><?php echo $data['namalengkap']; ?></td>
                                            <td align="center"><?php echo $data['angkatan'];?></td>
                                            <td align="center"><?php echo $data['jenjang']; ?></td>
                                            <td align="center"><?php echo $data['kamar']; ?></td>
                                            <td align="center"><?php echo $data['status'];?></td>
                                            <td align="center" style="text-align: justify-all;">
                                                <a href="hapus_santri.php?username=<?php echo $data['username'];?>" onclick="return confirm('Yakin datanya mau dihapus?')">
                                                <button type="button" class="btn btn-danger waves-effect" >
                                                    <span><b>Hapus</b></span> <i class="material-icons">delete</i>
                                                </button></a>

                                                <a href="../forms/profilsantri.php?username=<?php echo $data['username']; ?>" target="_blank">
                                                <button type="button" class="btn btn-primary waves-effect" >
                                                    <span><b>Edit</b></span> <i class="material-icons">mode_edit</i>
                                                </button></a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

             <!--BODY MODAL-->
                        <?php 
                        if(isset($_POST['tambah'])){
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $namalengkap = $_POST['namalengkap'];
                            $angkatan = $_POST['angkatan'];
                            $jenjang = $_POST['jenjang'];
                            $kamar = $_POST['kamar'];
                            $status = $_POST['status'];

                            $namaphoto=$_FILES['photo']['name'];
                            $formatphoto = pathinfo($namaphoto, PATHINFO_EXTENSION);

                            $ukuranphoto = $_FILES['photo']['size'];

                            $tipephoto = exif_imagetype($_FILES['photo']['tmp_name']);
                            $allowed = array(IMAGETYPE_JPG, IMAGETYPE_JPEG, IMAGETYPE_PNG);

                            if(in_array($tipephoto, $allowed)){
                                if($ukuranphoto < 1044070){
                                    $photo=$_FILES['photo']['tmp_name'];

                                    $time = time();
                                    $acak = rand(10000, 99999);

                                    $simpanphoto = "../../img/".$time."-".$acak."-".$namaphoto; 

                                    $photobaru = $time."-".$acak."-".$namaphoto;

                                    $upphoto = move_uploaded_file($photo, $simpanphoto);

                                    if($upphoto == true) {
                                        $tambahsantri = mysqli_query($koneksi, "INSERT INTO identitas VALUES(DEFAULT,'$username','$password','$namalengkap',
                                            '$angkatan','$jenjang','$kamar','Santri','$status','$photobaru','10','Diperbolehkan',NULL,NULL,'0','0','0','0','0')");

                                        if($tambahsantri == true){
                                        ?>
                                        <script type="text/javascript">
                                        alert("Syukron, santri berhasil ditambahkan!");
                                        window.location.href="datasantri.php";
                                        </script>
                                        <?php }
                                        else {
                                        ?>
                                        <script type="text/javascript">
                                        alert("Ada yang salah, coba deh cek lagi!");
                                        window.location.href="datasantri.php";
                                        </script>
                                        <?php
                                        }
                                    }
                                }
                            }
                         }?>

                        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="defaultModalLabel">Tambah Data Perizinan Santri</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <label for="email_address">Username</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="username" class="form-control">
                                            </div>
                                        </div>
            
                                        <label for="email_address">Password</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="password" class="form-control">
                                            </div>
                                        </div>
                                        
                                       <label for="email_address">Nama Lengkap</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="namalengkap" class="form-control">
                                            </div>
                                        </div>

                                        <label for="email_address">Angkatan</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" name="angkatan" class="form-control" placeholder="Isi dengan angka">
                                            </div>
                                        </div>

                                        <label for="email_address">Jenjang</label>
                                        <div class="form-group">
                                            <div class="demo-checkbox">
                                            <div class="form-line">
                                                <input name="jenjang" value="SMP" type="radio" id="radio_1" class="radio-col-green" />
                                                <label for="radio_1">SMP</label>
                                                
                                                <input name="jenjang" value="SMA" type="radio" id="radio_2" class="radio-col-pink"/>
                                                <label for="radio_2">SMA</label>
                                            </div>
                                            </div>
                                        </div>

                                        <label for="email_address">Kamar</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="number" name="kamar" class="form-control" placeholder="Isi dengan angka">
                                            </div>
                                        </div>
                                        
                                        <label for="email_address">Status</label>
                                        <div class="form-group">
                                            <select name="status" class="form-control">
                                                <option value="Kosong">Pilih Satu</option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Alumni">Alumni</option>
                                                <option value="Mengundurkan Diri">Mengundurkan Diri</option>
                                                <option value="Dikeluarkan">Dikeluarkan</option>
                                            </select>
                                        </div>

                                        <label for="email_address">Photo Santri</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" accept="image/*"  name="photo" class="form-control">
                                            </div>
                                        </div>
                                <div class="modal-footer">
                                    <button type="submit" name="tambah" class="btn btn-link waves-effect">Tambah</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!--END OF MODAL-->
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

        <!-- Multi Select Plugin Js -->
    <script src="../../plugins/multi-select/js/jquery.multi-select.js"></script>

     <!-- Bootstrap Notify Plugin Js -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script>

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

<?php 

    mysqli_close($koneksi);
    ob_end_flush();

?>