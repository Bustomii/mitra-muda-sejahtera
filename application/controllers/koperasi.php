<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Koperasi extends CI_Controller
{

	public function index()
	{

		$d['judul'] = $this->config->item('judul');
		$d['nama_perusahaan'] = $this->app_model->Nama_Perusahaan();
		$d['alamat_perusahaan'] = $this->app_model->Alamat();
		$d['hp'] = $this->app_model->Hp();
		$d['lisensi'] = $this->config->item('lisensi_app');

		$d['username'] = array(
			'name' => 'username',
			'id' => 'username',
			'type' => 'text',
			'class' => 'input-teks-login',
			'autocomplete' => 'off',
			'size' => '30',
			'placeholder' => 'Masukkan username.....'
		);
		$d['password'] = array(
			'name' => 'password',
			'id' => 'password',
			'type' => 'password',
			'class' => 'input-teks-login',
			'autocomplete' => 'off',
			'size' => '30',
			'placeholder' => 'Masukkan password.....'
		);
		$d['submit'] = array(
			'name' => 'submit',
			'id' => 'submit',
			'type' => 'submit',
			'class' => 'easyui-linkbutton',
			'data-options' => 'iconCls:\'icon-lock_open\''
		);

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login', $d);
		} else {
			$u = $this->input->post('username');
			$p = $this->input->post('password');
			$this->app_model->getLoginData($u, $p);
		}
	}

	public function masuk()
	{
		$d['judul'] = "Login - Sistem Informasi Koperasi";
		$u = $this->input->post('username');
		$p = $this->input->post('password');
		$this->app_model->getLoginData($u, $p);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		header('location:' . base_url());
		//redirect('/login/');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/koperasi.php */
