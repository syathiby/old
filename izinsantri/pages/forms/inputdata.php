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
                <?php
                $sql = mysqli_query ($koneksi, "SELECT * FROM aplikasi") or die (mysqli_error());
                $data = mysqli_fetch_array ($sql)
                ?>
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);"><?php echo $data['copyright']; ?></a>.
                </div>
                <div class="version">
                    Dikembangkan oleh: <a href="<?php echo $data['url']; ?>" target="_blank"><b><?php echo $data['developer']; ?></b></a>
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
                                LANGKAH PENDAFTARAN SANTRI BARU ONLINE <b>PROGRAM ASRAMA</b>
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
                               <div id="wizard_vertical">
                                <h2>Berkas</h2>
                                <section>
                                    <p>
                                        <H4>SIAPKAN BERKAS</H4>
                                        Pastikan anda sudah mempersiapkan seluruh berkas yang dibutuhkan, sebagai berikut: <br>
                                        <b>1. Pas Photo Santri</b> <br>
                                        <b>2. Transkrip Nilai Semester Terakhir</b><br>
                                        <b>3. KTP Orang Tua</b><br>
                                        <b>4. Kartu Keluarga</b><br>
                                        <b>5. Surat Keterangan Sehat Dokter</b><br>
                                        Semua berkas di atas dalam bentuk <b>Scan (Soft Copy)</b> dan ukuran untuk masing-masing file <b>Maksimal 1 MB</b>. Jika ukuran file
                                        lebih dari 1 MB maka pendaftaran akan GAGAL
                                    </p>
                                </section>
                                
                                <h2>Formulir</h2>
                                <section>
                                    <p>
                                    <H4>MENGISI FORMULIR PENDAFTARAN ONLINE</H4>
                                    Isilah formulir dengan lengkap dan benar, pastikan anda mengupload semua berkas yang dibutuhkan. Apabila anda gagal mengisi formulir, maka
                                    perhatikan <b>kolom isian dan ukuran file yang diupload</b>. Jika terjadi kesalahan sistem akan otomatis menolak pendaftaran anda.
                                    </p>
                                </section>

                                <h2>Seleksi</h2>
                                <section>
                                    
                                    <p>
                                    <H4>SELEKSI BERKAS</H4>
                                    Setelah anda berhasil mengisi form online, lalu Login ke Aplikasi silahkan tunggu proses "Seleksi Berkas". <BR><BR>Pada tahap ini, anda diberi waktu <b>3 Hari</b> untuk memperbaiki
                                    berkas jika ada kekurangan/kesalahan. Apabila berkas tidak segera diperbaiki, maka anda akan dianggap <b>GUGUR.</b> <br>
                                    Apabila anda dinyatakan LULUS Seleksi Berkas, silahkan langsung melakukan pembayaran biaya pendaftaran sesuai dengan ketentuan.
            
                                    </p>
                                </section>

                                <h2>Kartu Tes</h2>
                                <section>
                                    
                                    <p>
                                        <H4>CETAK KARTU TES</H4>
                                        Untuk mengikuti Tes Seleksi Masuk maka calon santri wajib untuk membawa kartu tes, kartu ini dapat anda print/cetak dari menu yang
                                        tersedia di Aplikasi. Proses Cetak Kartu Tes ini hanya bisa dilakukan jika anda sudah <b>LULUS SELEKSI BERKAS & MELAKUKAN UPLOAD BUKTI
                                        TRANSFER BIAYA PENDAFTARAN</b>. <br<br>
                                        Simpan kartu ini dengan baik, dan jangan lupa membawanya saat pelaksanaan tes masuk.
                                    </p>
                                </section>

                                <h2>Lulus</h2>
                                <section>
                                    <p>
                                        <H4>CETAK BUKTI KELULUSAN</H4>
                                        Apabila anda dinyakan LULUS tes seleksi masuk, silahkan untuk mencetak/print <b>Bukti Kelulusan.</b> Calon santri WAJIB membawa Kartu Bukti Kelulusan saat melakukan daftar ulang<br><br>
                                        
                                    </p>
                                </section>
                            </div>
                            </div>
                            <br>
                            <p align="center"><img src="../../img/Alur-Pendaftaran.jpg" width="80%" height="auto"></p>
    
                            <p align="center"><a href="img/Alur-Pendaftaran.jpg" download><strong>DOWNLOAD GAMBAR</strong></a></p>
                            <br>
                            <br>
                            <?php 
                            date_default_timezone_set('Asia/Jakarta');
                            $tgl = strtotime("2019-11-01 08:00:00");
                            $now = time();
                            $selisih = $now - $tgl;
                            $hasil = floor($selisih/(60*60*24));
                            if($hasil=='0') {
                                ?>
                            <h2>Untuk mengisi form online silahkan klik tombol berikut: </h2>
                            <?php } else{
                            ?>
                            <h2>Pendaftaran akan dibuka dalam waktu : </h2>
                            <?php }
                            ?>
 
                                <div class="row clearfix">
                                    <div class="col-lg-offset-4 col-md-offset-4 col-sm-offset-1 col-xs-offset-1">
                                        <h2 id="demo"></h2>
                                    </div>
                                </div>
                          
                                <script type="text/javascript">
                                // Set the date we're counting down to
                                var countDownDate = new Date("Nov 01, 2019 08:00:00").getTime();
                                
                                // Update the count down every 1 second
                                var x = setInterval(function() {
                                
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
                                  document.getElementById("demo").innerHTML = days + " Hari " + hours + " Jam "
                                  + minutes + " Menit " + seconds + " Detik ";
                                    
                                  // If the count down is over, write some text 
                                  if (distance < 0) {
                                    clearInterval(x);
                                    document.getElementById("demo").innerHTML = '<a href="isiform.php"><button>DAFTAR SEKARANG</button></a>';
                                    
                                  }
                                }, 1000);
                                </script>
                       
                            
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
    
    <!-- JQuery Steps Plugin Js -->
    <script src="../../plugins/jquery-steps/jquery.steps.js"></script>

    
    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/ui/notifications.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
    <script src="../../js/pages/forms/form-wizard.js"></script>
    
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