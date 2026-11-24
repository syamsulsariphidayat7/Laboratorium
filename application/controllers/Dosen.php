<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
	}
	
	public function getDosen()
	{
		$data = array(
			'title' => 'Laboratorium | Dosen',
			'no' => 1,
			'dosen' => $this->M_Dosen->getDosen()->result(),
		);

		$this->load->view('template/header', $data);
		$this->load->view('dosen/data_dosen', $data);
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

	public function tambahDosen()
	{		
		// set upload
		$ekstensi = explode(".", $_FILES['photo']['name']);
		$namaPhoto = "D-".round(microtime(true)).".".end($ekstensi);
		$config['file_name'] = $namaPhoto;
		$config['upload_path'] = './assets/media/photo/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';	
		
		$this->upload->initialize($config);

		if ( ! $this->upload->do_upload('photo')){			
			$this->session->set_userdata('info','Gagal Upload Photo.');
			redirect('dosen/getDosen','refresh');
		}else{			
			$param = array(
				'nidn' => $this->input->post('nidn',true),
				'nama_dosen' => $this->input->post('nama',true),
				'jk_dosen' => $this->input->post('jk',true),
				'alamat_dosen' => $this->input->post('alamat',true),
				'kontak' => $this->input->post('kontak',true),
				'password' => $this->acak(10),
				'foto_dosen' => $namaPhoto,
			);

			$insert = $this->M_Dosen->addDosen($param);
			if ($insert > 0) {
				$this->session->set_userdata('info','Berhasil');
				redirect('dosen/getDosen','refresh');
			}else{
				$this->session->set_userdata('info','Gagal Tambah Data');
				redirect('dosen/getDosen','refresh');
			}

		}
	}

	public function hapus($id=null)
	{
		$data = $this->M_Dosen->getDosen($id)->row();			
		if (file_exists("./assets/media/photo/".$data->foto_dosen)) {
			unlink("./assets/media/photo/".$data->foto_dosen);			
		}
		
		$delete = $this->M_Dosen->deleteDosen($id);
		if ($delete) {
			$this->session->set_userdata( 'info','Berhasil hapus' );
			redirect('dosen/getDosen','refresh');
		}else{
			$this->session->set_userdata( 'info','Gagal hapus' );
			redirect('dosen/getDosen','refresh');
		}
	}
}

/* End of file Dosen.php */
/* Location: ./application/controllers/Dosen.php */