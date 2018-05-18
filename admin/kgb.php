
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

  include '../koneksi.php';

  $n=$_GET['kode'];
  $sql = "SELECT * FROM guru WHERE Kd_guru='$n'";
  $query = $db->query($sql);
  $data = $query->fetch_array();
  $nip = $data['Kd_guru'];
  $nama = $data['Nama'];
  $golongan = $data['Kd_golongan'];

  $cari=mysqli_query($db,"SELECT MAX(Kd_kgb) FROM kgb");
      $data=mysqli_fetch_array($cari);
        
        if($data) {
          $nilaikode = substr($data[0], 1);
          // menjadikan $nilaikode ( int )
          $kode = (int) $nilaikode;
          // setiap $kode di tambah 1
          $kode = $kode + 1;
          $kode_otomatis = "K".str_pad($kode, 2, "0", STR_PAD_LEFT);
        } 
          else {
            $kode_otomatis = "K01";
          }
  
?>


<!DOCTYPE html>
<html>
<head>
  <title> Aplikasi Kenaikan Gaji Berkala  </title>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../asset/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body background="../Gambar/Hijau.jpg">

  <!-- Dropdown Structure -->
    <ul id="dropdown1" class="dropdown-content">
      <li><a href="form_Tanak.php">Tunjangan Anak</a></li>
      <li><a href="T_transport.php"> Tunjangan transportasi</a></li>
      <li><a href="t_fungsional.php"> Tunjangan fungsional</a></li>
      <li><a href="form_kenaikanKGB.php"> Kenaikan Gaji</a></li>
    </ul>

    <!-- Dropdown Structure 2 -->
    <ul id="dropdown2" class="dropdown-content">
      <li><a href="transaksigaji.php"> Gaji </a></li>
      <li class="active"><a href="tampil_kgb.php"> KGB </a></li>
    </ul>
 <!-- Dropdown Structure 3 -->
    <ul id="dropdown3" class="dropdown-content">
      <li><a href="laporangaji.php"> Laporan Gaji </a></li>
      <li><a href="laporankgb.php"> Laporan KGB </a></li>
    </ul>

    <nav>
      <div class="nav-wrapper  deep-purple darken-2">
        <a href="index.php" class="brand-logo">SD IT SAHABAT </a>
        <ul class="right hide-on-med-and-down">
          <li><a href="index.php">Beranda</a></li>
          <li><a href="tampil_guru.php">Guru</a></li>
          <li><a href="form_jabatan.php">Jabatan </a></li>
          <li><a href="form_golongan.php">Golongan</a></li>
          <!-- Dropdown Trigger -->
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Tunjangan<i class="material-icons right">keyboard_arrow_down</i></a></li>
          <!-- Dropdown Trigger 2 -->
          <li class="active"><a class="dropdown-button" href="#!" data-activates="dropdown2">Transaksi<i class="material-icons right">keyboard_arrow_down</i></a></li>
          <!-- Dropdown Trigger 3 -->
          <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Laporan<i class="material-icons right">keyboard_arrow_down</i></a></li>
          <li><a href="../logout.php">Keluar </a></li>
        </ul> 
      </div>
    </nav>
    <!-- isi  -->
      <div class="container">
         <img class="responsive-img" src="../gambar/Logo.png">
      </div>
      <br>
     <!-- KGB-->
    <div class="container white">
      <form action="proseskgb.php" method="POST">
        <div class="row">
          <div class="col s5 offset-s5">
            <h5> KGB </h5>    
        </div>  
        </div>
        
         <!--  kode KGB -->
        <div class="row">
            <div class="input-field col s6 offset-s3">
              <input readonly value="<?php echo $kode_otomatis ?>" name="kode" id="kode_kgb" type="text" class="validate">
              <label for="kode_kgb">Kode KGB </label>
            </div>
        </div>
        
        <div class="row">
          <div class="input-field col s6 offset-s3">
              <input readonly value="<?php echo $nip ?>" name="nip" id="nip" type="text" class="validate">
              <label>NIP</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6 offset-s3">
              <input readonly value="<?php echo $nama ?>" name="nama" id="nama" type="text" class="validate">
              <label>Nama Guru</label>
          </div>
        </div>
          
        <!--  kode Golongan -->
        <div class="row">
          <div class="input-field col s6 offset-s3">
              <input readonly value="<?php echo $golongan ?>" name="kdgolongan" id="golongan" type="text" class="validate">
              <label>Golongan</label>
          </div>
        </div>
        
        <div class="row">
          <div class="input-field col s6 offset-s3">
              <?php
                $SQL_Data = $db->query("SELECT * FROM kenaikan_kgb");  
                  echo '<select name="kdkenaikankgb">';  
                  echo '<option>Pilih Besar Kenaikan</option>';  
                    while ($row = mysqli_fetch_array($SQL_Data)) {  
                      echo'<option value="' . $row['Kd_kenaikan'] . '">'.$row['Kenaikan'].' %</option>';      
                    }  
                  echo '<select/>';
              ?>
              
              <label>Besar Kenaikan</label>
            </div>
        </div>
        
        <!-- ini Tombol -->
        <div class="row">
          <div class="col s6 offset-s5">
            <button class="btn waves-effect waves-light center" type="submit" name="simpan">Proses<i class="material-icons right">send</i>
             </button> 
          </div>
        </div>
        </div>
      </form>          
      <br>      

 <!--bagian footer-->
      <footer class="page-footer  deep-purple darken-2">                
          <div class="footer-copyright">
            <div>
            © 2018 Copyright Yuli Aridwan   
            </div>
          </div>
        </footer>
        <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../asset/js/materialize.min.js"></script>
      <script type="text/javascript">
            $(document).ready(function(){
              $('.dropdown-button').dropdown();
              $('select').material_select(); 
            });
      </script>
        
</body>
</html>