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

		$('#form_input').dialog({
			buttons: [{
				text: 'Simpan',
				iconCls: 'icon-save',
				handler: function() {
					simpan();
					return false;
				}
			}, {
				text: 'Tambah',
				iconCls: 'icon-add',
				handler: function() {
					$('input').val('');
					$('#userid').focus();
					return false;
				}
			}, {
				text: 'Tutup',
				iconCls: 'icon-close',
				handler: function() {
					$('#form_input').dialog('close');
					window.parent.location.reload(true);
					//$('.data').flexReload();
				}
			}]
		});

		$("#tambah").click(function() {
			$('#form_input').dialog('open');
			$('input').val('');
			$('#userid').focus();
		});

		$("#refresh").click(function() {
			//window.parent.location.reload(true);
			window.location.replace('<?php echo site_url(); ?>/pengguna/index');
		});

		function simpan() {
			var userid = $("#userid").val();
			var namalengkap = $("#namalengkap").val();
			var password = $("#password").val();
			var level = $("#level").val();

			var string = "userid=" + userid + "&namalengkap=" + namalengkap + "&password=" + password + "&level=" + level;
			//alert('Info '+string);

			if (userid.length == 0) {
				alert('Maaf, User ID tidak boleh kosong');
				$("#userid").focus();
				return false();
			}
			if (namalengkap.length == 0) {
				alert('Maaf, Nama Lengkap tidak boleh kosong');
				$("#namalengkap").focus();
				return false();
			}
			if (password.length == 0) {
				alert('Maaf, Password tidak boleh kosong');
				$("#password").focus();
				return false();
			}
			if (level.length == 0) {
				alert('Maaf, Level tidak boleh kosong');
				$("#level").focus();
				return false();
			}
			$.ajax({
				type: 'POST',
				url: "<?php echo site_url(); ?>/pengguna/simpan",
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
	});

	function editData(ID) {
		var cari = ID;
		//alert('Info '+ID);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>/pengguna/cari",
			data: "cari=" + cari,
			dataType: "json",
			success: function(data) {
				//$("#tampil_data_detail").html(data);
				$('#userid').val(ID);
				$("#userid").attr("disabled", true);
				$('#namalengkap').val(data.namalengkap);
				$('#level').val(data.level);
				//$('#password').val(data.password);
				$('#form_input').dialog('open');
				$('#namalengkap').focus();

			}
		});
	}

	function deleteData(ID) {
		var id = ID;
		var pilih = confirm('Data yang akan dihapus  = ' + id + '?');
		if (pilih == true) {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/pengguna/hapus",
				data: "id=" + id,
				success: function(data) {
					window.parent.location.reload(true);
				}
			});
		}
	}
</script>
<style type="text/css">
	#tombol {
		float: left;
	}

	#pencarian {
		float: right;
	}
</style>
<div class="atas">
	<p><img src="<?php echo base_url(); ?>/asset/css/themes/icons/users_add.png" align="absmiddle" />
		DAFTAR PENGGUNA
	</p>
</div>
<div class="tengah">
	<div id="tombol_proses">
		<div id="tombol">
			<?php echo form_button($tambah, 'Tambah Data'); ?>
			<?php echo form_button($refresh, 'Refresh Data'); ?>
		</div>
		<div id="pencarian">
			<?php echo form_open('pengguna/index'); ?>
			Pencarian <?php echo form_input($cari); ?>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div class="tampil_data">
		<table id="theTable" width="100%">
			<tr>
				<th width="5">No</th>
				<th>User ID</th>
				<th>Nama Lengkap</th>
				<th>Level</th>
				<th colspan="2" width="5">Aksi</th>
			</tr>
			<?php
			if ($dt_pengguna->num_rows() > 0) {
				$no = 1 + $hal;
				foreach ($dt_pengguna->result_array() as $db) {
					$l = $db['level'];
					$lv = $this->app_model->nama_level($l);
			?>
					<tr>
						<td align="center"><?php echo $no; ?></td>
						<td><?php echo $db['user_id']; ?></td>
						<td><?php echo $db['namalengkap']; ?></td>
						<td><?php echo $l; ?></td>
						<td align="center">
							<a href="javascript:editData('<?php echo $db['user_id'] ?>')">
								<img src="<?php echo base_url(); ?>asset/images/ed.png" title='Ubah'>
							</a>
						</td>
						<td align="center">
							<a href="javascript:deleteData('<?php echo $db['user_id']; ?>')">
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
					<td colspan="4" align="center">Tidak Ada Data</td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
	<div id="form_input" class="easyui-dialog" title="Input Data" style="padding:5px;width:520px;height:220px;" data-options="closed:true,modal:true,buttons:'#dlg-buttons',resizable:false">
		<p><label>User ID</label>:<?php echo form_input($userid); ?></p>
		<p><label>Nama Lengkap</label>:<?php echo form_input($namalengkap); ?></p>
		<p><label>Password *)</label>:<?php echo form_input($password); ?></p>
		<p>*)Password harus diisi kembali</p>
		<p><label>Level</label>:<?php echo form_dropdown('level', $opt_level, '', $level); ?></p>
	</div>
</div>
<div class="bawah">
	<div id="paging">
		<center><?php echo $paginator; ?></center>
	</div>
</div>