
<?php
session_start();
if(empty($_SESSION)){
  header("Location: ../index.php");
}
  include '../koneksi.php';
  $username = $_SESSION['username'];
  $SQL_DATA = $db->query("SELECT * FROM guru WHERE username='".$username."'");
  $data = $SQL_DATA->fetch_array();
  
  date_default_timezone_set('Asia/Jakarta');
  $tgl=date('d-m-Y');

  $cari=mysqli_query($db,"SELECT MAX(Kd_gaji) FROM gaji");
			$data=mysqli_fetch_array($cari);
				
				if($data) {
					$nilaikode = substr($data[0], 1);
					// menjadikan $nilaikode ( int )
					$kode = (int) $nilaikode;
					// setiap $kode di tambah 1
					$kode = $kode + 1;
					$kode_otomatis = "G".str_pad($kode, 5, "0", STR_PAD_LEFT);
				} 
					else {
						$kode_otomatis = "G00001";
					}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Aplikasi Kenaikan Gaji Berkala</title>
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
      <li class="active"><a href="transaksigaji.php"> Gaji </a></li>
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
          <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Tunjangan<i class="material-icons right">keyboard_arrow_down</i></a></li>
          <!-- Dropdown Trigger 2 -->
          <li class="active"><a class="dropdown-button" href="#!" data-activates="dropdown2">Transaksi<i class="material-icons right">keyboard_arrow_down</i></a></li>
          <!-- Dropdown Trigger 3 -->
          <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Laporan<i class="material-icons right">keyboard_arrow_down</i></a></li>
          <li><a href="../logout.php">Keluar </a></li>
        </ul> 
      </div>
    </nav>

    <div class="container white">
      <img class="responsive-img" src="../gambar/Logo.png">
    </div>
    <br>

    <div class="container white">
    	<div class="row">
    		<form method="POST" action="prosesgaji.php">
				<div class="row">
					<h4 class="center-align">
						Tambah Data Gaji
					</h4>
          <!-- KODE TRANSAKSI -->
					<div class="row">
            <div class="col s10 offset-s1">
              <fieldset>
                <legend>Form Gaji</legend>
                <div class="col s5 offset-s1 input-field">
                  <input type="text" readonly value="<?php echo $kode_otomatis ?>" name="kode" required id="icon_prefix">
                  <label for="icon_prefix">Kode</label>
                </div>
                <div class="col s5 input-field">
                  <input type="text" readonly value="<?php echo $tgl ?>" name="tanggal" required id="tanggal">
                  <label for="tanggal">Tanggal</label>
                </div>
              </fieldset>
            </div>
					</div>
					<br>
          <!-- SELECT GURU -->
          <!-- NIP -->
          <div class="row">
            <div class="input-field col s10 offset-s1">
              <input type="text" readonly name="nip" readonly value="NIP" id="p_kode">
              <label for="p_kode">NIP</label>
            </div>
          </div>
          <!-- Nama -->
					<div class="row">
						<div class="input-field col s10 offset-s1">
              <?php
                $SQL_Data = $db->query("SELECT * FROM guru");  
                $guru = "var guru = new Array();\n";  
                  echo '<select name="namaguru" onchange="changeValue(this.value)">';  
                  echo '<option>Pilih Guru</option>';  
                    while ($row = mysqli_fetch_array($SQL_Data)) {  
                      echo'<option value="' . $row['Nama'] . '">' . $row['Nama'] . '</option>';    
                        $guru .= "guru['" . $row['Nama'] . "'] = {kode:'" . addslashes($row['Kd_guru']) . "',jarak:'".addslashes($row['JarakRumah'])."',anak:'".addslashes($row['JumlahAnak'])."',jabatan:'".addslashes($row['Kd_jabatan'])."',golongan:'".addslashes($row['Kd_golongan'])."'};\n";    
                    }  
                  echo '<select/>';
              ?>
							
							<label>Nama Guru</label>
						</div>
					</div>
          <!-- Jarak -->
          <div class="row">
            <div class="input-field col s5 offset-s1">
              <input type="text" readonly name="jarak" value="0" id="p_jarak">
              <label for="p_jarak">Jarak Rumah</label>
            </div>

            <div class="input-field col s5">
              <input type="text" readonly name="jumlahanak" value="0" id="p_anak">
              <label for="p_anak">Jumlah Anak</label>
            </div>
          </div>
          <!-- Jabatan -->
          <div class="row">
            <div class="input-field col s5 offset-s1">
              <input type="text" readonly name="kdjabatan" value="0" id="p_jabatan">
              <label for="p_jabatan">Jabatan</label>
            </div>

            <div class="input-field col s5">
              <input type="text" readonly name="kdgolongan" value="0" id="p_golongan">
              <label for="p_golongan">Golongan</label>
            </div>
          </div>

          <div class="row">

            <div class="input-field col s5 offset-s1">
              <?php
                $SQL_Data = $db->query("SELECT * FROM t_anak");  
                  echo '<select name="kdanak" onchange="changeValue(this.value)">';  
                  echo '<option>Pilih Tunjangan</option>';  
                    while ($row = mysqli_fetch_array($SQL_Data)) {  
                      echo'<option value="' . $row['Kd_Tanak'] . '">Rp '.number_format($row['Tanak']).',00</option>';        
                    }  
                  echo '<select/>';
              ?>
              
              <label>Tunjangan Anak</label>
            </div>

            <div class="input-field col s5">
              <?php
                $SQL_Data = $db->query("SELECT * FROM t_fungsional");  
                  echo '<select name="kdfungsional" onchange="changeValue(this.value)">';  
                  echo '<option>Pilih Tunjangan</option>';  
                    while ($row = mysqli_fetch_array($SQL_Data)) {  
                      echo'<option value="' . $row['Kd_fungsional'] . '">'.$row['Jumlah'].' %</option>';      
                    }  
                  echo '<select/>';
              ?>
              
              <label>Tunjangan Fungsional</label>
            </div>

          </div>
          
          <!-- SUBMIT -->
					<div class="row">
						<div class="input-field center-align">
							<button class="btn waves-effect waves-light" type="submit" name="simpan">Simpan<i class="material-icons right">send</i></button>
						</div>
					</div>
				</div>
			</form>
    	</div>
    </div>
    <br>

    <footer class="page-footer  deep-purple darken-2">                   
    	<div class="footer-copyright">
    		<div class="container center-align">
            	<div>2018 Copyright Yuli Aridwan</div>
        	</div>
        </div>
    </footer>

	<!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../asset/js/materialize.min.js"></script>
    <script>
		$(document).ready(function(){
			$('.button-collapse').sideNav();
			$('select').material_select();
			$('.modal').modal();
		});
    </script>

    <script type="text/javascript">    
    <?php echo $guru; ?>  
      function changeValue(id){  
      document.getElementById('p_kode').value = guru[id].kode;
      document.getElementById('p_jarak').value = guru[id].jarak;
      document.getElementById('p_anak').value = guru[id].anak;
      document.getElementById('p_jabatan').value = guru[id].jabatan;
      document.getElementById('p_golongan').value = guru[id].golongan;
      };
    </script>

    
</body>
</html>