
<?php
session_start();
if($_SESSION == false)  {
  header("Location: ../logout.php");
}

  include '../koneksi.php';
  $perhalaman = 10;
  $data = mysqli_query($db,"SELECT * FROM guru");
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
      <li class="active"><a href="tampil_kgb.php"> KGB </a></li>
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
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Tunjangan<i class="material-icons right">keyboard_arrow_down</i></a></li>
          <!-- Dropdown Trigger 2 -->
          <li class="active"><a class="dropdown-button" href="#!" data-activates="dropdown2">Transaksi<i class="material-icons right">keyboard_arrow_down</i></a></li>
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
     <!-- KGB-->
    <div class="container white">
        <div class="row">
          <div class="col s10 offset-s1">
            <table class="bordered highlight responsive-table">
              <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Golongan</th>
                    <th>Tanggal Masuk</th>
                    <th>Tanggal Kgb</th>
                    <th>Status</th>
                </tr>
              </thead>
            <tbody>

          <?php

            date_default_timezone_set('Asia/Jakarta');
            $tgl=date('d-m-Y');
            $sql = "SELECT * FROM guru INNER JOIN golongan ON guru.Kd_golongan=golongan.Kd_golongan INNER JOIN jabatan ON guru.Kd_jabatan=jabatan.Kd_jabatan LIMIT $awaldata, $perhalaman";
            $query = $db->query($sql);              
                while ($row = $query->fetch_array()){

                  $tanggalmasuk = $row['Tanggal_masuk'];
                  $date1 = strtotime($tanggalmasuk);
                  $date2 = strtotime($tgl);
                  $lama = ($date2-$date1)/3600/24;
                 
                 // date('d-m-Y',strtotime("+7 day")); Tambah 7 Hari
                 // $tglkgb = date('d-m-y',strtotime("+2 year"));
                  $tglkgb = date('Y-m-d', strtotime('+2 year', strtotime($tanggalmasuk)));
            
                  ?>
                    <tr>
                      <td><?php echo $no++;?></td>
                      <td><?php echo $row["Kd_guru"]; ?></td>
                      <td><?php echo $row["Nama"]; ?></td>
                      <td><?php echo $row["Nm_jabatan"]; ?></td>
                      <td><?php echo $row["Nm_golongan"]; ?></td>
                      <td><?php echo $row["Tanggal_masuk"]; ?></td>
                      <td><?php echo $tglkgb  ?></td>
                      <td>

                        <?php
                          if ($lama > 730) {
                            echo' <a href="kgb.php?kode='.$row['Kd_guru'].'" class="waves-effect waves-light btn">KBG</a>';
                          }
                          else {
                            echo'<a href="#!" class="waves-effect waves-light btn red">PROSES KGB</a>';
                          }
                        ?>
                      </td>
                    </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>        

        <div class="row">
          <div class="col s10 offset-s1"> 
            <ul class="pagination">
              <?php if( $halamanaktif > 1) : ?>
                <li class="waves-effect"><a href="tampil_kgb.php?halaman=<?php echo $halamanaktif - 1; ?>"><i class="material-icons">skip_previous</i></a></li>
              <?php endif; ?>

              <?php for( $i = 1; $i <= $jumhalaman; $i++) : ?>
                  <?php if( $i == $halamanaktif) : ?>
                    <li class="active"><a href="tampil_kgb.php?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
                  <?php else : ?>
                    <li class="waves-effect"><a href="tampil_kgb.php?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
                  <?php endif; ?>
              <?php endfor; ?>

              <?php if( $halamanaktif < $jumhalaman) : ?>
                <li class="waves-effect"><a href="tampil_kgb.php?halaman=<?php echo $halamanaktif + 1; ?>"><i class="material-icons">skip_next</i></a></li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
        <!--bagian footer-->
        <footer class="page-footer  deep-purple darken-2">                
          <div class="footer-copyright">
            <div>
            © 2018 Copyright Yuli Aridwan   
            </div>
          </div>
        </footer>
    </div>
        <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="../asset/js/materialize.min.js"></script>
      <script type="text/javascript">
            $(document).ready(function(){
              $('.dropdown-button').dropdown();
              $('select').material_select(); 
            });
      </script>
        
</body>
</html>