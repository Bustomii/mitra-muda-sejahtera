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

			$('#ajax_paging').hide();
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

			$('#ajax_paging').show();
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
			$("#view_simpanan").hide();
		});

		$("#tutup").click(function() {
			//tampil_data();
			window.location.replace('<?php echo site_url(); ?>/simpanan/index');
		});

		function CariKode() {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/simpanan/CariKode",
				dataType: "json",
				cache: false,
				success: function(data) {
					$('#nomor').val(data.nomor);
				}
			});
		}

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
					$('#hp').val(data.hp);
					var nama = data.anggota;
					if (nama.length > 1) {
						$("#view_simpanan").show();
						view_simpanan(isi);
					} else {
						$("#view_simpanan").hide();
						view_simpanan(isi);
					}
				}
			});
		}

		function view_simpanan(isi) {
			var nomor = isi; //$("#anggota").val();
			//alert('Info '+nomor);
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/simpanan/view_simpanan",
				data: "nomor=" + nomor,
				success: function(data) {
					$("#view_simpanan").html(data);
					//alert('info'+nomor);
				}
			});
		}

		function CariJenis() {
			var id = $("#jenis").val();
			//alert('Info '+nomor);
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/simpanan/CariJenis",
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
			window.location.replace('<?php echo site_url(); ?>/simpanan/index');
		});

		$("#simpan").click(function() {
			simpan();
		});

		function simpan() {
			var nomor = $("#nomor").val();
			var tgl = $("#tgl").val();
			var anggota = $("#anggota").val();
			var jenis = $("#jenis").val();
			var jumlah = $("#jumlah").val();

			var string = "nomor=" + nomor + "&tgl=" + tgl + "&anggota=" + anggota +
				"&jenis=" + jenis + "&jumlah=" + jumlah;

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
			if (jenis.length == 0) {
				alert('Maaf, Jenis tidak boleh kosong');
				$("#jenis").focus();
				return false();
			}
			if (jumlah.length == 0) {
				alert('Maaf, Jumlah tidak boleh kosong');
				$("#jumlah").focus();
				return false();
			}
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url(); ?>/simpanan/simpan",
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
					view_simpanan(anggota);
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
			var jenis = $("#jenis").val();
			var jumlah = $("#jumlah").val();

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
			if (jenis.length == 0) {
				alert('Maaf, Jenis tidak boleh kosong');
				$("#jenis").focus();
				return false();
			}
			if (jumlah.length == 0) {
				alert('Maaf, Jumlah tidak boleh kosong');
				$("#jumlah").focus();
				return false();
			}
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/simpanan/CariData",
				data: "id=" + id,
				cache: false,
				dataType: "json",
				success: function(data) {
					//$('#jumlah').val(data.jumlah);
					//alert('Info '+data.info);
					if (data.info == true) {
						window.open('<?php echo site_url(); ?>/simpanan/cetak?id=' + id);
					} else {
						alert('Maaf, Data belum tersimpan');
					}

				}
			});
		});

	});
</script>


<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Simpanan</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Simpanan</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
	<div class="container-fluid">

		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">

				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><strong>DAFTAR SIMPANAN ANGGOTA</strong></h3>
					</div>
					<!-- /.card-header -->
					<!-- Main content -->
					<section class="content">
						<div class="row">
							<div class="card-body">
								<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tombol_input">
									<i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data
								</button>
								<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">
									<i class="fa fa-retweet" aria-hidden="true"></i> Refresh Data
								</button>
								<?php echo form_button($tambah, 'Tambah Data'); ?>
								<?php echo form_button($refresh, 'Refresh Data'); ?>
								<br><br>

								<table id="example1" class="table table-bordered table-striped">
									<div class="col-12">
										<thead>
											<tr>
												<th rowspan="2" width="5%">No.</th>
												<th rowspan="2" width="9%">No.Identitas</th>
												<th rowspan="2">Nama Anggota</th>
												<th rowspan="2">JK</th>
												<?php
												if ($header_jenis->num_rows() > 0) {
													foreach ($header_jenis->result_array() as $db) {
												?>
														<th colspan="3"><?php echo $db['jenis_simpanan']; ?></th>
												<?php
													}
												}
												?>
											</tr>
											<tr>
												<?php
												if ($header_jenis->num_rows() > 0) {
													foreach ($header_jenis->result_array() as $db) {
												?>
														<th>Debet</th>
														<th>Kredit</th>
														<th class="saldo">Saldo</th>
												<?php
													}
												}
												?>
											</tr>
										</thead>
										<tbody>
											<?php
											if ($dt_simpanan->num_rows() > 0) {
												$no = 1 + $hal;
												foreach ($dt_simpanan->result_array() as $db) {
													if ($db['jk'] == 'L') {
														$sex = 'Laki-laki';
													} else {
														$sex = 'Perempuan';
													}

													$saldo = $db['jumlah_simpanan'] - $db['jumlah_pengambilan']
											?>
													<tr>
														<td align="center"><?php echo $db['noanggota']; ?></td>
														<td align="center"><?php echo $db['noidentitas']; ?></td>
														<td><?php echo $db['namaanggota']; ?></td>
														<td align="center"><?php echo $db['jk']; ?></td>
														<?php
														if ($header_jenis->num_rows() > 0) {
															foreach ($header_jenis->result_array() as $datas) {
																$id = $db['noanggota'];
																$jn = $datas['id_jenis'];
																$simpanan = $this->app_model->Jumlah_Simpanan_Jenis($id, $jn);
																$pengambilan = $this->app_model->Jumlah_Pengambilan_Jenis($id, $jn);
																$saldoPerJenis = $simpanan - $pengambilan;
														?>
																<td align="right"><?php echo number_format($pengambilan); ?></td>
																<td align="right"><?php echo number_format($simpanan); ?></td>
																<td class="saldo" align="right"><?php echo number_format($saldoPerJenis); ?></td>
														<?php
															}
														}
														?>
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
										</tbody>
										<tfoot>
											<tr>
												<th rowspan="2" width="5%">No.</th>
												<th rowspan="2" width="9%">No.Identitas</th>
												<th rowspan="2">Nama Anggota</th>
												<th rowspan="2">Jenis Kelamin</th>
												<?php
												if ($header_jenis->num_rows() > 0) {
													foreach ($header_jenis->result_array() as $db) {
												?>
														<th colspan="3"><?php echo $db['jenis_simpanan']; ?></th>
												<?php
													}
												}
												?>
											</tr>
											<tr>
												<?php
												if ($header_jenis->num_rows() > 0) {
													foreach ($header_jenis->result_array() as $db) {
												?>
														<th>Debet</th>
														<th>Kredit</th>
														<th class="saldo">Saldo</th>
												<?php
													}
												}
												?>
											</tr>
										</tfoot>
									</div>
								</table>

								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
						<!-- /.col -->
				</div>
				<!-- /.row -->

			</section>
		</div>
		<!-- /.row (main row) -->

	</div>
</section>
<!-- /.content -->