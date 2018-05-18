<?php
	Include "../koneksi.php";
			
			$n=$_GET['kode'];

			$SQL = $db->query("DELETE FROM t_fungsional WHERE Kd_fungsional='".$n."'");
			if ($SQL) {
				echo"<script>window.alert('DATA BERHASIL DIHAPUS');window.location='../admin/t_fungsional.php'</script>";
			}else {
				echo $db->error;
			}
?>