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

<?php 
$sql = mysqli_query ($koneksi, "SELECT * FROM identitas INNER JOIN izin_santri ON 
identitas.username = izin_santri.username WHERE identitas.level='Santri' AND izin_santri.posisi!='Di Mahad'") or die (mysqli_error());
while ($data = mysqli_fetch_array ($sql)) {
$kembali = $data['waktu_kembali'];
$user = $data['username'];
?>
<h5 id=<?php echo $user;?>></h5>
<?php } ?>

<?php echo $user;?>

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