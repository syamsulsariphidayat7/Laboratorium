<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
	}

	public function index()
	{			
		$docVideo = [];	
		$docPhoto = [];
		$id = $this->session->userdata('login');
		$data = $this->M_Portofolio->getAllPortofolio()->result();		

		foreach ($data as $doc) {
			$pecah = explode('.', $doc->praktek);
			$eks = end($pecah);

			if ($eks == 'mp4' || $eks == 'mkv' || $eks == 'mpeg' || $eks == '3gp' ) {
				$docVideo []= $doc->praktek;
			}elseif ($eks == 'jpeg' || $eks == 'jpg' || $eks == 'png' ) {
				$docPhoto []= $doc->praktek;
			}
		}				
	
		$data = array(
			'title' => 'Laboratorium | Dashboard',
			'dosen' => $this->M_Login->countDosen(),
			'praktikan' => $this->M_Login->countPraktikan(),
			'portofolio' => $this->M_Login->countPortofolio(),
			'jadwal' => $this->M_Login->countJadwal(),
			'docVideo' => $docVideo, 
			'docPhoto' => $docPhoto,
		);
		
		$this->load->view('template/header', $data);
		$this->load->view('dashboard/home',$data);
		$this->load->view('template/footer');
	}

	public function panduan()
	{				

		$data = array(
			'title' => 'Laboratorium | Panduan',
		);

		$this->load->view('template/header', $data);
		$this->load->view('dashboard/panduan');
		$this->load->view('template/footer');
	}

	public function ubahPassword()
	{
		$data['id'] = $this->input->post('id',true);
		$data['level'] = $this->input->post('level', true);
		$data['passwordLama'] = $this->input->post('password', true);
		$data['passwordBaru'] = $this->input->post('passwordBaru', true);
		$data['konfirmasiPassword'] = $this->input->post('konfirmasiPassword', true);

		if ($data['passwordBaru'] != $data['konfirmasiPassword']) {			
			$this->session->set_userdata( 'info', 'konfirmasi password salah');				
			redirect('admin','refresh');
		}else{
			if ($data['level'] === 'admin') {
				$this->ubahAdmin($data);
			}elseif ($data['level'] === 'dosen') {
				$this->ubahDosen($data);				
			}elseif ($data['level'] === 'asisten') {
				$this->ubahAsisten($data);				
			}elseif ($data['level'] === 'mahasiswa') {
				$this->ubahMahasiswa($data);				
			}
		}
	}

	public function ubahAdmin($data=null)
	{
		$param = array(
			'id_user' => $data['id'],
			'password' => $data['passwordLama'],
		);
		$cek = $this->M_Login->getLogin($param)->row();
		if ($cek) {						
			$ubah = $this->M_Login->ubahPasswordAdmin($data['id'],$data['passwordBaru']);

			if ($ubah) {
				$this->session->set_userdata( 'info', 'Ubah password berhasil.' );				
				redirect('auth/getLogout','refresh');
			}			
		}else{
			$this->session->set_userdata( 'info', 'Password lama salah.' );				
			redirect('admin','refresh');
		}	
	}

	public function ubahDosen($data=null)
	{
		$param = array(
			'id_dosen' => $data['id'],
			'password' => $data['passwordLama'],
		);
		$cek = $this->M_Login->getLoginDosen($param)->row();
		if ($cek) {						
			$ubah = $this->M_Login->ubahPasswordDosen($data['id'],$data['passwordBaru']);

			if ($ubah) {
				$this->session->set_userdata( 'info', 'Ubah password berhasil.' );				
				redirect('auth/getLogout','refresh');
			}			
		}else{
			$this->session->set_userdata( 'info', 'Password lama salah.' );				
			redirect('admin','refresh');
		}	
	}

	public function ubahAsisten($data=null)
	{
		$param = array(
			'id_asisten' => $data['id'],
			'password_asisten' => $data['passwordLama'],
		);
		$cek = $this->M_Login->getLoginAsisten($param)->row();
		if ($cek) {						
			$ubah = $this->M_Login->ubahPasswordAsisten($data['id'],$data['passwordBaru']);

			if ($ubah) {
				$this->session->set_userdata( 'info', 'Ubah password berhasil.' );				
				redirect('auth/getLogout','refresh');
			}			
		}else{
			$this->session->set_userdata( 'info', 'Password lama salah.' );				
			redirect('admin','refresh');
		}	
	}

	public function ubahMahasiswa($data=null)
	{
		$param = array(
			'nim' => $data['id'],
			'password' => $data['passwordLama'],
		);
		$cek = $this->M_Login->getLoginMahasiswa($param)->row();
		if ($cek) {						
			$ubah = $this->M_Login->ubahPasswordMahasiswa($data['id'],$data['passwordBaru']);

			if ($ubah) {
				$this->session->set_userdata( 'info', 'Ubah password berhasil.' );				
				redirect('auth/getLogout','refresh');
			}			
		}else{
			$this->session->set_userdata( 'info', 'Password lama salah.' );				
			redirect('admin','refresh');
		}	
	}

	// ubah photo
	public function ubahPhoto()
	{
		if (empty($_FILES['photo']['name'])) {
			redirect('admin','refresh');
			die();
		}

		$id = $this->session->userdata('login');
		$level = $this->session->userdata('level');
		$photoLama = $this->session->userdata('photo');		

		// set upload
		$ekstensi = explode(".", $_FILES['photo']['name']);
		$namaPhoto = "P-".round(microtime(true)).".".end($ekstensi);
		$config['file_name'] = $namaPhoto;
		$config['upload_path'] = './assets/media/photo/';
		$config['allowed_types'] = 'jpg|png|jpeg';

		$this->upload->initialize($config);		

		if ( ! $this->upload->do_upload('photo')){			
			$this->session->set_userdata('info','Gagal upload photo baru!');
			redirect('admin','refresh');
		}else{									
			if ($level == 'admin') {
				$insert = $this->M_Login->ubahPhotoAdmin($id,$namaPhoto);
			}elseif ($level == 'dosen') {
				$insert = $this->M_Login->ubahPhotoDosen($id,$namaPhoto);
			}elseif ($level == 'asisten') {
				$insert = $this->M_Login->ubahPhotoAsisten($id,$namaPhoto);
			}elseif ($level == 'mahasiswa') {				
				$insert = $this->M_Login->ubahPhotoMahasiswa($id,$namaPhoto);
			}
			
			if ($insert > 0) {
				@unlink('./assets/media/photo/'.$photoLama);
				$this->session->unset_userdata('photo');
				$this->session->set_userdata('photo',$namaPhoto);
				$this->session->set_userdata('info','Berhasil ubah photo');
				redirect('admin','refresh');
			}else{
				$this->session->set_userdata('info','Gagal ubah photo');
				redirect('admin','refresh');					
			}
		}
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */