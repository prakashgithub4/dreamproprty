<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashbordController extends CI_Controller {

	public function index()
	{
		$user =$this->session->userdata('id');
		if(!empty($user))
		{
			$this->load->view('dashbord/index');
		}
		else
		{
           return redirect('/');
		}
		
	}
	
}
