
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

  include '../koneksi.php';
  $perhalaman = 3;
  $data = mysqli_query($db,"SELECT * FROM jabatan");
  $jumlahdata = mysqli_num_rows($data);
  $jumhalaman = ceil($jumlahdata / $perhalaman);
  $halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] :1;
  $awaldata = ($perhalaman * $halamanaktif) - $perhalaman;
  $no=$awaldata + 1;
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
      <div id="modal1" class="modal">
          <div class="modal-content">

            <?php

            if(isset($_POST["tambah"])) {

              $id=$_POST["kode"];
              $nama=$_POST["nama"];
              $tunjangan=$_POST["tunjangan"];

              $sql="INSERT INTO jabatan VALUES('$id','$nama','$tunjangan')";
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
                  <h5>Input Data Jabatan </h5>    
                </div>
              </div>

              <!-- kode jabatan --> 
              <div class="row center">
                <div class="input-field">
                  <input name="kode" required placeholder="kode jabatan" id="Kode_jabatan" type="text" class="validate">
                  <label for="kode_jabatan">Kode jabatan</label>
                </div>
              </div>

            <!--  Nama Jabatan  -->
              <div class="row">
                  <div class="input-field">
                    <input name="nama" required placeholder="Masukkan data jabatan" id="nama_jabatan" type="text" class="validate">
                    <label for="nama_golongan">Nama Jabatan</label>
                  </div>
              </div>

            <!--  Jumlah Tunjangan  -->
              <div class="row">
                  <div class="input-field">
                    <input name="tunjangan" required placeholder="Masukkan Jumlah Tunjangan" id="tunjangan" type="text" class="validate">
                    <label for="tunjangan">Jumlah Tunjangan</label>
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
            </form>';
            ?>

        </div>
      </div>
      <!-- Form -->

      <!-- Tampil data -->
      <div class="row">
          <div class="col s10 offset-s1">
            <h5 class="center-align">Data Jabatan</h5>
            <table class="bordered highlight responsive-table">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Jabatan</th>
                    <th>Nama Jabatan</th>
                    <th>Tunjangan Struktural</th>
                    <th>Aksi</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $sql = "SELECT * FROM jabatan LIMIT $awaldata, $perhalaman";
                $query = $db->query($sql);
                while ($row = $query->fetch_array()){;?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $row["Kd_jabatan"]; ?></td>
                      <td><?php echo $row["Nm_jabatan"]; ?></td>
                      <td>Rp <?php echo number_format($row["TunjanganStruktural"],0,",","."); ?> ,-</td>
                      <td>
                        <?php echo' <a href="editjabatan.php?kode='.$row['Kd_jabatan'].'" class="waves-effect waves-light btn">Edit Data </a>';?>
                        <?php echo' <a href="deljab.php?kode='.$row['Kd_jabatan'].'" class="waves-effect waves-light red btn">Hapus Data </a>';?>
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
      <!-- Paging -->  
      <div class="row">
        <div class="col s10 offset-s1">
        <ul class="pagination">
          <?php if( $halamanaktif > 1) : ?>
            <li class="waves-effect"><a href="form_jabatan.php?halaman=<?php echo $halamanaktif - 1; ?>"><i class="material-icons">skip_previous</i></a></li>
          <?php endif; ?>

          <?php for( $i = 1; $i <= $jumhalaman; $i++) : ?>
              <?php if( $i == $halamanaktif) : ?>
                <li class="active"><a href="form_jabatan.php?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
              <?php else : ?>
                <li class="waves-effect"><a href="form_jabatan.php?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
              <?php endif; ?>
          <?php endfor; ?>

          <?php if( $halamanaktif < $jumhalaman) : ?>
            <li class="waves-effect"><a href="form_jabatan.php?halaman=<?php echo $halamanaktif + 1; ?>"><i class="material-icons">skip_next</i></a></li>
          <?php endif; ?>
        </ul>
        </div>
      </div>
      <!-- Paging -->

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