
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

include '../koneksi.php';
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
      <li class="active"><a href="form_kenaikanKGB.php"> Kenaikan Gaji</a></li>
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
        <div id="modal1" class="modal">
          <div class="modal-content">

          <?php
            if(isset($_POST["tambah"])) {

              $id=$_POST["kode"];
              $Kenaikan=$_POST["Kenaikan"];

              $sql="INSERT INTO kenaikan_kgb VALUES('$id','$Kenaikan')";
              $hasil=mysqli_query($db,$sql);

              if($hasil) {
                echo"<script>window.alert('DATA BERHASIL DISIMPAN');;window.location='../admin/form_kenaikanKGB.php'</script>";
              } 
                else {
                  echo $db->error;
                }     
            }

            echo'

              <form action="" method="POST">
                <div class="row">
                  <div class="center-align">
                    <h5>Input Data Kenaikan KGB </h5>    
                  </div>
                </div>

                 <!-- Kode Kenaikan  --> 
                <div class="row center">
                  <div class="input-field">
                    <input name="kode" required placeholder="Masukkan kode Kenaikan " id="Kd_kenaikan" type="text" class="validate">
                    <label for="Kd_kenaikan">Kode kenaikan </label>
                  </div>
                </div>

                <!-- Jumlah  kenaikan -->
                <div class="row">
                  <div class="input-field">
                    <input name="Kenaikan" required placeholder="Masukkan Jumlah kenaikan" id="Kenaikan" type="text" class="validate">
                    <label for="Kenaikan">jumlah kenaikan </label>
                  </div>
                </div>

                <!-- ini Tombol -->
                <div class="row">
                  <div class="input-field center-align">
                    <button class="btn waves-effect waves-light center" type="submit" name="tambah">Tambah Data <i class="material-icons right">send</i>
                    </button> 
                  </div>
                </div>          
                <br>      
              </form>';?>
        </div>
      </div>
    <!-- Form -->
    <!-- Tampil data -->
      <div class="row">
          <div class="col s10 offset-s1">
            <h5 class="center-align">Kenaikan KGB</h5>
            <table class="bordered highlight responsive-table">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kenaikan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $sql = "SELECT * FROM kenaikan_kgb";
                $query = $db->query($sql);
                $no =1;
                while ($row = $query->fetch_array()){;?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $row["Kd_kenaikan"]; ?></td>
                      <td><?php echo $row["Kenaikan"]; ?> %</td>
                      <td>
                        <?php echo' <a href="editkenaikanKGB.php?kode='.$row['Kd_kenaikan'].'" class="waves-effect waves-light btn">Edit Data </a>';?>
                        <?php echo' <a href="delkenaikanKGB.php?kode='.$row['Kd_kenaikan'].'" class="waves-effect waves-light red btn">Hapus Data </a>';?>
                      </td>
                        
                      <?php } ?>
                    </tr>
               </tbody>
            </table>
        </div>
      </div>
      <!-- Tampil Data -->

      <!-- button modal -->
      <div class="row">
        <div class="col s2 offset-s1">
          <a class="waves-effect waves-light btn green modal-trigger" href="#modal1">Tambah</a>
        </div>
      </div>
      <!-- button modal -->
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
      <script type="text/javascript" src="../asset/js/materialize.min.js"></script>
      <script type="text/javascript">
        $( document ).ready(function(){

            $('.dropdown-button').dropdown();
            $('.modal').modal();
        });
      </script>
</body>
</html>


          