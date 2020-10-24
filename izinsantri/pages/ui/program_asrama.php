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
    <title>Program Tahfizh Asrama - PSB Online | Ma'had Al Imam Asy Syathiby</title>
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
                            <li class="active">
                                <a href="#">Tahfizh Asrama</a>
                            </li>
                            <li>
                                <a href="non_asrama.php">Tahfizh Non Asrama</a>
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
                                PROGRAM TAHFIZH ASRAMA
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                
                            </ul>
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#reguler" data-toggle="tab">
                                        <i class="material-icons">work</i> SMA Diniyyah
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#murojaah" data-toggle="tab">
                                        <i class="material-icons">autorenew</i> SMP Tahfizh Intensif
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="reguler">
                                    <b>Target Mutqin 15 Juz dan Mampu Bahasa Arab Dengan Ketentuan:</b>
                                    <p>
                                        <br>1. Mampu menyetorkan hafalan <b>per hari minimal 1/2 halaman</b> atau Mampu menyelesaikan hafalan <b>per bulan sebanyak 1/2 Juz</b>
                                        <br>2. Lama Pendidikan <b>3 Tahun</b>
                                        <br>3. Bersedia untuk diasramakan.
                                        <br>4. Bersedia mengikuti tata aturan ma’had
                                        <br>5. Kurikulum : Diniyyah dan Tahfizh
                                        <br>6. Pengabdian 1 tahun
                                        <br><br>
                                        <b>Persyaratan:</b>
                                        <br>1. Berijazah SD
                                        <br>2. Wajib Asrama
                                        <br>3. Memiliki hafalan mutqin minimal 5 juz
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="murojaah">
                                    <b>Target Mutqin 30 Juz dan Mampu Bahasa Arab Dengan Ketentuan</b>
                                    <p>
                                        <br>1. Mampu menyetorkan hafalan <b>per hari minimal 1 halaman</b> atau Mampu menyelesaikan hafalan <b>per bulan sebanyak 1 Juz</b>
                                        <br>2. Lama Pendidikan <b>6 Tahun (paket)</b>
                                        <br>3. Bersedia untuk diasramakan.
                                        <br>4. Bersedia mengikuti tata aturan ma’had
                                        <br>5. Kurikulum : 
                                        <br>-3 Tahun pertama Tahfizh
                                        <br>-3 Tahun kedua Diniyyah
                                        <br>6. Pengabdian 1 tahun
                                        <br>7. Bagi santri lulusan SMP yang tidak melanjutkan ke jenjang SMA di Ma'had Al-Imam Asy-Syathiby, maka hanya akan mendapatkan sertifikat pencapaian hafalan. Bila
                                        menyelesaikan hingga jenjang SMA serta pengabdian 1 tahun maka akan mendapatkan ijazah tahfizh dan ijazah pesantren
                                        <br><br>
                                        <b>Persyaratan:</b>
                                        <br>1. Berijazah SMP
                                        <br>2. Wajib Asrama
                                        <br>3. Memiliki hafalan mutqin minimal 2 juz
                                    </p>
                                    <br>
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