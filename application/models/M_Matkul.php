<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Matkul extends CI_Model {

	public function getMatkul($id=null)
	{	
		$this->db->select('*');
		$this->db->from('mata_kuliah');
		$this->db->join('dosen', 'dosen.id_dosen = mata_kuliah.id_dosen', 'left');
		if ($id != null) {
			$this->db->where('mata_kuliah.id_mata_kuliah', $id);
		}
		return $this->db->get();
	}

	public function getMatkulIdDosen($id=null)
	{	
		$this->db->select('*');
		$this->db->from('mata_kuliah');
		$this->db->join('dosen', 'dosen.id_dosen = mata_kuliah.id_dosen', 'left');
		if ($id != null) {
			$this->db->where('dosen.id_dosen', $id);
		}
		return $this->db->get();
	}

	public function addMatkul($param=null)
	{
		return $this->db->insert('mata_kuliah', $param);
	}

	public function deleteMatkul($id=null)
	{
		$this->db->where('id_mata_kuliah', $id);
		return $this->db->delete('mata_kuliah');
	}	

}

/* End of file M_Matkul.php */
/* Location: ./application/models/M_Matkul.php */