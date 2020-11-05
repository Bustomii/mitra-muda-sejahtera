<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Simpanan extends CI_Controller
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
					if ($db->kontrol_simpanan != 1) {
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
					FROM simpanan as a
					JOIN anggota as b
					ON a.noanggota=b.noanggota
					WHERE a.noanggota LIKE '%$id%' OR b.namaanggota LIKE '%$id%' OR b.noidentitas LIKE '%$id%'
					GROUP BY a.noanggota";
			$tot_hal = $this->app_model->manualQuery($text);

			$config['base_url'] = site_url() . '/simpanan/index/';
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

			$text = "SELECT a.id_simpanan,a.noanggota,
					sum(a.jumlah) as jumlah_simpanan,
					(select sum(jumlah) FROM pengambilan WHERE noanggota=a.noanggota) as jumlah_pengambilan,
					b.namaanggota,b.jk,b.noidentitas
					FROM simpanan as a
					JOIN anggota as b
					ON a.noanggota=b.noanggota
					WHERE a.noanggota LIKE '%$id%' OR b.namaanggota LIKE '%$id%' OR b.noidentitas LIKE '%$id%'
					GROUP BY a.noanggota
					LIMIT $limit OFFSET $offset";
			$d['dt_simpanan'] = $this->app_model->manualQuery($text);

			$d['isi'] = $this->load->view('simpanan', $d, true);

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
			$data['nomor'] = $this->app_model->getMaxKodeSimpanan();
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
			$up['id_simpanan'] = $this->input->post('nomor');
			$up['tgl'] = $this->app_model->tgl_sql($tgl);
			$up['noanggota'] = $this->input->post('anggota');
			$up['id_jenis'] = $this->input->post('jenis');
			$up['jumlah'] = str_replace(",", "", $this->input->post('jumlah'));
			$up['user_id'] = $this->session->userdata('username');
			$up['tglinsert'] = date('Y-m-d H:i:s');

			$id['id_simpanan'] = $this->input->post('nomor');

			$hasil = $this->app_model->getSelectedData("simpanan", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$this->app_model->updateData("simpanan", $up, $id);
				echo "Data sukses diubah";
			} else {
				$this->app_model->insertData("simpanan", $up);
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
					$data['sisa_angsuran'] = $this->app_model->sisa_pinjaman($db->noanggota);
					$id_pinjam =  $this->app_model->cari_nopinjam($db->noanggota);
					$data['no_pinjam'] = $id_pinjam;
					$data['lama'] = $this->app_model->cari_lama($id_pinjam);
					$data['bunga'] = $this->app_model->cari_bunga($id_pinjam);
					$data['jumlah'] = number_format($this->app_model->cari_jumlah($id_pinjam));
					$data['angsuran'] = $this->app_model->cicilan_ke($id_pinjam) . ' / ' .
						number_format($this->app_model->cicilan_angsuran($id_pinjam));

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
				$data['sisa_angsuran'] = '';
				$data['no_pinjam'] = '';
				$data['lama'] = '';
				$data['bunga'] = '';
				$data['jumlah'] = '';
				$data['angsuran'] = '';
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
				$data['jumlah'] = 0;

				echo json_encode($data);
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id['id_simpanan'] = $this->input->post('id');

			$hasil = $this->app_model->getSelectedData("simpanan", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$this->app_model->deleteData("simpanan", $id);
				echo "Data sukses dihapus";
			} else {
				echo "Tidak ada data yang dihapus";
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function view_simpanan()
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
					FROM simpanan 
					WHERE noanggota='$id'";
			$tot_hal = $this->app_model->manualQuery($text);
			/*
			$config['full_tag_open'] = '<div class="ajax_paging">';
			$config['full_tag_close'] = '</div>';
			*/
			$config['base_url'] = site_url() . '/simpanan/view_simpanan/';
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
			$text = "SELECT a.id_simpanan,a.noanggota,a.id_jenis,a.jumlah,a.tgl,
					b.jenis_simpanan
					FROM simpanan as a
					JOIN jenis_simpan as b
					ON a.id_jenis=b.id_jenis
					WHERE a.noanggota='$id'
					ORDER BY a.id_simpanan DESC
					LIMIT $limit OFFSET $offset";
			$d['dt_view_simpanan'] = $this->app_model->manualQuery($text);

			//$d['isi'] = $this->load->view('view_simpanan', $d, true);
			$this->load->view('view_simpanan', $d);
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

			$text = "SELECT a.id_simpanan,a.noanggota,a.id_jenis,a.jumlah,a.tgl,
					b.jenis_simpanan,
					c.namaanggota,c.noidentitas,c.alamat
					FROM simpanan as a
					JOIN jenis_simpan as b
					JOIN anggota as c
					ON a.id_jenis=b.id_jenis AND a.noanggota=c.noanggota
					WHERE a.id_simpanan='$id'";

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
			$id['id_simpanan'] = $this->input->post('id');

			$hasil = $this->app_model->getSelectedData("simpanan", $id);
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
