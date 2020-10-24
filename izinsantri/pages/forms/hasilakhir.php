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
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$usern' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);
                                
                                $sql_draft = mysqli_query($koneksi, "SELECT * FROM draft WHERE thn_ajaran='$thn_ajaran'");
                                $draft = mysqli_fetch_array ($sql_draft);
                                $folder = $draft ['folder_photo'];

                            ?>
                <div class="image">
                    <img src="../../img/<?php echo $folder;?>/<?php echo $data_ubah['photodiri']; ?>" width="48" height="48" alt="User" />
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
                     <li class="">
                        <a href="../tables/tabelsantri.php">
                            <i class="material-icons">account_box</i>
                            <span>Data Santri</span>
                        </a>
                    </li>

                    <li class="active">
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
                        <a href="">
                            <i class="material-icons">map</i>
                            <span>Panduan Aplikasi</span>
                        </a>
                        
                    </li>
                    
                        <?php } ?>

                        <?php 
                        if ($_SESSION['santri'] || $_SESSION['admin']) {

                         ?>
                        <a href="pages/changelogs.html">
                            <i class="material-icons">update</i>
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
                    &copy; 2018 <a href="javascript:void(0);">PPDB Online - Mahad Syathiby</a>.
                </div>
                <div class="version">
                    <b>Dibuat oleh: </b> ADS Dev
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
                                DATA NILAI TES MASUK SANTRI
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
                            
                            $idsantri=$_GET['id'];
                               
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
                                        <label for="username">Nama Lengkap</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="namalengkap" class="form-control" 
                                                value="<?php echo $data_ubah['namalengkap'] ?>" disabled />
                                            </div>
                                            <div>
                                                <input type="hidden" name="username" class="form-control" 
                                                value="<?php echo $data_ubah['username'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="email_address_2">Jenis Kelamin</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="jk" class="form-control" value="<?php echo $data_ubah['jk'] ?>" disabled/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="email_address_2">Asal Sekolah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="asal_sekolah" class="form-control" value="<?php echo $data_ubah['asal_sekolah'] ?>" disabled/>
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
                                                <input type="text" name="program_pilihan" class="form-control" value="<?php echo $data_ubah['program_pilihan'] ?>" disabled/>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="tempat_lahir">Daftar Ulang</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <select name="daftar_ulang" class="form-control">
                                                <option><?php echo $data_ubah['daftar_ulang']?></option>
                                                <option value="28 Jan 2019">28 Januari 2019</option>
                                                <option value="29 Jan 2019">29 Januari 2019</option>
                                                <option value="30 Jan 2019">30 Januari 2019</option>
                                                <option value="31 Jan 2019">31 Januari 2019</option>
                                                <option value="01 Feb 2019">01 Februari 2019</option>
                                                <option value="02 Feb 2019">02 Februari 2019</option>
                                                <option value="03 Feb 2019">03 Februari 2019</option>
                                                <option value="04 Feb 2019">04 Februari 2019</option>
                                                <option value="05 Feb 2019">05 Februari 2019</option>
                                                <option value="06 Feb 2019">06 Februari 2019</option>
                                                <option value="07 Feb 2019">07 Februari 2019</option>
                                                <option value="08 Feb 2019">08 Februari 2019</option>
                                                <option value="09 Feb 2019">09 Februari 2019</option>
                                                <option value="10 Feb 2019">10 Februari 2019</option>
                                            </select>    
                                        </div>
                                    </div>
                                </div> 
                                <!--#AKHIR DATA SANTRI-->

                                <!--NILAI SANTRI-->
                                <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        NILAI SANTRI
                                    </button>
                                </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="email_address_2">Tes Tahfizh</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tes_tahfizh" class="form-control" value="<?php echo $data_ubah['tes_tahfizh'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Wawancara Anak</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                           <select name="tes_wawancara" class="form-control">
                                                <option> <?php echo $data_ubah['tes_wawancara']?> </option>
                                                <option value="Tidak Tes">Tidak Tes</option>
                                                <option value="Direkomendasikan">Direkomendasikan</option>
                                                <option value="Tidak Direkomendasikan">Tidak Direkomendasikan</option>
                                                <option value="Dipertimbangkan">Dipertimbangkan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="email_address_2">Tes Psikologi</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tes_psikologi" class="form-control" value="<?php echo $data_ubah['tes_psikologi'] ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Wawancara Orang Tua</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                           <select name="ortu_wawancara" class="form-control">
                                                <option> <?php echo $data_ubah['ortu_wawancara']?> </option>
                                                <option value="Tidak Tes">Tidak Tes</option>
                                                <option value="Direkomendasikan">Direkomendasikan</option>
                                                <option value="Tidak Direkomendasikan">Tidak Direkomendasikan</option>
                                                <option value="Dipertimbangkan">Dipertimbangkan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label for="email_address_2">Tes Kesehatan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tes_kesehatan" class="form-control" value="<?php echo $data_ubah['tes_kesehatan'] ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <!--Tombol Update-->
                                <div class="row clearfix">
                                    
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" name="update" class="btn btn-primary m-t-15 waves-effect">Simpan</button>
                                    </div>
                                    
                                </div>

                                <?php

                                if(isset($_POST['update'])){
                                
                                $id= $_POST['id'];
                                $username = $_POST['username'];
                                $tes_tahfizh = $_POST['tes_tahfizh'];
                                $tes_psikologi = $_POST['tes_psikologi'];
                                $tes_kesehatan = $_POST['tes_kesehatan'];
                                $tes_wawancara = $_POST['tes_wawancara'];
                                $ortu_wawancara = $_POST['ortu_wawancara'];
                                $daftar_ulang = $_POST['daftar_ulang'];
                                $nilai = $tes_tahfizh+$tes_psikologi+$tes_kesehatan;
                                
                                if($nilai>=70){
                                    $hasil='LULUS';
                                }
                                else {
                                    $hasil='GAGAL';
                                }

                                
                                $update = mysqli_query($koneksi, "UPDATE hasil SET tes_tahfizh='$tes_tahfizh', tes_psikologi='$tes_psikologi',
                                        tes_kesehatan='$tes_kesehatan', tes_wawancara='$tes_wawancara', ortu_wawancara='$ortu_wawancara', nilai_akhir='$nilai',
                                        hasil_akhir='$hasil', daftar_ulang='$daftar_ulang'
                                        WHERE username='$username'");
                                if($update == true){
                                        ?>
                                        <script type="text/javascript">
                                        alert("Berhasil Update!");
                                        window.location.href="../tables/tabellulus.php";
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
    
    
    <!-- Bootstrap Notify Plugin Js -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="../../plugins/sweetalert/sweetalert.min.js"></script>

      <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/medias/image-gallery.js"></script>
    
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