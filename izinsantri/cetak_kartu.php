<?php 
        $content= 
        '
        <style type="text/css">
        .judul { background-color:#f60; color:#fff; }

        </style>
        ';

        $content .=
        '
        <page>
       
        <div style="padding:2mm; border:1px solid;" align="center" class="judul">
        <h2>BUKTI KELULUSAN</h2>
        </div>

        <div align="center">
        <br>
        <img src="img/logo.png"/>
        <h3>Mahad Tahfizh Al Quran Al Imam Asy Syathiby</h3>
        </div>
        <div aligh="left">
        <p>Setelah melalui serangkaian proses <strong>Tes Seleksi</strong> penerimaan santri baru <strong>Tahun Ajaran 2019/2020</strong>, maka dengan ini kami menyatakan bahwa anda :</p>
        </div>

        <div align="center">
  
        <h1>---------LULUS---------</h1>
        
        </div>

        <div align="left">
        <p>Selanjutnya silahkan melakukan <strong>Daftar Ulang</strong> dengan ketentuan yang telah disampaikan.</p>
        <p><strong>CATATAN:</strong>
        <br>
        <strong>1. HARAP MENYIMPAN BUKTI KELULUSAN DAN DITUNJUKAN KE PANITIA SAAT DAFTAR ULANG!</strong>
        <br>
        <strong>2. KEPUTUSAN PANITIA PPDB BERSIFAT MUTLAK!</strong>
        </p>
        
        </div>
        </page>
        ';

        require_once('html2pdf/html2pdf.class.php');
        $html2pdf = new HTML2PDF('L','A5','en');
        $html2pdf->WriteHTML($content);
        $html2pdf->Output('Bukti Kelulusan.pdf');

     ?>
