<style type="text/css">
	* {
		font-family: Arial;
		margin: 0px;
		padding: 0px;
	}

	@page {
		margin-left: 3cm 2cm 2cm 2cm;
	}

	table.grid {
		width: 29.7cm;
		font-size: 9pt;
		border-collapse: collapse;
	}

	table.grid th {
		padding-top: 1mm;
		padding-bottom: 1mm;
	}

	table.grid th {
		background: #F0F0F0;
		border-top: 0.2mm solid #000;
		border-bottom: 0.2mm solid #000;
		text-align: center;
		padding-left: 0.2cm;
		border: 1px solid #000;
	}

	table.grid tr td {
		padding-top: 0.5mm;
		padding-bottom: 0.5mm;
		padding-left: 2mm;
		border-bottom: 0.2mm solid #000;
		border: 1px solid #000;
	}

	h1 {
		font-size: 18pt;
	}

	h2 {
		font-size: 14pt;
	}

	.profil {
		display: block;
		width: 20.4cm;
		font-size: 10px;
		margin: 0px;
		padding: 0px;
	}

	.profil .koperasi {
		font-size: 14px;
		font-weight: bold;
	}

	.header {
		display: block;
		width: 29.7cm;
		margin-bottom: 0.3cm;
		text-align: center;
	}

	.attr {
		font-size: 9pt;
		width: 100%;
		padding-top: 2pt;
		padding-bottom: 2pt;
		border-top: 0.2mm solid #000;
		border-bottom: 0.2mm solid #000;
	}

	.pagebreak {
		width: 29.7cm;
		page-break-after: always;
		margin-bottom: 10px;
	}

	.akhir {
		width: 29.7cm;
		font-size: 13px;
	}

	.page {
		width: 29.7cm;
		font-size: 12px;
	}
</style>
<?php

$judul_H = "Laporan Anggota <br>";

if ($pilih == 'pilih') {
	$where	= " WHERE noanggota ='$noanggota'";
	$judul_H .= "Berdasarkan Nomor $noanggota<br>";
} else {
	$where	= "";
}

$profil = "<span class='koperasi'>" . $nama_perusahaan . "</span><br>";
$profil .= $alamat_perusahaan;

$query = "select * from anggota
		$where
		order by noanggota";
//echo $query;

$data = $this->db->query($query);

function myheader($profil, $judul_H)
{
	echo  "<div class='profil'>" . $profil . "
		</div>
		<br>
		<div class='header'>
		  <h2>" . $judul_H . "</h2>
		  </div>
		<table class='grid' >
		<tr>
			<th width='5%'>No</th>
			<th >Nomor Anggota</th>
			<th >No Identitas</th>
			<th >Nama Anggota</th>
			<th >L/P</th>
			<th >Tempat, Tanggal Lahir</th>
			<th >Alamat</th>
			<th >HP</th>
			<th >Simpanan Pokok</th>
			<th >Simpanan Wajib</th>
			<th >Simpanan Sukarela</th>
			<th >Simpanan Apa Saja</th>
			<th >Simpanan Angsuran</th>			
			<th >Simpanan Total</th>			
			<th >Pinjaman</th>
		</tr>";
}
//echo $query;
function myfooter()
{
	echo "</table>";
}
$no = 1;
$page = 1;
foreach ($data->result_array() as $r_data) {
	$tgllhr = $this->app_model->tgl_str($r_data['tgl_lahir']);
	$simpanan = $this->app_model->Jumlah_Simpanan($r_data['noanggota']);
	$simpanan_pokok = $this->app_model->Jumlah_Simpanan_Pokok($r_data['noanggota']);
	$simpanan_wajib = $this->app_model->Jumlah_Simpanan_Wajib($r_data['noanggota']);
	$simpanan_sukarela = $this->app_model->Jumlah_Simpanan_Sukarela($r_data['noanggota']);
	$simpanan_apa_saja = $this->app_model->Jumlah_Simpanan_Apa_Saja($r_data['noanggota']);
	$simpanan_angsuran = $this->app_model->Jumlah_Simpanan_Angsuran($r_data['noanggota']);
	$pinjaman = $this->app_model->sisa_pinjaman($r_data['noanggota']);
	$pengambilan = $this->app_model->Jumlah_Pengambilan($r_data['noanggota']);
	$pengambilan_pokok = $this->app_model->Jumlah_Pengambilan_Pokok($r_data['noanggota']);
	$pengambilan_wajib = $this->app_model->Jumlah_Pengambilan_Wajib($r_data['noanggota']);
	$pengambilan_sukarela = $this->app_model->Jumlah_Pengambilan_Sukarela($r_data['noanggota']);
	$pengambilan_apa_saja = $this->app_model->Jumlah_Pengambilan_Apa_Saja($r_data['noanggota']);
	$pengambilan_angsuran = $this->app_model->Jumlah_Pengambilan_Angsuran($r_data['noanggota']);

	$sisa = $simpanan - $pengambilan;
	$sisa_pokok = $simpanan_pokok - $pengambilan_pokok;
	$sisa_wajib = $simpanan_wajib - $pengambilan_wajib;
	$sisa_sukarela = $simpanan_sukarela - $pengambilan_sukarela;
	$sisa_apa_saja = $simpanan_apa_saja - $pengambilan_apa_saja;
	$sisa_angsuran = $simpanan_angsuran - $pengambilan_angsuran;
	if (($no % 40) == 1) {
		if ($no > 1) {
			myfooter();
			echo "<div class=\"pagebreak\" align='right'>
		<div class='page' align='center'>Hal - $page</div>
		</div>";
			$page++;
		}
		myheader($profil, $judul_H);
	}
	echo "<tr>
			<td align='center'>$no</td>
			<td align='center'>$r_data[noanggota]</td>
			<td align='center'>$r_data[noidentitas]</td>
			<td align='left'>$r_data[namaanggota]</td>
			<td align='center'>$r_data[jk]</td>
			<td align='left'>$r_data[tempat_lahir], $tgllhr</td>
			<td align='left'>$r_data[alamat]</td>
			<td align='left'>$r_data[hp]</td>
			<td align='right'>" . number_format($sisa_pokok) . "</td>
			<td align='right'>" . number_format($sisa_wajib) . "</td>
			<td align='right'>" . number_format($sisa_sukarela) . "</td>
			<td align='right'>" . number_format($sisa_apa_saja) . "</td>
			<td align='right'>" . number_format($sisa_angsuran) . "</td>
			<td align='right'>" . number_format($sisa) . "</td>
			<td align='right'>" . number_format($pinjaman) . "</td>
			</tr>";
	$no++;
}

myfooter();
echo "</table>";
//echo "<div class='akhir' align='right'>
//		Total <b>".number_format($gtotal)."</b>
//	</div>";
echo "<br>";
echo "<div class='akhir' align='right'>";
echo "Lampung Tengah, " . date('d F Y');
echo "<br>Staf Koperasi";
echo "<br><br><br>";
echo $this->session->userdata('username');
echo  "</div>";
echo "<div class='page' align='center'>Hal - " . $page . "</div>";
/*
	header("Content-type: application/x-msdownload");
	header("Content-Disposition: attachment; filename=laporan.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	*/
//echo $content;
//}
?>