
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

  include '../koneksi.php';
  $username = $_SESSION['username'];
  $SQL_DATA = $db->query("SELECT * FROM guru WHERE username='".$username."'");
  $data = $SQL_DATA->fetch_array();
  $kodeguru = $data['Kd_guru'];

  $perhalaman = 10;
  $data = mysqli_query($db,"SELECT * FROM gaji WHERE Kd_guru='$kodeguru'");
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

    <nav>
      <div class="nav-wrapper  deep-purple darken-2">
        <a href="index.php" class="brand-logo">SD IT SAHABAT </a>
        <ul class="right hide-on-med-and-down">
          <li><a href="index.php">Beranda</a></li>
          <li class="active"><a href="gaji.php">Gaji</a></li>
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

    <div class="row white">
      <div class="col s10 offset-s1">
        <h5 class="center-align">Riwayat Gaji</h5>
            <table class="bordered highlight responsive-table">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Gaji</th>
                    <th>Tanggal Terbit</th>
                    <th>Jumlah Gaji</th>
                    <th>Aksi</th>
                </tr>
              </thead>
            <tbody>

              <?php
                $sql = "SELECT * FROM gaji WHERE Kd_guru='$kodeguru' LIMIT $awaldata, $perhalaman";
                $query = $db->query($sql);              
                while ($row = $query->fetch_array()){;?>

                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $row["Kd_gaji"]; ?></td>
                  <td><?php echo $row["TanggalGaji"]; ?></td>
                  <td>Rp <?php echo number_format($row["TotalGaji"],0,",","."); ?> ,-</td>
                  <td><?php echo' <a href="../laporan/laporanslip.php?kode='.$row['Kd_gaji'].'" class="waves-effect waves-light btn green" target="_blank">Cetak Slip</a>';?></td>
                  
                  <?php } ?>
                </tr>
              </tbody>
            </table>
        
        <br>

        <!-- Paging -->  
          <ul class="pagination">
            <?php if( $halamanaktif > 1) : ?>
              <li class="waves-effect"><a href="gaji.php?halaman=<?php echo $halamanaktif - 1; ?>"><i class="material-icons">skip_previous</i></a></li>
            <?php endif; ?>

            <?php for( $i = 1; $i <= $jumhalaman; $i++) : ?>
                <?php if( $i == $halamanaktif) : ?>
                  <li class="active"><a href="gaji.php?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
                <?php else : ?>
                  <li class="waves-effect"><a href="gaji.php?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if( $halamanaktif < $jumhalaman) : ?>
              <li class="waves-effect"><a href="gaji.php?halaman=<?php echo $halamanaktif + 1; ?>"><i class="material-icons">skip_next</i></a></li>
            <?php endif; ?>
          </ul>
        <!-- Paging -->
        </div>
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