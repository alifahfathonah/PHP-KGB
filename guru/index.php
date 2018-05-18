
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
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../asset/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body background="../Gambar/Hijau.jpg">

  <!-- Menu -->
    <nav>
      <div class="nav-wrapper  deep-purple darken-2">
        <a href="index.php" class="brand-logo">SD IT SAHABAT </a>
        <ul class="right hide-on-med-and-down">
          <li class="active"><a href="index.php">Beranda</a></li>
          <li><a href="gaji.php">Gaji</a></li>
          <li><a href="../logout.php">Keluar</a></li>
        </ul> 
      </div>
    </nav>
    <!-- Menu -->

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

    </div>
  
      
      <!--bagian footer-->
      <footer class="page-footer  deep-purple darken-2">
                        
        <div class="footer-copyright">
          
        </div>
      </footer>
      <!--bagian footer-->

  <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../asset/js/materialize.min.js"></script>
      <script type="text/javascript">
        $( document ).ready(function()){
            $('.button-collapse').sideNav();
            $('.dropdown-button').dropdown();
        });
      
      </script>

</body>
</html>