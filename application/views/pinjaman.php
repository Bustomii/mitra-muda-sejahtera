<script type="text/javascript">
	$(function() {
		$("#theTable tr:even").addClass("stripe1");
		$("#theTable tr:odd").addClass("stripe2");
		$("#theTable tr").hover(
			function() {
				$(this).toggleClass("highlight");
			},
			function() {
				$(this).toggleClass("highlight");
			}
		);
	});
	$(document).ready(function() {
		$(':input:not([type="submit"])').each(function() {
			$(this).focus(function() {
				$(this).addClass('hilite');
			}).blur(function() {
				$(this).removeClass('hilite');
			});
		});

		//$("#tgl").datepicker();
		$("#tgl").datepicker({
			dateFormat: "dd-mm-yy"
		});
		$("#anggota").keyup(function(e) {
			var isi = $(e.target).val();
			$(e.target).val(isi.toUpperCase());
			CariAnggota(isi);
		});

		$('#harga_barang').priceFormat({
			prefix: '',
			centsSeparator: '',
			thousandsSeparator: ',',
			centsLimit: 0
		});

		$('#dp').priceFormat({
			prefix: '',
			centsSeparator: '',
			thousandsSeparator: ',',
			centsLimit: 0
		});

		$('#lama').priceFormat({
			prefix: '',
			centsSeparator: '',
			thousandsSeparator: ',',
			centsLimit: 0
		});

		$('#bunga').keypress(function(e) {
			var charCode = (e.which) ? e.which : e.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 46 || charCode > 46)) {
				return false;
			}
			return true;
		});
		/*$('#bunga').priceFormat({
			prefix: '',
			centsSeparator: '',
			thousandsSeparator: ',',
			centsLimit: 0
		});*/

		$('#jumlah').priceFormat({
			prefix: '',
			centsSeparator: '',
			thousandsSeparator: ',',
			centsLimit: 0
		});
		$("#harga_barang").keyup(function(e) {
			CariPinjaman();
		});

		$("#dp").keyup(function(e) {
			CariPinjaman();
		});
		$("#lama").keyup(function(e) {
			CariPinjaman();
		});
		$("#bunga").keyup(function(e) {
			CariPinjaman();
		});

		function tampil_data() {

			$('#form_input').hide();
			$('#tombol_input').hide();
			//$('#view_anggota').hide();
			$('#view_simpanan').hide();

			$('.tampil_data').show();
			$('#tombol').show();
			$('#pencarian').show();
			$('#paging').show();

			//$('#ajax_paging').hide();
		}

		function input_data() {
			$('#form_input').show();
			$('#tombol_input').show();
			//$('#view_anggota').show();
			$('#view_simpanan').show();

			$('.tampil_data').hide();
			$('#tombol').hide();
			$('#pencarian').hide();
			$('#paging').hide();

			//$('#ajax_paging').show();
		}

		tampil_data();


		$("#tambah").click(function() {
			input_data();
			$('input').val('');
			$('select').val('');
			CariKode();
			$('#anggota').focus();
		});

		$("#kosong").click(function() {
			$('input').val('');
			$('select').val('');
			CariKode();
			$('#anggota').focus();
			$("#view_pinjaman").hide();
			//view_pinjaman('xxx');
		});

		$("#tutup").click(function() {
			//tampil_data();
			window.location.replace('<?php echo site_url(); ?>/pinjaman/index');
		});

		function CariKode() {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/pinjaman/CariKode",
				dataType: "json",
				cache: false,
				success: function(data) {
					$('#nomor').val(data.nomor);
				}
			});
		}

		function CariPinjaman() {
			var hb = $("#harga_barang").val();
			var dp = $("#dp").val();
			var lm = $("#lama").val();
			var bg = $("#bunga").val();
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/pinjaman/CariPinjaman",
				data: "hb=" + hb + "&dp=" + dp + "&lm=" + lm + "&bg=" + bg,
				dataType: "json",
				cache: false,
				success: function(data) {
					$('#jumlah').val(data.jumlah);
					$('#pokok_b').val(data.pokok_b);
					$('#bunga_b').val(data.bunga_b);
					$('#ang_total_b').val(data.ang_total_b);
					$('#tot_pokok').val(data.tot_pokok);
					$('#tot_bunga').val(data.tot_bunga);
					$('#ang_total').val(data.ang_total);
				}
			});
		}

		function CariAnggota(isi) {
			var nomor = isi; //$("#anggota").val();
			//alert('Info ' + nomor);
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/ref_json/CariAnggota",
				data: "nomor=" + nomor,
				dataType: "json",
				cache: false,
				success: function(data) {
					$('#identitas').val(data.identitas);
					$('#nama_anggota').val(data.anggota);
					$('#jk').val(data.jk);
					$('#hp').val(data.hp);
					$('#angsuran').val(data.angsuran);
					$('#sisa_angsuran').val(data.sisa_angsuran);
					/*if (data.sisa_angsuran > 0) {
						$("#simpan").attr("disabled", true);
					} else {
						$("#simpan").attr("disabled", false);
					}*/
					//$('#nomor').val(data.no_pinjam);
					//$('#lama').val(data.lama);
					//$('#bunga').val(data.bunga);
					//$('#jumlah').val(data.jumlah);
					//$('#angsuran').val(data.angsuran);
					view_pinjaman(data.no_pinjam);
				}
			});
		}

		function view_pinjaman(isi) {
			var nomor = isi; //$("#anggota").val();
			//alert('Info '+nomor);
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/pinjaman/view_pinjaman",
				data: "nomor=" + nomor,
				success: function(data) {
					$("#view_pinjaman").html(data);
					//alert('info'+nomor);
				}
			});
		}

		function CariJenis() {
			var id = $("#jenis").val();
			//alert('Info '+nomor);
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/pinjaman/CariJenis",
				data: "id=" + id,
				cache: false,
				dataType: "json",
				success: function(data) {
					$('#jumlah').val(data.jumlah);
				}
			});
		}

		$("#jenis").change(function() {
			CariJenis();
		});

		$("#refresh").click(function() {
			window.location.replace('<?php echo site_url(); ?>/pinjaman/index');
		});

		$("#simpan").click(function() {
			simpan();
		});

		function simpan() {
			var nomor = $("#nomor").val();
			var tgl = $("#tgl").val();
			var anggota = $("#anggota").val();
			var lama = $("#lama").val();
			var bunga = $("#bunga").val();
			var jumlah = $("#jumlah").val();
			var harga_barang = $("#harga_barang").val();
			var dp = $("#dp").val();
			var sisa = $("#sisa_angsuran").val();

			var string = "nomor=" + nomor + "&tgl=" + tgl + "&anggota=" + anggota +
				"&lama=" + lama + "&jumlah=" + jumlah + "&bunga=" + bunga + "&harga_barang=" + harga_barang + "&dp=" + dp;

			//alert('Info ' + string);
			if (sisa != 0) {
				alert('Maaf, Angsuran Belum LUNAS');
				$("#anggota").focus();
				return false();
			}
			if (anggota.length == 0) {
				alert('Maaf, Nomor Anggota tidak boleh kosong');
				$("#anggota").focus();
				return false();
			}
			if (tgl.length == 0) {
				alert('Maaf, Tanggal tidak boleh kosong');
				$("#tgl").focus();
				return false();
			}
			if (harga_barang.length == 0) {
				alert('Maaf, Harga Barang tidak boleh kosong');
				$("#harga_barang").focus();
				return false();
			}
			if (dp.length == 0) {
				alert('Maaf, Uang Muka tidak boleh kosong');
				$("#dp").focus();
				return false();
			}
			if (lama.length == 0) {
				alert('Maaf, Lama tidak boleh kosong');
				$("#lama").focus();
				return false();
			}
			if (bunga.length == 0) {
				alert('Maaf, Margin tidak boleh kosong');
				$("#bunga").focus();
				return false();
			}
			if (jumlah.length == 0) {
				alert('Maaf, Jumlah tidak boleh kosong');
				$("#jumlah").focus();
				return false();
			}
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url(); ?>/pinjaman/simpan",
				data: string,
				cache: false,
				success: function(data) {
					//alert('Info ' + data);
					//window.parent.location.reload(true);
					$.messager.show({
						title: 'Info',
						msg: data, //'Password Tidak Boleh Kosong.',
						timeout: 2000,
						showType: 'slide'
					});
					view_pinjaman(nomor);
				},
				error: function(xhr, teksStatus, kesalahan) {
					$.messager.show({
						title: 'Info',
						msg: 'Server tidak merespon :' + kesalahan,
						timeout: 2000,
						showType: 'slide'
					});
				}
			});
		}

		$("#cetak").click(function() {
			var id = $("#nomor").val();
			var tgl = $("#tgl").val();
			var anggota = $("#anggota").val();
			//var jenis		= $("#jenis").val();
			var jumlah = $("#jumlah").val();

			if (anggota.length == 0) {
				alert('Maaf, Nomor Anggota tidak boleh kosong');
				$("#anggota").focus();
				return false();
			}
			if (tgl.length == 0) {
				alert('Maaf, Tanggal tidak boleh kosong');
				$("#tgl").focus();
				return false();
			}
			if (jumlah.length == 0) {
				alert('Maaf, Jumlah tidak boleh kosong');
				$("#jumlah").focus();
				return false();
			}
			if (harga_barang.length == 0) {
				alert('Maaf, Harga Barang tidak boleh kosong');
				$("#harga_barang").focus();
				return false();
			}
			if (dp.length == 0) {
				alert('Maaf, Uang Muka tidak boleh kosong');
				$("#dp").focus();
				return false();
			}
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/pinjaman/CariData",
				data: "id=" + id,
				cache: false,
				dataType: "json",
				success: function(data) {
					//$('#jumlah').val(data.jumlah);
					//alert('Info '+data.info);
					if (data.info == true) {
						window.open('<?php echo site_url(); ?>/pinjaman/cetak/' + id);
					} else {
						alert('Maaf, Data belum tersimpan');
					}

				}
			});
		});

	});

	function cetakData(ID) {
		var id = ID;
		//alert(id);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>/pinjaman/CariData",
			data: "id=" + id,
			cache: false,
			dataType: "json",
			success: function(data) {
				//$('#jumlah').val(data.jumlah);
				//alert('Info '+data.info);
				if (data.info == true) {
					window.open('<?php echo site_url(); ?>/pinjaman/cetak/' + id);
				} else {
					alert('Maaf, Data belum tersimpan');
				}

			}
		});
	}
</script>
<style type="text/css">
	#tombol {
		float: left;
	}

	#pencarian {
		float: right;
	}

	#form_input {
		width: 100%;
		height: 200px;
	}

	#simulasi {
		width: 30%;
		padding-top: 5px;
	}

	#inputan {
		width: 30%;
		padding-top: 5px;
	}

	#view_anggota {
		width: 30%;
		padding-top: 5px;
	}

	#view_simpanan {
		margin: 0px;
	}
</style>
<div class="atas">
	<p><img src="<?php echo base_url(); ?>/asset/css/themes/icons/pinjaman.png" align="absmiddle" />
		DAFTAR PINJAMAN ANGGOTA
	</p>
</div>
<div class="tengah">
	<div id="tombol_proses">
		<div id="tombol">
			<?php echo form_button($tambah, 'Tambah Data'); ?>
			<?php echo form_button($refresh, 'Refresh Data'); ?>
		</div>
		<div id="pencarian">
			<?php echo form_open('pinjaman/index'); ?>
			Pencarian <?php echo form_input($cari); ?>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div class="tampil_data">
		<table id="theTable" width="100%">
			<tr>
				<th width="5">No</th>
				<th width="50">Nomor</th>
				<th>Tanggal</th>
				<th>Nomor Anggota</th>
				<th>Nama Anggota</th>
				<th>Jenis Kelamin</th>
				<th>Lama</th>
				<th>Jumlah</th>
				<th>Margin</th>
				<th>Jumlah Bayar</th>
				<th>Jumlah Cicilan</th>
				<th>Sisa</th>
				<th>Aksi</th>
			</tr>
			<?php
			if ($dt_pinjaman->num_rows() > 0) {
				$no = 1 + $hal;
				foreach ($dt_pinjaman->result_array() as $db) {
					if ($db['jk'] == 'L') {
						$sex = 'Laki-laki';
					} else {
						$sex = 'Perempuan';
					}
					$jml_bayar = $db['jumlah'] + (($db['jumlah'] * $db['bunga'] / 100) * $db['lama']);
					$jml_cicilan = $this->app_model->jmlCicilan($db['id_pinjam']);
					$sisa = $jml_bayar - $jml_cicilan;
			?>
					<tr>
						<td align="center"><?php echo $no; ?></td>
						<td align="center"><?php echo $db['id_pinjam']; ?></td>
						<td align="center"><?php echo $this->app_model->tgl_str($db['tgl']); ?></td>
						<td align="center"><?php echo $db['noanggota']; ?></td>
						<td><?php echo $db['namaanggota']; ?></td>
						<td align="center"><?php echo $sex; ?></td>
						<td align="center"><?php echo $db['lama'] . " Bulan"; ?></td>
						<td align="right"><?php echo number_format($db['jumlah']); ?></td>
						<td align="center"><?php echo $db['bunga'] . "%"; ?></td>
						<td align="right"><?php echo number_format($jml_bayar); ?></td>
						<td align="right"><?php echo number_format($jml_cicilan); ?></td>
						<td align="right"><?php echo number_format($sisa); ?></td>
						<td align="center">
							<!--<a href="<?php echo base_url(); ?>index.php/pinjaman/hapus/<?php echo $db['id_pinjam']; ?>" onClick="return confirm('Anda yakin ingin menghapus data ini?')">
								<img src="<?php echo base_url(); ?>asset/images/del.png" title='Hapus'>
							</a>-->
							<a href="javascript:cetakData('<?php echo $db['id_pinjam'] ?>')">
								<img src="<?php echo base_url(); ?>asset/images/print.png" title='Cetak'>
							</a>
						</td>
					</tr>
				<?php
					$no++;
				}
			} else {
				?>
				<tr>
					<td colspan="5" align="center">Tidak Ada Data</td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
	<div id="form_input" class="easyui-layout" data-options="fit:true">
		<div id="inputan" region="center" title="Data Pinjaman">
			<p><label>ID Pinjaman</label>:<?php echo form_input($nomor); ?></p>
			<p><label>Nomor Anggota</label>:<?php echo form_input($anggota); ?></p>
			<p><label>Tanggal</label>:<?php echo form_input($tgl); ?></p>
			<p><label>Harga Barang</label>:<?php echo form_input($harga_barang); ?></p>
			<p><label>Uang Muka</label>:<?php echo form_input($dp); ?></p>
			<p><label>Lama Pinjaman</label>:<?php echo form_input($lama); ?> Bulan
			</p>
			<p>
				<label>Margin</label>:<?php echo form_input($bunga); ?> %/Bulan
			</p>
			<p><label>Jumlah Pinjaman</label>:<?php echo form_input($jumlah); ?></p>
		</div>
		<div id="simulasi" region="west" title="Simulasi" data-options="collapsible:false">
			<p><label>Pokok per Bulan</label>:<?php echo form_input($pokok_b); ?></p>
			<p><label>Margin per Bulan</label>:<?php echo form_input($bunga_b); ?></p>
			<p><label>Angsuran per Bulan</label>:<?php echo form_input($ang_total_b); ?></p>
			<p><label>Total Pokok</label>:<?php echo form_input($tot_pokok); ?></p>
			<p><label>Total Margin</label>:<?php echo form_input($tot_bunga); ?></p>
			<p><label>Total Bayar</label>:<?php echo form_input($ang_total); ?></p>
		</div>
		<div id="view_anggota" region="east" title="Data Anggota" data-options="collapsible:false">
			<p><label>No.Identitas</label>:<?php echo form_input($identitas); ?></p>
			<p><label>Nama Anggota</label>:<?php echo form_input($nama_anggota); ?></p>
			<p><label>Jenis Kelamin</label>:<?php echo form_input($jk); ?></p>
			<p><label>HP</label>:<?php echo form_input($hp); ?></p>
			<p><label>Cicilan / Angsuran</label>:<?php echo form_input($angsuran); ?></p>
			<p><label>Sisa Angsuran</label>:<?php echo form_input($sisa_angsuran); ?></p>
		</div>
	</div>
</div>
<div class="bawah">
	<div id="paging">
		<p>
			<center><?php echo $paginator; ?></center>
		</p>
	</div>
	<div id="tombol_input">
		<center>
			<?php echo form_button($simpan, 'SIMPAN'); ?>
			<?php echo form_button($cetak, 'CETAK'); ?>
			<?php echo form_button($kosong, 'KOSONG'); ?>
			<?php echo form_button($tutup, 'TUTUP'); ?>
		</center>
	</div>
</div>
<div id="view_pinjaman"></div>