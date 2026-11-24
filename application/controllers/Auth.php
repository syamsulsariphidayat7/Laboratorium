<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function index()
	{
		$this->cekAdmin();
		$data = array(
			'title' => 'Laboratorium | Login',
		);		
		
		$this->load->view('auth/login');
	}

	public function getLogin()
	{	
		$level = $this->input->post('level');
		if ($level === 'admin') {
			$this->loginAdmin();
		}elseif ($level == 'dosen') {
			$this->loginDosen();			
		}elseif ($level == 'mahasiswa') {
			$this->loginMahasiswa();
		}elseif ($level == 'asisten') {
			$this->loginAsisten();
		}else{
			redirect('auth','refresh');
		}
	}

	public function loginAdmin()
	{
		$param = array(
			'username' => $this->input->post('username', true),
			'password' => $this->input->post('password', true),
		);

		$cek = $this->M_Login->getLogin($param)->row();		
		if ($cek) {
			$array = array(
				'login' => $cek->id_user,
				'photo' => $cek->photo_admin,
				'nama' => $cek->username,
				'level' => 'admin',
			);
			
			$this->session->set_userdata( $array );
			redirect('admin');
		}else{
			$this->session->set_userdata('info','Login gagal');
			redirect('auth');
		}
	}

	public function loginDosen()
	{
		$param = array(
			'nidn' => $this->input->post('username',true),
			'password' => $this->input->post('password',true),
		);

		$cek = $this->M_Login->getLoginDosen($param)->row();								
		if ($cek){
			$array = array(
				'login' => $cek->id_dosen,
				'level' => 'dosen',
				'photo' => $cek->foto_dosen,
				'nama' => $cek->nama_dosen
			);
			
			$this->session->set_userdata( $array );
			redirect('admin');	
		}else{
			$this->session->set_userdata('info','Login gagal');
			redirect('auth');
		}
	}

	public function loginMahasiswa()
	{
		$param = array(
			'nim' => $this->input->post('username',true),
			'password' => $this->input->post('password',true),			
		);

		$cek = $this->M_Login->getLoginMahasiswa($param)->row();								
		if ($cek){
			$array = array(
				'login' => $cek->nim,
				'photo' => $cek->foto_mahasiswa,
				'nama' => $cek->nama_mahasiswa,
				'level' => 'mahasiswa',
			);
			
			$this->session->set_userdata( $array );
			redirect('admin');	
		}else{
			$this->session->set_userdata('info','Login gagal');
			redirect('auth');
		}
	}

	public function loginAsisten()
	{
		$param = array(
			'nim_asisten' => $this->input->post('username',true),
			'password_asisten' => $this->input->post('password',true),			
		);

		$cek = $this->M_Login->getLoginAsisten($param)->row();								
		if ($cek){
			$array = array(
				'login' => $cek->id_asisten,
				'asisten' => $cek->nim_asisten,
				'nama' => $cek->nama_asisten,
				'photo' => $cek->photo_asisten,
				'level' => 'asisten',				
			);
			
			$this->session->set_userdata( $array );
			redirect('admin');	
		}else{
			$this->session->set_userdata('info','Login gagal');
			redirect('auth');
		}
	}

	public function getLogout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */