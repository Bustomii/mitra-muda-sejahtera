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

		$("#anggota").focus();

		$("#tgl").datepicker({
			dateFormat: "dd-mm-yy"
		});

		$("#anggota").keyup(function(e) {
			var isi = $(e.target).val();
			$(e.target).val(isi.toUpperCase());
			CariAnggota(isi);
		});

		$('#jumlah').priceFormat({
			prefix: '',
			centsSeparator: '',
			thousandsSeparator: ',',
			centsLimit: 0
		});

		function tampil_data() {

			$('#form_input').hide();
			$('#tombol_input').hide();
			$('#view_anggota').hide();
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
			$('#view_anggota').show();
			$('#view_simpanan').show();

			$('.tampil_data').hide();
			$('#tombol').hide();
			$('#pencarian').hide();
			$('#paging').hide();

			//$('#ajax_paging').show();
		}

		//tampil_data();

		$("#tambah").click(function() {
			input_data();
			$('input').val('');
			$('select').val('');
			$('#anggota').focus();
		});

		$("#kosong").click(function() {
			$('input').val('');
			$('select').val('');
			$('#anggota').focus();
			$("#view_pinjaman").hide();
			//view_pinjaman('xxx');
		});

		$("#tutup").click(function() {
			//tampil_data();
			window.location.replace('<?php echo site_url(); ?>/pinjaman/index');
		});

		function CariAnggota(isi) {
			var nomor = isi; //$("#anggota").val();
			//alert('Info '+nomor);
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
					//$('#hp').val(data.hp);
					$('#sisa_angsuran').val(data.sisa_angsuran);
					$('#nomor').val(data.no_pinjam);
					$('#lama').val(data.lama);
					$('#bunga').val(data.bunga);
					$('#jumlah').val(data.jumlah);
					$('#angsuran').val(data.angsuran);
					view_pinjaman(data.no_pinjam);
				}
			});
		}

		function view_pinjaman(isi) {
			var nomor = isi; //$("#anggota").val();
			//alert('Info '+nomor);
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/pembayaran/view_bayar",
				data: "nomor=" + nomor,
				success: function(data) {
					$("#view_pinjaman").html(data);
					//alert('info'+nomor);
				}
			});
		}

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
			var sisa = $("#sisa_angsuran").val();
			var angsuran = $("#angsuran").val();

			var string = "nomor=" + nomor + "&tgl=" + tgl + "&anggota=" + anggota +
				"&lama=" + lama + "&jumlah=" + jumlah + "&bunga=" + bunga + "&angsuran=" + angsuran;

			if (anggota.length == 0) {
				alert('Maaf, Nama Anggota tidak boleh kosong');
				$("#anggota").focus();
				return false();
			}
			if (tgl.length == 0) {
				alert('Maaf, Tanggal tidak boleh kosong');
				$("#tgl").focus();
				return false();
			}
			if (lama.length == 0) {
				alert('Maaf, Lama tidak boleh kosong');
				$("#lama").focus();
				return false();
			}
			if (bunga.length == 0) {
				alert('Maaf, Bunga tidak boleh kosong');
				$("#bunga").focus();
				return false();
			}
			if (jumlah.length == 0) {
				alert('Maaf, Jumlah tidak boleh kosong');
				$("#jumlah").focus();
				return false();
			}
			if (sisa.length == 0) {
				alert('Maaf, Angsuran Belum LUNAS');
				$("#anggota").focus();
				return false();
			}
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url(); ?>/pembayaran/simpan",
				data: string,
				cache: false,
				success: function(data) {
					//alert('Info '+data);
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
			var anggota = $("#anggota").val();
			var jumlah = $("#jumlah").val();

			if (anggota.length == 0) {
				alert('Maaf, Nama Anggota tidak boleh kosong');
				$("#anggota").focus();
				return false();
			}
			if (jumlah.length == 0) {
				alert('Maaf, Jumlah tidak boleh kosong');
				$("#jumlah").focus();
				return false();
			}
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/pembayaran/CariData",
				data: "id=" + id,
				cache: false,
				dataType: "json",
				success: function(data) {
					//$('#jumlah').val(data.jumlah);
					//alert('Info '+data.info);
					if (data.info == true) {
						window.open('<?php echo site_url(); ?>/pembayaran/cetak/' + id);
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

	#view_anggota {
		float: right;
	}

	#view_pinjaman {
		margin: 0px;
	}
</style>
<div class="atas">
	<p><img src="<?php echo base_url(); ?>/asset/css/themes/icons/bayar.png" align="absmiddle" />
		BAYAR PINJAMAN ANGGOTA
	</p>
</div>
<div class="tengah">

	<div id="form_input">
		<div id="view_anggota">
			<p><label>No.Identitas</label>:<?php echo form_input($identitas); ?></p>
			<p><label>Nama Anggota</label>:<?php echo form_input($nama_anggota); ?></p>
			<p><label>Jenis Kelamin</label>:<?php echo form_input($jk); ?></p>
			<p><label>Sisa Angsuran</label>:<?php echo form_input($sisa_angsuran); ?></p>
			<p><label>Cicilan / Angsuran</label>:<?php echo form_input($angsuran); ?></p>
		</div>
		<p><label>Nomor Anggota</label>:<?php echo form_input($anggota); ?></p>
		<p><label>Tanggal</label>:<?php echo form_input($tgl); ?></p>
		<p><label>ID Pinjaman</label>:<?php echo form_input($nomor); ?></p>
		<p><label>Lama</label>:<?php echo form_input($lama); ?></p>
		<p><label>Bunga</label>:<?php echo form_input($bunga); ?>%</p>
		<p><label>Jumlah</label>:<?php echo form_input($jumlah); ?></p>
	</div>
</div>
<div class="bawah">
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