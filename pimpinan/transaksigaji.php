<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

  include '../koneksi.php';
  $perhalaman = 10;
  $data = mysqli_query($db,"SELECT * FROM karyawan");
  $jumlahdata = mysqli_num_rows($data);
  $jumhalaman = ceil($jumlahdata / $perhalaman);
  $halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] :1;
  $awaldata = ($perhalaman * $halamanaktif) - $perhalaman;
  $no=$awaldata + 1;
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

 <!-- Dropdown Structure 1 -->
    <ul id="dropdown1" class="dropdown-content">
      <li><a href="Tampil_Tanak.php">Tunjangan Anak </a></li>
      <li><a href="Tampil_Tjarak.php">Tunjangan Transportasi </a></li>
      <li><a href="t_fungsional.php"> Tunjangan fungsional</a></li>
      <li><a href="form_kenaikanKGB.php"> Kenaikan KGB</a></li>
    </ul>
      <!-- Dropdown Structure 2 -->
    <ul id="dropdown2" class="dropdown-content">
      <li><a href="transaksigaji.php"> Gaji </a></li>
      <li><a href="form_kgb.php"> KGB </a></li>
      <li class="divider"></li>
    </ul>
    <!-- Dropdown Structure 3 -->
    <ul id="dropdown3" class="dropdown-content">
      <li><a href="LaporanGaji.php">Laporan Gaji </a></li>
      <li><a href="LaporanKGB.php">Laporan KGB </a></li>
    </ul>
     <!-- Dropdown Structure 4 -->
    <nav>
      <div class="nav-wrapper  deep-purple darken-2">
        <a href="index.php" class="brand-logo">SD IT SAHABAT </a>
        <ul class="right hide-on-med-and-down">
          <li><a href="index.php">Beranda</a></li>
          <li><a href="tampil_karyawan.php">Guru</a></li>
          <li><a href="form_jabatan.php">Jabatan </a></li>
          <li class="active"><a href="Tampil_golongan.php">Golongan</a></li>
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
      <!-- Tampil data -->
      <div class="container white">

         <!-- Tampil data -->
      <div class="row">
          <div class="col s10 offset-s1">
            <h5 class="center-align">Gaji</h5>
            <table class="bordered highlight responsive-table">
              <thead>
                <tr>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Kode Karyawan</th>
                </tr>
              </thead>
              <tbody>

                  <?php
                $sql = "SELECT * FROM gaji";
                $query = $db->query($sql);
                $no =1;
                while ($row = $query->fetch_array()){;?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $row["Kd_gaji"]; ?></td>
                      <td><?php echo $row["TanggalGaji"]; ?></td>
                      <td><?php echo $row["Kd_karyawan"]; ?></td>
                    </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </body>
    </html>


