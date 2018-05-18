
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

  include '../koneksi.php';
  
  $id = $_GET['kode'];
  $sql = "SELECT * FROM guru WHERE Kd_guru='$id'";
  $query = $db->query($sql);
  $data = $query->fetch_array();
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
      <li><a href="laporangaji.php"> Laporan Gaji </a></li>
      <li><a href="laporankgb.php"> Laporan KGB </a></li>
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
              $level=$_POST["level"];
              $a=$_POST["nama"];
              $b=$_POST["tempatlahir"];
              $c=date("Y-m-d",strtotime($_POST["tanggallahir"]));
              $d=$_POST["alamat"];
              $e=$_POST["jeniskelamin"];
              $f=$_POST["hp"];
              $h=$_POST["anak"];
              $i=$_POST["jarak"];
              $g=date("Y-m-d",strtotime($_POST["tanggalmasuk"]));
              $jabatan=$_POST['kdjabatan'];
              $golongan=$_POST['kdgolongan'];

              $sql="UPDATE guru SET Nama='$a',TempatLahir='$b', TanggalLahir='$c', Alamat='$d', JenisKelamin='$e', Handphone='$f', JarakRumah='$i', JumlahAnak='$h', Tanggal_masuk='$g', level='$level', Kd_jabatan='$jabatan', Kd_golongan='$golongan' WHERE Kd_guru='$id'";
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
                  <h5>Edit Data Guru </h5>    
                </div>
              </div>

              <!-- kode Guru --> 
              <div class="row center">
                <div class="input-field col s6 offset-s3">
                  <input name="kode" value="'.$data['Kd_guru'].'" id="Kode_guru" type="text" class="validate">
                  <label for="kode_guru">Kode Guru</label>
                </div>
              </div>

            <!-- Level -->
              <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <select name="level" required>';
                      if ($data['level']== "pimpinan") 
                        echo '<option value="pimpinan" selected>Pimpinan</option>';
                      else 
                        echo '<option value="pimpinan">Pimpinan</option>';
                      if ($data['level']== "admin") 
                        echo '<option value="admin" selected>Administrator</option>';
                      else
                        echo '<option value="admin">Administrator</option>';
                      if ($data['level']== "guru")
                        echo'<option value="guru" selected>Guru</option>';
                      else
                        echo '<option value="guru">Guru</option>';
                    echo'
                    </select>
                    <label>Pilih Level </label>
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

            <!--  Nama Pegawai  -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="nama" value="'.$data['Nama'].'" id="nama" type="text" class="validate">
                  <label for="nama">Nama Pegawai </label>
                </div>
              </div>

              <!-- Tempat Lahir  -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="tempatlahir" value="'.$data['TempatLahir'].'" id="TempatLahir" type="text" class="validate">
                  <label for="TempatLahir">Tempat Lahir  </label>
                </div>
              </div>

              <!--Tanggal Lahir-->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="tanggallahir" value="'.$data['TanggalLahir'].'" id="TanggalLahir" type="date" class="datepicker">
                  <label for="TanggalLahir">Tanggal Lahir </label>
                </div>
              </div>

              <!-- Alamat-->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="alamat" value="'.$data['Alamat'].'" id="Alamat" type="text" class="validate">
                  <label for="Alamat">Alamat </label>
                </div>
              </div>

              <!-- Pilih jenis kelamin -->
              <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <select name="jeniskelamin" required>';
                      if ($data['JenisKelamin']== "laki") 
                        echo '<option value="laki" selected>Laki-laki</option>';
                      else 
                        echo '<option value="laki">Laki-laki</option>';
                      if ($data['level']== "perempuan") 
                        echo '<option value="perempuan" selected>Perempuan</option>';
                      else
                        echo '<option value="perempuan">Perempuan</option>';
                      echo '
                    </select>
                    <label>Pilih jenis kelamin </label>
                  </div>
              </div>
              
              <!-- No Hp -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="hp" value="'.$data['Handphone'].'" id="handphone" type="text" class="validate">
                  <label for="handphone">No Handphone </label>
                </div>
              </div>

              <!-- Jumlah Anak -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="anak" value="'.$data['JumlahAnak'].'" id="anak" type="text" class="validate">
                  <label for="anak">Jumlah Anak </label>
                </div>
              </div>

              <!-- Jarak Rumah -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="jarak" value="'.$data['JarakRumah'].'" id="jarak" type="text" class="validate">
                  <label for="jarak">Jarak Rumah </label>
                </div>
              </div>
              
              <!--Tanggal Masuk-->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="tanggalmasuk" value="'.$data['Tanggal_masuk'].'" id="Tanggalmasuk" type="date">
                  
                </div>
              </div>
              
              <!-- ini Tombol -->
              <div class="row">
                <div class="col s6 offset-s5">
                  <a href="tampil_guru.php" class="btn waves-effect waves-light blue center">Kembali</a>
                   <button class="btn waves-effect waves-light center" type="submit" name="tambah">Ubah Data <i class="material-icons right">send</i>
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