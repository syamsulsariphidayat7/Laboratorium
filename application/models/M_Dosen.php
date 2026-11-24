<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Dosen extends CI_Model {

	public function getDosen($id=null)
	{	
		if ($id != null) {
			$this->db->where('id_dosen', $id);
		}
		return $this->db->get('dosen');
	}

	public function addDosen($param=null)
	{
		return $this->db->insert('dosen', $param);
	}

	public function deleteDosen($id=null)
	{
		$this->db->where('id_dosen', $id);
		return $this->db->delete('dosen');
	}

}

/* End of file M_Dosen.php */
/* Location: ./application/models/M_Dosen.php */