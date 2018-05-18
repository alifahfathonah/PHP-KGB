<?php
	Include "../koneksi.php";
			
			$n=$_GET['kode'];

			$SQL = $db->query("DELETE FROM jabatan WHERE Kd_jabatan='".$n."'");
			if ($SQL) {
				echo"<script>window.alert('DATA BERHASIL DIHAPUS');window.location='../admin/form_jabatan.php'</script>";
			}else {
				echo $db->error;
			}
?>