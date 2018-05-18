
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');
  $tgl=date('d-m-Y');


  $cari=mysqli_query($db,"SELECT MAX(Kd_guru) FROM guru");
      $data=mysqli_fetch_array($cari);
        
        if($data) {
          $nilaikode = substr($data[0], 1);
          // menjadikan $nilaikode ( int )
          $kode = (int) $nilaikode;
          // setiap $kode di tambah 1
          $kode = $kode + 1;
          $kode_otomatis = "G".str_pad($kode, 2, "0", STR_PAD_LEFT);
        } 
          else {
            $kode_otomatis = "G01";
          }
?>

<!DOCTYPE>
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
      <li><a href="tampil_kgb.php"> KGB </a></li>
    </ul>
 <!-- Dropdown Structure 3 -->
    <ul id="dropdown3" class="dropdown-content">
      <li><a href="../laporan/laporan.php" target="_blank"> Laporan Gaji </a></li>
      <li><a href="../laporan/laporankgb.php" target="_blank"> Laporan KGB </a></li>
      <li><a href="../laporan/laporanslip.php" target="_blank"> Laporan Slip Gaji </a></li>
    </ul>

    <nav>
      <div class="nav-wrapper  deep-purple darken-2">
        <a href="index.php" class="brand-logo">SD IT SAHABAT </a>
        <ul class="right hide-on-med-and-down">
          <li><a href="index.php">Beranda</a></li>
          <li class="active"><a href="tampil_guru.php">Guru</a></li>
          <li><a href="form_jabatan.php">Jabatan </a></li>
          <li><a href="form_golongan.php">Golongan</a></li>
          <!-- Dropdown Trigger -->
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Tunjangan<i class="material-icons right">keyboard_arrow_down</i></a></li>
          <!-- Dropdown Trigger 2 -->
          <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Transaksi<i class="material-icons right">keyboard_arrow_down</i></a></li>
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

    <!-- ini form tambah Data Guru  -->
    <div class="container white">

            <?php

            if(isset($_POST["tambah"])) {

              $id=$_POST["kode"];
              $username=$_POST["username"];
              $password=$_POST["password"];
              $level=$_POST["level"];
              $a=$_POST["nama"];
              $b=$_POST["tempatlahir"];
              $c=date("Y-m-d",strtotime($_POST["tanggallahir"]));
              $d=$_POST["alamat"];
              $e=$_POST["jeniskelamin"];
              $f=$_POST["hp"];
              $h=$_POST["anak"];
              $i=$_POST["jarak"];
              date_default_timezone_set('Asia/Jakarta');
              $tgl=date('Y-m-d');
              $g=$_POST["kdjabatan"];
              $z=$_POST["kdgolongan"];


              $sql="INSERT INTO guru VALUES('$id','$username','$password','$level','$a','$b','$c','$d','$e','$f','$i','$h','$tgl','$g','$z')";
              $hasil=mysqli_query($db,$sql);

              if($hasil) {
                echo"<script>window.alert('DATA BERHASIL DISIMPAN');;window.location='../admin/tampil_guru.php'</script>";
              } 
                else {
                  echo $db->error;
                }     
            }

            echo'


            <form action="" method="POST">
              <div class="row">
                <div class="col s6 offset-s5">
                  <h5>Input Data Guru </h5>    
                </div>
              </div>

              <!-- kode Guru --> 
              <div class="row center">
                <div class="input-field col s6 offset-s3">
                  <input name="kode" required value="'; echo $kode_otomatis; echo'" id="Kode_guru" type="text" class="validate">
                  <label for="kode_guru">NIP</label>
                </div>
              </div>

            <!--  Username  -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="username" required placeholder="Masukkan username" id="a" type="text" class="validate">
                  <label for="a">Username </label>
                </div>
              </div>

            <!--  Password  -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="password" required placeholder="Masukkan password" id="b" type="text" class="validate">
                  <label for="b">Password </label>
                </div>
              </div>

            <!-- Level -->
              <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <select name="level" required>
                      <option value="pimpinan">Pimpinan</option>
                      <option value="admin">Administrator</option>
                      <option value="guru">Guru</option>
                    </select>
                    <label>Pilih Jabatan </label>
                  </div>
              </div>

            <!--  Nama Pegawai  -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="nama" required placeholder="Masukkan nama pegawai" id="nama" type="text" class="validate">
                  <label for="nama">Nama Guru </label>
                </div>
              </div>

              <!-- Tempat Lahir  -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="tempatlahir" required placeholder="Masukkan Tempat Lahir" id="TempatLahir" type="text" class="validate">
                  <label for="TempatLahir">Tempat Lahir  </label>
                </div>
              </div>

                <!--Tanggal Lahir-->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="tanggallahir" required id="TanggalLahir" type="date" class="datepicker">
                  <label for="TanggalLahir">Tanggal Lahir </label>
                </div>
              </div>

              <!-- Alamat-->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="alamat" required placeholder="Masukkan Alamat" id="Alamat" type="text" class="validate">
                  <label for="Alamat">Alamat </label>
                </div>
              </div>

              <div class="row">

                <div class="input-field col s6 offset-s3">';
                  
                    $SQL_Data = $db->query("SELECT * FROM jabatan");  
                      echo '<select name="kdjabatan" onchange="changeValue(this.value)">';  
                      echo '<option>Pilih Jabatan</option>';  
                        while ($row = mysqli_fetch_array($SQL_Data)) {  
                          echo'<option value="' . $row['Kd_jabatan'] . '">'.$row['Kd_jabatan'].'  ('.$row['Nm_jabatan'].')</option>';        
                        }  
                      echo '<select/>
                  
                  
                  <label>Jabatan</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s6 offset-s3">';
                  
                    $SQL_Data = $db->query("SELECT * FROM golongan");  
                      echo '<select name="kdgolongan" onchange="changeValue(this.value)">';  
                      echo '<option>Pilih Golongan</option>';  
                        while ($row = mysqli_fetch_array($SQL_Data)) {  
                          echo'<option value="' . $row['Kd_golongan'] . '">'.$row['Kd_golongan'].'  ('.$row['Nm_golongan'].')</option>';      
                        }  
                      echo '<select/>
              
                  
                  <label>Golongan</label>
                </div>
              </div>

              <!-- Pilih jenis kelamin -->
              <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <select name="jeniskelamin" required>
                      <option value="laki">Laki-laki</option>
                      <option value="perempuan">Perempuan</option>
                    </select>
                    <label>Pilih jenis kelamin </label>
                  </div>
              </div>
              
              <!-- No Hp -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="hp" required placeholder="Masukkan  No handphone " id="handphone" type="text" class="validate">
                  <label for="handphone">No Handphone </label>
                </div>
              </div>

              <!-- Jumlah Anak -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="anak" required placeholder="Masukkan  Jumlah Anak " id="anak" type="text" class="validate">
                  <label for="anak">Jumlah Anak </label>
                </div>
              </div>

              <!-- Jarak Rumah -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="jarak" required placeholder="Masukkan  Jarak Rumah " id="jarak" type="text" class="validate">
                  <label for="jarak">Jarak Rumah </label>
                </div>
              </div>
              
              <!--Tanggal Masuk-->
               <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input readonly name="tanggalmasuk" id="TanggalMasuk" type="text" value="'; echo $tgl; echo'">
                </div>
              </div>
              
              <!-- ini Tombol -->
              <div class="row">
                <div class="col s6 offset-s5">
                   <button class="btn waves-effect waves-light center" type="submit" name="tambah">Tambah Data <i class="material-icons right">send</i>
                   </button> 
                </div>
              </div>
              <br>
            </form>';?>
    </div>               

 <!--bagian footer-->
      <footer class="page-footer  deep-purple darken-2">
                        
        <div class="footer-copyright">
          <div class="container center-align">
            <div>
              2018 Copyright Yuli Aridwan   
            </div>
          </div>
        </div>
      </footer>
  <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../asset/js/materialize.min.js"></script>
      <script type="text/javascript">
            $(document).ready(function(){
  
            $('.dropdown-button').dropdown();
            
            $('.datepicker').pickadate({
              selectMonths: true, // Creates a dropdown to control month
              selectYears: 120,

            });
            $('select').material_select(); 
            });
      </script>
        
</body>
</html>