<?php 
    ob_start();
    session_start();
    if(!isset($_SESSION['akun_id'])) header("location: login.php");
    include "inc/config.php"; 
    $kode = $_GET['kode'];
    $query = mysqli_query($koneksi, "SELECT * FROM identitas WHERE id = '".$kode."'");
    $data = mysqli_fetch_array($query);

    error_reporting(0);
?>


<html>

<body>
<?php
echo 
'
<div style="padding:1mm; border:1px solid;" align="center" class="judul">
        <h2>BUKTI KELULUSAN</h2>
        </div>

        <div align="center">
        <br>
        <img src="img/logo.png"/>
        <h3>Mahad Tahfizh Al Quran Al Imam Asy Syathiby</h3>
        </div>
       
        <p>Setelah melalui serangkaian proses <strong>Tes Seleksi</strong> penerimaan santri baru <strong>Tahun Ajaran 2020/2021</strong>, maka dengan ini kami nyatakan bahwa : <br> 
        <strong>Nama            : '.$data['namalengkap'].'</strong><br>
        <strong>Jenis Kelamin   : '.$data['jk'].'</strong><br>
        <strong>Asal Sekolah    : '.$data['asal_sekolah'].'</strong><br>
        <strong>Program Pilihan : '.$data['program_pilihan'].'</strong>
        </p>

        <h1 align="center">---------LULUS---------</h1>
       
        <div align="left">
        <p><strong>CATATAN:</strong>
   
        <strong>1. HARAP MENYIMPAN BUKTI KELULUSAN DAN DITUNJUKAN KE PANITIA SAAT DAFTAR ULANG!</strong>
        <strong>2. KONTAK DAFTAR ULANG : 0812 9111 1756</strong>
        </p>

        </div>

        <div align="right">
            <p>Cileungsi, '.date("d-m-y").'
            Mudir Mahad Imam Syathiby
            <img src="img/mudir.png" />
            <b>Nawawi Hanafiah</b>
            </p>
        </div>
'
?>

</body>
</html>


<?php
$filename="Bukti-Kelulusan-".$data['namadepan']."-PPDB.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
 require_once('html2pdf/html2pdf.class.php');
 try
 {
        $html2pdf = new HTML2PDF('P','A4','en');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>