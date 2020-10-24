    <?php 

    global $koneksi;

    $nameserver ='localhost';
    $username ='root';
    $password ='';
    $namadb ='academy';

    $koneksi = mysqli_connect($nameserver, $username, $password, $namadb); 

    if(!$koneksi) {
        die("Koneksi Gagal".mysqli_connect_error());
    }

 ?>

    <?php 
   		if(isset($_POST['daftar'])){
   			
   			$username=$_POST['username'];
   			$password=$_POST['password'];
        	$namadepan= $_POST['namadepan'];
        	$tempat_lahir= $_POST['tempat_lahir'];
        	$jk=$_POST['jk'];
            
        	$program_pilihan=$_POST['program_pilihan'];

            
         $photodiri=$_FILES['photodiri']['tmp_name'];
         $namaphoto=$_FILES['photodiri']['name'];
         $ijazah=$_FILES['ijazah']['tmp_name'];
         $namaijazah=$_FILES['ijazah']['name'];
         $simpan='../../img/';
        
        $pindah = move_uploaded_file($photodiri, $simpan.$namaphoto);
        $masuk = move_uploaded_file($ijazah, $simpan.$namaijazah);
        
        	if($pindah){
        	mysqli_query($koneksi, "INSERT INTO tb_tes VALUES(DEFAULT,'$username','$password','$namadepan','$tempat_lahir','$jk','Diproses',
                        '$program_pilihan','$namaphoto','$namaijazah')");
        	?>
        	<script type="text/javascript">
        	alert("Berhasil Daftar! Silahkan Log In");
        	</script>
        	<?php
        	}
        		else{
        		?>
        		<script type="text/javascript">
        		alert("Gambar Belum Di Upload");
        		</script>
        		<?php
        	}
        
            						 
        }
            					
     ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Form Examples | Bootstrap Based Admin Template - Material Design</title>
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


<body class="theme-red">
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
            <p>Please wait...</p>
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
                <a class="navbar-brand" href="index.html">PPDB Online - Ma'had Imam Syathiby</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
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
                    <li class="active">
                        <a href="../../index.php">
                            <i class="material-icons">home</i>
                            <span>Halaman Depan</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="pages/form.php">
                            <i class="material-icons">content_paste</i>
                            <span>Login</span>
                        </a>
                    </li>
                    
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">swap_calls</i>
                            <span>Program Pilihan</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="pages/ui/alerts.html">Tahfizh Asrama</a>
                            </li>
                            <li>
                                <a href="pages/ui/animations.html">Tahfizh Non Asrama</a>
                            </li>
                        </ul>

                        <a href="pages/changelogs.html">
                            <i class="material-icons">update</i>
                            <span>Hubungi Kami</span>
                        </a>
                        
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

  <section class="content">
        <div class="container-fluid">
            <!-- Widgets -->

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                FORMULIR PENDAFTARAN SANTRI BARU
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
                            
                            <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                            	<div class="row clearfix jsdemo-notification-button">
                            		 <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA LOGIN
                                    </button>
                                </div>
                            	</div>
                            	<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Username</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="username" class="form-control" placeholder="Username untuk Login" required="Wajib Diisi" />
                                            </div>
                                        
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Password</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" name="password" class="form-control" placeholder="Kata Sandi" />
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>


                            	<div class="row clearfix jsdemo-notification-button">
                            		 <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        DATA PRIBADI
                                    </button>
                                </div>
                            	</div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Nama Depan</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="namadepan" class="form-control" required="Tidak Boleh Kosong" />
                                            </div>
                                        
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Tempat Lahir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="tempat_lahir" class="form-control"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row clearfix">
                                	<div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Jenis Kelamin</label>
                                	</div>
                                	<div class="col-sm-4">
                                		<div class="form-group">
                                    		<select name="jk" class="form-control">
                                        		<option>Pilih</option>
                                        		<option value="laki-laki">Laki-laki</option>
                                        		<option value="perempuan">Perempuan</option>
                                   			</select>
                                   		</div>

                                	</div>
                                </div>

                               

                                 <div class="row clearfix">
                                    <div class="col-xs-8 col-sm-8 col-md-3 col-lg-3">
                                    <button class="btn btn-success btn-lg btn-block waves-effect" type="button">PROGRAM TAHFIZH <span class="badge">Pilih 1</span></button>
                                	</div>
                                 </div>

                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-5 form-control-label">
                                        <label>TAHFIZH ASRAMA</label>
                                    </div>
                                    <div class="col-lg-10 col-md-8 mt-15">
                                    	<div class="form-group">
                                        <div class="demo-checkbox">
                                        	<div class="form-line">
                                				<input name="program_pilihan" type="radio" id="radio_1" value="Intensif Putra"class="radio-col-green" />
                                				<label for="radio_1">Intensif Putra</label>
                                				<input name="program_pilihan" type="radio" id="radio_2" class="radio-col-pink"/>
                                				<label for="radio_2">Intensif Putri</label>
                                				<input name="program_pilihan" type="radio" id="radio_3" class="radio-col-indigo"/>
                                				<label for="radio_3">Reguler Putra</label>
                                				<input name="program_pilihan" type="radio" id="radio_4" class="radio-col-purple" />
                                				<label for="radio_4">Reguler Putri</label>
                                				<input name="program_pilihan" type="radio" id="radio_5" class="radio-col-red"/>
                                				<label for="radio_5">Muroja'ah Putra</label>
                                				<input name="program_pilihan" type="radio" id="radio_6" class="radio-col-blue" />
                                				<label for="radio_6">Muroja'ah Putri</label>

                                				<input name="program_pilihan" type="radio" id="radio_7" class="radio-col-amber" />
                                				<label for="radio_7">Sanad Putra</label>
                                				<input name="program_pilihan" type="radio" id="radio_8" class="radio-col-cyan"/>
                                				<label for="radio_8">Sanad Putri</label>
                                				<input name="program_pilihan" type="radio" id="radio_9" class="radio-col-orange"/>
                                				<label for="radio_9">Hadits Putra</label>
                                				<input name="program_pilihan" type="radio" id="radio_10" class="radio-col-yellow" />
                                				<label for="radio_10">Hadits Putri</label>
                                				<input name="program_pilihan" type="radio" id="radio_11" class="radio-col-black"/>
                                				<label for="radio_11">Matan Putra</label>
                                				<input name="program_pilihan" type="radio" id="radio_12" class="radio-col-teal" />
                                				<label for="radio_12">Matan Putri</label>

                                			</div>
                                    	</div>
                                    	</div>
                                    </div>
                                 </div>

                                

                               

                                 <div class="row clearfix jsdemo-notification-button">
                            		 <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2">
                                    <button type="button" class="btn bg-orange btn-block waves-effect" data-placement-from="top" data-placement-align="left"
                                            data-animate-enter="animated zoomInUp" data-animate-exit="animated zoomOutUp" data-color-name="bg-black">
                                        UPLOAD BERKAS
                                    </button>
                                </div>
                            	</div>
                                
                       

                            	<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Photo 3x4</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" name="photodiri" class="form-control"/>
                                            </div>
                                        
                                        </div>
                                    </div>
                               

                                    <div class="col-lg-2 col-md-2 form-control-label">
                                        <label>Ijazah Terakhir</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="file" name="ijazah" class="form-control"/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                 </div>


                              
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" name="daftar" class="btn btn-primary m-t-15 waves-effect">DAFTAR</button>
                                    </div>
                                </div>
                            </form>
                           
                       
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

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>

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

    <!-- Moment Plugin Js -->
    <script src="../../plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

</body>
</html>