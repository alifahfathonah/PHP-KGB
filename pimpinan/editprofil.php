
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

  <!-- Dropdown Structure 2 -->
    <ul id="dropdown2" class="dropdown-content">
      <li><a href="Tampil_Tanak.php">Tunjangan Anak </a></li>
      <li><a href="Tampil_Tjarak.php">Tunjangan Transportasi </a></li>
    </ul>
	 <!-- MENU -->
  <nav>
      <div class="nav-wrapper  deep-purple darken-2">
        <a href="index.php" class="brand-logo">SD IT SAHABAT </a>
        <ul class="right hide-on-med-and-down">
          <li class="active"><a href="index.php">Beranda</a></li>
          <li><a href="absensi.php">Absensi</a></li>
          <li><a href="Tampil_guru.php">Guru</a></li>
           <li><a href="Tampil_Jabatan.php">Jabatan</a></li>
           <li><a href="Tampil_golongan.php">Golongan</a></li>
          <li><a href="gaji.php">Gaji</a></li>  
           <!-- Dropdown Trigger 2 -->
          <li><a class="dropdown-button" href="#!" data-activates="dropdown2">Tunjangan<i class="material-icons right">keyboard_arrow_down</i></a></li> 
          <li><a href="../logout.php">Keluar</a></li>
        </ul> 
      </div>
    </nav>
<!-- MENU -->

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


              $sql="UPDATE guru SET username='$username', password='$password' WHERE Kd_guru='$id'";
              $hasil=mysqli_query($db,$sql);

              if($hasil) {
                echo"<script>window.alert('DATA BERHASIL DISIMPAN');;window.location='../logout.php'</script>";
              } 
                else {
                  echo $db->error;
                }     
            }

            echo'


            <form action="" method="POST">
              <div class="row">
                <div class="col s6 offset-s5">
                  <h5>Edit Data Pimpinan </h5>    
                </div>
              </div>

              <!-- kode guru --> 
              <div class="row center">
                <div class="input-field col s6 offset-s3">
                  <input name="kode" value="'.$data['Kd_guru'].'" id="Kode_guru" type="text" class="validate">
                  <label for="kode_guru">Kode Guru</label>
                </div>
              </div>

            <!--  username  -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="username" value="'.$data['username'].'" id="username" type="text" class="validate">
                  <label for="username">Username </label>
                </div>
              </div>

              <!-- Tempat Lahir  -->
              <div class="row">
                <div class="input-field col s6 offset-s3">
                  <input name="password" value="'.$data['password'].'" id="password" type="text" class="validate">
                  <label for="password">Password</label>
                </div>
              </div>
            
              <!-- ini Tombol -->
              <div class="row">
                <div class="col s6 offset-s5">
                  <a href="index.php" class="btn waves-effect waves-light blue center">Kembali</a>
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
            });
      </script>
        
</body>
</html>