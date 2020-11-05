<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		$level = $this->session->userdata('level');
		if (!empty($cek) && $level == 'admin') {
			$d['judul'] = $this->config->item('judul');
			$d['nama_perusahaan'] = $this->app_model->Nama_Perusahaan();
			$d['alamat_perusahaan'] = $this->app_model->Alamat();
			$d['hp'] = $this->app_model->Hp();
			$d['lisensi'] = $this->config->item('lisensi_app');

			$d['isi'] = $this->load->view('home', $d, true);

			$this->load->view('media', $d);
		} else {
			redirect('/koperasi/logout/');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		//redirect('/login/');
		header('location:' . base_url());
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/login.php */
