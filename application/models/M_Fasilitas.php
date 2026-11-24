<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Fasilitas extends CI_Model {

	public function getFasilitasAlat($id=null)
	{
		$this->db->where('jenis_fasilitas', 'alat');
		return $this->db->get('fasilitas');
	}	

	public function getFasilitasBahan($id=null)
	{
		$this->db->where('jenis_fasilitas', 'bahan');
		return $this->db->get('fasilitas');
	}	

	public function addFasilitas($param=null)
	{
		return $this->db->insert('fasilitas', $param);
	}

	public function deleteFasilitas($id=null)
	{
		$this->db->where('id_fasilitas', $id);
		return $this->db->delete('fasilitas');
	}

}

/* End of file M_Fasilitas.php */
/* Location: ./application/models/M_Fasilitas.php */