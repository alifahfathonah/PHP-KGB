<?php
    
    session_start();
    if(empty($_SESSION)){
      header("Location: ../index.php");
    }
      include '../koneksi.php';
      $username = $_SESSION['username'];
      $SQL_DATA = $db->query("SELECT * FROM guru WHERE username='".$username."'");
      $data = $SQL_DATA->fetch_array();
      $nama=$data['Nama'];


// memanggil library FPDF
require('../asset/fpdf/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('P','mm','A4'); //P potrait L lanscape
// membuat halaman baru
$pdf->AddPage(); 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(15,7,'',0,1);
 

$kodekgb = $_GET['kode'];

// guru
$DATAGAJI = mysqli_query($db, "SELECT * FROM kgb INNER JOIN guru ON kgb.Kd_guru=guru.Kd_guru WHERE Kd_kgb='$kodekgb'");
$row = mysqli_fetch_array($DATAGAJI);
$tanggalmasuk = $row['Tanggal_masuk'];
$tglkgb = date('Y-m-d', strtotime('+2 year', strtotime($tanggalmasuk)));

// golongan
$DATAGOLONGAN = mysqli_query($db, "SELECT * FROM kgb INNER JOIN golongan ON kgb.Kd_golongan=golongan.Kd_golongan WHERE Kd_kgb='$kodekgb'");
$golongan = mysqli_fetch_array($DATAGOLONGAN);
$gapok = $golongan['gapok'];

//kenaikan
// golongan
$DATAkenaikan = mysqli_query($db, "SELECT * FROM kgb INNER JOIN kenaikan_kgb ON kgb.Kd_kenaikan=kenaikan_kgb.Kd_kenaikan WHERE Kd_kgb='$kodekgb'");
$kenaikan = mysqli_fetch_array($DATAkenaikan);


    // KOP  
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(190,5,'Laporan Kenaikan Gaji Berkala',0,1,'C');
    $pdf->Cell(190,5,'SD IT Sahabat Sragen',0,1,'C');

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,5,'Plupuh, Sragen ',0,1,'C');
    $pdf->Cell(190,6,'___________________________________________________________________________________',0,1,'C');

    // ISI
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    
    // NiP
    $pdf->Cell(40,6,'NIP',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(30,6,$row['Kd_guru'],0,0);

    // Golongan
    $pdf->Cell(50,6,'',0,0);
    $pdf->Cell(30,6,'Golongan',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(35,6,$golongan['Nm_golongan'],0,1);

    // Nama Guru
    $pdf->Cell(40,6,'Nama',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(30,6,$row['Nama'],0,1);

    // Tanggal masuk
    $pdf->Cell(40,6,'Tanggal Masuk',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(30,6,$row['Tanggal_masuk'],0,1);

    // Tanggal masuk
    $pdf->Cell(40,6,'Tanggal Kenaikan',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(30,6,$tglkgb,0,1);    
     

    $pdf->Ln();
    $pdf->Cell(15,7,'KENAIKAN GAJI BERKALA',0,1);

    $pdf->Cell(55,6,'Gaji Pokok',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(7,6,'Rp',0,0);
    $pdf->Cell(35,6,number_format($gapok,0,",","."),0,1);

    $pdf->Cell(55,6,'Jumlah Kenaikan',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(5,6,$kenaikan['Kenaikan'],0,0);
    $pdf->Cell(7,6,'%',0,1);

    $pdf->Cell(55,6,'Kenaikan Gaji',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(7,6,'Rp',0,0);
    $pdf->Cell(35,6,number_format($row['TotalKenaikan'],0,",","."),0,1);
    $pdf->Ln();

    $pdf->Cell(140,6,'',0,0);
    $pdf->Cell(30,6,'Tertanda',0,1,'C');
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Cell(140,6,'',0,0);
    $pdf->Cell(30,6,$nama,0,1,'C');

    $pdf->Output();
?>