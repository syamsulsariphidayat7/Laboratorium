<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
	}

	public function index()
	{				
		$id_asistent = $this->session->userdata('login');
		$data = array(
			'title' => 'Laboratorium | Anggota',
			'no' => 1,
			'mahasiswa' => $this->M_Mahasiswa->getMahasiswa()->result(),						
			'anggota' => $this->M_Anggota->getAnggota($id_asistent)->result(),
		);
		
		$this->load->view('template/header', $data);
		$this->load->view('asisten/data_anggota', $data);
		$this->load->view('template/footer');
	}

	public function tambahAnggota($nim_anggota=null)
	{
		$nim_asisten = $this->session->userdata('asisten');
		$param = array(
			'id_asisten' => $this->session->userdata('login'), 
			'nama_asisten' => $this->session->userdata('nama'),
			'nim_anggota' => $nim_anggota, 
		);

		$tambah = $this->M_Anggota->addAnggota($param);
		if ($tambah > 0) {
			$this->session->set_userdata('info', 'Anggota berhasil ditambah.');
			redirect('anggota');
		}else{
			$this->session->set_userdata('info', 'Anggota gagal ditambah.');
			redirect('anggota');			
		}
	}

	public function hapus($id=null)
	{	
		$delete = $this->M_Anggota->deleteAnggota($id);
		if ($delete) {
			$this->session->set_userdata( 'info','Berhasil hapus anggota' );
			redirect('anggota','refresh');
		}else{
			$this->session->set_userdata( 'info','Gagal hapus anggota' );
			redirect('anggota','refresh');
		}
	}

}

/* End of file Anggota.php */
/* Location: ./application/controllers/Anggota.php */













