<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Asisten extends CI_Model {

	public function getAsisten($id=null)
	{
		$this->db->select('*');
		$this->db->from('asisten_praktikan');
		$this->db->join('mahasiswa', 'asisten_praktikan.nim_asisten = mahasiswa.nim', 'left');
		$this->db->join('jadwal_praktek', 'asisten_praktikan.id_jadwal = jadwal_praktek.id_jadwal_praktek', 'left');
		$this->db->join('dosen', 'dosen.id_dosen = jadwal_praktek.id_dosen', 'left');
		if ($id != null) {
			$this->db->where('dosen.id_dosen', $id);
		}
		return $this->db->get();
	}

	public function getAsistenId($id='')
	{
		$this->db->where('id_asisten', $id);
		return $this->db->get('asisten_praktikan');
	}

	public function getJadwal()
	{		
		return $this->db->get('jadwal_praktek');
	}	

	public function addAsisten($param='')
	{
		return $this->db->insert('asisten_praktikan', $param);
	}

	public function deleteAsisten($id='')
	{
		$this->db->where('id_asisten', $id);
		return $this->db->delete('asisten_praktikan');
	}

}

/* End of file M_Asisten.php */
/* Location: ./application/models/M_Asisten.php */