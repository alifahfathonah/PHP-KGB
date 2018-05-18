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
$pdf->Cell(280,10,'Laporan Gaji  Guru SD IT Sahabat Sragen',0,1,'C');
$pdf->SetFont('Arial','B',20);
$pdf->Cell(280,10,'Plupuh, Sragen ',0,1,'C');
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(15,7,'',0,1);
 
$pdf->SetFont('Arial','B',12);
$pdf->Cell(10,6,'No',1,0);
$pdf->Cell(13,6,'NIP',1,0);
$pdf->Cell(45,6,'Nama',1,0);
$pdf->Cell(35,6,'Jabatan',1,0);
$pdf->Cell(50,6,'Golongan',1,0);
$pdf->Cell(35,6,'Transportasi',1,0);
$pdf->Cell(35,6,'Tunjangan Anak',1,0);
$pdf->Cell(30,6,'Fungsional',1,0);
$pdf->Cell(30,6,'Total Gaji',1,1);
$pdf->SetFont('Arial','',12);

include '../koneksi.php';
$no=1;
$Rp='Rp ';
$persen=' %';
$mahasiswa = mysqli_query($db, "SELECT * FROM gaji INNER JOIN guru ON gaji.Kd_guru=guru.Kd_guru INNER JOIN jabatan ON gaji.Kd_jabatan=jabatan.Kd_jabatan INNER JOIN golongan ON gaji.Kd_golongan=golongan.Kd_golongan INNER JOIN t_transportrasi ON gaji.Kd_transport=t_transportrasi.Kd_transport INNER JOIN t_anak ON gaji.Kd_Tanak=t_anak.Kd_Tanak INNER JOIN t_fungsional ON gaji.Kd_fungsional=t_fungsional.Kd_fungsional");
while ($row = mysqli_fetch_array($mahasiswa)){
    $pdf->Cell(10,6,$no++,1,0);
    $pdf->Cell(13,6,$row['Kd_guru'],1,0);
    $pdf->Cell(45,6,$row['Nama'],1,0);
    $pdf->Cell(35,6,$row['Nm_jabatan'],1,0);
    $pdf->Cell(50,6,$row['Nm_golongan'],1,0);
    $pdf->Cell(35,6,$Rp .number_format($row["Tjarak"],0,",","."),1,0); 
    $pdf->Cell(35,6,$Rp .number_format($row["Tanak"],0,",","."),1,0);
    $pdf->Cell(30,6,number_format($row["Jumlah"],0,",","."). $persen,1,0);
    $pdf->Cell(30,6,$Rp .number_format($row['TotalGaji'],0,",","."),1,1);
}
 
$pdf->Output();
?>