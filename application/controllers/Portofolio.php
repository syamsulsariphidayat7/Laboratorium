<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portofolio extends MY_Controller {

	public function __construct()
	{ 
		parent::__construct();
		$this->cekLogin();
	}
	
	public function index()
	{		
		$nim_anggota = $this->session->userdata('login');
		$data = array(
			'title' => 'Laboratorium | Portofolio',
			'no' => 1,			
			'portofolio' => $this->M_Portofolio->getPortofolio($nim_anggota)->result(),			
			'anggota' => $this->M_Portofolio->getAnggota($nim_anggota)->result(),			
		);
		
		$this->load->view('template/header', $data);
		$this->load->view('praktik/data_portofolio', $data);
		$this->load->view('template/footer');
	}

// portofolio untuk mahasiswa
	public function getNilaiMahasiswa()
	{
		$idmhs = $this->session->userdata('login');
		$data = array(
			'title' => 'Laboratorium | Penilaian',
			'no' => 1,			
			'nilai' => $this->M_Portofolio->getNilaiMahasiswa($idmhs)->result(),
		);
		
		$this->load->view('template/header', $data);
		$this->load->view('praktik/data_nilai', $data);
		$this->load->view('template/footer');
	}

	public function hapus($id=null)
	{
		$cek = $this->M_Portofolio->getHapusPortofolio($id)->row();

		if (file_exists("./assets/media/portofolio/".$cek->jurnal)) {
			unlink("./assets/media/portofolio/".$cek->jurnal);			
		}

		if (file_exists("./assets/media/portofolio/".$cek->praktek)) {
			unlink("./assets/media/portofolio/".$cek->praktek);		
		}

		if (file_exists("./assets/media/portofolio/".$cek->laporan)) {
			unlink("./assets/media/portofolio/".$cek->laporan);			
		}

		$delete = $this->M_Portofolio->deletePortofolio($id);
		if ($delete) {			
			$this->session->set_userdata('info','Hapus Portofolio Berhasil');
			redirect('portofolio','refresh');
		}else{
			$this->session->set_userdata('info','Gagal Hapus Portofolio');
			redirect('portofolio','refresh');
		}
	}
// .portofolio untuk mahasiswa

// portofolio untuk dosen

	public function getNilai()
	{
		$idDosen = $this->session->userdata('login');
		$data = array(
			'title' => 'Laboratorium | Penilaian',
			'no' => 1,			
			'nilai' => $this->M_Portofolio->getNilai($idDosen)->result(),
		);
		
		$this->load->view('template/header', $data);
		$this->load->view('praktik/data_nilai', $data);
		$this->load->view('template/footer');
	}

	public function formNilai()
	{
		$jurnal = $this->input->post('jurnal',true);
		$laporan = $this->input->post('laporan',true);
		$documentasi = $this->input->post('documentasi',true);
		$rata = ($jurnal + $laporan + $documentasi) / 3;

		$param = array(
			'id_portofolio' => $this->input->post('prt', true), 
			'id_anggota' => $this->input->post('anggota', true), 
			'id_dosen' => $this->input->post('dosen', true),
			'id_mata_kuliah' => $this->input->post('mk', true), 
			'id_jadwal_praktek' => $this->input->post('jadwal', true), 
			'ulasan' => $this->input->post('ulasan', true), 
			'nilai_jurnal' => $jurnal, 
			'nilai_praktek' => $documentasi, 
			'nilai_laporan' => $laporan, 
			'rata_rata' => $rata, 
		);	

		$nilai = $this->M_Portofolio->addNilai($param);
		if ($nilai > 0) {
			$this->M_Portofolio->ubahPortofolio($param['id_portofolio']);
			$this->session->set_userdata('info','Penilaian Berhasil');
			redirect('portofolio/getNilai','refresh');
		}else{
			$this->session->set_userdata('info','Gagal Penilaian');
			redirect('portofolio/getNilai','refresh');
		}
	}

	public function getPortofolio()
	{
		$idDosen = $this->session->userdata('login');
		$data = array(
			'title' => 'Laboratorium | Portofolio',
			'no' => 1,			
			'portofolio' => $this->M_Portofolio->getPortofolioDosen($idDosen)->result(),
		);
		
		$this->load->view('template/header', $data);
		$this->load->view('praktik/data_portofolio', $data);
		$this->load->view('template/footer');
	}

	public function hapusNilai($id='',$idPrt=null)
	{
		$hapus = $this->M_Portofolio->hapusNilaiPraktik($id);
		if ($hapus) {
			$this->M_Portofolio->ubahPortofolioNol($idPrt);
			$this->session->set_userdata('info','Berhasil hapus nilai');
			redirect('portofolio/getNilai','refresh');
		}else{
			$this->session->set_userdata('info','Gagal hapus Data');
			redirect('portofolio/getNilai','refresh');
		}
	}
// .portofolio untuk dosen

// portofolio untuk asisten
	public function getNilaiAsisten()
	{
		$idAsisten = $this->session->userdata('login');
		$data = array(
			'title' => 'Laboratorium | Penilaian',
			'no' => 1,			
			'nilai' => $this->M_Portofolio->getNilaiAsisten($idAsisten)->result(),
		);
		
		$this->load->view('template/header', $data);
		$this->load->view('praktik/data_nilai', $data);
		$this->load->view('template/footer');
	}

	public function formNilaiAsisten()
	{
		$jurnal = $this->input->post('jurnal',true);
		$laporan = $this->input->post('laporan',true);
		$documentasi = $this->input->post('documentasi',true);
		$rata = ($jurnal + $laporan + $documentasi) / 3;

		$param = array(
			'id_portofolio' => $this->input->post('prt', true), 
			'id_anggota' => $this->input->post('anggota', true), 
			'id_dosen' => $this->input->post('dosen', true),
			'id_mata_kuliah' => $this->input->post('mk', true), 
			'id_jadwal_praktek' => $this->input->post('jadwal', true), 
			'ulasan' => $this->input->post('ulasan', true), 
			'nilai_jurnal' => $jurnal, 
			'nilai_praktek' => $documentasi, 
			'nilai_laporan' => $laporan, 
			'rata_rata' => $rata, 
		);	

		$nilai = $this->M_Portofolio->addNilai($param);
		if ($nilai > 0) {
			$this->M_Portofolio->ubahPortofolio($param['id_portofolio']);
			$this->session->set_userdata('info','Penilaian Berhasil');
			redirect('portofolio/getNilai','refresh');
		}else{
			$this->session->set_userdata('info','Gagal Penilaian');
			redirect('portofolio/getNilai','refresh');
		}
	}

	public function getPortofolioAsisten()
	{
		$idAsisten = $this->session->userdata('login');
		$data = array(
			'title' => 'Laboratorium | Portofolio',
			'no' => 1,			
			'portofolio' => $this->M_Portofolio->getPortofolioAsisten($idAsisten)->result(),
		);
		
		$this->load->view('template/header', $data);
		$this->load->view('praktik/data_portofolio', $data);
		$this->load->view('template/footer');
	}

	public function hapusNilaiAsisten($id='',$idPrt=null)
	{
		$hapus = $this->M_Portofolio->hapusNilaiPraktik($id);
		if ($hapus) {
			$this->M_Portofolio->ubahPortofolioNol($idPrt);
			$this->session->set_userdata('info','Berhasil hapus nilai');
			redirect('portofolio/getNilai','refresh');
		}else{
			$this->session->set_userdata('info','Gagal hapus Data');
			redirect('portofolio/getNilai','refresh');
		}
	}
// .portofolio untuk asisten

	public function tambahPortofolio()
	{		
		// set upload jurnal
		if (!empty($_FILES['jurnal']['name'])) {	
			$ekstensi = explode(".", $_FILES['jurnal']['name']);
			$namaJurnal = "J-".round(microtime(true)).".".end($ekstensi);	
			$config['file_name'] = $namaJurnal;
			$config['upload_path'] = './assets/media/portofolio/';
			$config['allowed_types'] = 'doc|docx|pdf';	
			
		$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('jurnal')){
				$this->session->set_userdata('info','Gagal Upload Jurnal.');
				redirect('portofolio','refresh');
				exit();
			}
		}else{
			$namaJurnal = '';
		}
		// set .upload jurnal

		// set upload laporan
		if (!empty($_FILES['laporan']['name'])) {			
			$ekstensi = explode(".", $_FILES['laporan']['name']);
			$namaLaporan = "L-".round(microtime(true)).".".end($ekstensi);
			$config['file_name'] = $namaLaporan;
			$config['upload_path'] = './assets/media/portofolio/';
			$config['allowed_types'] = 'doc|docx|pdf';				
			
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('laporan')){			
				$this->session->set_userdata('info','Gagal Upload laporan.');
				redirect('portofolio','refresh');
				exit();
			}
		}else{
			$namaLaporan = '';
		}
		// set .upload laporan

		// set upload media
		if (!empty($_FILES['media']['name'])) {			
			$ekstensi = explode(".", $_FILES['media']['name']);
			$namaMedia = "M-".round(microtime(true)).".".end($ekstensi);
			$config['file_name'] = $namaMedia;
			$config['upload_path'] = './assets/media/portofolio/';
			$config['allowed_types'] = 'mp4|mpeg|3gp|mkv|jpg|png|jpeg';
			
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('media')){			
				$this->session->set_userdata('info','Gagal Upload media.');
				redirect('portofolio','refresh');
				exit();
			}
		}else{
			$namaMedia = '';
		}
		// set .upload media

		// save upload database
			$param = array(
				'nim_mhs' => $this->session->userdata('login'),
				'id_anggota' => $this->input->post('idanggota'),
				'id_asisten' => $this->input->post('asisten'),
				'jurnal' => $namaJurnal,
				'praktek' => $namaMedia,
				'laporan' => $namaLaporan,						
			);

			$insert = $this->M_Portofolio->addPortofolio($param);
			if ($insert > 0) {
				$this->session->set_userdata('info','Berhasil Tambah Portofolio');
				redirect('portofolio','refresh');
			}else{
				$this->session->set_userdata('info','Gagal Tambah Data');
				redirect('portofolio','refresh');
			}
		// .save upload database
	}
}

/* End of file Portofolio.php */
/* Location: ./application/controllers/Portofolio.php */