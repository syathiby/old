<?php 

	session_start();
	include "inc/config.php";

	/*Proses Login*/
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql_login = mysqli_query($koneksi, "SELECT * FROM identitas WHERE username ='$username' and password ='$password'");

		if(mysqli_num_rows($sql_login)>0){
			$row_akun = mysqli_fetch_array($sql_login);
			$_SESSION['akun_id'] = $row_akun['id'];
			$_SESSION['akun_username'] = $row_akun['username'];
            $_SESSION['akun_namalengkap'] = $row_akun['namalengkap'];
			$_SESSION['akun_level'] = $row_akun['level'];
            

            if($row_akun['level']=="Admin"){
                $_SESSION['admin'] = $row_akun['level'];
                $_SESSION['username'] = $row_akun['username'];
                $_SESSION['namalengkap'] = $row_akun['namalengkap'];
                $_SESSION['thn_ajaran'] = $row_akun['thn_ajaran'];
                $_SESSION['id'] = $row_akun['id'];
                $_SESSION['tes_tahfizh'] = $row_akun['tes_tahfizh'];
                $_SESSION['tes_psikologi'] = $row_akun['tes_psikologi'];
                $_SESSION['tes_wawancara'] = $row_akun['tes_wawancara'];
                header("location: index.php");
            }


            if($row_akun['level']=="Security"){
                $_SESSION['security'] = $row_akun['level'];
                $_SESSION['username'] = $row_akun['username'];
                $_SESSION['namalengkap'] = $row_akun['namalengkap'];
                $_SESSION['thn_ajaran'] = $row_akun['thn_ajaran'];
                $_SESSION['id'] = $row_akun['id'];
                $_SESSION['tes_tahfizh'] = $row_akun['tes_tahfizh'];
                $_SESSION['tes_psikologi'] = $row_akun['tes_psikologi'];
                $_SESSION['tes_wawancara'] = $row_akun['tes_wawancara'];
                header("location: pages/tables/monitor_izin.php");
            }

            else if($row_akun['level']=="Santri"){
                $_SESSION['id'] = $row_akun['id'];
                $_SESSION['username'] = $row_akun['username'];
                $_SESSION['thn_ajaran'] = $row_akun['thn_ajaran'];
                $_SESSION['santri'] = $row_akun['level'];
                $_SESSION['seleksi_berkas'] = $row_akun['seleksi_berkas'];
                $_SESSION['tes_tahfizh'] = $row_akun['tes_tahfizh'];
                $_SESSION['tes_psikologi'] = $row_akun['tes_psikologi'];
                $_SESSION['tes_wawancara'] = $row_akun['tes_wawancara'];
                $_SESSION['namalengkap'] = $row_akun['namalengkap'];
                $_SESSION['namabelakang'] = $row_akun['namabelakang'];
                $_SESSION['tempat_lahir'] = $row_akun['tempat_lahir'];
                $_SESSION['tgl_lahir'] = $row_akun['tgl_lahir'];
                $_SESSION['hasil_akhir'] = $row_akun['hasil_akhir'];
                $_SESSION['transfer'] = $row_akun['transfer'];
                $_SESSION['waktu_tes'] = $row_akun['waktu_tes'];
                $_SESSION['publikasi'] = $row_akun['publikasi'];
                $_SESSION['nilai_akhir'] = $row_akun['nilai_akhir'];
                $_SESSION['tes_kesehatan'] = $row_akun['tes_kesehatan'];
                header("location: index.php");
            }
		}

		else {
			header("location: login.php?gagal-login");
		}
	}

 ?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Log in | Aplikasi Perizinan Ma'had Al Imam Asy Syathiby</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Kesantrian<b> Apps</b></a>
            <small>Aplikasi Perizinan Santri Online Terpadu Ma'had Imam Syathiby</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" action="" method="POST">
                    <div class="msg">Silahkan login untuk melihat data anda</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username (No. HP Orang Tua)" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" id="sandiku" class="form-control" name="password" placeholder="Password (Kata Sandi)" required>
                        </div>
                        <div class="demo-checkbox">
                        <input type="checkbox" onclick="myFunction()" id="md_checkbox_21" class="filled-in chk-col-red">
                                <label for="md_checkbox_21">Tampilkan Password</label>
                        </div>
                    </div>

                    <div class="row">
     
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit" name="login">MASUK</button>
                        </div>
                    </div>

                    <?php 
                    if(isset($_GET['gagal-login'])){
                    ?>
                    <div>
                    	<label>Maaf, Username atau Password Salah!</label>
                    </div>
                    <?php }?>
                </form>
               
            </div>
        </div>
    </div>
     <div class="legal">
                <div class="copyright" align="center">
                    &copy; 2020 <a href="javascript:void(0);">Perizinan Online - Ma'had Al Imam As Syathiby</a>.
                </div>
                <div class="version" align="center">
                   Dikembangkan oleh: <a href="https://facebook.com/Alendia.Desta" target="_blank"><b>ADS Dev</b></a>
                </div>
                </div>
    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>
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
</body>
</html>

<?php 

	mysqli_close($koneksi);
	ob_end_flush();

 ?>