<?php
	Include "../koneksi.php";
			
			$n=$_GET['kode'];

			$SQL = $db->query("DELETE FROM t_transportrasi WHERE Kd_transport='".$n."'");
			if ($SQL) {
				echo"<script>window.alert('DATA BERHASIL DIHAPUS');window.location='../admin/T_transport.php'</script>";
			}else {
				echo $db->error;
			}
?>