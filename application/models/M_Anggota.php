<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Anggota extends CI_Model {

	public function getAnggota($id=null)
	{
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->join('mahasiswa', 'mahasiswa.nim = anggota.nim_anggota', 'left');
		$this->db->join('asisten_praktikan', 'asisten_praktikan.id_asisten = anggota.id_asisten', 'left');				
		$this->db->join('jadwal_praktek', 'jadwal_praktek.id_jadwal_praktek = asisten_praktikan.id_jadwal', 'left');
		$this->db->join('dosen', 'jadwal_praktek.id_dosen = dosen.id_dosen', 'left');		
		$this->db->where('asisten_praktikan.id_asisten', $id);
		return $this->db->get();
	}	

	public function addAnggota($param='')
	{
		return $this->db->insert('anggota', $param);
	}

	public function deleteAnggota($id='')
	{
		$this->db->where('id_anggota', $id);
		return $this->db->delete('anggota');
	}

}

/* End of file M_Anggota.php */
/* Location: ./application/models/M_Anggota.php */