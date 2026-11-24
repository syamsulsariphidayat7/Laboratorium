<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Mahasiswa extends CI_Model {

	public function getMahasiswa($id=null)
	{
		if ($id != null) {
			$this->db->where('id_mahasiswa', $id);
		}
		return $this->db->get('mahasiswa');
	}	

	public function getMahasiswaAsisten($nim=null)
	{
		if ($nim != null) {
			$this->db->where('nim', $nim);
		}
		return $this->db->get('mahasiswa');
	}	

	public function addMahasiswa($param=null)
	{
		return $this->db->insert('mahasiswa', $param);
	}

	public function deleteMahasiswa($id=null)
	{
		$this->db->where('id_mahasiswa', $id);
		return $this->db->delete('mahasiswa');
	}

}

/* End of file M_Mahasiswa.php */
/* Location: ./application/models/M_Mahasiswa.php */