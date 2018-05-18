
<?php
session_start();
if(empty($_SESSION)){
  header("Location: ../index.php");
}
  include '../koneksi.php';
  $username = $_SESSION['username'];
  $SQL_DATA = $db->query("SELECT * FROM guru WHERE username='".$username."'");
  $data = $SQL_DATA->fetch_array();
  
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
          <li class="active"><a href="index.php">Beranda</a></li>
          <li><a href="tampil_guru.php">Guru</a></li>
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
    <div class="container white">
      <img class="responsive-img" src="../gambar/Logo.png">
    </div>
    <br>

    <div class="container white">
      <!-- <div class="row"> -->
      <h5 class="center-align"> Selamat Datang</h5>
      <div class="col s6 offset-s3">
        <table class="bordered striped">
          <thead>
            <tr>
                <th>Nama</th>
                <td>:</td>
                <td><?php echo $data["Nama"];?></td>
            </tr>
            <tr>
              <th>Alamat</th>
              <td>:</td>
              <td><?php echo $data["Alamat"]; ?></td>
            </tr>
            <tr>
                <th>Hp</th>
                <td>:</td>
                <td><?php echo $data["Handphone"]; ?></td>
            </tr>
            <tr>
                <th>Username</th>
                <td>:</td>
                <td><?php echo $data["username"]; ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td>:</td>
                <td><?php echo $data["password"]; ?></td>
            </tr>
          </thead>
        </table>
      </div>
      <br>
      <div class="center-align">
        <?php echo' <a href="editprofil.php?kode='.$data['Kd_guru'].'" class="waves-effect waves-light btn">Edit Username & Password </a>';?>
      </div>
      <br>
      <!-- </div> -->
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
        $( document ).ready(function()){

            $('.dropdown-button').dropdown();
        });
      
      </script>

</body>
</html>