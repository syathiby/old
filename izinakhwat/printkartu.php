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

<!DOCTYPE html>
<html>

<head>
<style type/css>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
}

</style>
</head>

<body>
        <img src="img/kop7.jpg" />
        <h4 align="center">KARTU TES (F2)</h4>
        Mahad Tahfizh Al Quran Al Imam Asy Syathiby menyatakan bahwa :
        <?php 
        echo
        '
        <strong>Nomor Registrasi : '.$data['noreg'].'</strong>
        <strong>Nama Lengkap    : '.$data['namalengkap'].'</strong>
        <strong>Program Pilihan : '.$data['program_pilihan'].'</strong>
        <p align="center"><b>------- LULUS SELEKSI BERKAS -------</b></p>
        <h5 style="color:blue">Tanggal Tes : '.$data['waktu_tes'].' | Waktu : 07.30 WIB | Tempat : Mahad Imam Syathiby</h5>
        '?>
        
        <table border="1">
            <tr>
                <th height="20" align="center">Jenis Tes</th>
                <th height="20" align="center">Waktu Tes</th>
            </tr>
            <tr>
                <td height="20" align="center">Tes Psikologi</td>
                <td align="center">08.00 - 09.30</td>
                
            </tr>
            <tr>
                <td height="20" align="center">Tes Akademis</td>
                <td align="center">09.45 - 11.50</td>
                
            </tr>
            <tr>
                <td height="20" align="center">Tes Kesehatan</td>
                <td align="center">09.45 - 11.50</td>
               
            </tr>
            <tr>
                <td height="20" align="center">Tes Wawancara</td>
                <td align="center">12.50 - 14.00</td>
                
            </tr>
        </table>

<?php
echo'
        <div align="right">
            <p>Cileungsi, '.date("d-m-y").'
            Mudir Mahad Imam Syathiby
            <img src="img/mudir.png" />
            <b>Nawawi Hanafiah</b>
            </p>
        </div>
'?>
</body>
</html>


<?php
$filename="Kartu-Tes-".$data['namadepan']."-PPDB.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
 require_once('html2pdf/html2pdf.class.php');
 try
 {
        $html2pdf = new HTML2PDF('P','A5','en');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>