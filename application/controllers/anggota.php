<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Anggota extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('app_model');
	}
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

			//foto
			$d['prev_foto'] = array(
				'name' => 'prev_foto',
				'id' => 'prev_foto',
				'src' => base_url('uploads') . '/default.png',
				'width' => '250px',
				'height' => '250px',
				'class' => 'img-responsive img-thumbnail',
				'alt' => 'Preview Image'
			);
			$d['old_foto'] = array(
				'name' => 'old_foto',
				'id' => 'old_foto',
				'type' => 'hidden',
				'size' => '50',
				'class' => 'easyui-validatebox',
				'maxlength' => '500'
			);
			$d['foto'] = array(
				'name' => 'foto',
				'id' => 'foto',
				'type' => 'file',
				'size' => '20',
				'accept' => 'image/*',
				'maxlength' => '500'
			);
			$d['capture'] = array(
				'name' => 'capture',
				'id' => 'capture',
				'type' => 'button',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-capture\''
			);
			$d['close_capture'] = array(
				'name' => 'close_capture',
				'id' => 'close_capture',
				'type' => 'button',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-close\''
			);

			//inputan
			$d['nomor'] = array(
				'name' => 'nomor',
				'id' => 'nomor',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '10',
				'maxlength' => '500',
				'readonly' => true
			);

			$d['identitas'] = array(
				'name' => 'identitas',
				'id' => 'identitas',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '20',
				'onkeypress' => 'return hanyaAngka(event)',
				'maxlength' => '20'
			);

			$d['anggota'] = array(
				'name' => 'anggota',
				'id' => 'anggota',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '50',
				'maxlength' => '50'
			);

			$d['jk'] = 'id="jk"';
			$d['opt_jk'] = array(
				'' => '-Pilih-',
				'L' => 'Laki-laki',
				'P' => 'Perempuan'
			);

			$d['tempat_lhr'] = array(
				'name' => 'tempat_lhr',
				'id' => 'tempat_lhr',
				'type' => 'text',
				'size' => '50',
				'class' => 'easyui-validatebox',
				'maxlength' => '50',
			);

			$d['tgl_lhr'] = array(
				'name' => 'tgl_lhr',
				'id' => 'tgl_lhr',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '12',
			);

			$d['hp'] = array(
				'name' => 'hp',
				'id' => 'hp',
				'type' => 'text',
				'size' => '20',
				'class' => 'easyui-validatebox',
				'onkeypress' => 'return hanyaAngka(event)',
				'maxlength' => '20'
			);

			$d['alamat'] = array(
				'name' => 'alamat',
				'id' => 'alamat',
				'type' => 'text',
				'size' => '50',
				'class' => 'easyui-validatebox',
				'maxlength' => '50'
			);

			//tombol bawah
			$d['simpan'] = array(
				'name' => 'simpan',
				'id' => 'simpan',
				'type' => 'submit',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-save\''
			);
			$d['kosong'] = array(
				'name' => 'kosong',
				'id' => 'kosong',
				'type' => 'button',
				'class' => 'easyui-linkbutton',
				'data-options' => 'iconCls:\'icon-new\''
			);
			$d['tutup'] = array(
				'name' => 'tutup',
				'id' => 'tutup',
				'type' => 'button',
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

			if (!empty($id)) {
				$text = "SELECT * FROM anggota WHERE noanggota LIKE '%$id%' OR noidentitas LIKE '%$id%' OR namaanggota LIKE '%" . $id . "%'";
				$tot_hal = $this->app_model->manualQuery($text);
			} else {
				$tot_hal = $this->app_model->getAllData("anggota");
			}
			$config['base_url'] = site_url() . '/anggota/index/';
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

			if (!empty($id)) {
				$text = "SELECT * FROM anggota WHERE noanggota LIKE '%$id%' OR noidentitas LIKE '%$id%' OR namaanggota LIKE '%" . $id . "%' LIMIT $limit OFFSET $offset";
				$d['dt_anggota'] = $this->app_model->manualQuery($text);
			} else {
				$d['dt_anggota'] = $this->app_model->getAllDataLimited("anggota", $limit, $offset);
			}

			$d['isi'] = $this->load->view('anggota', $d, true);

			$this->load->view('media', $d);
		} else {
			//header('location:'.base_url());
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function CariKode()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$data['nomor'] = $this->app_model->getMaxKodeAnggota();
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
			$tgl_lhr = $this->input->post('tgl_lhr');
			$id['noanggota'] = $this->input->post('nomor');

			$config['upload_path']		= "./uploads/";
			$config['allowed_types']	= 'gif|jpg|png';
			$config['file_name']		= $this->input->post('nomor');
			$config['overwrite']		= true;
			$this->load->library('upload', $config);

			$up['noanggota'] = $this->input->post('nomor');
			$up['noidentitas'] = $this->input->post('identitas');
			$up['namaanggota'] = $this->input->post('anggota');
			$up['jk'] = $this->input->post('jk');
			$up['tempat_lahir'] = $this->input->post('tempat_lhr');
			$up['tgl_lahir'] = $this->app_model->tgl_sql($tgl_lhr);
			$up['alamat'] = $this->input->post('alamat');
			$up['hp'] = $this->input->post('hp');
			$up['pwd'] = md5('koperasi');
			if ($this->upload->do_upload("foto")) {
				$data = array('upload_data' => $this->upload->data("file_name"));

				$up['foto'] = $data['upload_data']['file_name'];

				$hasil = $this->app_model->getSelectedData("anggota", $id);
				$row = $hasil->num_rows();
				if ($row > 0) {
					$this->app_model->updateData("anggota", $up, $id);
					echo "Data sukses diubah";
				} else {
					$this->app_model->insertData("anggota", $up);
					echo "Data sukses disimpan";
				}
			} else {

				$hasil = $this->app_model->getSelectedData("anggota", $id);
				$row = $hasil->num_rows();
				if ($row > 0) {
					$this->app_model->updateData("anggota", $up, $id);
					echo "Data sukses diubah";
				} else {
					$this->app_model->insertData("anggota", $up);
					echo "Data sukses disimpan";
				}
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function simpan_capture()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$tgl_lhr = $this->input->get('tgl_lhr');
			$nama = $this->input->get('nomor');
			$id['noanggota'] = $this->input->get('nomor');

			$config['upload_path']		= "./uploads/";
			$config['allowed_types']	= 'gif|jpg|png';
			$config['file_name']		= $this->input->get('nomor');
			$config['overwrite']		= true;
			$this->load->library('upload', $config);

			$up['noanggota'] = $this->input->get('nomor');
			$up['noidentitas'] = $this->input->get('identitas');
			$up['namaanggota'] = $this->input->get('anggota');
			$up['jk'] = $this->input->get('jk');
			$up['tempat_lahir'] = $this->input->get('tempat_lhr');
			$up['tgl_lahir'] = $this->app_model->tgl_sql($tgl_lhr);
			$up['alamat'] = $this->input->get('alamat');
			$up['hp'] = $this->input->get('hp');
			$up['pwd'] = md5('koperasi');


			if ($this->upload->do_upload("webcam")) {
				$data = array('upload_data' => $this->upload->data("file_name"));

				$up['foto'] = $data['upload_data']['file_name'];

				$hasil = $this->app_model->getSelectedData("anggota", $id);
				$row = $hasil->num_rows();
				if ($row > 0) {
					$this->app_model->updateData("anggota", $up, $id);
					echo "Data sukses diubah";
				} else {
					$this->app_model->insertData("anggota", $up);
					echo "Data sukses disimpan";
				}
			} else {
				echo "gagal upload foto";
			}

			/*

			if (file_put_contents(FCPATH . '/uploads/' . $filename, $image)) {

				$up['foto'] = $filename;

				$hasil = $this->app_model->getSelectedData("anggota", $id);
				$row = $hasil->num_rows();
				if ($row > 0) {
					$this->app_model->updateData("anggota", $up, $id);
					echo json_encode("Data sukses diubah");
				} else {
					$this->app_model->insertData("anggota", $up);
					echo json_encode("Data sukses disimpan");
				}
			} else {
				echo json_encode("gagal upload foto");
			}
			*/
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$id['noanggota'] = $this->input->post('cari');

			$hasil = $this->app_model->getSelectedData("anggota", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				foreach ($hasil->result() as $db) {
					$data['identitas'] = $db->noidentitas;
					$data['anggota'] = $db->namaanggota;
					$data['jk'] = $db->jk;
					$data['tempat_lhr'] = $db->tempat_lahir;
					$data['tgl_lhr'] = $this->app_model->tgl_str($db->tgl_lahir);
					$data['alamat'] = $db->alamat;
					$data['hp'] = $db->hp;
					$data['foto'] = $db->foto;

					echo json_encode($data);
				}
			} else {
				$data['identitas'] = '';
				$data['anggota'] = '';
				$data['jk'] = '';
				$data['tempat_lhr'] = '';
				$data['tgl_lhr'] = '';
				$data['alamat'] = '';
				$data['hp'] = '';
				$data['foto'] = '';
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
			$id['noanggota'] = $this->input->post('id');

			$hasil = $this->app_model->getSelectedData("anggota", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$this->app_model->deleteData("anggota", $id);
				echo "Data sukses dihapus";
			} else {
				echo "Tidak ada data yang dihapus";
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}
}

/* End of file anggota.php */
/* Location: ./application/controllers/anggota.php */
