<!DOCTYPE html>
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

<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Program Tahfizh Non Asrama - PSB Online | Ma'had Al Imam Asy Syathiby</title>
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

    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
</head>


<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
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
        <input type="text" placeholder="Langsung Ketik Disini..">
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

                    <li class="">
                        <a href="../forms/inputdata.php">
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
                    
                    <li class="active">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">subject</i>
                            <span>Program Pilihan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="program_asrama.php">Tahfizh Asrama</a>
                            </li>
                            <li class="active">
                                <a href="#">Tahfizh Non Asrama</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="hubungi.php">
                            <i class="material-icons">phone_in_talk</i>
                            <span>Hubungi Kami</span>
                        </a>
                        
                    </li>
                    <li class="">
                        <a href="video-panduan.php">
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
    </section>
        <!-- #END# Left Sidebar -->

         <!-- Tabs With Icon Title -->
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                PROGRAM TAHFIZH NON ASRAMA
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                
                            </ul>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#ceria_emas" data-toggle="tab">
                                        <i class="material-icons">star</i> Ceria Emas
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#fullday" data-toggle="tab">
                                        <i class="material-icons">work</i> Full Day
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="ceria_emas">
                                    <p>
                                        Program Istimewa Ma’had Tahfizh Imam Syathiby diperuntukkan untuk anak-anak kaum muslimin <b>usia 4 – 6 tahun</b>, 
                                        merupakan usia emas bagi setiap anak untuk menghafal ayat ayat Al Qur’an al Karim dan membaca Al Qur’an sesuai kaidah ilmu tajwid 
                                        dengan bimbingan para pengajar Al Qur’an yang memiliki dedikasi yang kuat dan metode tahfizh imam syathiby <b>Talaqy musyafahatan</b> 
                                        yang dengan idzin dari Allah dan pertolongan-Nya akan menghantarkan anak-anak emas ini mernjadi calon-calon huffazul qur’an yang mutqin 
                                        dan memiliki akhlaq dan adab yang mulia.
                                        <br>
                                        <br><b>PERINCIAN PROGRAM</b>
                                        <br>1. Masa Belajar : <b>3 tahun</b>
                                        <br>2. Materi pembelajaran : <b>Tajwid, Tahfizh Al Qur’an, Tahfizh Al Hadits, Dzikir & Doa, Adab dan Akhlaq Penghafal Al Qur’an.</b>
                                        <br>3. Target Hafalan: 1 juz pertahun, mulai dari juz 30, 29 dan 28.
                                        <br>4. Waktu belajar: hari <b>Senin s/d Jum’at pukul 07.30-11.30.</b>
                                        
                                        <br>
                                        <br><b>FASILITAS PEMBELAJARAN</b>
                                        <br>1. Ruang kelas ber AC
                                        <br>2. Seragam Ceria Emas
                                        <br>3. Ruang Bermain Edukatif
                                        <br>4. Syathibi Mart
                                        <br>5. Kantin Sehat Syathiby
                                        <br>6. Musholla
                                        <br>7. Mushaf Tahfizh
                                        <br>8. Audio Video Murottal Qur’an.
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="fullday">
                                    <p>
                                        Program Istimewa Ma’had Tahfizh Imam Syathiby diperuntukkan untuk anak-anak kaum muslimin <b>usia 7 – 12 tahun</b>, 
                                        merupakan usia emas dalam semangat dan potensi  bagi setiap anak untuk menghafal ayat ayat Al Qur’an al Karim dengan bimbingan 
                                        para pengajar Al Qur’an yang memiliki dedikasi yang kuat dan metode tahfizh imam syathiby <b>Talaqy musyafahatan</b>  
                                        yang dengan izin dari Allah dan pertolongan-Nya akan menghantarkan anak-anak emas ini menjadi calon-calon huffazul qur’an yang 
                                        memiliki karakter yang kuat , kedisiplinan dan adab serta akhlaq yang mulia.
                                        
                                        <br>
                                        <br>
                                        <b>PERINCIAN PROGRAM</b>
                                        <br>1. Masa Belajar : <b>6 tahun</b>
                                        <br>2. Materi pembelajaran : <b>Tajwid, Tahfizh Al Qur’an, Tahfizh Al Hadits, Dzikir & Doa, Adab dan Akhlaq Penghafal Al Qur’an.</b>
                                        <br>3. Target hafalan: <b>3 juz pertahun</b> dan 9 Juz selama 3 tahun masa program.
                                        <br>4. Waktu belajar: hari <b>Senin s/d Jum’at pukul 07.30-14.30.</b> 
                                        
                                        <br>
                                        <br><b>FASILITAS PEMBELAJARAN</b>
                                        <br>1. Ruang kelas ber AC
                                        <br>2. Seragam Ceria Emas
                                        <br>3. Ruang Bermain Edukatif
                                        <br>4. Syathibi Mart
                                        <br>5. Kantin Sehat Syathiby
                                        <br>6. Musholla
                                        <br>7. Mushaf Tahfizh
                                        <br>8. Audio Video Murottal Qur’an.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </section>

            <!-- #END# Tabs With Icon Title -->

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

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/ui/notifications.js"></script>

      <!-- Autosize Plugin Js -->
    <script src="../../plugins/autosize/autosize.js"></script>
    
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