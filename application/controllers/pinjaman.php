<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pinjaman extends CI_Controller
{
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id = $this->input->post('cari');

			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->app_model->Nama_Perusahaan();
			$d['alamat_perusahaan'] = $this->app_model->Alamat();
			$d['hp'] = $this->app_model->Hp();
			$d['lisensi'] = $this->config->item('lisensi_app');

			$d['jam_now'] = $this->app_model->Jam_Now();
			$d['hari_now'] = $this->app_model->Hari_Bulan_Indo();
			$d['tgl_now'] = $this->app_model->tgl_now_indo();

			//inputan
			$d['nomor'] = array(
				'name' => 'nomor',
				'id' => 'nomor',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '10',
				'maxlength' => '10',
				'readonly' => true
			);
			$d['tgl'] = array(
				'name' => 'tgl',
				'id' => 'tgl',
				'type' => 'text',
				'size' => '12',
				'maxlength' => '12'
			);
			$d['anggota'] = array(
				'name' => 'anggota',
				'id' => 'anggota',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '12',
				'maxlength' => '12',
				'data-options' => 'required:true,validType:\'length[1,20]\''
			);
			$d['lama'] = array(
				'name' => 'lama',
				'id' => 'lama',
				'type' => 'text',
				'size' => '5',
				'maxlength' => '5'
			);
			$d['harga_barang'] = array(
				'name' => 'harga_barang',
				'id' => 'harga_barang',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20'
			);
			$d['dp'] = array(
				'name' => 'dp',
				'id' => 'dp',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20'
			);

			$d['bunga'] = array(
				'name' => 'bunga',
				'id' => 'bunga',
				'type' => 'text',
				'size' => '5',
				'maxlength' => '5'
			);
			$d['jumlah'] = array(
				'name' => 'jumlah',
				'id' => 'jumlah',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);

			//view anggota
			$d['identitas'] = array(
				'name' => 'identitas',
				'id' => 'identitas',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['nama_anggota'] = array(
				'name' => 'nama_anggota',
				'id' => 'nama_anggota',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['jk'] = array(
				'name' => 'jk',
				'id' => 'jk',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['hp'] = array(
				'name' => 'hp',
				'id' => 'hp',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['angsuran'] = array(
				'name' => 'angsuran',
				'id' => 'angsuran',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['sisa_angsuran'] = array(
				'name' => 'sisa_angsuran',
				'id' => 'sisa_angsuran',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);

			//simulasi
			$d['pokok_b'] = array(
				'name' => 'pokok_b',
				'id' => 'pokok_b',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['bunga_b'] = array(
				'name' => 'bunga_b',
				'id' => 'bunga_b',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['ang_total_b'] = array(
				'name' => 'ang_total_b',
				'id' => 'ang_total_b',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['tot_pokok'] = array(
				'name' => 'tot_pokok',
				'id' => 'tot_pokok',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['tot_bunga'] = array(
				'name' => 'tot_bunga',
				'id' => 'tot_bunga',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['ang_total'] = array(
				'name' => 'ang_total',
				'id' => 'ang_total',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);

			//tombol bawah
			$d['simpan'] = array(
				'name' => 'simpan',
				'id' => 'simpan',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-save\''
			);
			$d['cetak'] = array(
				'name' => 'cetak',
				'id' => 'cetak',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-print\''
			);
			$d['kosong'] = array(
				'name' => 'kosong',
				'id' => 'kosong',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-new\''
			);
			$d['tutup'] = array(
				'name' => 'tutup',
				'id' => 'tutup',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-close\''
			);

			//tombol proses
			$d['cari'] = array(
				'name' => 'cari',
				'id' => 'cari',
				'type' => 'text',
				'size' => '50',
				'maxlength' => '50',
				'value' => $id,
				'placeholder' => 'Masukkan text.....'
			);
			$d['tambah'] = array(
				'name' => 'tambah',
				'id' => 'tambah',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-add\''
			);
			$d['refresh'] = array(
				'name' => 'refresh',
				'id' => 'refresh',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-reload\''
			);

			//paging
			$page = $this->uri->segment(3);
			$limit = $this->config->item('limit_data');
			if (!$page) :
				$offset = 0;
			else :
				$offset = $page;
			endif;

			$text = "SELECT a.id_pinjam,a.noanggota,
					b.namaanggota
					FROM pinjaman_header as a
					JOIN anggota as b
					ON a.noanggota=b.noanggota
					WHERE a.noanggota LIKE '%$id%' OR b.namaanggota LIKE '%$id%' OR a.id_pinjam LIKE '%$id%'
					GROUP BY a.id_pinjam";
			$tot_hal = $this->app_model->manualQuery($text);

			$config['base_url'] = site_url() . '/pinjaman/index/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$d["paginator"] = $this->pagination->create_links();
			$d['hal'] = $offset;

			$text = "SELECT a.id_pinjam,a.tgl,a.noanggota,a.jumlah,a.lama,a.bunga,
					b.namaanggota,b.jk,b.noidentitas
					FROM pinjaman_header as a
					JOIN anggota as b
					ON a.noanggota=b.noanggota
					WHERE a.noanggota LIKE '%$id%' OR b.namaanggota LIKE '%$id%' OR a.id_pinjam LIKE '%$id%'
					GROUP BY a.id_pinjam
					LIMIT $limit OFFSET $offset";
			$d['dt_pinjaman'] = $this->app_model->manualQuery($text);

			$d['isi'] = $this->load->view('pinjaman', $d, true);

			$this->load->view('media', $d);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function CariKode()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$data['nomor'] = $this->app_model->getMaxKodePinjaman();
			echo json_encode($data);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function simpan()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$tgl = $this->input->post('tgl');
			$lama = str_replace(",", "", $this->input->post('lama'));
			$harga_barang = str_replace(",", "", $this->input->post('harga_barang'));
			$dp = str_replace(",", "", $this->input->post('dp'));
			$jumlah = str_replace(",", "", $this->input->post('jumlah'));
			$bunga = str_replace(",", "", $this->input->post('bunga'));

			$up['id_pinjam'] = $this->input->post('nomor');
			$up['tgl'] = $this->app_model->tgl_sql($tgl);
			$up['noanggota'] = $this->input->post('anggota');
			$up['harga_barang'] = $harga_barang;
			$up['dp'] = $dp;
			$up['jumlah'] = $jumlah;
			$up['lama'] = $lama;
			$up['bunga'] = $bunga;
			$up['user_id'] = $this->session->userdata('username');

			$ud['id_pinjam'] = $this->input->post('nomor');
			$ud['bunga'] = ceil(($jumlah * $bunga / 100));
			$ud['angsuran'] = ceil($jumlah / $lama);

			$id['id_pinjam'] = $this->input->post('nomor');
			$hasil = $this->app_model->getSelectedData("pinjaman_header", $id);
			$row = $hasil->num_rows();
			if ($row == 0) {
				$this->app_model->insertData("pinjaman_header", $up);
				for ($i = 1; $i <= $lama; $i++) {
					$ud['tgl_jatuh_tempo'] = $this->app_model->tgl_tagihan($i, $tgl);
					$ud['cicilan'] = $i;
					$this->app_model->insertData("pinjaman_detail", $ud);
				}
				//$this->simpan_detail($up);
				echo "Data sukses disimpan";
			} else {
				echo "Data sudah ada!!!";
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function CariAnggota()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id['noanggota'] = $this->input->post('nomor');

			$hasil = $this->app_model->getSelectedData("anggota", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				foreach ($hasil->result() as $db) {
					if ($db->jk == 'L') {
						$sex = 'Laki-laki';
					} else {
						$sex = 'Perempuan';
					}
					$data['identitas'] = $db->noidentitas;
					$data['anggota'] = $db->namaanggota;
					$data['jk'] = $sex;
					$data['hp'] = $db->hp;
					$data['sisa_angsuran'] = 0; // $this->app_model->sisa_pinjaman($db->noanggota);

					echo json_encode($data);
				}
			} else {
				$data['identitas'] = '';
				$data['anggota'] = '';
				$data['jk'] = '';
				$data['hp'] = '';
				$data['sisa_angsuran'] = '';
				echo json_encode($data);
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function CariPinjaman()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$hb = str_replace(",", "", $this->input->post('hb'));
			$dp = str_replace(",", "", $this->input->post('dp'));
			$lm = str_replace(",", "", $this->input->post('lm'));
			$bg = str_replace(",", "", $this->input->post('bg'));
			$jm = $hb - $dp;
			$pokok_b = ceil($jm / $lm);
			$bunga_b = ceil(($jm * $bg) / 100);
			$data['jumlah'] = number_format($jm);
			$data['pokok_b'] = number_format($pokok_b);
			$data['bunga_b'] = number_format($bunga_b);
			$data['ang_total_b'] = number_format($pokok_b + $bunga_b);
			$data['tot_pokok'] = number_format($pokok_b * $lm);
			$data['tot_bunga'] = number_format($bunga_b * $lm);
			$data['ang_total'] = number_format(($pokok_b + $bunga_b) * $lm);
			echo json_encode($data);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}


	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			//$id['id_pinjam'] = $this->input->post('id');
			$id['id_pinjam'] = $this->uri->segment(3);

			$hasil = $this->app_model->getSelectedData("pinjaman_header", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$this->app_model->deleteData("pinjaman_header", $id);
				$this->app_model->deleteData("pinjaman_detail", $id);
				//echo "Data sukses dihapus";
				redirect('pinjaman', 'refresh');
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function view_pinjaman()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id = $this->input->post('nomor');

			$text = "SELECT *
					FROM pinjaman_detail
					WHERE id_pinjam='$id'
					ORDER BY cicilan";
			$d['dt_view_pinjaman'] = $this->app_model->manualQuery($text);

			$this->load->view('view_pinjaman', $d);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek)) {
			$id = $this->uri->segment(3); // $this->input->get('id');

			$text = "SELECT *
					FROM pinjaman_header as a
					JOIN pinjaman_detail as b
					JOIN anggota as c
					ON a.id_pinjam=b.id_pinjam AND a.noanggota=c.noanggota
					WHERE a.id_pinjam='$id'";

			//$hasil = $this->app_model->getSelectedData("anggota",$id);

			$hasil = $this->app_model->manualQuery($text);
			$row = $hasil->num_rows();
			if ($row > 0) {
				foreach ($hasil->result() as $db) {
					$d['kode'] = $id;
					$d['tgl'] = $this->app_model->tgl_str($db->tgl);
					$d['identitas'] = $db->noidentitas;
					$d['noanggota'] = $db->noanggota;
					$d['nama'] = $db->namaanggota;
					$d['alamat'] = $db->alamat;
					//$d['jenis'] = $db->jenis_simpanan;
					$d['jumlah'] = number_format($db->jumlah);
					//$d['terbilang'] = $this->app_model->terbilang($db->jumlah,4);
				}
			}
			//$d['kode'] = $id;

			$this->load->view('cetak-pinjaman', $d);
			//echo $text;

		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function CariData()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek)) {
			$id['id_pinjam'] = $this->input->post('id');

			$hasil = $this->app_model->getSelectedData("pinjaman_header", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$data['info'] = true;
				echo json_encode($data);
			} else {
				$data['info'] = false;
				echo json_encode($data);
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}
}

/* End of file anggota.php */
/* Location: ./application/controllers/anggota.php */
