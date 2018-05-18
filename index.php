
<?php
session_start();
if($_SESSION){
  header("Location: logout.php");
}
?>

<!DOCTYPE html>
<html>
<head>
      <title> Aplikasi Kenaikan Gaji Berkala  </title>
  <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="asset/css/materialize.min.css"  media="screen,projection"/>

  <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body background="Gambar/Hijau.jpg">

    <nav>
      <div class="nav-wrapper  deep-purple darken-2">
        <a href="#!" class="brand-logo">SD IT SAHABAT</a>
      </div>
    </nav> 
    <!-- isi  -->

    <div class="container">
      <img class="responsive-img" src="gambar/Logo.png">
    </div>
    <br>

      <!-- ini form login  -->
    <div class="container white">

      <?php
        if(isset($_POST['login'])){
          include("koneksi.php");
          
          $username = $_POST['username'];
          $password = $_POST['password'];
        //  $level    = $_POST['level'];
          
          $query = mysqli_query($db, "SELECT * FROM guru WHERE username='$username' AND password='$password'");
          if(mysqli_num_rows($query) == 0){
            echo '<div class="alert alert-danger">Upss...!!! Login gagal.</div>';
          }else{
            $row = mysqli_fetch_assoc($query);
            
            if($row['level'] == 'admin'){
              $_SESSION['username']=$username;
              $_SESSION['level']='admin';
              header("Location: ./admin/index.php");
            }else if($row['level'] == 'guru'){
              $_SESSION['username']=$username;
              $_SESSION['level']='guru';
              header("Location: ./guru/index.php");
            }else if($row['level'] == 'pimpinan'){
              $_SESSION['username']=$username;
              $_SESSION['level']='pimpinan';
              header("Location: ./pimpinan/index.php");
            }else{
              echo '<div class="alert alert-danger">Upss...!!! Login gagal.</div>';
            }
          }
        }
        ?>


      <form action="" method="POST">
        <div class="row">
          <div class="center-align">
            <h5>FORM LOGIN</h5>    
          </div>
          
        </div>

        <!-- ini username --> 
        <div class="row">
          <div class="input-field col s6 offset-s3">
            <i class="material-icons prefix">account_circle</i>
            <input id="icon_prefix" type="text" autofocus="autofocus" name="username" class="validate">
            <label for="icon_prefix">Username</label>
          </div>
        </div>

        <!--   ini password -->
        <div class="row">
            <div class="input-field col s6 offset-s3">
            <i class="material-icons prefix">lock_outline</i>
            <input id="icon_prefix" type="password" name="password" class="validate">
            <label for="icon_prefix">Password</label>
            </div>
        </div>

        <!-- ini pilih jabatan -->
        <!-- <div class="row">
            <div class="input-field col s6 offset-s3">
              <select name="level">
                <option value="">Pilih Jabatan</option>
                <option value="admin">Admin</option>
                <option value="guru">Guru</option>
                <option value="pimpinan">Pimpinan</option>
              </select>
              <label>Pilih jabatan </label>
            </div>
        </div> -->
        <!-- ini Tombol -->
        <div class="row">
          <div class="center-align">
            <button class="btn waves-effect waves-light center" type="submit" name="login">LOGIN<i class="material-icons right">send</i>
            </button>
          </div>
        </div>

      </form>
      <br>
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
      <script type="text/javascript" src="asset/js/materialize.min.js"></script>
      <script type="text/javascript">
        
        $(document).ready(function() {
          $('select').material_select();
        });
      </script>
      
</body>
</html>