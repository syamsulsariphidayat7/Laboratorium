<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asisten extends MY_Controller {

	public function __construct($value='')
	{
		parent::__construct();
		$this->cekLogin();
	}

	public function index()
	{
		$id = $this->session->userdata('login');
		$data = array(
			'title' => 'Laboratorium | Asisten',
			'no' => 1,			
			'praktek' => $this->M_Jadwal->getJadwalIdDosen($id)->result(),
			'asisten' => $this->M_Asisten->getAsisten($id)->result(),
		);
		
		$this->load->view('template/header', $data);
		$this->load->view('dosen/data_asisten', $data);
		$this->load->view('template/footer');
	}	

	// set password
	public function acak($panjang)
	{	    
		$karakter = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
		$string = '';
		for ($i = 0; $i < $panjang; $i++) {
			$pos = rand(0, strlen($karakter)-1);
			$string .= $karakter[$pos];
		}
		return $string;
	}

	public function tambahAsisten()
	{
		// set upload
		$ekstensi = explode(".", $_FILES['photo']['name']);
		$namaPhoto = "A-".round(microtime(true)).".".end($ekstensi);
		$config['file_name'] = $namaPhoto;
		$config['upload_path'] = './assets/media/photo/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';	
		
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload('photo')){
			$this->session->set_userdata('info','Gagal Upload Photo.');
			redirect('asisten','refresh');
		}else{
			$param = array(
				'nim_asisten' => $this->input->post('nim'), 
				'nama_asisten' => $this->input->post('nama'), 
				'id_jadwal' => $this->input->post('jadwal'),
				'kontak_asisten' => $this->input->post('kontak'), 
				'kelompok' => $this->input->post('kelompok'), 
				'jk_asisten' => $this->input->post('jk'), 
				'photo_asisten' => $namaPhoto, 
				'password_asisten' => $this->acak(10), 
			);

			$insert = $this->M_Asisten->addAsisten($param);
			if ($insert) {
				$this->session->set_userdata('info','Berhasil tambah Asisten');
				redirect('asisten','refresh');									
			}else{
				$this->session->set_userdata('info','Gagal tambah Asisten');
				redirect('asisten','refresh');									
			}
		}
	}

	public function hapus($id=null)
	{	
		$data = $this->M_Asisten->getAsistenId($id)->row();			
		if (file_exists("./assets/media/photo/".$data->photo_asisten)) {
			unlink("./assets/media/photo/".$data->photo_asisten);			
		}

		$delete = $this->M_Asisten->deleteAsisten($id);
		if ($delete) {
			$this->session->set_userdata( 'info','Berhasil hapus asisten' );
			redirect('asisten','refresh');
		}else{
			$this->session->set_userdata( 'info','Gagal hapus asisten' );
			redirect('asisten','refresh');
		}
	}
}

/* End of file Asisten.php */
/* Location: ./application/controllers/Asisten.php */