<?php
	Include "../koneksi.php";
			
			$n=$_GET['kode'];

			$SQL = $db->query("DELETE FROM kenaikan_kgb WHERE Kd_kenaikan='".$n."'");
			if ($SQL) {
				echo"<script>window.alert('DATA BERHASIL DIHAPUS');window.location='../admin/form_kenaikanKGB.php'</script>";
			}else {
				echo $db->error;
			}
?>