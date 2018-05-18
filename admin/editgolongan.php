
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

  include '../koneksi.php';
  $id = $_GET['kode'];
  $sql = "SELECT * FROM golongan WHERE Kd_golongan='$id'";
  $query = $db->query($sql);
  $data = $query->fetch_array();
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
          <li><a href="tampil_guru.php">Guru</a></li>
          <li><a href="form_jabatan.php">Jabatan </a></li>
          <li class="active"><a href="form_golongan.php">Golongan</a></li>
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

    <div class="container white">

      <!-- form tambah Data golongan -->
            <?php

                  if(isset($_POST["tambah"])) {

                    $id=$_POST["kode"];
                    $nama=$_POST["nama"];
                    $gapok=$_POST["gapok"];

                    $sql="UPDATE golongan SET Nm_golongan='$nama',gapok='$gapok' WHERE Kd_golongan='$id'";
                    $hasil=mysqli_query($db,$sql);

                    if($hasil) {
                      echo"<script>window.alert('DATA BERHASIL DISIMPAN');;window.location='../admin/form_golongan.php'</script>";
                    } 
                      else {
                        echo $db->error;
                      }     
                  }

                  echo'

            <form action="" method="POST">
              <div class="row">
                <div class="center-align">
                  <h5>Ubah Data  Golongan </h5>    
                </div>
                
              </div>

              <!-- kode Golongan --> 
              <div class="row center">
                <div class="input-field col s6 offset-s3">
                  <input name="kode" value="'.$data['Kd_golongan'].'" id="Kode_golongan" type="text" class="validate">
                  <label for="kode_golongan">Kode Golongan</label>
                </div>
              </div>
            <!--  Nama Golongan  -->
              <div class="row">
                  <div class="input-field col s6 offset-s3">
                      <input name="nama" value="'.$data['Nm_golongan'].'" id="nama_golongan" type="text" class="validate">
                      <label for="nama_golongan">Nama Golongan</label>
                  </div>
              </div>

            <!--  GAPOK  -->
              <div class="row">
                  <div class="input-field col s6 offset-s3">
                      <input name="gapok" value="'.$data['gapok'].'" id="gapok" type="text" class="validate">
                      <label for="gapok">Gaji Pokok</label>
                  </div>
              </div>

              <!-- ini Tombol -->
              <div class="row">
                <div class="input-field center-align">
                  <a href="form_golongan.php" class="btn waves-effect waves-light blue center">Kembali</a>
                  <button class="btn waves-effect waves-light center" type="submit" name="tambah">Ubah Data <i class="material-icons right">send</i>
                  </button> 
                </div>
              </div>          
            <br>
            </form>';?>
    </div>
    <br>

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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script type="text/javascript" src="../asset/js/materialize.min.js"></script>
      <script type="text/javascript">
        $( document ).ready(function(){

            $('.dropdown-button').dropdown();
            $('.modal').modal();
        });
      </script>
</body>
</html>