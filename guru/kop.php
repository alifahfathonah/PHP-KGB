<?php
require('../asset/fpdf/fpdf.php');
/**
* Gambar
*/
class pdf extends FPDF
{
	
	function letak($gambar)
	{
		# code...
		$this->Image($gambar,10,10,25,25);
	}
	function judul($teks1,$teks2,$teks3,$teks4,$teks5)
	{
$this->Cell(25);
$this->SetFont('Times','B','12');
$this->Cell(0,5,$teks1,0,1,'C');
$this->Cell(25);
$this->Cell(0,5,$teks2,0,2,'C');
$this->Cell(25);
$this->SetFont('Times','B','15');
$this->Cell(0,5,$teks3,0,1,'C');
$this->Cell(25);
$this->SetFont('Times','I','8');
$this->Cell(0,5,$teks4,0,1,'C');
$this->Cell(25);
$this->Cell(0,5,$teks5,0,1,'C');
	}
	function garis() {
$this->SetLineWidth(1);
$this->Line(10,36,158,36);
$this->SetLineWidth(1);
$this->Line(10,37,158,37);
	}
}
$pdf=new pdf();
$pdf->AddPage('P','A4');
$pdf->letak('logo.png');
$pdf->judul('PEMERINTAH KOTA PAGAR ALAM','DINAS PENDIDIKAN','SEKOLAH MENENGAH ATAS NEGERI 4','Jambat Balo Pagar Alam Selatan Kota Pagar Alam Telp. (0730)622422','Website:http://meong.id | E-Mail: meong@meong.id');
$pdf->garis();
$pdf->Output('hasilunsman4pga.pdf','I');
?>