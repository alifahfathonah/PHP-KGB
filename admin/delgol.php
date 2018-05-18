<?php
	Include "../koneksi.php";
			
			$n=$_GET['kode'];

			$SQL = $db->query("DELETE FROM golongan WHERE Kd_golongan='".$n."'");
			if ($SQL) {
				echo"<script>window.alert('DATA BERHASIL DIHAPUS');window.location='../admin/form_golongan.php'</script>";
			}else {
				echo $db->error;
			}
?>