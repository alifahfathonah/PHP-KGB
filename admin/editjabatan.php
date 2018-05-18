
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

include '../koneksi.php';

  $id = $_GET['kode'];
  $sql = "SELECT * FROM jabatan WHERE Kd_jabatan='$id'";
  $query = $db->query($sql);
  $data = $query->fetch_array();

  // $id = $_GET['kode'];
  // $SQL_DATA = $aqua->query("SELECT * FROM jabatan WHERE idfauna='$id'");
  // $data = $SQL_DATA->fetch_array();

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
          <li><a href="tampil_guru.php">Guru</a></li>
          <li class="active"><a href="form_jabatan.php">Jabatan </a></li>
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

    <div class="container white">

      <!-- form tambah Data Jabatan -->
            <?php

            if(isset($_POST["tambah"])) {

              $id=$_POST["kode"];
              $nama=$_POST["nama"];
              $tunjangan=$_POST["tunjangan"];

              $sql="UPDATE jabatan SET Nm_jabatan='$nama',TunjanganStruktural='$tunjangan' WHERE Kd_jabatan='$id'";
              $hasil=mysqli_query($db,$sql);

              if($hasil) {
                echo"<script>window.alert('DATA BERHASIL DISIMPAN');;window.location='../admin/form_jabatan.php'</script>";
              } 
                else {
                  echo $db->error;
                }     
            }

            echo'

            <form action="" method="POST">
              <div class="row">
                <div class="center-align">
                  <h5>Ubah Data Jabatan </h5>    
                </div>
              </div>

              <!-- kode jabatan --> 
              <div class="row center">
                <div class="input-field col s6 offset-s3">
                  <input name="kode" value="'.$data['Kd_jabatan'].'" id="Kode_jabatan" type="text" class="validate">
                  <label for="kode_jabatan">Kode jabatan</label>
                </div>
              </div>

            <!--  Nama Jabatan  -->
              <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <input name="nama" value="'.$data['Nm_jabatan'].'" id="nama_jabatan" type="text" class="validate">
                    <label for="nama_golongan">Nama Jabatan</label>
                  </div>
              </div>


            <!--  Tunjangan  -->
              <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <input name="tunjangan" value="'.$data['TunjanganStruktural'].'" id="tunjangan" type="text" class="validate">
                    <label for="tunjangann">Jumlah Tunjangan</label>
                  </div>
              </div>

            <!-- ini Tombol -->
              <div class="row">
                <div class="input-field center-align">
                  <a href="form_jabatan.php" class="btn waves-effect waves-light blue center">Kembali</a>
                  <button class="btn waves-effect waves-light center" type="submit" name="tambah">Ubah Data <i class="material-icons right">send</i>
                  </button> 

                </div>
              </div>
              <br>
            </form>';
            ?>
      <!-- Form -->

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