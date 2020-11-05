<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller
{
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$akses = $this->session->userdata('akses');
		if (!empty($cek) && $level == 'admin' && $akses == 'super admin') {
			$id = $this->input->post('cari'); //'ded';

			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->app_model->Nama_Perusahaan();
			$d['alamat_perusahaan'] = $this->app_model->Alamat();
			$d['hp'] = $this->app_model->Hp();

			$d['lisensi'] = $this->config->item('lisensi_app');
			$d['jam_now'] = $this->app_model->Jam_Now();
			$d['hari_now'] = $this->app_model->Hari_Bulan_Indo();
			$d['tgl_now'] = $this->app_model->tgl_now_indo();

			//inputan
			$d['userid'] = array(
				'name' => 'userid',
				'id' => 'userid',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '30',
				'maxlength' => '30',
				'data-options' => 'required:true,validType:\'length[1,50]\''
			);
			$d['namalengkap'] = array(
				'name' => 'namalengkap',
				'id' => 'namalengkap',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '30',
				'maxlength' => '30',
				'data-options' => 'required:true,validType:\'length[1,50]\''
			);
			$d['password'] = array(
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'class' => 'easyui-validatebox',
				'size' => '30',
				'maxlength' => '30',
				'data-options' => 'required:true,validType:\'length[1,50]\''
			);

			$d['level'] = 'id="level"';
			$level = $this->app_model->manualQuery("SELECT id,nama_level FROM user_level");
			foreach ($level->result() as $db) {
				$d['opt_level'][$db->id] = $db->nama_level;
			}

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
				$text = "SELECT * FROM users WHERE user_id LIKE '%$id%' OR namalengkap LIKE '%$id%'";
				$tot_hal = $this->app_model->manualQuery($text);
			} else {
				$tot_hal = $this->app_model->getAllData("users");
			}
			$config['full_tag_open'] = '<div class="pagination">';
			$config['full_tag_close'] = '</div>';

			$config['num_tag_open'] = '<div class="digit">';
			$config['num_tag_close'] = '</div>';

			$config['cur_tag_open'] = '<div class="digit current">';
			$config['cur_tag_close'] = '</div>';

			$config['base_url'] = site_url() . '/pengguna/index/';
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
				$text = "SELECT * FROM users WHERE user_id LIKE '%$id%'  OR namalengkap LIKE '%$id%'
						 LIMIT $limit OFFSET $offset";
				$d['dt_pengguna'] = $this->app_model->manualQuery($text);
			} else {
				$d['dt_pengguna'] = $this->app_model->getAllDataLimited("users", $limit, $offset);
			}

			$d['isi'] = $this->load->view('pengguna', $d, true);

			$this->load->view('media', $d);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function simpan()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$akses = $this->session->userdata('akses');
		if (!empty($cek) && $level == 'admin' && $akses == 'super admin') {

			$up['user_id'] = $this->input->post('userid');
			$up['namalengkap'] = $this->input->post('namalengkap');
			$up['password'] = md5($this->input->post('password'));
			$up['level'] = $this->input->post('level');

			$id['user_id'] = $this->input->post('userid');


			$hasil = $this->app_model->getSelectedData("users", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$this->app_model->updateData("users", $up, $id);
				echo "Data sukses diubah";
			} else {
				$this->app_model->insertData("users", $up);
				echo "Data sukses disimpan";
			}

			//echo "Maaf, script kami Non aktifkan";
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function cari()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$akses = $this->session->userdata('akses');
		if (!empty($cek) && $level == 'admin' && $akses == 'super admin') {
			$id['user_id'] = $this->input->post('cari');

			$hasil = $this->app_model->getSelectedData("users", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				foreach ($hasil->result() as $db) {
					$data['namalengkap'] = $db->namalengkap;
					$data['level'] = $db->level;
					//$data['password'] = md5($db->password);
					echo json_encode($data);
				}
			} else {
				$data['namalengkap'] = '';
				$data['level'] = '';
				//$data['password'] = '';
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
		$akses = $this->session->userdata('akses');
		if (!empty($cek) && $level == 'admin' && $akses == 'super admin') {
			$id['user_id'] = $this->input->post('id');

			$hasil = $this->app_model->getSelectedData("users", $id);
			$row = $hasil->num_rows();
			if ($row > 0) {
				$this->app_model->deleteData("users", $id);
				echo "Data sukses dihapus";
			} else {
				echo "Tidak ada data yang dihapus";
			}
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}

	public function pencarian()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		$akses = $this->session->userdata('akses');
		if (!empty($cek) && $level == 'admin' && $akses == 'super admin') {
			//$id['user_id'] = 'admin'; //$this->input->post('cari');
			$id = $this->input->post('cari'); //'ded';

			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->config->item('nama_perusahaan');
			$d['alamat_perusahaan'] = $this->config->item('alamat_perusahaan');
			$d['lisensi'] = $this->config->item('lisensi_app');


			//inputan
			$d['userid'] = array(
				'name' => 'userid',
				'id' => 'userid',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '30',
				'maxlength' => '30',
				'data-options' => 'required:true,validType:\'length[1,50]\''
			);
			$d['namalengkap'] = array(
				'name' => 'namalengkap',
				'id' => 'namalengkap',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'size' => '30',
				'maxlength' => '30',
				'data-options' => 'required:true,validType:\'length[1,50]\''
			);
			$d['password'] = array(
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'class' => 'easyui-validatebox',
				'size' => '30',
				'maxlength' => '30',
				'data-options' => 'required:true,validType:\'length[1,50]\''
			);
			$d['level'] = 'id="level"';
			$level = $this->app_model->manualQuery("SELECT id,nama_level FROM user_level");
			foreach ($level->result() as $db) {
				$d['opt_level'][$db->id] = $db->nama_level;
			}

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

			$tot_hal = $this->app_model->getQueryData("users", $id);
			//$tot_hal = $this->app_model->getSelectedData("users",$id);
			$config['base_url'] = site_url() . '/pengguna/index/';
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

			$d['dt_pengguna'] = $this->app_model->getQueryDataLimited("users", $id, $limit, $offset);
			//$d['dt_pengguna'] = $this->app_model->getSelectedDataLimited("users",$id,$limit,$offset);
			$d['isi'] = $this->load->view('pengguna', $d, true);

			$this->load->view('media', $d);
		} else {
			redirect('/koperasi/logout/', 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/pengguna.php */
