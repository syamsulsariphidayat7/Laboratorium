<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Portofolio extends CI_Model {

	public function getAllPortofolio($id=null)
	{		
		return $this->db->get('portofolio');
	}

	public function getHapusPortofolio($id=null)
	{
		$this->db->where('id_portofolio', $id);
		return $this->db->get('portofolio');
	}

	public function getPortofolio($id=null)
	{
		$this->db->select('*');
		$this->db->from('portofolio');
		$this->db->join('mahasiswa', 'mahasiswa.nim = portofolio.nim_mhs', 'left');
		$this->db->join('asisten_praktikan', 'asisten_praktikan.id_asisten = portofolio.id_asisten', 'left');
		$this->db->join('jadwal_praktek', 'jadwal_praktek.id_jadwal_praktek = asisten_praktikan.id_jadwal', 'left');		
		if ($id != null) {
			$this->db->where('portofolio.nim_mhs', $id);			
		}

		return $this->db->get();
	}

	public function getPortofolioDosen($idDosen=null)
	{
		$this->db->select('*');
		$this->db->from('portofolio');
		$this->db->join('mahasiswa', 'mahasiswa.nim = portofolio.nim_mhs', 'left');
		$this->db->join('asisten_praktikan', 'asisten_praktikan.id_asisten = portofolio.id_asisten', 'left');
		$this->db->join('jadwal_praktek', 'jadwal_praktek.id_jadwal_praktek = asisten_praktikan.id_jadwal', 'left');
		$this->db->join('dosen', 'dosen.id_dosen = jadwal_praktek.id_dosen', 'left');
		
		if ($idDosen != null) {
			$this->db->where('dosen.id_dosen', $idDosen);	
		}
		return $this->db->get();
	}

	public function getPortofolioAsisten($idAsisten=null)
	{
		$this->db->select('*');
		$this->db->from('portofolio');
		$this->db->join('mahasiswa', 'mahasiswa.nim = portofolio.nim_mhs', 'left');
		$this->db->join('asisten_praktikan', 'asisten_praktikan.id_asisten = portofolio.id_asisten', 'left');
		$this->db->join('jadwal_praktek', 'jadwal_praktek.id_jadwal_praktek = asisten_praktikan.id_jadwal', 'left');
		$this->db->join('dosen', 'dosen.id_dosen = jadwal_praktek.id_dosen', 'left');
		
		if ($idAsisten != null) {
			$this->db->where('asisten_praktikan.id_asisten', $idAsisten);	
		}
		return $this->db->get();
	}

	public function getNilai($idDosen=null)
	{
		$this->db->select('*');
		$this->db->from('nilai_praktek');
		$this->db->join('jadwal_praktek', 'jadwal_praktek.id_jadwal_praktek = nilai_praktek.id_jadwal_praktek', 'left');
		$this->db->join('asisten_praktikan', 'asisten_praktikan.id_jadwal = jadwal_praktek.id_jadwal_praktek', 'left');
		$this->db->join('anggota', 'anggota.id_anggota = nilai_praktek.id_anggota', 'left');		
		$this->db->join('mahasiswa', 'mahasiswa.nim = anggota.nim_anggota', 'left');
		$this->db->join('dosen', 'dosen.id_dosen = nilai_praktek.id_dosen', 'left');

		if ($idDosen != null) {
			$this->db->where('dosen.id_dosen', $idDosen);
		}

		return $this->db->get();
	}

	public function getNilaiMahasiswa($idmhs=null)
	{
		$this->db->select('*');
		$this->db->from('nilai_praktek');
		$this->db->join('jadwal_praktek', 'jadwal_praktek.id_jadwal_praktek = nilai_praktek.id_jadwal_praktek', 'left');
		$this->db->join('asisten_praktikan', 'asisten_praktikan.id_jadwal = jadwal_praktek.id_jadwal_praktek', 'left');
		$this->db->join('anggota', 'anggota.id_anggota = nilai_praktek.id_anggota', 'left');		
		$this->db->join('mahasiswa', 'mahasiswa.nim = anggota.nim_anggota', 'left');
		$this->db->join('dosen', 'dosen.id_dosen = nilai_praktek.id_dosen', 'left');

		if ($idmhs != null) {
			$this->db->where('mahasiswa.nim', $idmhs);
		}

		return $this->db->get();
	}

	public function getNilaiAsisten($idAsisten=null)
	{
		$this->db->select('*');
		$this->db->from('nilai_praktek');
		$this->db->join('jadwal_praktek', 'jadwal_praktek.id_jadwal_praktek = nilai_praktek.id_jadwal_praktek', 'left');
		$this->db->join('asisten_praktikan', 'asisten_praktikan.id_jadwal = jadwal_praktek.id_jadwal_praktek', 'left');
		$this->db->join('anggota', 'anggota.id_anggota = nilai_praktek.id_anggota', 'left');		
		$this->db->join('mahasiswa', 'mahasiswa.nim = anggota.nim_anggota', 'left');
		$this->db->join('dosen', 'dosen.id_dosen = nilai_praktek.id_dosen', 'left');

		if ($idAsisten != null) {
			$this->db->where('asisten_praktikan.id_asisten', $idAsisten);
		}

		return $this->db->get();
	}

	public function getAnggota($id=null)
	{
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->join('asisten_praktikan', 'asisten_praktikan.id_asisten = anggota.id_asisten', 'left');
		$this->db->join('jadwal_praktek', 'jadwal_praktek.id_jadwal_praktek = asisten_praktikan.id_jadwal', 'left');
		$this->db->where('anggota.nim_anggota', $id);
		return $this->db->get();
	}	

	public function addPortofolio($param=null)
	{
		return $this->db->insert('portofolio', $param);
	}

	public function addNilai($param=null)
	{
		return $this->db->insert('nilai_praktek', $param);
	}

	public function ubahPortofolio($param=null)
	{
		$this->db->where('id_portofolio', $param);
		$this->db->set('status','1');
		return $this->db->update('portofolio');
	}

	public function ubahPortofolioNol($param=null)
	{
		$this->db->where('id_portofolio', $param);
		$this->db->set('status','0');
		return $this->db->update('portofolio');
	}

	public function hapusNilaiPraktik($id='')
	{
		$this->db->where('id_nilai', $id);
		return $this->db->delete('nilai_praktek');
	}

	public function deletePortofolio($id=null)
	{
		$this->db->where('id_portofolio', $id);
		return $this->db->delete('portofolio');
	}

}

/* End of file M_Portofolio.php */
/* Location: ./application/models/M_Portofolio.php */