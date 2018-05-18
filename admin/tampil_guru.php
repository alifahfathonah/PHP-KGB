
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
          <li class="active"><a href="tampil_guru.php">Guru</a></li>
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
    <div class="container">
      <img class="responsive-img" src="../gambar/Logo.png">
    </div>
    <br>

    <div class="row white">
      <div class="col s10 offset-s1">
        <h5 class="center-align">Data Guru</h5>
            <table class="bordered highlight responsive-table">
              <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Handphone</th>
                    <th>Jarak Rumah</th>
                    <th>Jumlah Anak</th>
                    <th>Level</th>
                    <th>Tanggal Masuk</th>
                    <th>AKSI</th>
                </tr>
              </thead>
            <tbody>

            	<?php
  				      $sql = "SELECT * FROM guru LIMIT $awaldata, $perhalaman";
  				      $query = $db->query($sql);				      
  				      while ($row = $query->fetch_array()){;?>

                <tr>
                	<td><?php echo $no++;?></td>
                	<td><?php echo $row["Kd_guru"]; ?></td>
                	<td><?php echo $row["Nama"]; ?></td>
                	<td><?php echo $row["Alamat"]; ?></td>
                	<td><?php echo $row["TempatLahir"]; ?></td>
                	<td><?php echo $row["TanggalLahir"]; ?></td>
                	<td><?php echo $row["JenisKelamin"]; ?></td>
                	<td><?php echo $row["Handphone"]; ?></td>
                	<td><?php echo $row["JarakRumah"]; ?></td>
                	<td><?php echo $row["JumlahAnak"]; ?></td>
                  <td><?php echo $row["level"]; ?></td>
                	<td><?php echo $row["Tanggal_masuk"]; ?></td>
                	<td>
                		<?php echo' <a href="editguru.php?kode='.$row['Kd_guru'].'" class="waves-effect waves-light btn">Edit Data </a>';?>
                		<?php echo' <a href="delgur.php?kode='.$row['Kd_guru'].'" class="waves-effect waves-light red btn">Hapus Data </a>';?>
                	</td>
                    
                  <?php } ?>
                </tr>
              </tbody>
                <td><a href="form_guru.php" class="waves-effect waves-light btn">Tambah Data </a></td>
            </table>
        
        <br>

        <!-- Paging -->  
          <ul class="pagination">
            <?php if( $halamanaktif > 1) : ?>
              <li class="waves-effect"><a href="tampil_guru.php?halaman=<?php echo $halamanaktif - 1; ?>"><i class="material-icons">skip_previous</i></a></li>
            <?php endif; ?>

            <?php for( $i = 1; $i <= $jumhalaman; $i++) : ?>
                <?php if( $i == $halamanaktif) : ?>
                  <li class="active"><a href="tampil_guru.php?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
                <?php else : ?>
                  <li class="waves-effect"><a href="tampil_guru.php?halaman=<?php echo $i ?>"><?php echo $i; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if( $halamanaktif < $jumhalaman) : ?>
              <li class="waves-effect"><a href="tampil_guru.php?halaman=<?php echo $halamanaktif + 1; ?>"><i class="material-icons">skip_next</i></a></li>
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
            
            $('.datepicker').pickadate({
              selectMonths: true,
              selectYears: 88,

            });
            $('select').material_select(); 
            });
      </script>
</body>
</html>