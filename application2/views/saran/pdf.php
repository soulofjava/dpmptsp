<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Cetak Contoh</title>
	<style type="text/css">
		html,
		body {
			background-color: #fff;
			margin:0.2cm;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #000000;
			font-size:9px;
		}
		hr{
		color:#000000;
		background-color: #000000;
		}
		.header,
			.footer {
					width: 100%;
					text-align: left;
					position: fixed;
			}
			.header {
					top: 0px;
			}
			.footer {
					bottom: 1.5cm;
			}
			.pagenum:before {
					content: counter(page);
			}
	</style>
</head>
<body>
<table style="width:20.1cm;border-bottom:2px solid #000000; font-size:12px;">
	<thead>
		<tr>
			<td style="width:3cm;">
			<?php  
			$path = './media/logo_wsb.jpg';
			echo '<img src="'.$path.'" />';
			?>
			</td>
			<td style="width:13cm;text-align:center;">
			<font size="16">DINAS KESEHATAN KABUPATEN WONOSOBO</font><br><br>
			<font size="16"><b>SEKSI FARMAMIN DAN PERBEKES</b></font><br><br>
			Jl A. Yani No. 2 Wonosobo Telepon (0286) 321033 Kode Pos 56311
			</td>
			<td style="width:3cm;">
			<?php  
			//$path2 = './assets/dist/img/iso.jpg';
			//echo '<img src="'.$path2.'" />';
			?>
			</td>
		</tr>
	</thead>
</table>

	
			<table style="width:20.1cm;">
				<tr>
					<td>XXX</td>
					<td>:XXX</td>
					<td>YYY</td>
					<td>:YYY</td>
					<td>ZZZ</td>
					<td>:ZZZ</td>
				</tr>
				<tr>
					<td>XXX</td>
					<td>:XXX</td>
					<td>YYY</td>
					<td>:YYY</td>
					<td>ZZZ</td>
					<td>:ZZZ</td>
				</tr>
			</table>
	
	<table style="width:20.1cm;border-bottom:2px solid #000000;">
		<thead>
			<tr>
				<td style="" colspan="10" valign="top">
				<center>SURAT PENYERAHAN BARANG</center>
				</td>
			</tr>
			<tr>
				<td style="background-color: #cccccc;">No</td>
				<td style="background-color: #cccccc;">NIK</td>
				<td style="background-color: #cccccc;">Telp</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			$no = 0;
			$jumlah_total = 0;
			foreach($data_fumgsi->result() as $r) 
				{
				$no = $no + 1;
				echo '<tr>';
				echo '<td valign="top" style="padding:2px; ">'.$no.'</td>';
				echo '<td valign="top" style="padding:2px; ">'.$r->kode_fumgsi.'</td>';
				echo '<td valign="top" style="padding:2px; ">'.$r->password.'</td>';
				echo '</tr>';
				}
			?>
			<tr>
				<td style="" colspan="10" valign="top">
				<b>CATATAN</b>
				</td>
			</tr>
		</tbody>
	</table>
	
	<table style="width:20.1cm;border-bottom:2px solid #000000; font-size:9px;">
		<tr>
			<td style="width:30%;"><center>CATATAN</center></td>
			<td style="width:30%;"><center>CATATAN</td>
			<td style="width:30%;"><center>CATATAN</center></td>
		</tr>
		<tr>
			<td style="width:30%;"><center>CATATAN</center></td>
			<td style="width:30%;"><center>CATATAN</td>
			<td style="width:30%;"><center>CATATAN</center></td>
		</tr>
		<tr>
			<td style="width:30%;"><center>CATATAN</center></td>
			<td style="width:30%;"><center>CATATAN</td>
			<td style="width:30%;"><center>CATATAN</center></td>
		</tr>
	</table>
	
	<?php
	function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
        return $temp;
	}
	 
	 
	function terbilang($x, $style=4) {
	    if($x<0) {
	        $hasil = "minus ". trim(kekata($x));
	    } else {
	        $hasil = trim(kekata($x));
	    }     
	    switch ($style) {
	        case 1:
	            $hasil = strtoupper($hasil);
	            break;
	        case 2:
	            $hasil = strtolower($hasil);
	            break;
	        case 3:
	            $hasil = ucwords($hasil);
	            break;
	        default:
	            $hasil = ucfirst($hasil);
	            break;
	    }     
	    return $hasil;
	}
	?>
	
<div class="footer">
<table style="width:20.1cm; border-top:2px solid #000000;">
	<thead>
		<tr>
			<td style="" valign="top">
			Dinas Kesehatan Kabupaten Wonosobo
			</td>
		</tr>
	</thead>
</table>	
</div>
</body>
</html>