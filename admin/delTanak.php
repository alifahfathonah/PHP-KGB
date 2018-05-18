<?php
	Include "../koneksi.php";
			
			$n=$_GET['kode'];

			$SQL = $db->query("DELETE FROM t_anak WHERE Kd_Tanak='".$n."'");
			if ($SQL) {
				echo"<script>window.alert('DATA BERHASIL DIHAPUS');window.location='../admin/form_Tanak.php'</script>";
			}else {
				echo $db->error;
			}
?>