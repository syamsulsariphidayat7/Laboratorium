<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matkul extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
	}

	public function index()
	{
		$this->getMatkul();
	}

	public function getMatkul()
	{
		$data = array(
			'title' => 'Laboratorium | Mata Kuliah',
			'no' => 1,
			'matakuliah' => $this->M_Matkul->getMatkul()->result(),
			'dosen' => $this->M_Dosen->getDosen()->result(),
		);

		$this->load->view('template/header', $data);
		$this->load->view('mata_kuliah/data_matkul', $data);
		$this->load->view('template/footer');
	}		

	public function tambahMatkul()
	{					
		$param = array(
			'kode_mata_kuliah' => $this->input->post('kode',true),
			'id_dosen' => $this->input->post('dosen',true),
			'nama_mata_kuliah' => $this->input->post('matkul',true),
			'sks' => $this->input->post('sks',true),
		);

		$insert = $this->M_Matkul->addMatkul($param);

		if ($insert > 0) {
			$this->session->set_userdata('info','Berhasil');
			redirect('matkul/getMatkul','refresh');
		}else{
			$this->session->set_userdata('info','Gagal Tambah Data');
			redirect('matkul/getMatkul','refresh');
		}
	}

	public function hapus($id=null)
	{			
		$delete = $this->M_Matkul->deleteMatkul($id);
		if ($delete) {
			$this->session->set_userdata( 'info','Berhasil hapus' );
			redirect('matkul/getMatkul','refresh');
		}else{
			$this->session->set_userdata( 'info','Gagal hapus' );
			redirect('matkul/getMatkul','refresh');
		}
	}

}

/* End of file Matkul.php */
/* Location: ./application/controllers/Matkul.php */