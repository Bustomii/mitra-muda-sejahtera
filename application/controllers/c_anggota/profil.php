<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller
{
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if (!empty($cek)) {
			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->app_model->Nama_Perusahaan();
			$d['alamat_perusahaan'] = $this->app_model->Alamat();
			$d['hp'] = $this->app_model->Hp();
			$d['lisensi'] = $this->config->item('lisensi_app');
			$d['jam_now'] = $this->app_model->Jam_Now();
			$d['hari_now'] = $this->app_model->Hari_Bulan_Indo();
			$d['tgl_now'] = $this->app_model->tgl_now_indo();

			$pilih['id'] = '1'; //$this->uri->segment(3);
			$dt_profil = $this->app_model->getSelectedData("profile", $pilih);
			foreach ($dt_profil->result() as $db) {
				$d['koperasi'] = $db->koperasi;
				$d['alamat'] = $db->alamat;
				$d['kota'] = $db->kota;
				$d['hp'] = $db->hp;
				$d['fax'] = $db->fax;
				$d['email'] = $db->email;
			}

			$d['koperasi'] = array(
				'name' => 'koperasi',
				'id' => 'koperasi',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'value' => $d['koperasi'],
				'size' => '50',
				'maxlength' => '50',
				'data-options' => 'required:true,validType:\'length[1,50]\'',
				'readonly' => 'readonly'
			);
			$d['alamat'] = array(
				'name' => 'alamat',
				'id' => 'alamat',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'value' => $d['alamat'],
				'size' => '50',
				'maxlength' => '50',
				'data-options' => 'required:true,validType:\'length[1,50]\'',
				'readonly' => 'readonly'
			);
			$d['kota'] = array(
				'name' => 'kota',
				'id' => 'kota',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'value' => $d['kota'],
				'size' => '50',
				'maxlength' => '50',
				'readonly' => 'readonly'
			);
			$d['hp'] = array(
				'name' => 'hp',
				'id' => 'hp',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'value' => $d['hp'],
				'size' => '20',
				'maxlength' => '50',
				'readonly' => 'readonly'
			);
			$d['fax'] = array(
				'name' => 'fax',
				'id' => 'fax',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'value' => $d['fax'],
				'size' => '20',
				'maxlength' => '50',
				'readonly' => 'readonly'
			);
			$d['email'] = array(
				'name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'class' => 'easyui-validatebox',
				'value' => $d['email'],
				'size' => '50',
				'maxlength' => '50',
				'readonly' => 'readonly'
			);


			$id['noanggota'] = $this->session->userdata('username');
			$dt_profil = $this->app_model->getSelectedData("anggota", $id);
			foreach ($dt_profil->result() as $db) {
				$d['noidentitas'] = $db->noidentitas;
				$d['namaanggota'] = $db->namaanggota;
				$d['jk'] = $db->jk;
				$d['tempat_lahir'] = $db->tempat_lahir;
				$d['tgl_lahir'] = $this->app_model->tgl_str($db->tgl_lahir);
				$d['alamat'] = $db->alamat;
				$d['hp'] = $db->hp;
			}

			$d['isi'] = $this->load->view('v_anggota/profil', $d, true);
			$this->load->view('v_anggota/media', $d);
		} else {
			redirect('/c_anggota/home/logout/', 'refresh');
		}
	}
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
