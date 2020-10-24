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
    <title>Monitoring Perizinan Santri - Kesantrian Apps | Ma'had Al Imam Asy Syathiby</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

        <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Bootstrap DatePicker Css -->
    <link href="../../plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    
     <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

     <!-- Bootstrap Select Css -->
    <link href="../../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../css/themes/all-themes.css" rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var auto_refresh = setInterval(
            function () {
                $('#load_content').load('isi_tabel.php').fadeIn("slow");
            }, 10000); // refresh setiap 10000 milliseconds
    
    </script>
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
                <a class="navbar-brand"><b>Monitoring Perizinan Santri - Aplikasi Perizinan Online | Ma'had Al-Imam Asy-Syathiby </b></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="status_perizinan.php"><i class="material-icons">account_circle</i></a></li>
                    <li><a href="../../logout.php"><i class="material-icons">open_in_new</i></a></li>
                    <!-- #END# Call Search -->
                   
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
    <div class="row clearfix">
    <div class="card">
        <div class="alert alert-success">
            <strong>DATA SANTRI YANG SEDANG IZIN</strong>
        </div>
        <br>
        <br>
            <div class="table-responsive">
                <table class="table table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">No</th>
                                            <th style="text-align: center;">Nama Lengkap</th>
                                            <th style="text-align: center;">Kamar</th>
                                            <th style="text-align: center;">Jenjang</th>
                                            <th style="text-align: center;">Kategori Izin</th>
                                            <th style="text-align: center;">Keterangan</th>
                                            <th style="text-align: center;">Jadwal Keluar</th>
                                            <th style="text-align: center;">Jadwal Kembali</th>
                                            <th style="text-align: center;">Sisa Waktu Kembali</th>
                                            <th style="text-align: center;">Status Santri</th>
                                            <!--<th style="text-align: center;">Status Kembali</th>-->
                                        </tr>
                                    </thead>
                                    <?php 
                                        $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                        identitas.username = izin_santri.username WHERE identitas.level='Santri' AND izin_santri.posisi!='Di Mahad'") or die (mysqli_error());
                                        $cek = mysqli_num_rows($sql);

                                        if($cek==0){
                                        ?>
                                        <tbody>
                                            <tr>
                                                <td colspan="10" align="center"><font color="red"><b>TIDAK ADA SANTRI YANG SEDANG IZIN</b></font></td>
                                            <tr>
                                        </tbody>
                                    <?php
                                    } else {
                                    ?>

                                    <tbody>
                                          <?php 
                                            $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                            identitas.username = izin_santri.username WHERE identitas.level='Santri' AND izin_santri.posisi!='Di Mahad'") or die (mysqli_error());
                                            $no=1;
                                            while ($data = mysqli_fetch_array ($sql)) {
                                            $kembali = $data['waktu_kembali'];
                                            $user = $data['username'];
                                         ?>
                                        <tr>
                                            <td align="center"><?php echo $no++ ?></td>
                                            <td align="center"><?php echo $data['namalengkap']; ?></td>
                                            <td align="center">Kamar <?php echo $data['kamar']; ?></td>
                                            <td align="center"><?php echo $data['jenjang'];?></td>
                                            <td align="center"><?php echo $data['kategori']; ?></td>
                                            <td align="center"><?php echo $data['keterangan']; ?></td>
                                            <td align="center"><?php echo $data['waktu_keluar']; ?></td>
                                            <td align="center"><?php echo $kembali; ?></td>
                                            <td align="center"><h5 id=<?php echo $user;?>></h5></td>       
                                            <td align="center" style="text-align: justify-all;">
                                               <?php 
                                                 if($data['posisi'] == "Pulang"){
                                                 ?>
                                                    <button type="button" class="btn bg-red waves-effect"><b>Pulang</b></button>
                                                 <?php } 
                                                 else if ($data['posisi'] == "Keluar") {
                                                 ?>
                                                    <button type="button" class="btn bg-orange waves-effect"><b>Keluar</b></button>
                                                 <?php }
                                                 else if($data['posisi'] == "Diproses"){
                                                 ?>
                                                 <button type="button" class="btn bg-blue waves-effect"><b>Diproses</b></button>
                                                 <?php } 
                                                 else {
                                                 ?>
                                                    <button type="button" class="btn bg-green waves-effect"><b>Ma'had</b></button>
                                                 <?php }
                                               ?>
                                            </td>                         
                                        </tr>

                                        <?php }  ?>
                                    </tbody>
                                    <?php
                                    }
                                    ?>

                                    
                                    <script type="text/javascript">
                                    function createCountDown(elementId, date) {
                                    // Set the date we're counting down to
                                    var countDownDate = new Date(date).getTime();

                                    // Update the count down every 1 second
                                    var x = setInterval(function()  {
                                                                                    
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
                                    document.getElementById(elementId).innerHTML = days + " Hari " + hours + " Jam " + minutes + " Menit " + seconds + " Detik ";
                                                                                        
                                    // If the count down is over, write some text 
                                    if (distance < 0) {
                                    clearInterval(x);
                                    document.getElementById(elementId).innerHTML = "Terlambat";
                                                                                        
                                    }
                                    } , 1000);
                                    }
                                    </script>

                                    <?php 
                                    $sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
                                    identitas.username = izin_santri.username WHERE identitas.level='Santri' AND izin_santri.posisi!='Di Mahad'") or die (mysqli_error());
                                    while ($data = mysqli_fetch_array ($sql)) {
                                    $user = $data['username'];
                                    $kembali = $data['waktu_kembali'];
                                    $id = $data['id'];
                                    ?>
                                    <script type="text/javascript">
                                    do{
                                      createCountDown('<?php echo $user;?>', "<?php echo $kembali;?>");
                                    }
                                    while($id > 0);
                                    </script>
                                    <?php } ?>
                                </table>
                            </div>
                            <!--Ujung Tabel-->
        </div>
        </div>
        </div>
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

     <!-- Bootstrap Notify Plugin Js -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script>

    <!-- Multi Select Plugin Js -->
    <script src="../../plugins/multi-select/js/jquery.multi-select.js"></script>

    <!-- Sweet Alert Css -->
    <link href="../../plugins/sweetalert/sweetalert.css" rel="stylesheet" />

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
    <script src="../../js/pages/ui/notifications.js"></script>
    <script src="../../js/pages/forms/basic-form-elements.js"></script>
    <!--<script src="../../js/pages/ui/modals.js"></script>-->

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>


    <script type="text/javascript">
    function autoRefreshPage()
    {
        window.location = window.location.href;
    }
    setInterval('autoRefreshPage()', 45000);
    </script>

</body>

</html>