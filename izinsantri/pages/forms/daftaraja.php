<?php 

    global $koneksi;

    $nameserver ='localhost';
    $username ='u4486592_alen';
    $password ='r3dh41r3d';
    $namadb ='u4486592_ppdb';

    $koneksi = mysqli_connect($nameserver, $username, $password, $namadb); 

    if(!$koneksi) {
        die("Koneksi Gagal".mysqli_connect_error());
    }

 ?>



    <?php 
   		if(isset($_POST['daftar'])){
   			
            $bulan_daftar = $_POST['bulan_daftar'];
   			$username=$_POST['username'];
   			$password=$_POST['password'];
        	$namadepan= addslashes($_POST['namadepan']);
        	$namabelakang= addslashes($_POST['namabelakang']);
        	$tempat_lahir= addslashes($_POST['tempat_lahir']);
        	$tgl_lahir = $_POST['tgl_lahir'];
            $alamat_santri = $_POST['alamat_santri'];
        	$jk = $_POST['jk'];
        	$asal_sekolah = addslashes($_POST['asal_sekolah']);
            $nisn = $_POST['nisn'];
        	$program_pilihan= $_POST['program_pilihan'];

            $nama_ayah= addslashes($_POST['nama_ayah']);
            $tmp_ayah= addslashes($_POST['tmp_ayah']);
            $tgl_ayah= $_POST['tgl_ayah'];
            $alamat_ayah= $_POST['alamat_ayah'];
            $hp_ayah= $_POST['hp_ayah'];
            $pendidikan_ayah= $_POST['pendidikan_ayah'];
            $pekerjaan_ayah= $_POST['pekerjaan_ayah'];
            $penghasilan_ayah= $_POST['penghasilan_ayah'];

            $nama_ibu= addslashes($_POST['nama_ibu']);
            $tmp_ibu= addslashes($_POST['tmp_ibu']);
            $tgl_ibu = $_POST['tgl_ibu'];
            $alamat_ibu = $_POST['alamat_ibu'];
            $hp_ibu = $_POST['hp_ibu'];
            $pendidikan_ibu = $_POST['pendidikan_ibu'];
            $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
            $penghasilan_ibu = $_POST['penghasilan_ibu'];

            $nama_wali = addslashes($_POST['nama_wali']);
            $tmp_wali = $_POST['tmp_wali'];
            $tgl_wali = $_POST['tgl_wali'];
            $alamat_wali = $_POST['alamat_wali'];
            $hp_wali = $_POST['hp_wali'];
            $pendidikan_wali = $_POST['pendidikan_wali'];
            $pekerjaan_wali = $_POST['pekerjaan_wali'];
            $penghasilan_wali = $_POST['penghasilan_wali'];

        
         
         $namaphoto=$_FILES['photodiri']['name'];
         $formatphoto = pathinfo($namaphoto, PATHINFO_EXTENSION);

         
         $namatranskrip=$_FILES['transkrip']['name'];
         $formattranskrip = pathinfo($namatranskrip, PATHINFO_EXTENSION);

         
         $namakartu_kel=$_FILES['kartu_kel']['name'];
         $formatkartu_kel = pathinfo($namakartu_kel, PATHINFO_EXTENSION);

         
         $namaktp_ortu=$_FILES['ktp_ortu']['name'];
         $formatktp_ortu = pathinfo($namaktp_ortu, PATHINFO_EXTENSION);

         
         $namasurat_sehat=$_FILES['surat_sehat']['name'];
         $formatsurat_sehat = pathinfo($namasurat_sehat, PATHINFO_EXTENSION);

         $simpan='../../img/';
         

        $ukuranphoto = $_FILES['photodiri']['size'];
        $ukurantranskrip = $_FILES['transkrip']['size'];
        $ukurankartu_kel = $_FILES['kartu_kel']['size'];
        $ukuranktp_ortu = $_FILES['ktp_ortu']['size'];
        $ukuransurat_sehat = $_FILES['surat_sehat']['size'];

        $tipephoto = exif_imagetype($_FILES['photodiri']['tmp_name']);
        $tipetranskrip = exif_imagetype($_FILES['transkrip']['tmp_name']);
        $tipekartu_kel = exif_imagetype($_FILES['kartu_kel']['tmp_name']);
        $tipektp_ortu = exif_imagetype($_FILES['ktp_ortu']['tmp_name']);
        $tipesurat_sehat = exif_imagetype($_FILES['surat_sehat']['tmp_name']);
        $allowed = array(IMAGETYPE_JPG, IMAGETYPE_JPEG, IMAGETYPE_PNG);

        ?>

    <?php
        
        if($jk=="----"){
        ?>    
        <script type="text/javascript">
        alert("MOHON MAAF, PENDAFTARAN SUDAH TUTUP!");
        </script>
        <?php
            
        }
        
        else {
        if($namaphoto=="" or $namatranskrip=="" or $namakartu_kel=="" or $namaktp_ortu=="" or $namasurat_sehat==""){
        ?>
        <script type="text/javascript">
        alert("Upload Berkas Tidak Boleh Kosong!");
        </script>
        <?php
        }
        
        else {
            if(in_array($tipephoto,$allowed) and in_array($tipetranskrip,$allowed) and in_array($tipekartu_kel,$allowed) 
            and in_array($tipektp_ortu,$allowed) and in_array($tipesurat_sehat,$allowed)){
            if(($ukuranphoto < 1044070) and ($ukurantranskrip < 1044070) and ($ukurankartu_kel < 1044070) and ($ukuranktp_ortu < 1044070) 
                and ($ukuransurat_sehat < 1044070)){
                $photodiri=$_FILES['photodiri']['tmp_name'];
                $transkrip=$_FILES['transkrip']['tmp_name'];
                $kartu_kel=$_FILES['kartu_kel']['tmp_name'];
                $ktp_ortu=$_FILES['ktp_ortu']['tmp_name'];
                $surat_sehat=$_FILES['surat_sehat']['tmp_name'];
                
                    $time = time();
                    $acak = rand(10000, 99999);
                    
                    $simpanphoto = "../../img/".$time."-".$acak."-".$namaphoto;
                    $simpantranskrip = "../../img/".$time."-".$acak."-".$namatranskrip;
                    $simpankartu_kel = "../../img/".$time."-".$acak."-".$namakartu_kel;
                    $simpanktp_ortu = "../../img/".$time."-".$acak."-".$namaktp_ortu;
                    $simpansurat_sehat = "../../img/".$time."-".$acak."-".$namasurat_sehat;
                
                $photobaru = $time."-".$acak."-".$namaphoto;
                $transkripbaru = $time."-".$acak."-".$namatranskrip;
                $kartu_kelbaru = $time."-".$acak."-".$namakartu_kel;
                $ktp_ortubaru = $time."-".$acak."-".$namaktp_ortu;
                $surat_sehatbaru = $time."-".$acak."-".$namasurat_sehat;
                    
                $upphoto = move_uploaded_file($photodiri, $simpanphoto);
                $uptranskrip = move_uploaded_file($transkrip, $simpantranskrip);
                $upkk = move_uploaded_file($kartu_kel, $simpankartu_kel);
                $upktp = move_uploaded_file($ktp_ortu, $simpanktp_ortu);
                $upsurat = move_uploaded_file($surat_sehat, $simpansurat_sehat);
 
                // Validasi upload (hasil true jika upload berhasil)
                if(($upphoto == true) and ($uptranskrip == true) and ($upkk == true) and ($upktp == true) and ($upsurat == true)){
                    
                    $sql_cek = mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$username'");
                    if (mysqli_num_rows($sql_cek)>0) {
                    ?>
                        <script type="text/javascript">
                        alert ("Username Anda Sudah Terdaftar, Silahkan Coba Login!");
                        window.location.href="../../login.php";
                        </script>
                    <?php
                    } else{
                         $tulisdata = mysqli_query($koneksi, "INSERT INTO akun VALUES(DEFAULT,'$bulan_daftar','$username','$password','$namadepan',
                        '$namabelakang','$tempat_lahir','$tgl_lahir','$alamat_santri','$jk','Santri','$asal_sekolah','$nisn','$program_pilihan','$nama_ayah',
                        '$tmp_ayah','$tgl_ayah','$alamat_ayah','$hp_ayah','$pendidikan_ayah','$pekerjaan_ayah','$penghasilan_ayah','$nama_ibu','$tmp_ibu',
                        '$tgl_ibu','$alamat_ibu','$hp_ibu','$pendidikan_ibu','$pekerjaan_ibu','$penghasilan_ibu','$nama_wali','$tmp_wali','$tgl_wali',
                        '$alamat_wali','$hp_wali','$pendidikan_wali','$pekerjaan_wali','$penghasilan_wali','Diproses','Tentukan','Tentukan','Menunggu','Menunggu',
                        'Menunggu','Menunggu','Menunggu','Diproses','Diproses','Hold','$photobaru','$transkripbaru','$kartu_kelbaru','$ktp_ortubaru','$surat_sehatbaru','')");
                    }
                    if($tulisdata == true){
                        ?>
                        <script type="text/javascript">
        	            alert("Berhasil Daftar! Silahkan Log In");
                        window.location.href="../../index.php";
        	            </script>
                    <?php }
                    else { ?>
                        <script type="text/javascript">
        	             alert("Daftar GAGAL! Periksa Kembali Kolom Isian Anda!");
                        </script>
                    <?php
                    }
                }
                else {
                    ?>
                    <script type="text/javascript">
        	          alert("UPLOAD BERKAS GAGAL, Periksa Koneksi Internat Anda!");
                    </script>
                <?php    
                }
              }else{
                  ?>
                 <script type="text/javascript">
        	       alert("UPLOAD BERKAS GAGAL, Ukuran file terlalu besar!");
                 </script>
                <?php
              }
                    
            }else{ // else validasi format
            ?>
                <script type="text/javascript">
        	      alert("Daftar GAGAL! Format File Upload Harus JPG/JPEG/PNG, Silahkan Coba Lagi");
                </script>
        	<?php
            }
        	 
          }	
        } 
      }
            					
     ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Form Pendaftaran Santri Baru - PSB Online | Ma'had Al Imam Asy Syathiby</title>
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

    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">
    
     <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
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
        <input type="text" placeholder="START TYPING...">
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
                <a class="navbar-brand" href="#">PSB Online - Ma'had Al Imam Asy Syathiby</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
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
            
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU UTAMA</li>
                    <li class="">
                        <a href="../../../index.html">
                            <i class="material-icons">home</i>
                            <span>Halaman Depan</span>
                        </a>
                    </li>

                    <li class="active">
                        <a href="#">
                            <i class="material-icons">book</i>
                            <span>Isi Formulir</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="../../login.php">
                            <i class="material-icons">account_circle</i>
                            <span>Login</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">subject</i>
                            <span>Program Pilihan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="../ui/program_asrama.php">Tahfizh Asrama</a>
                            </li>
                            <li>
                                <a href="../ui/non_asrama.php">Tahfizh Non Asrama</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="../ui/hubungi.php">
                            <i class="material-icons">phone_in_talk</i>
                            <span>Hubungi Kami</span>
                        </a>
                        
                    </li>
                    <li class="">
                        <a href="../ui/video-panduan.php">
                            <i class="material-icons">video_library</i>
                            <span>Video Panduan</span>
                        </a>
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

  <section class="content">
        <div class="container-fluid">
            <!-- Widgets -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                FORMULIR PENDAFTARAN SANTRI BARU <b>PROGRAM ASRAMA</b>
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
                            <div class="row-clearfix">
                                
                                <!--QUOTA IKHWAN-->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-blue hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons">verified_user</i>
                                    </div>
                                <div class="content">
                                    <div class="text">KUOTA IKHWAN</div>
                                <div>
                             
                                <h4>200 Santri</h4>
                                    
                                </div>
                                </div>
                                </div>
                                </div>
                                
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-blue hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons">assignment_ind</i>
                                    </div>
                                <div class="content">
                                    <div class="text">PENDAFTAR IKHWAN</div>
                                <div>
                             <?php 
                                $sql_cek = mysqli_query($koneksi, "SELECT * FROM akun WHERE level='Santri' AND jk='laki-laki'");
                                $hitung1 = 200;
                                ?>
                                <h4><?php echo $hitung1 ?> Santri</h4>
                                    
                                </div>
                                </div>
                                </div>
                                </div>
                                
                                
                                 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-blue hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons">access_alarm</i>
                                    </div>
                                <div class="content">
                                    <div class="text">SISA KUOTA IKHWAN</div>
                                <div>
                             <?php 
                                $kuota1 = 200;
                                $sisa1 = $kuota1-$hitung1;
            
                                ?>
                                <h4><?php 
                                if($sisa1 == 0){
                                    echo "TIDAK ADA";
                                } else {
                                echo $sisa1; ?> Santri </h4>
                                <?php }?>
                                
                                </div>
                                </div>
                                </div>
                                </div>
                                <!--#QUOTA IKHWAN-->
                                
                                
                                <!--QUOTA AKHWAT-->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-orange hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons">verified_user</i>
                                    </div>
                                <div class="content">
                                    <div class="text">KUOTA AKHWAT</div>
                                <div>
                             
                                <h4>200 Santri</h4>
                                    
                                </div>
                                </div>
                                </div>
                                </div>
                                
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-orange hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons">assignment_ind</i>
                                    </div>
                                <div class="content">
                                    <div class="text">PENDAFTAR AKHWAT</div>
                                <div>
                             <?php 
                                $sql_cek = mysqli_query($koneksi, "SELECT * FROM akun WHERE level='Santri' AND jk='perempuan'");
                                $hitung2 = 200;
                                ?>
                                <h4><?php echo $hitung2 ?> Santri</h4>
                                    
                                </div>
                                </div>
                                </div>
                                </div>
                                
                                
                                 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-orange hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons">access_alarm</i>
                                    </div>
                                <div class="content">
                                    <div class="text">SISA KUOTA AKHWAT</div>
                                <div>
                             <?php 
                                $kuota2 = 200;
                                $sisa2 = 0;
            
                                ?>
                                <h4><?php 
                                if($sisa2 == 0){
                                    echo "TIDAK ADA";
                                } else {
                                echo $sisa2; ?> Santri </h4>
                                <?php }?>
                                
                                </div>
                                </div>
                                </div>
                                </div>
                                <!--#QUOTA AKHWAT-->
                                
                                <p align="center"><img src="../../img/Alur-Pendaftaran-Online-Syathiby.jpg" width="80%" height="auto"></p>
    
                                <p align="center"><a href="../../img/Alur-Pendaftaran-Online-Syathiby.jpg" download><strong>DOWNLOAD GAMBAR</strong></a></p>
                                
                                <div class="alert alert-warning">
                                <h3><strong>PERHATIAN!</strong> Pendaftaran Program Asrama Tahun Ajaran 2019/2020 (Gelombang 1) Sudah TUTUP!</h3>
                                </div>
                                
                                <h3>PETUNJUK PENDAFTARAN!</h3>
                                <p>Sebelum melakukan pengisian formulir pendaftaran, perhatikan beberapa hal-hal berikut:
                                <br>
                                1. Siapkan semua berkas yang dibutuhkan dalam bentuk <b>Soft Copy</b> (sudah siap upload) :
                                <b>
                                    <br>
                                    Pas Photo Santri
                                    <br>
                                    Transkrip Nilai 2 Semester Terakhir
                                    <br>
                                    KTP Orang Tua
                                    <br>
                                    Kartu Keluarga
                                    <br>
                                    Surat Keterangan Sehat Dokter
                                    <br>
                                </b>
                                <br>
                                2. Tentukan <b>Program Pilihan</b> anda, info selengkapnya tentang program tahfizh klik <a href="../ui/program_asrama.php">Disini!</a>
                                <br>
                                <br>
                                3. Isi formulir di bawah ini dengan <b>lengkap dan benar</b>
                                <br>
                                <br>
                                4. Setelah dinyatakan <b>Berhasil Daftar,</b> silahkan <b>Login</b> menggunakan <b>Username dan Password</b> yang digunakan untuk mendaftar
                                <br>
                                <br>
                                5. Jika anda merasa kesulitan, silahkan lihat <b>Video Panduan Penggunaan Aplikasi</b> <a href="../ui/video-panduan.php">Disini!</a>
                                </p>
                                
                            </div>

                            <form id="sign_in" action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            	<div class="row clearfix jsdemo-notification-button">
                            		 <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA LOGIN
                                    </button>
                                </div>
                            	</div>
                            	
                            	 <div class="alert alert-success">
                                <strong>PERHATIAN!</strong> Catat <strong>Username dan Password</strong> Anda. Keduanya akan digunakan untuk login aplikasi
                                </div>
                                
                            	<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8" >
                                        <div class="form-group">
                                            <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="username" class="form-control" placeholder="No. HP Orang Tua/Wali" required>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="input-group">
                                            <div class="form-line">
                                                <input type="password" name="password" class="form-control" placeholder="Kata Sandi" required>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Waktu Daftar</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="bulan_daftar" class="form-control">
                                                <option value="----">----</option>
                                                <option value="Pekan 1">1-7 Des 2018</option>
                                                <option value="Pekan 2">8-14 Des 2018</option>
                                                <option value="Pekan 3">15-21 Des 2018</option>
                                                <option value="Pekan 4">22-31 Des 2018</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               

                                <!--AWAL DATA PRIBADI-->
                            	<div class="row clearfix jsdemo-notification-button">
                            		 <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA SANTRI
                                    </button>
                                </div>
                            	</div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nama</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="namadepan" name="namadepan" class="form-control" placeholder="Nama Depan" onkeyup="myFunction()" />
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nama Belakang</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="namabelakang" name="namabelakang" class="form-control" placeholder="Nama Belakang" onkeyup="nama_belakang()"/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tempat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="tmpsantri" name="tempat_lahir" class="form-control" placeholder="Tempat/Kota Kelahiran" onkeyup="tmp_santri()"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tanggal Lahir</label>   
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="tgl_lahir" placeholder="Contoh: 30/07/1994"/>
                                                </div>  
                                            </div>
                                    </div>   
                                </div>

                                <div class="row clearfix">
                                	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Jenis Kelamin</label>
                                	</div>
                                	<div class="col-lg-4 col-sm-4 col-sm-8 col-xs-8">
                                		<div class="form-group">
                                    		<select name="jk" class="form-control">
                                    		    <option value="----">----</option>
                                        		<option value="LAKI-LAKI">Laki-laki</option>
                                        		<option value="PEREMPUAN">Perempuan</option>
                                   			</select>
                                   		</div>
                                	</div>
                                </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Alamat Tinggal</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <textarea rows="4" name="alamat_santri" id="alamatsantri" onkeyup="alamat_s()" class="form-control no-resize" placeholder="Tulis alamat lengkap beserta Desa/Kelurahan, Kecamatan, Kab/Kota dan Provinsi"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Asal Sekolah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="asal_sekolah" id="asalsekolah" onkeyup="sekolah()" class="form-control" placeholder="Tulis Nama Sekolah Sebelumnya" />
                                            </div>
                                        
                                        </div>
                                    </div>
                                 </div>

                                  <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>NISN</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nisn" class="form-control" placeholder="Tulis Jika Ada" />
                                            </div>
                                        
                                        </div>
                                    </div>
                                 </div>
                                 <!--##AKHIR DATA PRIBADI-->

                                 <!--AWAL DATA AYAH-->
                                 <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA AYAH
                                    </button>
                                </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nama Ayah</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_ayah" id="namaayah" onkeyup="n_ayah()" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tempat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ayah" id="tmpayah" onkeyup="t_ayah()" class="form-control" placeholder="Tempat/Kota Kelahiran"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ayah" class="form-control" placeholder="Contoh : 21/05/1995" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Alamat Tinggal</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <textarea rows="4" name="alamat_ayah" id="alamatayah" onkeyup="al_ayah()" class="form-control no-resize" placeholder="Tulis alamat lengkap beserta Desa/Kelurahan, Kecamatan, Kab/Kota dan Provinsi"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>No.HP</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_ayah" class="form-control" placeholder="Contoh : 0812980xxxx (WA Aktif)" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pekerjaan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="pekerjaan_ayah" class="form-control">
                                                <option value="----">----</option>
                                                <option value="PNS">PNS</option>
                                                <option value="KARYAWAN">Karyawan Swasta</option>
                                                <option value="PEDAGANG">Pedagang</option>
                                                <option value="PENGUSAHA">Pengusaha</option>
                                                <option value="GURU">Guru</option>
                                                <option value="POLISI">Polisi</option>
                                                <option value="TNI">TNI</option>
                                                <option value="PILOT">Pilot</option>
                                                <option value="MASINIS">Masinis</option>
                                                <option value="NAHKODA">Nahkoda</option>
                                                <option value="DOKTER">Dokter</option>
                                                <option value="APOTEKER">Apoteker</option>
                                                <option value="FREELANCER">Freelancer</option>
                                                <option value="LAINNYA">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="pendidikan_ayah" class="form-control">
                                                <option value="----">----</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="DIPLOMA">Diploma</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="ACADEMY">Academy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="penghasilan_ayah" class="form-control">
                                                <option value="----">----</option>
                                                <option value=">20 JUTA">>20.000.000</option>
                                                <option value="15-20 JUTA">15.000.000 - 20.000.000</option>
                                                <option value="10-15 JUTA">10.000.000 - 15.000.000</option>
                                                <option value="5-9 JUTA">5.000.000 - 9.000.000</option>
                                                <option value="3-5 JUTA">3.000.000 - 5.000.000</option>
                                                <option value="2-3 JUTA">2.000.000 - 3.000.000</option>
                                                <option value="1-2 JUTA">1.000.000 - 2.000.000</option>
                                                <option value="<1 JUTA">Di bawah 1.000.000</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <!--#AKHIR DATA AYAH-->

                                 <!--AWAL DATA IBU-->
                                <div class="row clearfix jsdemo-notification-button">
                                     <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA IBU
                                    </button>
                                </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nama Ibu</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama_ibu" id="namaibu" onkeyup="n_ibu()" class="form-control"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tempat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tmp_ibu" class="form-control" id="tmpibu" onkeyup="t_ibu()" placeholder="Tempat/Kota Kelahiran"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_ibu" class="form-control" placeholder="Contoh : 21/05/1995" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Alamat Tinggal</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <textarea rows="4" name="alamat_ibu" id="alamatibu" onkeyup="al_ibu()" class="form-control no-resize" placeholder="Tulis alamat lengkap beserta Desa/Kelurahan, Kecamatan, Kab/Kota dan Provinsi"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>No.HP Ibu</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_ibu" class="form-control" placeholder="Contoh : 0812980xxxx (WA Aktif)" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pekerjaan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="pekerjaan_ibu" class="form-control">
                                                <option value="----">----</option>
                                                <option value="IRT">Ibu Rumah Tangga</option>
                                                <option value="PNS">PNS</option>
                                                <option value="KARYAWAN">Karyawan Swasta</option>
                                                <option value="PEDAGANG">Pedagang</option>
                                                <option value="PENGUSAHA">Pengusaha</option>
                                                <option value="GURU">Guru</option>
                                                <option value="POLISI">Polisi</option>
                                                <option value="DOKTER">Dokter</option>
                                                <option value="FREELANCER">Freelancer</option>
                                                <option value="LAINNYA">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="pendidikan_ibu" class="form-control">
                                                <option value="----">----</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="DIPLOMA">DIPLOMA</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="ACADEMY">ACADEMY</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="penghasilan_ibu" class="form-control">
                                                <option value="----">----</option>
                                                <option value=">20 JUTA">>20.000.000</option>
                                                <option value="15-20 JUTA">15.000.000 - 20.000.000</option>
                                                <option value="10-15 JUTA">10.000.000 - 15.000.000</option>
                                                <option value="5-9 JUTA">5.000.000 - 9.000.000</option>
                                                <option value="3-5 JUTA">3.000.000 - 5.000.000</option>
                                                <option value="2-3 JUTA">2.000.000 - 3.000.000</option>
                                                <option value="1-2 JUTA">1.000.000 - 2.000.000</option>
                                                <option value="<1 JUTA">Di bawah 1.000.000</option>
                                                <option value="TIDAK ADA">Tidak Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--#AKHIR DATA IBU-->

                                <!--AWAL DATA WALI-->
                                <div class="row clearfix jsdemo-notification-button">
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA WALI
                                    </button>
                                    </div>
                                </div>
                                <div class="alert alert-success">
                                <strong>PERHATIAN!</strong> Data Wali Diisi Apabila Tidak Ada <strong>Orang Tua</strong>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Nama Wali</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="namawali" onkeyup="n_wali()" name="nama_wali" class="form-control"/>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tempat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="tmpwali" onkeyup="t_wali()" name="tmp_wali" class="form-control" placeholder="Tempat/Kota Kelahiran"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Tanggal Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tgl_wali" class="form-control" placeholder="Contoh : 21/05/1995" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Alamat Tinggal</label>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                            <textarea rows="4" name="alamat_wali" id="alamatwali" onkeyup="al_wali()" class="form-control no-resize" placeholder="Tulis alamat lengkap beserta Desa/Kelurahan, Kecamatan, Kab/Kota dan Provinsi"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>No.HP</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="hp_wali" class="form-control" placeholder="Contoh : 0812980xxxx (WA Aktif)" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pekerjaan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="pekerjaan_wali" class="form-control">
                                                 <option value="----">----</option>
                                                <option value="PNS">PNS</option>
                                                <option value="KARYAWAN">Karyawan Swasta</option>
                                                <option value="PEDAGANG">Pedagang</option>
                                                <option value="PENGUSAHA">Pengusaha</option>
                                                <option value="GURU">Guru</option>
                                                <option value="POLISI">Polisi</option>
                                                <option value="TNI">TNI</option>
                                                <option value="PILOT">Pilot</option>
                                                <option value="MASINIS">Masinis</option>
                                                <option value="NAHKODA">Nahkoda</option>
                                                <option value="DOKTER">Dokter</option>
                                                <option value="APOTEKER">Apoteker</option>
                                                <option value="FREELANCER">Freelancer</option>
                                                <option value="LAINNYA">Lainnya</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Pendidikan Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="pendidikan_wali" class="form-control">
                                                <option value="----">----</option>
                                                <option value="SD">SD</option>
                                                <option value="SMP">SMP</option>
                                                <option value="SMA">SMA</option>
                                                <option value="DIPLOMA">Diploma</option>
                                                <option value="S1">S1</option>
                                                <option value="S2">S2</option>
                                                <option value="S3">S3</option>
                                                <option value="ACADEMY">Academy</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Penghasilan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <select name="penghasilan_wali" class="form-control">
                                                <option value="----">----</option>
                                                <option value=">20 JUTA">>20.000.000</option>
                                                <option value="15-20 JUTA">15.000.000 - 20.000.000</option>
                                                <option value="10-15 JUTA">10.000.000 - 15.000.000</option>
                                                <option value="5-9 JUTA">5.000.000 - 9.000.000</option>
                                                <option value="3-5 JUTA">3.000.000 - 5.000.000</option>
                                                <option value="2-3 JUTA">2.000.000 - 3.000.000</option>
                                                <option value="1-2 JUTA">1.000.000 - 2.000.000</option>
                                                <option value="<1 JUTA">Di bawah 1.000.000</option>
                                                <option value="TIDAK ADA">Tidak Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--#AKHIR DATA WALI-->

                                <!--PILIH PROGRAM-->
                                 <div class="row clearfix">
                                    <div class="col-xs-10 col-sm-10 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">PROGRAM TAHFIZH <span class="badge">Pilih 1</span></button>
                                	</div>
                                 </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-5 col-sm-4 col-xs-4 form-control-label">
                                        <label>TAHFIZH ASRAMA</label>
                                    </div>
                                    <div class="col-lg-10 col-md-8 col-sm-8 col-xs-8 mt-15">
                                    	<div class="form-group">
                                        <div class="demo-checkbox">
                                        	<div class="form-line">
                                				<input name="program_pilihan" value="INTENSIF PUTRA" type="radio" id="radio_1" class="radio-col-green" />
                                				<label for="radio_1">INTENSIF PUTRA</label>
                                				<input name="program_pilihan" value="INTENSIF PUTRI" type="radio" id="radio_2" class="radio-col-pink"/>
                                				<label for="radio_2">INTENSIF PUTRI</label>
                                				<input name="program_pilihan" value="MUROJAAH PUTRA" type="radio" id="radio_5" class="radio-col-red"/>
                                				<label for="radio_5">MUROJAAH PUTRA</label>
                                				<input name="program_pilihan" value="MUROJAAH PUTRI" type="radio" id="radio_6" class="radio-col-blue" />
                                				<label for="radio_6">MUROJAAH PUTRI</label>
                                				<input name="program_pilihan" value="SANAD PUTRA" type="radio" id="radio_7" class="radio-col-amber" />
                                				<label for="radio_7">SANAD PUTRA</label>
                                				<input name="program_pilihan" value="SANAD PUTRI" type="radio" id="radio_8" class="radio-col-cyan"/>
                                				<label for="radio_8">SANAD PUTRI</label>
                                				

                                			</div>
                                    	</div>
                                    	</div>
                                    </div>
                                 </div>
                                 <!--#AKHIR PILIH PROGRAM-->

                                 <!--UPLOAD BERKAS-->
                                 <div class="row clearfix jsdemo-notification-button">
                            		 <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        UPLOAD BERKAS
                                    </button>
                                </div>
                            	</div>
                                <label>Hanya Menerima File Dalam Format (.jpg .jpeg .png) TIDAK Menerima Dalam Format (.pdf)</label>
                                <label>PERHATIAN! Ukuran Maksimal Masing-Masing File Adalah <b>1 MB</b>, Lebih Dari Itu Pendaftaran akan GAGAL!</label>
                            	<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Photo</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            
                                            <div class="form-line">
                                                <input type="file"  accept="image/*" name="photodiri" class="form-control">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                    
                                <div class="row clearfix">    
                                     <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Transkrip Nilai</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file"  accept="image/*" name="transkrip" class="form-control">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Kartu Keluarga</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" accept="image/*" name="kartu_kel" class="form-control"/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
      
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>KTP Orang Tua</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" accept="image/*"  name="ktp_ortu" class="form-control">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Surat Keterangan Sehat</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" accept="image/*" name="surat_sehat" class="form-control">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="alert alert-success">
                                <strong>PERHATIAN!</strong> Jika anda mendaftar menggunakan HP (Smartphone), mohon menunggu proses UPLOAD BERKAS sampai selesai
                                (bisa lebih dari 1 menit, tergantung ukuran file dan kecepatan koneksi anda).
                                <strong>JANGAN KLIK TOMBOL DAFTAR 2x</strong> saat sedang proses upload berkas, hal itu bisa membuat pengisian form GAGAL!
                                </div>
                    
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" name="daftar" class="btn btn-primary m-t-15 waves-effect">DAFTAR</button>
                                    </div>
                                </div>
                            </form>
                            <!--#AKHIR UPLOAD BERKAS-->
                        </div>
                    </div>
                </div>
            </div>
    </section>

     <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>
    
    <!-- Dropzone Plugin Js -->
    <script src="../../plugins/dropzone/dropzone.js"></script>

    <!-- Input Mask Plugin Js -->
    <script src="../../plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="../../plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Jquery Spinner Plugin Js -->
    <script src="../../plugins/jquery-spinner/js/jquery.spinner.js"></script>

    <!-- Bootstrap Tags Input Plugin Js -->
    <script src="../../plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

    <!-- noUISlider Plugin Js -->
    <script src="../../plugins/nouislider/nouislider.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/forms/advanced-form-elements.js"></script>
    <script src="../../js/pages/ui/notifications.js"></script>
    <script src="../../js/pages/examples/sign-in.js"></script>
    

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>

      <!-- Moment Plugin Js -->
    <script src="../../plugins/momentjs/moment.js"></script>

      <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>
    
 
    <script src="../../js/kapital.js"></script>


</body>
</html>