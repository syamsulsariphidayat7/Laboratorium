<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
	}

	public function index()
	{
		$idDosen = $this->session->userdata('login');		
		$data = array(
			'title' => 'Laboratorium | Jadwal',
			'no' => 1,
			'jadwal' => $this->M_Jadwal->getJadwalIdDosen($idDosen)->result(),
			'matakuliah' => $this->M_Matkul->getMatkulIdDosen($idDosen)->result(),
		);

		$this->load->view('template/header', $data);
		$this->load->view('dosen/data_jadwal', $data);
		$this->load->view('template/footer');
	}

	public function getJadwalMahasiswa()
	{
		$idMhs = $this->session->userdata('login');		
		$data = array(
			'title' => 'Laboratorium | Jadwal',
			'no' => 1,
			'jadwal' => $this->M_Jadwal->getJadwalIdMhs($idMhs)->result(),			
		);

		$this->load->view('template/header', $data);
		$this->load->view('dosen/data_jadwal', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id=null)
	{	
		$doc = $this->M_Jadwal->getJadwal($id)->row();
		if (file_exists("./assets/media/document/".$doc->modul)) {
			unlink("./assets/media/document/".$doc->modul);
		}
		
		$delete = $this->M_Jadwal->deleteJadwal($id);
		if ($delete) {
			$this->session->set_userdata( 'info','Berhasil hapus Jadwal' );
			redirect('jadwal','refresh');
		}else{
			$this->session->set_userdata( 'info','Gagal hapus jadwal' );
			redirect('jadwal','refresh');
		}
	}

	public function download($modul=null)
	{
		force_download('./assets/media/document/'.$modul,null);
	}

	public function tambahJadwal()
	{		
		$judul = $this->input->post('judul');
		$eks = explode(".", $_FILES['modul']['name']);
		$modul = "F-".url_title($judul)."-".round(microtime(true)).".".end($eks);

		$config['upload_path'] = './assets/media/document/';
		$config['allowed_types'] = 'doc|pdf|docx|ppt|pptx';		
		$config['file_name']  = $modul;
		
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload('modul')){
			$this->session->set_userdata('info','Gagal Upload Modul');
			redirect('jadwal','refresh');					
		}
		else{			
			$param = array(
				'id_dosen' => $this->session->userdata('login'), 
				'id_mata_kuliah' => $this->input->post('matkul'), 
				'judul' => $judul, 
				'jadwal_praktek' => $this->input->post('tanggal'), 
				'modul' => $modul, 
			);

			$insert = $this->M_Jadwal->addJadwal($param);
			if ($insert) {
				$this->session->set_userdata('info','Berhasl tambah jadwal');
				redirect('jadwal','refresh');									
			}else{
				$this->session->set_userdata('info','Gagal tambah jadwal');
				redirect('jadwal','refresh');									
			}
		}
	}

}

/* End of file Jadwal.php */
/* Location: ./application/controllers/Jadwal.php */