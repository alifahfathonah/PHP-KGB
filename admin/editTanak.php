
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

include '../koneksi.php';
  $id = $_GET['kode'];
  $sql = "SELECT * FROM t_anak WHERE Kd_Tanak='$id'";
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
      <li class="active"><a href="form_Tanak.php">Tunjangan Anak</a></li>
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
          <li><a href="form_golongan.php">Golongan</a></li>
          <!-- Dropdown Trigger -->
          <li class="active"><a class="dropdown-button" href="#!" data-activates="dropdown1">Tunjangan<i class="material-icons right">keyboard_arrow_down</i></a></li>
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

      <!-- form tambah Tunjangan Struktural -->

          <?php
            if(isset($_POST["tambah"])) {

              $id=$_POST["kode"];
              $anak=$_POST["jumlahanak"];
              $jumlah=$_POST["jumlah"];
              $sql="UPDATE t_anak SET jumlah='$jumlah',jumlah='$anak' WHERE Kd_Tanak='$id'";
              $hasil=mysqli_query($db,$sql);

              if($hasil) {
                echo"<script>window.alert('DATA BERHASIL DISIMPAN');;window.location='../admin/form_Tanak.php'</script>";
              } 
                else {
                  echo $db->error;
                }     
            }

            echo'
 
              <form action="" method="POST">
                <div class="row">
                  <div class="center-align">
                    <h5>Ubah Data Tunjangan Anak </h5>    
                  </div>
                </div>

                 <!-- Kode Tunjangan Anak  --> 
                <div class="row center">
                  <div class="input-field col s6 offset-s3">
                    <input name="kode" value="'.$data['Kd_Tanak'].'" id="Kd_anak" type="text" class="validate">
                    <label for="Kd_anak">Kode Tunjangan </label>
                  </div>
                </div>

                <!-- Jumlah  anak -->
                <div class="row">
                 <div class="input-field col s6 offset-s3">
                  <div class="input-field">
                    <input name="jumlahanak" required placeholder="Masukkan Jumlah Anak" id="jumlahanak" value="'.$data['jumlah'].'"jumlahanak="jumlahanak"type="text" class="validate">
                    <label for="jumlahanak">Jumlah Anak  </label>
                  </div>
                </div>

                <!-- Jumlah  Tunjangan anak -->
                <div class="row">
                  <div class="input-field col s6 offset-s3">
                    <input name="jumlah" value="'.$data['Tanak'].'" id="Tstruktural" type="text" class="validate">
                    <label for="Tstruktural">Jumlah Tunjangan Anak  </label>
                  </div>
                </div>

                <!-- ini Tombol -->
                <div class="row">
                  <div class="input-field center-align">
                    <a href="form_Tanak.php" class="btn waves-effect waves-light blue center">Kembali</a>
                    <button class="btn waves-effect waves-light center" type="submit" name="tambah">Ubah Data <i class="material-icons right">send</i>
                    </button> 
                  </div>
                </div>          
                <br>      
              </form>';?>
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
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../asset/js/materialize.min.js"></script>
      <script type="text/javascript">
        $( document ).ready(function(){

            $('.dropdown-button').dropdown();
            $('.modal').modal();
        });
      </script>
</body>
</html>


          