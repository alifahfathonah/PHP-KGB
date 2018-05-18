<?php
	Include "../koneksi.php";
			
			$n=$_GET['kode'];

			$SQL = $db->query("DELETE FROM guru WHERE Kd_guru='".$n."'");
			if ($SQL) {
				echo"<script>window.alert('DATA BERHASIL DIHAPUS');window.location='../admin/tampil_guru.php'</script>";
			}else {
				echo $db->error;
			}
?>