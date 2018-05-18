

<?php
session_start();
if(empty($_SESSION)){
  header("Location: ../index.php");
}
  include '../koneksi.php';

  date_default_timezone_set('Asia/Jakarta');

  if (isset($_POST['simpan'])) {
  	
  	$kdkgb = $_POST['kode'];
  	$tgl=date('y-m-d');
  	$kdguru=$_POST['nip'];


  	$kdgolongan=$_POST['kdgolongan'];
    $LOADGolongan = $db->query("SELECT * FROM golongan WHERE Kd_golongan='$kdgolongan'");
    $datagolongan = $LOADGolongan->fetch_array();
    $gapok = $datagolongan['gapok'];    

    $kdkenaikan = $_POST['kdkenaikankgb'];
    $LOADkenaikan = $db->query("SELECT * FROM kenaikan_kgb WHERE Kd_kenaikan='$kdkenaikan'");
    $datakenaikan = $LOADkenaikan->fetch_array();
    $jumlah = $datakenaikan['Kenaikan'];
    $persentase = $jumlah/100;
  	$totalkenaikan=$gapok*$persentase;
    

 	$sql="INSERT INTO kgb VALUES('$kdkgb','$kdguru','$kdgolongan','$kdkenaikan','$totalkenaikan')";
   $hasil=mysqli_query($db,$sql);

       if($hasil) {
         echo"<script>window.alert('DATA BERHASIL DISIMPAN');;window.location='../admin/tampil_kgb.php'</script>";

         $sql1="UPDATE guru SET Tanggal_masuk='$tgl' WHERE Kd_guru='$kdguru'";
              $hasil1=mysqli_query($db,$sql1);
       } 
       else {
           echo $db->error;
       }
  }
?>