<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
	}

	public function index()
	{
		$this->getFasilitas();
	}

	public function getFasilitas()
	{				
		$data = array(
			'title' => 'Laboratorium | Fasilitas',
			'no' => 1,
			'fasilitasAlat' => $this->M_Fasilitas->getFasilitasAlat()->result(),
			'fasilitasBahan' => $this->M_Fasilitas->getFasilitasBahan()->result(),
		);

		$this->load->view('template/header', $data);
		$this->load->view('fasilitas/data_fasilitas');
		$this->load->view('template/footer');
	}	

	public function tambahfasilitas()
	{
		$param = array(
			'fasilitas' => $this->input->post('fasilitas',true), 
			'jumlah' => $this->input->post('jumlah',true), 
			'keterangan' => $this->input->post('keterangan',true), 
			'jenis_fasilitas' => $this->input->post('jenis',true), 
		);

		$tambah = $this->M_Fasilitas->addFasilitas($param);
		if ($tambah > 0) {
			$this->session->set_userdata('info', 'Fasilitas berhasil ditambah.');
			redirect('fasilitas/getFasilitas');
		}else{
			$this->session->set_userdata('info', 'Fasilitas gagal ditambah.');
			redirect('fasilitas/getFasilitas');
		}
	}

	public function hapus($id=null)
	{
		$delete = $this->M_Fasilitas->deleteFasilitas($id);
		if ($delete) {
			$this->session->set_userdata( 'info','Berhasil hapus' );
			redirect('fasilitas/getfasilitas','refresh');
		}else{
			$this->session->set_userdata( 'info','Gagal hapus' );
			redirect('fasilitas/getfasilitas','refresh');
		}
	}
}

/* End of file Fasilitas.php */
/* Location: ./application/controllers/Fasilitas.php */