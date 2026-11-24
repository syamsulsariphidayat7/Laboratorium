<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
	}

	public function getMahasiswa()
		{			
			$data = array(
				'title' => 'Laboratorium | Mahasiswa',
				'no' => 1,
				'mahasiswa' => $this->M_Mahasiswa->getMahasiswa()->result(),
			);

			$this->load->view('template/header', $data);
			$this->load->view('mahasiswa/data_mahasiswa', $data);
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

		public function tambahMahasiswa()
		{		
			// set upload
			$ekstensi = explode(".", $_FILES['photo']['name']);
			$namaPhoto = "M-".round(microtime(true)).".".end($ekstensi);
			$config['file_name'] = $namaPhoto;
			$config['upload_path'] = './assets/media/photo/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';	
			
			$this->upload->initialize($config);

			if ( ! $this->upload->do_upload('photo')){			
				$this->session->set_userdata('info','Gagal Upload Photo.');
				redirect('mahasiswa/getMahasiswa','refresh');
			}else{			
				$param = array(
					'nim' => $this->input->post('nim',true),
					'nama_mahasiswa' => $this->input->post('nama',true),
					'semester' => $this->input->post('semester',true),
					'jk_mahasiswa' => $this->input->post('jk',true),
					'alamat_mahasiswa' => $this->input->post('alamat',true),					
					'password' => $this->acak(10),
					'foto_mahasiswa' => $namaPhoto,
				);

				$insert = $this->M_Mahasiswa->addMahasiswa($param);
				if ($insert > 0) {
					$this->session->set_userdata('info','Berhasil');
					redirect('mahasiswa/getMahasiswa','refresh');
				}else{
					$this->session->set_userdata('info','Gagal Tambah Data');
					redirect('mahasiswa/getMahasiswa','refresh');					
				}

			}
		}

		public function hapus($id=null)
		{
			$data = $this->M_Mahasiswa->getMahasiswa($id)->row();			
			if (file_exists("./assets/media/photo/".$data->foto_mahasiswa)) {
				unlink("./assets/media/photo/".$data->foto_mahasiswa);			
			}
			
			$delete = $this->M_Mahasiswa->deleteMahasiswa($id);
			if ($delete) {
				$this->session->set_userdata( 'info','Berhasil hapus' );
				redirect('mahasiswa/getMahasiswa','refresh');
			}else{
				$this->session->set_userdata( 'info','Gagal hapus' );
				redirect('mahasiswa/getMahasiswa','refresh');
			}
		}

}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */