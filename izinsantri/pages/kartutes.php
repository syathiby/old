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


    if(!isset($_SESSION['akun_id'])) header("location: ../../login.php");
    include "../../inc/config.php"; 

    error_reporting(0);

 ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Pengumuman Kelulusan Pribadi - PSB Online | Ma'had Al Imam Asy Syathiby</title>
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
        <input type="text" placeholder="Tulis Langsung Disini...">
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
                <a class="navbar-brand" href="../../index.php">PSB Online - Ma'had Al Imam Asy Syathiby</a>
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
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$usern' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);

                            ?>
                <div class="image">
                    <img src="../../img/<?php echo $data_ubah['photodiri']; ?>" width="48" height="48" alt="User" />
                </div>
                <?php } ?>
                <div class="info-container">

                    <?php 
                    if($_SESSION['admin']){
                        $lagi_login = $_SESSION['admin'];
                    }
                    else if($_SESSION['namadepan']){
                        $lagi_login = $_SESSION['namadepan'];
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
                    
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">hearing</i>
                            <span>Pengumuman</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="luluspribadi.php">Kelulusan Pribadi</a>
                            </li>
                            <li>
                                <a href="lulusumum.php">Kelulusan Umum</a>
                            </li>
                            <li class="active">
                                <a href="#">Cetak Kartu Tes</a>
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
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);">Ma'had Al Imam Asy Syathiby</a>.
                </div>
                <div class="version">
                    Dikembangkan oleh: <a href="https://facebook.com/Alendia.Desta" target="_blank"><b>ADS Dev</b></a>
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
                               CETAK KARTU TES (F2)
                            </h2>
                            <br>
                            <?php 
                            if($_SESSION['seleksi_berkas']){
                            $hasil_berkas = $_SESSION['seleksi_berkas'];
                            }
                            ?>
                            
                            <?php 
                            if($hasil_berkas == "Diproses"){
                                ?>
                                <p>
                                    Terima kasih, berkas anda sudah kami terima. Mohon untuk menunggu proses seleksi berkas, insya allah anda dapat melihat hasilnya maksimal
                                    2x24 jam.<br>
                                    Bagi anda yang dinyatakan <b>LULUS</b> anda bisa langsung <b>Cetak Kartu Tes (F2)</b> dan bisa mengikuti tes masuk. Namun, jika anda 
                                    dinyatakan <b>GAGAL</b> maka anda tidak bisa mengikuti tes masuk dan silahkan mencoba tahun depan.
                                </p>
                            <?php
                            }
                            else if($hasil_berkas == "GAGAL"){
                                ?>
                                <p>
                                    Terima kasih sudah menunggu, setelah melalui proses seleksi dan pertimbangan berkas yang kami terima. Maka dengan ini <b>Ma'had
                                    Tahfizh Al Qur'an Al Imam Asy Syathiby</b> menyatakan bahwa :
                                </p>
                            <?php    
                            }
                            else { 
                            ?>
                               <p>    
                                Bagi santri yang dinyatakan <b>LULUS</b> Seleksi Berkas, silahkan melakukan pembayaran <b>Biaya Administrasi Pendaftaran:</b> 
                                <br>
                                <b>Rp 300.000 (Tiga Ratus Ribu Rupiah)</b>
                                <br>
                                <br>
                                Transfer melalui:
                                <br>
                                <b>Bank Syariah Mandiri</b>
                                <br>
                                <b>756-2020-009</b>
                                <br>
                                a/n <b>Yayasan Cahaya Sunnah</b>
                                <br>
                                <b>Kode Bank 451</b>
                                <br>
                                <br>
                                Selanjutnya silahkan untuk mencetak (print) <b>Kartu Tes (F2).</b> Calon Santri <b>WAJIB</b> membawa Kartu Tes (F2) saat hadir untuk <b>Pelaksanaan Tes Masuk</b>.
                                <br>
                                Insya Allah akan dilaksanakan pukul <b>07.30 WIB</b> bertempat di <b>Gedung Ma'had Tahfizh Al Qur'an Al Imam Asy Syathiby</b>
                            </p> 
                            <?php
                            }
                            ?>
                            
                            <div class="body">
                                <?php 
                            
                                if($_SESSION['username']){
                                $usern=$_SESSION['username'];
                               
                                $sql_ubah=mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$usern' ");
                                $data_ubah = mysqli_fetch_array ($sql_ubah);
                                $kode = $data_ubah['id'];
                                $bukti = $data_ubah['transfer'];


                                ?>
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="email_address_2">Nama Depan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="namadepan" class="form-control" value="<?php echo $data_ubah['namadepan'] ?>"/>
                                            </div>
                                            <div>
                                                <input type="hidden" name="id" class="form-control" 
                                                value="<?php echo $data_ubah['id'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="email_address_2">Nama Belakang</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="namabelakang" class="form-control" value="<?php echo $data_ubah['namabelakang'] ?>"/>
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
                                
                                    
                                <?php 
                                    if($_SESSION['seleksi_berkas']){
                                    $hasil_berkas = $_SESSION['seleksi_berkas'];
                                    }
                                ?>
                                
                                <?php
                                if($hasil_berkas == "LULUS"){
                                    
                                if($bukti == ""){
                                         ?>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Bukti Transfer</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" name="transfer" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                 <!--Tombol Update-->
                                    <div class="row clearfix">
                                    <div class="col-lg-offset-5 col-md-offset-5 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" name="update" class="btn btn-primary m-t-15 waves-effect">Upload Bukti Transfer</button>
                                    </div>
                                    </div>
                                    <?php
                                     }
                                     else {
                                         ?>
                                    <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label for="username">Waktu Tes</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="waktu_tes" class="form-control" 
                                                value="<?php echo $data_ubah['waktu_tes'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <a href="../../img/<?php echo $data_ubah['transfer']; ?>" data-sub-html="Bukti Transfer">
                                            <img class="img-responsive thumbnail" src="../../img/<?php echo $data_ubah['transfer']; ?>" width="150px">
                                        </a>
                                    </div>
                                    </div>
                                
                                 
                                     <?php
                                        }
                                    }
                                    ?>
                                    
                                    <?php
                                         if(isset($_POST['update'])){
                                            $transfer = $_FILES['transfer']['tmp_name'];
                                            $nama_transfer = $_FILES['transfer']['name'];
                                            $save='../../img/';
                                            $berkas= $data_ubah['seleksi_berkas'];
                                              $time = time();
                                              $acak = rand(10000, 99999);
                    
                                              $simpantransfer = "../../img/".$time."-".$acak."-".$nama_transfer;
                                              $transferbaru = $time."-".$acak."-".$nama_transfer;
                                              
                                              
                                            
                                         if($berkas == "Diproses") {
                                             ?>
                                             <script type="text/javascript">
                                             alert("Upload GAGAL! Mohon Tunggu Proses Seleksi Berkas Anda!");
                                             </script>
                                         <?php }
                                         else if($berkas=="GAGAL") {
                                             ?>
                                             <script type="text/javascript">
                                             alert("Mohon maaf, Anda GAGAL Seleksi Berkas");
                                             </script>
                                         <?php
                                         }
                                         
                                         else {
                                         $upphoto = move_uploaded_file($transfer, $simpantransfer);
                                         
                                             mysqli_query($koneksi, "UPDATE akun SET transfer='$transferbaru' 
                                             WHERE id='$kode'");
                                          ?>
                                          <script type="text/javascript">
                                          alert("Upload Berhasil, Silahkan Print Kartu Tes Anda!");
                                          window.location.href="../../index.php";
                                        </script>
                                         <?php
                                             
                                         }
                                        
                                        }
                                    ?>
                                </form>   
                            <?php }?>
                            </div>

                            <!--BATAS CETAK-->
                            <div class="body">
                            <a class="btn bg-pink waves-effect m-b-15" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false"
                               aria-controls="collapseExample">
                                CETAK KARTU
                            </a>
                            
                            <div class="collapse" id="collapseExample">
                                <div class="well">
                                    <?php 
                                    if($_SESSION['seleksi_berkas']){
                                        $berkas_saya = $_SESSION['seleksi_berkas'];
                                        
                                    ?>
                                
                                    <?php } ?>
                                    
                                    
                                    <?php
                                    if($berkas_saya == "LULUS"){
                                    
                                         if($bukti == ""){
                                             ?>
                                             <h4>Seleksi Berkas "<?php echo $berkas_saya; ?>"</h4>
                                             <label>Selamat! Anda Lulus, Silahkan Melakukan Pembayaran Biaya Administrasi Pendaftaran Agar Bisa Mencetak Kartu Tes (F2)</label>
                                             <br>
                                             <button class="btn btn-primary m-t-15 waves-effect">Menunggu Transfer</button>
                                         <?php }
                                         else {
                                             ?>
                                             <h4>Seleksi Berkas "<?php echo $berkas_saya; ?>"</h4>
                                             <label>Terima Kasih telah melakukan pembayaran biaya Tes Masuk. Silahkan Cetak Kartu Tes (F2) Anda!</label>
                                             <br>
                                             <a href="../../printkartu.php?kode=<?php echo $kode; ?>" target="_blank"><button class="btn btn-primary m-t-15 waves-effect">PRINT KARTU TES</button></a>
                                         <?php
                                         }
                                         ?>
                                    
                                    <?php }
                                        else if ($berkas_saya == "Diproses"){
                                            ?>
                                            <h4>Seleksi Berkas "<?php echo $berkas_saya; ?>"</h4>
                                            <label>Mohon Ditunggu, Berkas Anda Sedang Kami Proses. Maksimal 2x24 jam.</label>
                                        <?php }
                                        else {
                                            ?>
                                            <h4>Seleksi Berkas "<?php echo $berkas_saya; ?>"</h4>
                                            <label>Mohon Maaf, Anda Tidak Bisa Mengikuti Tes Masuk!</label>
                                        <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        
                        </div>
                        <!--AKHIR BATAS CETAK-->
                            
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

</body>
</html>