<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function cekLogin()
	{
		if (!$this->session->userdata('login')) {
			redirect('auth');
		}
	}

	public function cekAdmin()
	{
		if ($this->session->userdata('login')) {
			redirect('admin');
		}
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */