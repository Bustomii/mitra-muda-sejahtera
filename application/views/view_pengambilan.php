<script type="text/javascript">
	$(function() {
		$("#theTable.detail tr:even").addClass("stripe1");
		$("#theTable.detail tr:odd").addClass("stripe2");
		$("#theTable.detail tr").hover(
			function() {
				$(this).toggleClass("highlight");
			},
			function() {
				$(this).toggleClass("highlight");
			}
		);

		applyPagination();

		function applyPagination() {
			$("#ajax_paging a").click(function() {
				var url = $(this).attr("href");
				var nomor = $("#anggota").val();
				//alert('Info '+url);
				$.ajax({
					type: "POST",
					data: "ajax=1" + "&nomor=" + nomor,
					url: url,
					beforeSend: function() {
						$("#view_pengambilan").html("");
					},
					success: function(msg) {
						$("#view_pengambilan").html(msg);
						//alert(msg);
						applyPagination();
					}

				});
				return false;
			});
		}

	});

	function deleteData(ID) {
		var id = ID;
		var nomor = $("#anggota").val();
		var pilih = confirm('Data yang akan dihapus  = ' + id + '?');
		if (pilih == true) {
			$.ajax({
				type: "POST",
				url: "<?php echo site_url(); ?>/pengambilan/hapus",
				data: "id=" + id,
				success: function(data) {
					//window.parent.location.reload(true);
					view_pengambilan(nomor);
				}
			});
		}
	}

	function view_pengambilan(isi) {
		var nomor = isi; //$("#anggota").val();
		//alert('Info '+nomor);
		$.ajax({
			type: "POST",
			url: "<?php echo site_url(); ?>/pengambilan/view_pengambilan",
			data: "nomor=" + nomor,
			success: function(data) {
				$("#view_pengambilan").html(data);
				//alert('info'+nomor);
			}
		});
	}

	function cetakData(ID) {
		var id = ID;
		window.open('<?php echo site_url(); ?>/pengambilan/cetak?id=' + id);
	}
</script>
<style type="text/css">
	.tengah .tampil_data {
		margin: 0px;
	}
</style>
<div class="tengah">
	<div class="tampil_data">
		<table id="theTable" class="detail" width="100%">
			<tr>
				<th width="5">No</th>
				<th width="150">Tanggal</th>
				<th>Jenis Simpanan</th>
				<th>Jumlah </th>
				<th width="50">Aksi</th>
			</tr>
			<?php
			if ($dt_view_pengambilan->num_rows() > 0) {
				$no = 1 + $hal;
				foreach ($dt_view_pengambilan->result_array() as $db) {
					$tgl = $this->app_model->tgl_str($db['tgl']);
			?>
					<tr>
						<td align="center"><?php echo $no; ?></td>
						<td align="center"><?php echo $tgl; ?></td>
						<td><?php echo $db['jenis_simpanan']; ?></td>
						<td align="right"><?php echo number_format($db['jumlah']); ?></td>
						<td align="center">
							<a href="javascript:deleteData('<?php echo $db['id_ambil'] ?>')">
								<img src="<?php echo base_url(); ?>asset/images/del.png" title='Hapus'>
							</a>
							<a href="javascript:cetakData('<?php echo $db['id_ambil'] ?>')">
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
					<td colspan="6" align="center">Tidak Ada Data</td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
</div>
<div class="bawah">
	<div id="ajax_paging">
		<p>
			<center>
				<?php echo $paginators; ?>
			</center>
		</p>
	</div>
</div>