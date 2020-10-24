<?php 

    include "../../inc/config.php"; 

    error_reporting(0);

 ?>
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