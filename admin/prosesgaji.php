

<?php
session_start();
if(empty($_SESSION)){
  header("Location: ../index.php");
}
  include '../koneksi.php';

  date_default_timezone_set('Asia/Jakarta');

  if (isset($_POST['simpan'])) {
  	
  	$kdgaji = $_POST['kode'];
  	$tgl=date('y-m-d');
  	$kdguru=$_POST['nip'];

    // LOAD DATA TUNJANGAN STRUKTURAL
  	$kdjabatan=$_POST['kdjabatan'];
    $LOADJabatan = $db->query("SELECT * FROM jabatan WHERE Kd_jabatan='$kdjabatan'");
    $datajabatan = $LOADJabatan->fetch_array();
    $tunjanganstruktural = $datajabatan['TunjanganStruktural'];


  	$kdgolongan=$_POST['kdgolongan'];
    $LOADGolongan = $db->query("SELECT * FROM golongan WHERE Kd_golongan='$kdgolongan'");
    $datagolongan = $LOADGolongan->fetch_array();
    $gapok = $datagolongan['gapok'];    

  	$anak=$_POST['jumlahanak'];
    $kdanak=$_POST['kdanak'];
    $LOADanak = $db->query("SELECT * FROM t_anak WHERE Kd_Tanak='$kdanak'");
    $dataanak = $LOADanak->fetch_array();
    $Tanak = $dataanak['Tanak'];
    $tunjangananak = $anak * $Tanak;    

  	$jarak=$_POST['jarak'];
    if ($jarak < 5) {
    $jarak='dekat';
      }elseif ( 5 <= $jarak and $jarak <= 10) {
        $jarak ='sedang';
      }
      else{
        $jarak ='jauh';
      }

      $LOADjarak = $db->query("SELECT * FROM t_transportrasi WHERE NamaJarak='".$jarak."'");
        while ($row = mysqli_fetch_array($LOADjarak)) {
          $transport = $row['Tjarak'];
          $kdtransport = $row['Kd_transport'];      
        }

    $kdfungsional=$_POST['kdfungsional'];
  	$LOADfungsional = $db->query("SELECT * FROM t_fungsional WHERE Kd_fungsional='$kdfungsional'");
    $datafungsional = $LOADfungsional->fetch_array();
    $kisaran = $datafungsional['Jumlah'];
    $tunjanganfungsional = $gapok *($kisaran/100);


  	$totalgaji=$gapok+$tunjanganstruktural+$tunjanganfungsional+$transport+$tunjangananak;
    

 	$sql="INSERT INTO gaji VALUES('$kdgaji','$tgl','$kdguru','$kdjabatan','$kdgolongan','$kdtransport','A01','$kdfungsional','$totalgaji')";
   $hasil=mysqli_query($db,$sql);

       if($hasil) {
         echo"<script>window.alert('DATA BERHASIL DISIMPAN');;window.location='../admin/transaksigaji.php'</script>";
       } 
       else {
           echo $db->error;
       }
  }
?>