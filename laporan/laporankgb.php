<?php
// memanggil library FPDF
require('../asset/fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',24);
// mencetak string 
$pdf->Cell(280,10,'Laporan Kenaikan Gaji Berkala (KGB) Guru',0,1,'C');
$pdf->Cell(280,10,'SD IT Sahabat Sragen',0,1,'C');
$pdf->SetFont('Arial','B',20);
$pdf->Cell(280,10,'Plupuh, Sragen ',0,1,'C');
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(15,7,'',0,1);
 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,6,'No',1,0);
$pdf->Cell(15,6,'NIP',1,0);
$pdf->Cell(50,6,'Nama',1,0);
$pdf->Cell(35,6,'Tanggal Masuk',1,0);
$pdf->Cell(35,6,'Golongan',1,0);
$pdf->Cell(35,6,'Gaji Pokok',1,0);
$pdf->Cell(40,6,'Jumlah Kenaikan',1,0);
$pdf->Cell(35,6,'Kenaikan Gaji',1,1);
$pdf->SetFont('Arial','',12);

include '../koneksi.php';
$no=1;
$Rp='Rp ';
$persen=' %';
$mahasiswa = mysqli_query($db, "SELECT * FROM kgb INNER JOIN guru ON kgb.Kd_guru=guru.Kd_guru INNER JOIN golongan ON kgb.Kd_golongan=golongan.Kd_golongan INNER JOIN kenaikan_kgb ON kgb.Kd_kenaikan=kenaikan_kgb.Kd_kenaikan");
while ($row = mysqli_fetch_array($mahasiswa)){
    $pdf->Cell(10,6,$no++,1,0);
    $pdf->Cell(15,6,$row['Kd_guru'],1,0);
    $pdf->Cell(50,6,$row['Nama'],1,0);
    $pdf->Cell(35,6,$row['Tanggal_masuk'],1,0);
    $pdf->Cell(35,6,$row['Kd_golongan'],1,0);
    $pdf->Cell(35,6,$Rp .number_format($row["gapok"],0,",","."),1,0);
	$pdf->Cell(40,6,$row['Kenaikan']. $persen,1,0); 
    $pdf->Cell(35,6,$Rp .number_format($row["TotalKenaikan"],0,",","."),1,1);

}
 
$pdf->Output();
?>