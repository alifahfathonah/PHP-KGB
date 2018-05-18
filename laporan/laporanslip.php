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
 

$kodegaji = $_GET['kode'];

// guru
$DATAGAJI = mysqli_query($db, "SELECT * FROM gaji INNER JOIN guru ON gaji.Kd_guru=guru.Kd_guru WHERE Kd_gaji='$kodegaji'");
$row = mysqli_fetch_array($DATAGAJI);

// golongan
$DATAGOLONGAN = mysqli_query($db, "SELECT * FROM gaji INNER JOIN golongan ON gaji.Kd_golongan=golongan.Kd_golongan WHERE Kd_gaji='$kodegaji'");
$golongan = mysqli_fetch_array($DATAGOLONGAN);
$gapok = $golongan['gapok'];
// jabatan
$DATAjabatan = mysqli_query($db, "SELECT * FROM gaji INNER JOIN jabatan ON gaji.Kd_jabatan=jabatan.Kd_jabatan WHERE Kd_gaji='$kodegaji'");
$jabatan = mysqli_fetch_array($DATAjabatan);
// anak
$DATAanak = mysqli_query($db, "SELECT * FROM gaji INNER JOIN t_anak ON gaji.Kd_Tanak=t_anak.Kd_Tanak WHERE Kd_gaji='$kodegaji'");
$anak = mysqli_fetch_array($DATAanak);
$tunjangananak= $anak['Tanak']*$row['JumlahAnak'];

// tranasport
$DATAtransport = mysqli_query($db, "SELECT * FROM gaji INNER JOIN t_transportrasi ON gaji.Kd_transport=t_transportrasi.Kd_transport WHERE Kd_gaji='$kodegaji'");      
$transport = mysqli_fetch_array($DATAtransport);

// fungsional
$DATAfungsional = mysqli_query($db, "SELECT * FROM gaji INNER JOIN t_fungsional ON gaji.Kd_fungsional=t_fungsional.Kd_fungsional WHERE Kd_gaji='$kodegaji'");      
$fungsional = mysqli_fetch_array($DATAfungsional);
$jumlah = $fungsional['Jumlah'];
$persen = $jumlah/100;
$tunjanganfungsional = $gapok*$persen;


    // KOP  
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(190,5,'Laporan Slip Gaji Guru',0,1,'C');
    $pdf->Cell(190,5,'SD IT Sahabat Sragen',0,1,'C');

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(190,5,'Plupuh, Sragen ',0,1,'C');
    $pdf->Cell(190,6,'___________________________________________________________________________________',0,1,'C');

    // ISI
    $pdf->Ln();
    $pdf->SetFont('Arial','',12);
    
    // NiP
    $pdf->Cell(30,6,'NIP',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(30,6,$row['Kd_guru'],0,0);

    // Golongan
    $pdf->Cell(50,6,'',0,0);
    $pdf->Cell(30,6,'Golongan',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(35,6,$golongan['Nm_golongan'],0,1);

    // Nama Guru
    $pdf->Cell(30,6,'Nama',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(30,6,$row['Nama'],0,0);

    // Golongan
    $pdf->Cell(50,6,'',0,0);
    $pdf->Cell(30,6,'Jabatan',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(35,6,$jabatan['Nm_jabatan'],0,1);

    // Tanggal masuk
    $pdf->Cell(30,6,'Tanggal Masuk',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(30,6,$row['Tanggal_masuk'],0,0);

    // Tanggal terbit
    $pdf->Cell(50,6,'',0,0);
    $pdf->Cell(30,6,'Tanggal Terbit',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(30,6,$row['TanggalGaji'],0,1);
    
     

    $pdf->Ln();
    $pdf->Cell(15,7,'PENGHASILAN',0,1);

    $pdf->Cell(45,6,'Gaji Pokok',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(7,6,'Rp',0,0);
    $pdf->Cell(35,6,number_format($golongan['gapok'],0,",","."),0,1);

    $pdf->Cell(45,6,'Tunjangan Anak',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(7,6,'Rp',0,0);
    $pdf->Cell(35,6,number_format($tunjangananak,0,",","."),0,1);

    $pdf->Cell(45,6,'Tunjangan Transport',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(7,6,'Rp',0,0);
    $pdf->Cell(35,6,number_format($transport['Tjarak'],0,",","."),0,1);

    $pdf->Cell(45,6,'Tunjangan Fungsional',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(7,6,'Rp',0,0);
    $pdf->Cell(35,6,number_format($tunjanganfungsional,0,",","."),0,1);

    $pdf->Cell(45,6,'Tunjangan Struktural',0,0);
    $pdf->Cell(5,6,':',0,0);
    $pdf->Cell(7,6,'Rp',0,0);
    $pdf->Cell(35,6,number_format($jabatan['TunjanganStruktural'],0,",","."),0,1);

    $pdf->Cell(56,6,'_______________________________ +',0,0);
    $pdf->Ln();

    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(50,6,'Total Gaji',0,0);
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(7,6,'Rp',0,0);
    $pdf->Cell(35,6,number_format($row['TotalGaji'],0,",","."),0,1);

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