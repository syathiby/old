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

<?php 
$id = $_GET['id'];

$sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = izin_santri.username 
WHERE identitas.level='Santri' AND izin_santri.posisi!='Di Mahad' AND izin_santri.id='$id'") or die (mysqli_error());
$data = mysqli_fetch_array($sql);

$username = $data['username'];
$kategori = $data['kategori'];
$sisa_kuota = $data['kuota'];
$pluskuota = 1;
$kuota = $sisa_kuota + $pluskuota;

//LOGIKA JUMLAH IZIN
$sql_tajil = mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = 
izin_santri.username WHERE izin_santri.kategori='Tajil' AND identitas.username='$username'");
$hitung_tajil = mysqli_num_rows($sql_tajil);

$sql_keluar_sekitar = mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = 
izin_santri.username WHERE izin_santri.kategori='Keluar Sekitar' AND identitas.username='$username'");
$hitung_keluar_sekitar = mysqli_num_rows($sql_keluar_sekitar);

$sql_kunjungan_keluar = mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = 
izin_santri.username WHERE izin_santri.kategori='Kunjungan Keluar' AND identitas.username='$username'");
$hitung_kunjungan_keluar = mysqli_num_rows($sql_kunjungan_keluar);

$sql_pulang = mysqli_query($koneksi,"SELECT * FROM identitas INNER JOIN izin_santri ON identitas.username = 
izin_santri.username WHERE izin_santri.kategori='Pulang' AND identitas.username='$username'");
$hitung_pulang = mysqli_num_rows($sql_pulang);

$hitung_izin = $hitung_tajil + $hitung_keluar_sekitar + $hitung_kunjungan_keluar + $hitung_pulang;

if($kategori=="Tajil"){
$total_izin = $hitung_izin - 1;
$total_tajil = $hitung_tajil - 1;
$editkuota = mysqli_query($koneksi, "UPDATE identitas SET jml_tajil='$total_tajil', jml_keluar_sekitar='$hitung_keluar_sekitar', 
jml_kunjungan_keluar='$hitung_kunjungan_keluar', jml_pulang='$hitung_pulang',
total_izin = '$total_izin' WHERE username='$username'");
}
else if($kategori=="Keluar Sekitar"){
$total_izin = $hitung_izin - 1;
$total_keluar_sekitar = $hitung_keluar_sekitar - 1;
$editkuota = mysqli_query($koneksi, "UPDATE identitas SET jml_tajil='$hitung_tajil', jml_keluar_sekitar='$total_keluar_sekitar', 
jml_kunjungan_keluar='$hitung_kunjungan_keluar', jml_pulang='$hitung_pulang',
total_izin = '$total_izin' WHERE username='$username'");
} 
else if($kategori=="Kunjungan Keluar"){
$total_izin = $hitung_izin - 1;
$total_kunjungan_keluar = $hitung_kunjungan_keluar - 1;
$editkuota = mysqli_query($koneksi, "UPDATE identitas SET jml_tajil='$hitung_tajil', jml_keluar_sekitar='$hitung_keluar_sekitar', 
jml_kunjungan_keluar='$total_kunjungan_keluar', jml_pulang='$hitung_pulang',
total_izin = '$total_izin' WHERE username='$username'");
} 
else {
$total_izin = $hitung_izin - 1;
$total_pulang = $hitung_pulang - 1;
$editkuota = mysqli_query($koneksi, "UPDATE identitas SET jml_tajil='$hitung_tajil', jml_keluar_sekitar='$hitung_keluar_sekitar', 
jml_kunjungan_keluar='$hitung_kunjungan_keluar', jml_pulang='$total_pulang',
total_izin = '$total_izin' WHERE username='$username'");
} 

if($kategori=="Keluar Sekitar"){
    $kuota_balik = mysqli_query($koneksi,"UPDATE identitas SET kuota='$kuota' WHERE username='$username'");
} else {
    $kuota_tetap = mysqli_query($koneksi,"UPDATE identitas SET kuota='$sisa_kuota' WHERE username='$username'");
}


if($editkuota==true){
$hapus = mysqli_query ($koneksi, "DELETE FROM izin_santri WHERE id='$id'");
if($hapus){
    ?>
    <script type="text/javascript">
    alert("Terima Kasih, Data Telah Dihapus");
    window.location.href="perizinan.php";
    </script>
<?php
}

}
?>