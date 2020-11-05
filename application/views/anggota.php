<script type="text/javascript">
	var global_image = '';
	Webcam.set({
		// live preview size
		width: 320,
		height: 240,

		// device capture size
		dest_width: 320,
		dest_height: 240,

		// final cropped size
		crop_width: 240,
		crop_height: 240,

		image_format: 'jpeg',
		jpeg_quality: 90
	});
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

		$("#anggota").keyup(function(e) {
			var isi = $(e.target).val();
			$(e.target).val(isi.toUpperCase());
			CariAnggota(isi);
		});

		$("#tgl_lhr").datepicker({
			dateFormat: "dd-mm-yy",
			changeYear: true,
			changeMonth: true,
			yearRange: "-100:+0",
			modal: true
		});

		function tampil_data() {

			$('#form_input').hide();
			$('#tombol_input').hide();
			$('#w').window('close');
			$('.tampil_data').show();
			$('#tombol').show();
			$('#pencarian').show();
			$('#paging').show();
		}

		function input_data() {
			$('#form_input').show();
			$('#tombol_input').show();
			$('#w').window('close');
			$('.tampil_data').hide();
			$('#tombol').hide();
			$('#pencarian').hide();
			$('#paging').hide();
		}

		tampil_data();

		$("#tambah").click(function() {
			input_data();
			$('input').val('');
			$('select').val('');
			CariKode();
			$('#identitas').focus();
		});

		$("#kosong").click(function() {
			$('input').val('');
			$('select').val('');
			CariKode();
			$('#identitas').focus();
		});

		$("#tutup").click(function() {
			//tampil_data();
			window.location.replace('<?php echo site_url(); ?>/anggota/index');
		});

		function CariKode() {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/anggota/CariKode",
				dataType: "json",
				success: function(data) {
					$('#nomor').val(data.nomor);
				}
			});
		}
		$("#refresh").click(function() {
			window.location.replace('<?php echo site_url(); ?>/anggota/index');
		});

		$("#simpan").click(function() {
			simpan();
		});
		$("#prev_foto").click(function() {
			kamera();
		});
		$("#capture").click(function() {
			capture();
		});
		$("#close_capture").click(function() {
			close_capture();
		});

		$('#foto').change(function() {
			readURL(this);
		});

		function simpan() {
			var nomor = $("#nomor").val();
			var identitas = $("#identitas").val();
			var anggota = $("#anggota").val();
			var jk = $("#jk").val();
			var tempat_lhr = $("#tempat_lhr").val();
			var tgl_lhr = $("#tgl_lhr").val();
			var hp = $("#hp").val();
			var alamat = $("#alamat").val();
			var fotos = $("#foto").val();
			var foto = document.getElementById("foto").files[0];
			var old_foto = $("#old_foto").val();
			var base64image = global_image.replace(/^data\:image\/\w+\;base64\,/, '');
			var source_img = document.getElementById("prev_foto").src;
			var url = "<?php echo site_url('anggota/simpan_capture'); ?>";
			var string = "?nomor=" + nomor + "&identitas=" + identitas + "&anggota=" + anggota + "&jk=" + jk + "&tempat_lhr=" + tempat_lhr + "&tgl_lhr=" + tgl_lhr + "&hp=" + hp + "&alamat=" + alamat;
			//alert('Info ' + base64image);
			var form_data = new FormData();
			form_data.append("nomor", nomor);
			form_data.append("identitas", identitas);
			form_data.append("anggota", anggota);
			form_data.append("jk", jk);
			form_data.append("tempat_lhr", tempat_lhr);
			form_data.append("tgl_lhr", tgl_lhr);
			form_data.append("hp", hp);
			form_data.append("alamat", alamat);
			form_data.append("foto", foto);
			form_data.append("old_foto", old_foto);
			form_data.append("image", base64image);

			if (identitas.length == 0) {
				$.messager.show({
					title: 'Info',
					msg: "Maaf, No Identitas Tidak Boleh Kosong", //'Password Tidak Boleh Kosong.',
					timeout: 2000,
					showType: 'slide'
				});
				$("#identitas").focus();
				return false;
			} else {
				if (anggota.length == 0) {
					$.messager.show({
						title: 'Info',
						msg: "Maaf, Nama Anggota Tidak Boleh Kosong", //'Password Tidak Boleh Kosong.',
						timeout: 2000,
						showType: 'slide'
					});
					$("#anggota").focus();
					return false;
				} else {
					if (jk.length == 0) {
						$.messager.show({
							title: 'Info',
							msg: "Maaf, Jenis Kelamin Tidak Boleh Kosong", //'Password Tidak Boleh Kosong.',
							timeout: 2000,
							showType: 'slide'
						});;
						$("#jk").focus();
						return false;
					} else {
						if (tempat_lhr.length == 0) {
							$.messager.show({
								title: 'Info',
								msg: "Maaf, Tempat Lahir Tidak Boleh Kosong", //'Password Tidak Boleh Kosong.',
								timeout: 2000,
								showType: 'slide'
							});
							$("#tempat_lhr").focus();
							return false;
						} else {
							if (tgl_lhr.length == 0) {
								$.messager.show({
									title: 'Info',
									msg: "Maaf, Tanggal Lahir Tidak Boleh Kosong", //'Password Tidak Boleh Kosong.',
									timeout: 2000,
									showType: 'slide'
								});
								$("#tgl_lhr").focus();
								return false;
							} else {
								if (hp.length == 0) {
									$.messager.show({
										title: 'Info',
										msg: "Maaf, No Hp Tidak Boleh Kosong", //'Password Tidak Boleh Kosong.',
										timeout: 2000,
										showType: 'slide'
									});
									$("#hp").focus();
									return false;
								} else {
									if (alamat.length == 0) {
										$.messager.show({
											title: 'Info',
											msg: "Maaf, Alamat Tidak Boleh Kosong", //'Password Tidak Boleh Kosong.',
											timeout: 2000,
											showType: 'slide'
										});
										$("#alamat").focus();
										return false;
									} else {
										if (fotos.length == 0) {
											if (source_img != "<?= base_url('uploads') . '/'; ?>" + old_foto) {
												if (source_img == "<?= base_url('uploads') . '/default.png'; ?>") {
													$.messager.show({
														title: 'Info',
														msg: "Maaf, Foto Tidak Boleh Kosong", //'Password Tidak Boleh Kosong.',
														timeout: 2000,
														showType: 'slide'
													});
													$("#foto").focus();
													return false;
												} else {
													Webcam.on('uploadComplete', function(code, text) {
														$.messager.show({
															title: 'Info',
															msg: text, //'Password Tidak Boleh Kosong.',
															timeout: 2000,
															showType: 'slide'
														});
													});
													Webcam.upload(global_image, url + string);
													/*
													$.ajax({
														url: "<?php echo site_url(); ?>/anggota/simpan_capture",
														type: 'POST',
														data: form_data,
														processData: false,
														contentType: false,
														cache: false,
														async: false,
														success: function(data) {
															//alert('Info '+data);
															//window.parent.location.reload(true);
															$.messager.show({
																title: 'Info',
																msg: data, //'Password Tidak Boleh Kosong.',
																timeout: 2000,
																showType: 'slide'
															});
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
													*/

													/*
													$.ajax({
															url: '',
															type: 'POST',
															dataType: 'json',
															data: {
																nomor: nomor,
																identitas: identitas,
																anggota: anggota,
																jk: jk,
																tempat_lhr: tempat_lhr,
																tgl_lhr: tgl_lhr,
																hp: hp,
																alamat: alamat,
																image: base64image
															},
														})
														.done(function(data) {
															$.messager.show({
																title: 'Info',
																msg: data, //'Password Tidak Boleh Kosong.',
																timeout: 2000,
																showType: 'slide'
															});
														})
														.fail(function() {
															console.log("error");
														})
														.always(function() {
															console.log("complete");
														});
														*/
												}
											} else {
												$.ajax({
													url: "<?php echo site_url(); ?>/anggota/simpan",
													type: 'POST',
													data: form_data,
													processData: false,
													contentType: false,
													cache: false,
													async: false,
													success: function(data) {
														//alert('Info '+data);
														//window.parent.location.reload(true);
														$.messager.show({
															title: 'Info',
															msg: data, //'Password Tidak Boleh Kosong.',
															timeout: 2000,
															showType: 'slide'
														});
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
										} else {
											$.ajax({
												url: "<?php echo site_url(); ?>/anggota/simpan",
												type: 'POST',
												data: form_data,
												processData: false,
												contentType: false,
												cache: false,
												async: false,
												success: function(data) {
													//alert('Info '+data);
													//window.parent.location.reload(true);
													$.messager.show({
														title: 'Info',
														msg: data, //'Password Tidak Boleh Kosong.',
														timeout: 2000,
														showType: 'slide'
													});
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
									}
								}
							}
						}
					}
				}
			}
		}

		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#prev_foto').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}

		function kamera() {
			$('#w').window('open');
			Webcam.reset();
			// seleksi elemen video
			Webcam.attach('#my_camera');
		}

		function capture() {
			Webcam.snap(function(data_uri) {
				global_image = data_uri;
				$('#prev_foto').attr('src', global_image);
				//$('#old_foto').val(image);
				$('#w').window('close');
				Webcam.reset();
			});
		}

		function close_capture() {
			$('#w').window('close');
			Webcam.reset();
		}
	});

	function tampil_data() {
		$('#form_input').hide();
		$('#tombol_input').hide();
		$('#w').window('close');
		$('.tampil_data').show();
		$('#tombol').show();
		$('#pencarian').show();
		$('#paging').show();
	}

	function input_data() {
		$('#form_input').show();
		$('#tombol_input').show();
		$('#w').window('close');
		$('.tampil_data').hide();
		$('#tombol').hide();
		$('#pencarian').hide();
		$('#paging').hide();
	}

	function editData(ID) {
		var cari = ID;
		var dtfoto = "<?php echo base_url('uploads'); ?>/";
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>/anggota/cari",
			data: "cari=" + cari,
			dataType: "json",
			success: function(data) {
				input_data();

				dtfoto += data.foto;

				$('#nomor').val(ID);
				$('#identitas').val(data.identitas);
				$('#anggota').val(data.anggota);
				$('#jk').val(data.jk);
				$('#tempat_lhr').val(data.tempat_lhr);
				$('#tgl_lhr').val(data.tgl_lhr);
				$('#hp').val(data.hp);
				$('#alamat').val(data.alamat);
				$('#old_foto').val(data.foto);
				$('#prev_foto').attr("src", dtfoto);

				$('#identitas').focus();
			}
		});

	}

	function deleteData(ID) {
		var id = ID;
		var pilih = confirm('Data yang akan dihapus  = ' + id + '?');
		if (pilih == true) {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/anggota/hapus",
				data: "id=" + id,
				success: function(data) {
					window.parent.location.reload(true);
				}
			});
		}
	}

	function hanyaAngka(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))

			return false;
		return true;
	}
</script>

<style type="text/css">
	#tombol {
		float: left;
	}

	#pencarian {
		float: right;
	}

	#preview {
		float: right;
	}

	#w {
		width: 260px;
		padding: 10px;
	}

	#btn_capture {
		padding-top: 10px;
	}

	#capture {
		float: left;
	}

	#close_capture {
		float: right;
	}
</style>
<div class="atas">
	<p><img src="<?php echo base_url(); ?>/asset/css/themes/icons/users.png" align="absmiddle" />
		DAFTAR ANGGOTA
	</p>
</div>
<div class="tengah">
	<div id="tombol_proses">
		<div id="tombol">
			<?php echo form_button($tambah, 'Tambah Data'); ?>
			<?php echo form_button($refresh, 'Refresh Data'); ?>
		</div>
		<div id="pencarian">
			<?php echo form_open('anggota/index'); ?>
			Pencarian <?php echo form_input($cari); ?>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div class="tampil_data">
		<table id="theTable" width="100%">
			<tr>
				<th width="5">No</th>
				<th width="50">Nomor</th>
				<th>Foto</th>
				<th>No.Identitas</th>
				<th>Nama Anggota</th>
				<th>Jenis Kelamin</th>
				<th>HP</th>
				<th width="50" colspan="2">Aksi</th>
			</tr>
			<?php
			if ($dt_anggota->num_rows() > 0) {
				$no = 1 + $hal;
				foreach ($dt_anggota->result_array() as $db) {
					if ($db['jk'] == 'L') {
						$sex = 'Laki-laki';
					} else {
						$sex = 'Perempuan';
					}
			?>
					<tr>
						<td align="center"><?php echo $no; ?></td>
						<td align="center"><?php echo $db['noanggota']; ?></td>
						<td align="center"><img id="tb_foto" name="tb_foto" width="50px" height="50px" src="<?php echo base_url('uploads/' . $db['foto']); ?>" class="img-responsive img-thumbnail" alt="Preview Image" /></td>
						<td align="center"><?php echo $db['noidentitas']; ?></td>
						<td><?php echo $db['namaanggota']; ?></td>
						<td align="center"><?php echo $sex; ?></td>
						<td align="left"><?php echo $db['hp']; ?></td>
						<td align="center">
							<a href="javascript:editData('<?php echo $db['noanggota'] ?>')">
								<img src="<?php echo base_url(); ?>asset/images/ed.png" title='Ubah'>
							</a>
						</td>
						<td align="center">
							<a href="javascript:deleteData('<?php echo $db['noanggota']; ?>')">
								<img src="<?php echo base_url(); ?>asset/images/del.png" title='Hapus'>
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
	<div class="container">
		<div class="row">
			<div id="form_input">
				<form id="submit">
					<div class="col-md-4">
						<div id="preview">
							<div id="w" class="easyui-window" title="Take a foto" data-options="minimizable:false,maximizable:false,collapsible:false,closable:false">
								<div id="my_camera"></div>
								<!--<video id="player" autoplay></video>-->
								<div id="btn_capture">
									<?= form_button($capture, 'CAPTURE'); ?>
									<?= form_button($close_capture, 'CLOSE'); ?>
								</div>
							</div>
							<p><?php
								echo img($prev_foto);
								?>
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="inputan">
							<p><label>Nomor</label>:<?php echo form_input($nomor); ?></p>
							<p><label>No.Identitas</label>:<?php echo form_input($identitas); ?></p>
							<p><label>Nama Anggota</label>:<?php echo form_input($anggota); ?></p>
							<p><label>Jenis Kelamin</label>:<?php echo form_dropdown('jk', $opt_jk, '', $jk); ?></p>
							<p><label>Tempat Lahir</label>:<?php echo form_input($tempat_lhr); ?></p>
							<p><label>Tanggal Lahir</label>:<?php echo form_input($tgl_lhr); ?></p>
							<p><label>HP</label>:<?php echo form_input($hp); ?></p>
							<p><label>Alamat</label>:<?php echo form_input($alamat); ?></p>
							<p><label>Foto</label>:<?php
													echo form_input($foto);
													echo form_input($old_foto); ?></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="bawah">
	<div id="paging">
		<center><?php echo $paginator; ?></center>
	</div>
	<div id="tombol_input">
		<center><?php echo form_button($simpan, 'SIMPAN'); ?>
			<?php echo form_button($kosong, 'KOSONG'); ?>
			<?php echo form_button($tutup, 'TUTUP'); ?></center>
	</div>
</div>