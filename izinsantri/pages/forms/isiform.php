<?php 

    global $koneksi;

    $nameserver ='localhost';
    $username ='u4486592_alen';
    $password ='r3dh41r3d';
    $namadb ='u4486592_psbasrama';

    $koneksi = mysqli_connect($nameserver, $username, $password, $namadb); 

    if(!$koneksi) {
        die("Koneksi Gagal".mysqli_connect_error());
    }

 ?>



    <?php 
   		if(isset($_POST['daftar'])){
   			
   			$noreg = $_POST['noreg'];
   			$username=$_POST['username'];
   			$password=$_POST['password'];
        	$namalengkap= addslashes($_POST['namalengkap']);
        	$tempat_lahir= addslashes($_POST['tempat_lahir']);
        	$tgl_lahir = $_POST['tgl_lahir'];
            $alamat_santri = addslashes($_POST['alamat_santri']);
        	$jk = $_POST['jk'];
        	$asal_sekolah = addslashes($_POST['asal_sekolah']);
        	$program_pilihan= $_POST['program_pilihan'];
        	$hafalan = $_POST['hafalan'];

            $nama_ayah= addslashes($_POST['nama_ayah']);
            $tmp_ayah= addslashes($_POST['tmp_ayah']);
            $tgl_ayah= $_POST['tgl_ayah'];
            $alamat_ayah= addslashes($_POST['alamat_ayah']);
            $hp_ayah= $_POST['hp_ayah'];
            $pendidikan_ayah= $_POST['pendidikan_ayah'];
            $pekerjaan_ayah= $_POST['pekerjaan_ayah'];
            $penghasilan_ayah= $_POST['penghasilan_ayah'];

            $nama_ibu= addslashes($_POST['nama_ibu']);
            $tmp_ibu= addslashes($_POST['tmp_ibu']);
            $tgl_ibu = $_POST['tgl_ibu'];
            $alamat_ibu = addslashes($_POST['alamat_ibu']);
            $hp_ibu = $_POST['hp_ibu'];
            $pendidikan_ibu = $_POST['pendidikan_ibu'];
            $pekerjaan_ibu = $_POST['pekerjaan_ibu'];
            $penghasilan_ibu = $_POST['penghasilan_ibu'];

            $nama_wali = addslashes($_POST['nama_wali']);
            $tmp_wali = addslashes($_POST['tmp_wali']);
            $tgl_wali = $_POST['tgl_wali'];
            $alamat_wali = addslashes($_POST['alamat_wali']);
            $hp_wali = $_POST['hp_wali'];
            $pendidikan_wali = $_POST['pendidikan_wali'];
            $pekerjaan_wali = $_POST['pekerjaan_wali'];
            $penghasilan_wali = $_POST['penghasilan_wali'];
            $thn_ajaran = $_POST['thn_ajaran'];
            $periode = $_POST['periode'];

        
         
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

         $simpan='../../img/psb2020/';
         

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
                    
                    $simpanphoto = "../../img/psb2020/".$time."-".$acak."-".$namaphoto;
                    $simpantranskrip = "../../img/psb2020/".$time."-".$acak."-".$namatranskrip;
                    $simpankartu_kel = "../../img/psb2020/".$time."-".$acak."-".$namakartu_kel;
                    $simpanktp_ortu = "../../img/psb2020/".$time."-".$acak."-".$namaktp_ortu;
                    $simpansurat_sehat = "../../img/psb2020/".$time."-".$acak."-".$namasurat_sehat;
                
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
                    
                    $sql_cek = mysqli_query($koneksi, "SELECT * FROM identitas WHERE username='$username'");
                    if (mysqli_num_rows($sql_cek)>0) {
                    ?>
                        <script type="text/javascript">
                        alert ("Username Anda Sudah Terdaftar, Silahkan Coba Login!");
                        window.location.href="../../login.php";
                        </script>
                    <?php
                    } else{
                         $tulisdata = mysqli_query($koneksi, "INSERT INTO identitas VALUES(DEFAULT,'$noreg','$username','$password','$namalengkap',
                        '$tempat_lahir','$tgl_lahir','$alamat_santri','$jk','$asal_sekolah','$program_pilihan','$hafalan','$nama_ayah',
                        '$tmp_ayah','$tgl_ayah','$alamat_ayah','$hp_ayah','$pendidikan_ayah','$pekerjaan_ayah','$penghasilan_ayah','$nama_ibu','$tmp_ibu',
                        '$tgl_ibu','$alamat_ibu','$hp_ibu','$pendidikan_ibu','$pekerjaan_ibu','$penghasilan_ibu','$nama_wali','$tmp_wali','$tgl_wali',
                        '$alamat_wali','$hp_wali','$pendidikan_wali','$pekerjaan_wali','$penghasilan_wali','$photobaru','$transkripbaru','$kartu_kelbaru',
                        '$ktp_ortubaru','$surat_sehatbaru','','Santri','$thn_ajaran','Tentukan','Hold','$periode')");
                        
                        $tambahdata = mysqli_query($koneksi, "INSERT INTO hasil VALUES(DEFAULT, '$username','Diproses','Menunggu','Menunggu','Menunggu',
                        'Menunggu','Menunggu','Menunggu','Menunggu','Tentukan','Hold')");
                    
                    }
                    if(($tulisdata == true) and ($tambahdata == true)){
                        ?>
                        <script type="text/javascript">
        	            alert("SELAMAT! Anda Berhasil Mendaftar, Silahkan Log In");
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
              } else {
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
    <title>Form Online Pendaftaran Santri Baru - PSB Online | Ma'had Al Imam Asy Syathiby</title>
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

    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

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
                <a class="navbar-brand" href="#"><?php echo $data['judul_web']; ?></a>
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
                        <a href="inputdata.php">
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
                               <p>
                                   <h2>INFORMASI KUOTA PENERIMAAN SANTRI BARU TAHUN AJARAN 2020-2021</h2><br>
                                   <b>KUOTA PENDAFTARAN</b><br>
                                   1. Ikhwan : 160 Santri <br>
                                   2. Akhwat : 224 Santri <br>
                                   <br>
                                   <b>KUOTA PENERIMAAN</b><br>
                                   1. Ikhwan : SMP (22 Santri) | SMA (18 Santri)<br>
                                   2. Akhwat : SMP (40 Santriwati) | SMA (16 Santriwati)<br><br>
                                   
                                   <b>APABILA KUOTA PENDAFTARAN SUDAH TERPENUHI, MAKA PENDAFTARAN AKAN DITUTUP</b>
                               </p>
                                <!--QUOTA IKHWAN-->
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                    <div class="info-box bg-blue hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons">verified_user</i>
                                    </div>
                                <div class="content">
                                    <div class="text">KUOTA PENDAFTAR</div>
                                <div>
                                <?php 
                                $cek = mysqli_query($koneksi, "SELECT * FROM draft ORDER by id DESC LIMIT 1");
                                $hitung = mysqli_fetch_array($cek);
                                $kuotaL = $hitung['quota_laki'];
                                ?>
                                <h4> <?php echo $kuotaL;?> Santri</h4>
                                
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
                                $sql_cek1 = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level='Santri' AND jk='laki-laki'");
                                $hitung1 = mysqli_num_rows($sql_cek1);
                                ?>
                                <h4>
                                <?php if($hitung1 == 0) {
                                    echo "TIDAK ADA";
                                } else { 
                                    echo $hitung1;?> Santri </h4>
                                <?php } ?>
                                    
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
                                $cek = mysqli_query($koneksi, "SELECT * FROM draft ORDER by id DESC LIMIT 1");
                                $hitung = mysqli_fetch_array($cek);
                                $kuotaL = $hitung['quota_laki'];
                                
                                $sisa1 = $kuotaL-$hitung1;
            
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
                                    <div class="info-box bg-pink hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons">verified_user</i>
                                    </div>
                                <div class="content">
                                    <div class="text">KUOTA PENDAFTAR</div>
                                <div>
                                <?php 
                                $cek1 = mysqli_query($koneksi, "SELECT * FROM draft ORDER by id DESC LIMIT 1");
                                $cari = mysqli_fetch_array($cek1);
                                $kuotaP = $cari['quota_perempuan'];
                                ?>
                                <h4> <?php echo $kuotaP;?> Santri</h4>
                                    
                                </div>
                                </div>
                                </div>
                                </div>
                                
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-pink hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons">assignment_ind</i>
                                    </div>
                                <div class="content">
                                    <div class="text">PENDAFTAR AKHWAT</div>
                                <div>
                             <?php 
                                $sql_cek2 = mysqli_query($koneksi, "SELECT * FROM identitas WHERE level='Santri' AND jk='perempuan'");
                                $hitung2 = mysqli_num_rows($sql_cek2);;
                                ?>
                                <h4>
                                <?php if($hitung2 == 0) {
                                    echo "TIDAK ADA";
                                } else { 
                                    echo $hitung2;?> Santri </h4>
                                <?php } ?>
                                    
                                </div>
                                </div>
                                </div>
                                </div>
                                
                                
                                 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <div class="info-box bg-pink hover-zoom-effect">
                                    <div class="icon">
                                        <i class="material-icons">access_alarm</i>
                                    </div>
                                <div class="content">
                                    <div class="text">SISA KUOTA AKHWAT</div>
                                <div>
                             <?php 
                                $cek1 = mysqli_query($koneksi, "SELECT * FROM draft ORDER by id DESC LIMIT 1");
                                $cari = mysqli_fetch_array($cek1);
                                $kuotaP = $cari['quota_perempuan'];

                                $sisa2 = $kuotaP - $hitung2;
            
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
                                <h3>PETUNJUK PENGISIAN FORMULIR ONLINE!</h3>
                                <p>Sebelum melakukan pengisian formulir pendaftaran, perhatikan beberapa hal-hal berikut:
                                <br>
                                1. Siapkan semua berkas yang dibutuhkan dalam bentuk <b>Soft Copy</b> (sudah siap upload) :
                                <b>
                                    <br>
                                    Pas Photo Santri
                                    <br>
                                    Transkrip Nilai 1 Semester Terakhir
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
                
                            
                            <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
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
                                
                                <?php
                                date_default_timezone_set('Asia/Jakarta');
                                $cek = mysqli_query($koneksi, "SELECT * FROM identitas ORDER BY id DESC LIMIT 1");
                                $datacek = mysqli_fetch_array($cek);
                                    if ($datacek){
                                    $tanggal1 = date("md");
                                    $tanggal2 = date("His");
                                    $urut = $datacek['id'] + 1;
                                    $hasilkode = "PSB2007".$urut.$tanggal1.-$tanggal2;
                                    }
                                    else {
                                    $hasilkode = "PSB200701001";
                                    }
                                ?>
                                
                                <?php 
                                $cek_thnajaran = mysqli_query($koneksi, "SELECT * FROM draft ORDER BY id DESC LIMIT 1");
                                $data = mysqli_fetch_array($cek_thnajaran);
                                $tahunajaran = $data['thn_ajaran'];
                                ?>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>No Registrasi:</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="input-group">
                                            <div class="form-line">
                                                <label><?php echo $hasilkode; ?></label>
                                            </div>
                                            </div>
                                            <?php 
                                            $tanggal = date("Y-m-d");
                                            if($tanggal == "2019-10-15" or $tanggal=="2019-10-29" or $tanggal=="2019-10-30" or $tanggal=="2019-10-31"
                                            or $tanggal=="2019-11-01" or $tanggal=="2019-11-02" or $tanggal=="2019-11-03"){
                                                $periode ="Periode 1";
                                            } else if($tanggal == "2019-11-04" or $tanggal=="2019-11-05" or $tanggal=="2019-11-06" or $tanggal=="2019-11-07"
                                            or $tanggal=="2019-11-08" or $tanggal=="2019-11-09" or $tanggal=="2019-11-10") {
                                                $periode = "Periode 2";
                                            } else {
                                                $periode = "Periode 3";
                                            }
                                            ?>
                                            <input type="hidden" name="periode" class="form-control" value="<?php echo $periode;?>"/>
                                            <input type="hidden" name="noreg" class="form-control" value="<?php echo $hasilkode;?>"/>
                                            <input type="hidden" name="thn_ajaran" class="form-control" value="<?php echo $tahunajaran;?>"/>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            	<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
                                        <label>Username</p></label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8" >
                                        <div class="form-group">
                                            <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" name="username" class="form-control" placeholder="No. HP Orang Tua/Wali" required/>
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
                                                <input type="password" id="sandiku" name="password" class="form-control" placeholder="Kata Sandi" required/>  
                                            </div>
                                            <div class="demo-checkbox">
                                                <input type="checkbox" onclick="myFunction()" id="md_checkbox_21" class="filled-in chk-col-red">
                                                <label for="md_checkbox_21">Tampilkan Password</label>
                                            </div>
                                            </div>
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
                                        <label>Nama Lengkap</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="namalengkap" name="namalengkap" class="form-control" placeholder="Nama Lengkap" onkeyup="nama_lengkap()" />
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
                                                <div class="form-line" id="bs_datepicker_container">
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
                                    		<select name="jk" class="form-control" required>
                                    		    <?php 
                                    		    $sqlstatus = mysqli_query($koneksi,"SELECT * FROM draft ORDER BY id DESC LIMIT 1");
                                    		    $arraystatus = mysqli_fetch_array($sqlstatus);
                                    		    $status = $arraystatus['status'];
                                    		    
                                    		    if ($status == "TUTUP"){
                                    		    ?>
                                    		    <option value="----">----</option>
                                    		    <?php } else {
                                    		    ?>   
                                    		    <option value="----">Pilih Satu</option>
                                    		    <?php 
                                        		if($sisa1 > 0){
                                        		?>
                                        		<option value="LAKI-LAKI">Laki-laki</option>
                                        		<?php }
                                        		if($sisa2 > 0) {?>
                                        		<option value="PEREMPUAN">Perempuan</option>
                                        	    <?php }
                                    		    } ?>
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
                                        <label>Jumlah Hafalan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        <div class="form-group">
                                                <select name="hafalan" class="form-control">
                                    		    <option value="Kosong">Pilih Satu</option>
                                        		<option value="1 Juz">1 Juz</option>
                                        		<option value="2 Juz">2 Juz</option>
                                        		<option value="3 Juz">3 Juz</option>
                                        		<option value="4 Juz">4 Juz</option>
                                        		<option value="5 Juz">5 Juz</option>
                                        		<option value="6 Juz">6 Juz</option>
                                        		<option value="7 Juz">7 Juz</option>
                                        		<option value="8 Juz">8 Juz</option>
                                        		<option value="9 Juz">9 Juz</option>
                                        		<option value="10 Juz">10 Juz</option>
                                        		<option value="11 Juz">11 Juz</option>
                                        		<option value="12 Juz">12 Juz</option>
                                        		<option value="13 Juz">13 Juz</option>
                                        		<option value="14 Juz">14 Juz</option>
                                        		<option value="15 Juz">15 Juz</option>
                                        		<option value="16 Juz">16 Juz</option>
                                        		<option value="17 Juz">17 Juz</option>
                                        		<option value="18 Juz">18 Juz</option>
                                        		<option value="19 Juz">19 Juz</option>
                                        		<option value="20 Juz">20 Juz</option>
                                        		<option value="21 Juz">21 Juz</option>
                                        		<option value="22 Juz">22 Juz</option>
                                        		<option value="23 Juz">23 Juz</option>
                                        		<option value="24 Juz">24 Juz</option>
                                        		<option value="25 Juz">25 Juz</option>
                                        		<option value="26 Juz">26 Juz</option>
                                        		<option value="27 Juz">27 Juz</option>
                                        		<option value="28 Juz">28 Juz</option>
                                        		<option value="29 Juz">29 Juz</option>
                                        		<option value="30 Juz">30 Juz</option>
                                   			</select>
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
                                            <div class="form-line" id="bs_datepicker_container">
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
                                                <option value="Kosong">Pilih Satu</option>
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
                                                <option value="Kosong">Pilih Satu</option>
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
                                                <option value="Kosong">Pilih Satu</option>
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
                                            <div class="form-line" id="bs_datepicker_container">
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
                                                <option value="Kosong">Pilih Satu</option>
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
                                                <option value="Kosong">Pilih Satu</option>
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
                                                <option value="Kosong">Pilih Satu</option>
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
                                            <div class="form-line" id="bs_datepicker_container">
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
                                                 <option value="Kosong">Pilih Satu</option>
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
                                                <option value="Kosong">Pilih Satu</option>
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
                                                <option value="Kosong">Pilih Satu</option>
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
                                				<input name="program_pilihan" value="SMP Tahfizh Putra" type="radio" id="radio_1" class="radio-col-green" />
                                				<label for="radio_1">SMP Tahfizh Putra</label>
                                				
                                				<input name="program_pilihan" value="SMP Tahfizh Putri" type="radio" id="radio_2" class="radio-col-pink"/>
                                				<label for="radio_2">SMP Tahfizh Putri</label>
                                				
                                				<input name="program_pilihan" value="SMA Diniyyah Putra" type="radio" id="radio_3" class="radio-col-yellow"/>
                                				<label for="radio_3">SMA Diniyyah Putra</label>
                                				
                                				<input name="program_pilihan" value="SMA Diniyyah Putri" type="radio" id="radio_4" class="radio-col-blue" />
                                				<label for="radio_4">SMA Diniyyah Putri</label>
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
                                <label>Hanya Menerima File Dalam Format <font color="red">(.jpg .jpeg .png)</font> TIDAK Menerima Dalam Format (.pdf)</label>
                                <label>PERHATIAN! Ukuran Maksimal Masing-Masing File Adalah <font color="red">1 MB</font>, Lebih Dari Itu Pendaftaran akan GAGAL!</label>
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

    
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/ui/notifications.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
    
        <!-- Demo Js -->
    <script src="../../js/demo.js"></script>
 
    <script src="../../js/kapital.js"></script>
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
        
    </script>
    
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