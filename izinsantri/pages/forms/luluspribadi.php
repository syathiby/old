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
    <title>Kelulusan Santri - PSB Online | Ma'had Al Imam Asy Syathiby</title>
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
        <input type="text" placeholder="Tulis Langsung Disini....">
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
                    <li><a href="profil.php"><i class="material-icons">account_circle</i></a></li>
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
                                $folder = $draft['folder_photo'];

                            ?>
                <div class="image">
                    <img src="../../img/<?php echo $folder;?>/<?php echo $data_ubah['photodiri']; ?>" width="48" height="48" alt="User" />
                </div>
                <?php } ?>
                <div class="info-container">

                    <?php 
                    if($_SESSION['admin']){
                        $lagi_login = $_SESSION['admin'];
                    }
                    else if($_SESSION['namalengkap']){
                        $lagi_login = $_SESSION['namalengkap'];
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
                    <li class="">
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
                    
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">description</i>
                            <span>Hasil Tes Masuk</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="active">
                                <a href="#">Kelulusan Pribadi</a>
                            </li>
                            <li>
                                <a href="lulusumum.php">Kelulusan Umum</a>
                            </li>
        
                        </ul>

                        <?php } ?>
                    </li>
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
                    <li>
                        <?php 
                        if ($_SESSION['santri'] || $_SESSION['admin']) {

                         ?>
                        <a href="../ui/hubungilogin.php">
                            <i class="material-icons">phone_in_talk</i>
                            <span>Hubungi Kami </span>
                        </a>
                         <?php } ?>
                    </li>
                    
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
           

            <!-- Example -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                INFO KELULUSAN PRIBADI
                            </h2>
                            <br>
                            <p>    
                                Dengan mengharap ridho Allah subhanahu wa ta'ala, setelah melalui serangkaian proses <strong>Tes Seleksi Penerimaan Santri Baru Tahun Ajaran 2020-2021</strong> maka dengan ini kami manajemen <strong>Ma'had Tahfizh Al Quran Al Imam Asy Syathiby</strong> memutuskan bahwa
                            </p>
                            <div class="body">
                                <?php 
                            
                                if($_SESSION['username']){
                                $usern=$_SESSION['username'];
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$usern' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);
                                $kode = $data_ubah['id'];


                                ?>
                                <form>
                                    <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="email_address_2">Nama Depan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="namalengkap" class="form-control" value="<?php echo $data_ubah['namalengkap'] ?>"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="email_address_2">Tanggal Lahir</label>
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
                                        <label for="username">Jenis Kelamin</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="jk" class="form-control" 
                                                value="<?php echo $data_ubah['jk'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Program</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="program_pilihan" class="form-control" 
                                                value="<?php echo $data_ubah['program_pilihan'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Asal Sekolah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="asal_sekolah" class="form-control" 
                                                value="<?php echo $data_ubah['asal_sekolah'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </form>   
                            <?php }?>
                            </div>
                            
                            <?php 
                            $sqlpublikasi = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level = 'Admin'");
                            $datapublikasi = mysqli_fetch_array($sqlpublikasi);
                            $statuspublikasi = $datapublikasi['publikasi'];
                            
                            if (($_SESSION['hasil_akhir'] == "LULUS") and ($statuspublikasi == "Release")) { ?>
                            <p>
                                Kepada seluruh santri yang telah LULUS, <b>WAJIB</b> melakukan konfirmasi waktu daftar ulang dengan cara memilih tanggal di bawah ini:
                            </p>
                            
                            <form method="POST" action="">
                                <div>
                                    <input type="hidden" name="id" class="form-control" 
                                    value="<?php echo $data_ubah['id'] ?>" />
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="Tanggal">Daftar Ulang</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="daftar_ulang" class="form-control">
                                                <option><?php echo $data_ubah['daftar_ulang']?></option>
                                                <option value="15 Desember 2019">15 Desember 2019</option>
                                                <option value="16 Desember 2019">16 Desember 2019</option>
                                                <option value="17 Desember 2019">17 Desember 2019</option>
                                                <option value="18 Desember 2019">18 Desember 2019</option>
                                                <option value="19 Desember 2019">19 Desember 2019</option>
                                                <option value="20 Desember 2019">20 Desember 2019</option>
                                                <option value="21 Desember 2019">21 Desember 2019</option>
                                                <option value="22 Desember 2019">22 Desember 2019</option>
                                                <option value="23 Desember 2019">23 Desember 2019</option>
                                                <option value="24 Desember 2019">24 Desember 2019</option>
                                                <option value="25 Desember 2019">25 Desember 2019</option>
                                                <option value="26 Desember 2019">26 Desember 2019</option>
                                                <option value="27 Desember 2019">27 Desember 2019</option>
                                                <option value="28 Desember 2019">28 Desember 2019</option>
                                                <option value="29 Desember 2019">29 Desember 2019</option>
                                            </select>    
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                    <button type="submit" name="konfirmasi" class="btn btn-primary m-t-15 waves-effect">Konfirmasi Daftar Ulang</button>
                                </div>
                                </div>
                                
                                <?php
                                if(isset($_POST['konfirmasi'])){
                                
                                $id= $_POST['id'];
                                $daftar_ulang = $_POST['daftar_ulang'];
                                
                                $update = mysqli_query($koneksi, "UPDATE identitas SET daftar_ulang = '$daftar_ulang' WHERE id='$id'");
                                
                                if($update == true) {
                                    ?>
                                    <script type="text/javascript">
                                        alert("Terima Kasih Sudah Konfirmasi Waktu Daftar Ulang");
                                        window.location.href="../../index.php";
                                        </script>
                                    <?php
                                    }
                                }
                             } ?>
                            </form>
                            
                        </div>
                        <div class="body">
                            <a class="btn bg-pink waves-effect m-b-15" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false"
                               aria-controls="collapseExample">
                                LIHAT HASIL!
                            </a>
                            
                             <?php
                                $sql = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level='Admin'");
                                $data_baru = mysqli_fetch_array ($sql);
                             ?> 
                            
                            <div class="collapse" id="collapseExample">
                                <div class="well">
                                    <?php 
                                    if($_SESSION['hasil_akhir']){
                                        $hasil_saya = $_SESSION['hasil_akhir'];
                                        $publikasi = $data_baru['publikasi'];
                                    ?>

                                    <?php
                                    if($publikasi == "Hold"){
                                    ?>    
                                        <div class="alert alert-success">
                                            <strong>MOHON MAAF!</strong> Belum Ada Data Yang Ditampilkan, Masih Menunggu Perhitungan Hasil Tes!
                                        </div>
                                        
                                    <?php }
                                    
                                    else {
                                    if($hasil_saya == "LULUS"){
                                    ?>
                                         <h4>Hasil Tes "<?php echo $hasil_saya; ?>"</h4>
                                         <label>SELAMAT! Anda Lulus, Silahkan Cetak Bukti Kelulusan!</label>
                                         <br>
                                         <a href="../../printlulus.php?kode=<?php echo $kode; ?>" target="_blank"><button class="btn btn-primary m-t-15 waves-effect">PRINT BUKTI KELULUSAN</button></a>
                                         <br>
                                         <br>
                                         <p>
                                         <b>Agenda Daftar Ulang</b>
                                         <br>
                                         Tanggal : 28 Januari - 10 Februari 2019<br>
                                         Hari : Senin - Sabtu<br>
                                         Waktu : 08.00 - 16.00 WIB<br>
                                         Tempat : Gedung Ma'had Tahfizh Al Qur'an Al Imam Asy Syathiby<br>
                                         <b>PERHATIAN!!</b> Bagi yang tidak melakukan Daftar Ulang di tanggal yang telah ditetapkan, maka dianggap <b>Mengundurkan Diri</b>
                                         <br>
                                         <br>
                                         <b>Prosedur Daftar Ulang</b>
                                         <br>
                                         1. CETAK BUKTI KELULUSAN dan membawanya saat proses daftar ulang <br>
                                         2. Menandatangani Akad Pendidikan (Membawa Materai 6000 2 lbr) <br>
                                         3. Melunasi biaya Administrasi :<br>
                                            -Biaya Awal Pendidikan : Rp 8.500.000 <br>
                                            -Biaya Pendidikan Juli 2019 : Rp 1.500.000 <br>
                                            -TOTAL : <b>Rp 10.000.000</b><br>
                                         4. Pengukuran seragam santri <br>
                                         <br>
                                         <b>Transfer Biaya Daftar Ulang</b>
                                         <br>
                                         Bank Syariah Mandiri<br>
                                         756 2020 009<br>
                                         a/n Yayasan Cahaya Sunnah
                                         Kode Bank 451<br>
                                         <b>Konfirmasi Transfer:</b> 0812 9111 1756 (Whatsapp)
                                         
                                         </p>
                                    <?php 
                                    }
                                        else {
                                            ?>
                                            <h4>Hasil Tes "<?php echo $hasil_saya; ?>"</h4>
                                            <label>Mohon Maaf, Anda Belum Bisa Bergabung Bersama Kami.</label>
                                        <?php
                                        }
                    
                                    }
                                    ?>
                                    <?php } ?>
                                </div>
                            </div>
                            
                            
                            <div>
                            <a href="lulusumum.php"><button class="btn btn-primary m-t-15 waves-effect">Lihat Info Kelulusan Umum</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Example -->
          
    
            </div>
        </div>
    </section>


    <!-- Chart Plugins Js -->
    <script src="../../plugins/chartjs/Chart.bundle.js"></script>

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

    
    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
    
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5dad0d7a78ab74187a5a9de0/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->

</body>
</html>