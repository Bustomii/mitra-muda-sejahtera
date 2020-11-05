<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengambilan extends CI_Controller
{
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$akses = $this->session->userdata('akses');
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
			$d['jenis'] = 'id="jenis"';

			$jenis = $this->app_model->manualQuery("SELECT * FROM jenis_simpan");
			$d['opt_jenis'][''] = '-Pilih-';
			foreach ($jenis->result() as $db) {
				if ($akses == 'super admin') {
					$d['header_jenis'] = $jenis;
					$d['opt_jenis'][$db->id_jenis] = '| ' . $db->id_jenis . ' | ' . $db->jenis_simpanan;
				} else {
					if ($db->kontrol_laporan != 1) {
						$d['header_jenis'] = $this->app_model->manualQuery("SELECT * FROM jenis_simpan WHERE kontrol_laporan != '1'");
					}
					if ($db->kontrol_penarikan != 1) {
						$d['opt_jenis'][$db->id_jenis] = '| ' . $db->id_jenis . ' | ' . $db->jenis_simpanan;
					}
				}
			}

			$d['jumlah'] = array(
				'name' => 'jumlah',
				'id' => 'jumlah',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20'
			);
			$d['ket'] = array(
				'name' => 'ket',
				'id' => 'ket',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '512'
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
				'size' => '50',
				'maxlength' => '50',
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
			$d['txt_saldo'] = array(
				'name' => 'txt_saldo',
				'id' => 'txt_saldo',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'disabled' => true
			);
			$d['saldo_min'] = array(
				'name' => 'saldo_min',
				'id' => 'saldo_min',
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

			$text = "SELECT a.noanggota,b.namaanggota
					FROM pengambilan as a
					JOIN anggota as b
					ON a.noanggota=b.noanggota
					WHERE a.noanggota LIKE '%$id%' OR b.namaanggota LIKE '%$id%' OR b.noidentitas LIKE '%$id%'
					GROUP BY a.noanggota";
			$tot_hal = $this->app_model->manualQuery($text);

			$config['base_url'] = site_url() . '/pengambilan/index/';
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

			$text = "SELECT a.id_ambil,a.noanggota,
					(select sum(jumlah) FROM simpanan WHERE noanggota=a.noanggota) as jumlah_simpanan,
					sum(a.jumlah) as jumlah_pengambilan,
					b.namaanggota,b.jk,b.noidentitas
					FROM pengambilan as a
					JOIN anggota as b
					ON a.noanggota=b.noanggota
					WHERE a.noanggota LIKE '%$id%' OR b.namaanggota LIKE '%$id%' OR b.noidentitas LIKE '%$id%'
					GROUP BY a.noanggota
					LIMIT $limit OFFSET $offset";
			$d['dt_ambil'] = $this->app_model->manualQuery($text);

			$d['isi'] = $this->load->view('pengambilan', $d, true);

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
			$data['nomor'] = $this->app_model->getMaxKodeAmbil();
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
			$up['id_ambil'] = $this->input->post('nomor');
			$up['tgl'] = $this->app_model->tgl_sql($tgl);
			$up['noanggota'] = $this->input->post('anggota');
			$up['id_jenis'] = $this->input->post('jenis');
			$up['jumlah'] = str_replace(",", "", $this->input->post('jumlah'));
			$up['user_id'] = $this->session->userdata('username');
			$up['tglinsert'] = date('Y-m-d H:i:s');
			$up['ket'] = $this->input->post('ket');

			$id['id_ambil'] = $this->input->post('nomor');

			$hasil = $this->app_model->getSelectedData("pengambilan", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$this->app_model->updateData("pengambilan", $up, $id);
				echo "Data sukses diubah";
			} else {
				$this->app_model->insertData("pengambilan", $up);
				echo "Data sukses disimpan";
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
					$data['jk'] = $sex; // $db->jk;
					//$data['tempat_lhr'] = $db->tempat_lahir;
					//$data['tgl_lhr'] = $this->app_model->tgl_str($db->tgl_lahir);
					//$data['alamat'] = $db->alamat;
					$data['hp'] = $db->hp;

					echo json_encode($data);
				}
			} else {
				$data['identitas'] = '';
				$data['anggota'] = '';
				$data['jk'] = '';
				//$data['tempat_lhr'] = '';
				//$data['tgl_lhr'] = '';
				//$data['alamat'] = '';
				$data['hp'] = '';
				echo json_encode($data);
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function CariJenis()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id['id_jenis'] = $this->input->post('id');

			$hasil = $this->app_model->getSelectedData("jenis_simpan", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				foreach ($hasil->result() as $db) {
					$data['jumlah'] = number_format($db->jumlah);

					echo json_encode($data);
				}
			} else {
				$data['jumlah'] = number_format(0);

				echo json_encode($data);
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function CariSaldo()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id = $this->input->post('nomor');

			$hasil = $this->app_model->getSaldo($id);
			$data['saldo'] = number_format($hasil);
			echo json_encode($data);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}
	public function CariSaldoJenis()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id = $this->input->post('nomor');
			$jenis = $this->input->post('jenis');

			$hasil = $this->app_model->getSaldoJenis($id, $jenis);
			$data['saldo'] = number_format($hasil);
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
			$id['id_ambil'] = $this->input->post('id');

			$hasil = $this->app_model->getSelectedData("pengambilan", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$this->app_model->deleteData("pengambilan", $id);
				echo "Data sukses dihapus";
			} else {
				echo "Tidak ada data yang dihapus";
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function view_pengambilan()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id = $this->input->post('nomor');

			//paging
			$page = $this->uri->segment(3);
			$limit = $this->config->item('limit_data');
			if (!$page) :
				$offset = 0;
			else :
				$offset = $page;
			endif;

			$text = "SELECT *
					FROM pengambilan 
					WHERE noanggota='$id'";
			$tot_hal = $this->app_model->manualQuery($text);

			$config['base_url'] = site_url() . '/pengambilan/view_pengambilan/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['first_link'] = 'Awal';
			$config['last_link'] = 'Akhir';
			$config['next_link'] = 'Selanjutnya';
			$config['prev_link'] = 'Sebelumnya';
			$this->pagination->initialize($config);
			$d['paginators'] = $this->pagination->create_links();
			$d['hal'] = $offset;

			//LIMIT $limit OFFSET $offset
			$text = "SELECT a.id_ambil,a.noanggota,a.id_jenis,a.jumlah,a.tgl,
					b.jenis_simpanan
					FROM pengambilan as a
					JOIN jenis_simpan as b
					ON a.id_jenis=b.id_jenis
					WHERE a.noanggota='$id'
					ORDER BY a.id_ambil DESC
					LIMIT $limit OFFSET $offset";
			$d['dt_view_pengambilan'] = $this->app_model->manualQuery($text);

			//$d['isi'] = $this->load->view('view_pengambilan', $d, true);
			$this->load->view('view_pengambilan', $d);
			//$this->load->view('media',$d);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}
	public function cetak()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id = $this->input->get('id');

			$d['nomor'] = $id; //$this->config->item('judul');
			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
			$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
			$d['lisensi'] = $this->config->item('lisensi_app');

			$text = "SELECT a.id_ambil,a.noanggota,a.id_jenis,a.jumlah,a.tgl,
					b.jenis_simpanan,
					c.namaanggota,c.noidentitas,c.alamat
					FROM pengambilan as a
					JOIN jenis_simpan as b
					JOIN anggota as c
					ON a.id_jenis=b.id_jenis AND a.noanggota=c.noanggota
					WHERE a.id_ambil='$id'";

			//$hasil = $this->app_model->getSelectedData("anggota",$id);
			$hasil = $this->app_model->manualQuery($text);
			$row = $hasil->num_rows();
			if ($row > 0) {
				foreach ($hasil->result() as $db) {
					$d['tgl'] = $this->app_model->tgl_str($db->tgl);
					$d['identitas'] = $db->noidentitas;
					$d['noanggota'] = $db->noanggota;
					$d['nama'] = $db->namaanggota;
					$d['alamat'] = $db->alamat;
					$d['jenis'] = $db->jenis_simpanan;
					$d['jumlah'] = number_format($db->jumlah);
					$d['terbilang'] = $this->app_model->terbilang($db->jumlah, 4);
				}
			}

			$this->load->view('cetak-terima', $d);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function CariData()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id['id_ambil'] = $this->input->post('id');

			$hasil = $this->app_model->getSelectedData("pengambilan", $id);
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
