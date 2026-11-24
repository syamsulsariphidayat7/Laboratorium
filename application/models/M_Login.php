<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Login extends CI_Model {

	public function getLogin($param = null)
	{
		return $this->db->get_where('user', $param);
	}

	public function getLoginDosen($param = null)
	{		
		return $this->db->get_where('dosen',$param);
	}

	public function getLoginMahasiswa($param = null)
	{		
		return $this->db->get_where('mahasiswa',$param);
	}

	public function getLoginAsisten($param = null)
	{		
		return $this->db->get_where('asisten_praktikan',$param);
	}
	
	public function ubahPasswordAdmin($id=null,$param=null)
	{
		$this->db->where('id_user', $id);
		$this->db->set('password',$param);
		return $this->db->update('user');
	}

	public function ubahPasswordDosen($id=null,$param=null)
	{
		$this->db->where('id_dosen', $id);
		$this->db->set('password',$param);
		return $this->db->update('dosen');
	}

	public function ubahPasswordAsisten($id=null,$param=null)
	{
		$this->db->where('id_asisten', $id);
		$this->db->set('password_asisten',$param);
		return $this->db->update('asisten_praktikan');
	}

	public function ubahPasswordMahasiswa($id=null,$param=null)
	{
		$this->db->where('nim', $id);
		$this->db->set('password',$param);
		return $this->db->update('mahasiswa');
	}

	// rows
	public function countJadwal()
	{
		$this->db->get('jadwal_praktek');
		return $this->db->affected_rows();
	}

	public function countDosen()
	{
		$this->db->get('dosen');
		return $this->db->affected_rows();
	}

	public function countPortofolio()
	{
		$this->db->get('portofolio');
		return $this->db->affected_rows();
	}

	public function countPraktikan()
	{
		$this->db->get('anggota');
		return $this->db->affected_rows();
	}
	// .rows

	// ubah photo
	public function ubahPhotoMahasiswa($id=null,$namaPhoto=null)
	{
		$this->db->where('nim', $id);
		$this->db->set('foto_mahasiswa',$namaPhoto);
		return $this->db->update('mahasiswa');
	}

	public function ubahPhotoAsisten($id=null,$namaPhoto=null)
	{
		$this->db->where('id_asisten', $id);
		$this->db->set('photo_asisten',$namaPhoto);
		return $this->db->update('asisten_praktikan');
	}

	public function ubahPhotoDosen($id=null,$namaPhoto=null)
	{
		$this->db->where('id_dosen', $id);
		$this->db->set('foto_dosen',$namaPhoto);
		return $this->db->update('dosen');
	}

	public function ubahPhotoAdmin($id=null,$namaPhoto=null)
	{
		$this->db->where('id_user', $id);
		$this->db->set('photo_admin',$namaPhoto);
		return $this->db->update('user');
	}
	// .ubah photo

}

/* End of file M_Login.php */
/* Location: ./application/models/M_Login.php */