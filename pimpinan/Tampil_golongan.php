
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

  include '../koneksi.php';
  $perhalaman = 5;
  $data = mysqli_query($db,"SELECT * FROM golongan");
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
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
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
      <li><a href="form_kenaikanKGB.php"> KenaikanKGB</a></li>
    </ul>

   <!-- Dropdown Structure 3 -->
    <ul id="dropdown3" class="dropdown-content">
      <li><a href="laporangaji.php"> LaporanGaji </a></li>
      <li><a href="laporanKGB.php"> LaporanKGB </a></li>
    </ul>
        
<!-- MENU -->
  <nav>
      <div class="nav-wrapper  deep-purple darken-2">
        <a href="index.php" class="brand-logo">SD IT SAHABAT </a>
        <ul class="right hide-on-med-and-down">
          <li><a href="index.php">Beranda</a></li>
          <li><a href="Tampil_guru.php">Guru</a></li>
          <li><a href="Tampil_Jabatan.php">Jabatan</a></li>
          <li class="active"><a href="Tampil_golongan.php">Golongan</a></li>
          <!-- Dropdown Trigger -->
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Tunjangan<i class="material-icons right">keyboard_arrow_down</i></a></li>
           <!-- Dropdown Trigger 3 -->
          <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Laporan<i class="material-icons right">keyboard_arrow_down</i></a></li>
          
          <li><a href="../logout.php">Keluar </a></li>
        </ul> 
      </div>
    </nav> 
<!-- MENU -->

    <!-- isi  -->
      <div class="container">
         <img class="responsive-img" src="../gambar/Logo.png">
      </div>
      <br>

<!--     <div class="container white"> -->

      <!-- Tampil data -->
      <div class="row white">
          <div class="col s10 offset-s1">
            <h5 class="center-align">Data Golongan</h5>
            <table class="bordered highlight responsive-table">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Golongan</th>
                    <th>Nama Golongan</th>
                    <th>Gaji Pokok</th>
                </tr>
              </thead>
              <tbody>

                <?php
                $sql = "SELECT * FROM golongan LIMIT $awaldata, $perhalaman";
                $query = $db->query($sql);
                while ($row = $query->fetch_array()){;?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $row["Kd_golongan"]; ?></td>
                      <td><?php echo $row["Nm_golongan"]; ?></td>
                     <td>Rp <?php echo number_format($row["gapok"],0,",","."); ?>,-</td>
                      <td>
                    </tr>
                    <?php } ?>
               </tbody>
               <td><a href="" class="waves-effect waves-light btn">Cetak Laporan  </a></td>
            </table>
        </div>
  

      <!-- Paging -->  
      <div class="row">
        <div class="col s10 offset-s1">
        <ul class="pagination">
          <?php if( $halamanaktif > 1) : ?>
            <li class="waves-effect"><a href="?halaman=<?php echo $halamanaktif - 1; ?>"><i class="material-icons">skip_previous</i></a></li>
          <?php endif; ?>

          <?php for( $i = 1; $i <= $jumhalaman; $i++) : ?>
              <?php if( $i == $halamanaktif) : ?>
                <li class="active"><a href="?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
              <?php else : ?>
                <li class="waves-effect"><a href="?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
              <?php endif; ?>
          <?php endfor; ?>

          <?php if( $halamanaktif < $jumhalaman) : ?>
            <li class="waves-effect"><a href="?halaman=<?php echo $halamanaktif + 1; ?>"><i class="material-icons">skip_next</i></a></li>
          <?php endif; ?>
        </ul>
        </div>
      </div>
      <!-- Paging -->

      </div>
      <!-- Tampil Data -->

       <div class="row">
          <div class="col s10 offset-s1">
            <h5 class="center-align">Data Golongan</h5>
            <table class="bordered highlight responsive-table">
            </table>
          </div>
        </div>
              <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Golongan</th>
                    <th>Nama Golongan</th>
                    <th>Gaji Pokok</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                $sql = "SELECT * FROM golongan LIMIT $awaldata, $perhalaman";
                $query = $db->query($sql);
                while ($row = $query->fetch_array()){};?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $row["Kd_golongan"]; ?></td>
                      <td><?php echo $row["Nm_golongan"]; ?></td>
                      <td>Rp <?php echo number_format($row["gapok"],0,",","."); ?>,-</td>
                    </tr>
                  </tbody>
    <!-- </div> -->
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
        });
      </script>
</body>
</html>