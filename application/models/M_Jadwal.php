<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Jadwal extends CI_Model {

	public function getJadwal($id=null)
	{
		$this->db->select('*');
		$this->db->from('jadwal_praktek');
		$this->db->join('mata_kuliah', 'jadwal_praktek.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left');
		$this->db->join('dosen', 'jadwal_praktek.id_dosen = dosen.id_dosen', 'left');
		
		if ($id != null) {
			$this->db->where('jadwal_praktek.id_jadwal_praktek', $id);
		}

		return $this->db->get();
	}

	public function getJadwalIdMhs($id=null)
	{
		$this->db->select('*');
		$this->db->from('jadwal_praktek');
		$this->db->join('mata_kuliah', 'jadwal_praktek.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left');
		$this->db->join('dosen', 'jadwal_praktek.id_dosen = dosen.id_dosen', 'left');
		$this->db->join('asisten_praktikan', 'asisten_praktikan.id_jadwal = jadwal_praktek.id_jadwal_praktek', 'left');
		$this->db->join('anggota', 'anggota.id_asisten = asisten_praktikan.id_asisten', 'left');
		
		if ($id != null) {
			$this->db->where('anggota.nim_anggota', $id);
		}

		return $this->db->get();
	}

	public function getJadwalIdDosen($id=null)
	{
		$this->db->select('*');
		$this->db->from('jadwal_praktek');
		$this->db->join('mata_kuliah', 'jadwal_praktek.id_mata_kuliah = mata_kuliah.id_mata_kuliah', 'left');
		$this->db->join('dosen', 'jadwal_praktek.id_dosen = dosen.id_dosen', 'left');
		
		if ($id != null) {
			$this->db->where('dosen.id_dosen', $id);
		}

		return $this->db->get();
	}

	public function addJadwal($param='')
	{
		return $this->db->insert('jadwal_praktek', $param);
	}

	public function deleteJadwal($id=null)
	{
		$this->db->where('id_jadwal_praktek', $id);
		return $this->db->delete('jadwal_praktek');
	}

}

/* End of file M_Jadwal.php */
/* Location: ./application/models/M_Jadwal.php */