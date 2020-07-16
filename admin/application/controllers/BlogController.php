<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogController extends CI_Controller {

	public function index()
	{
		$user_id = $this->session->userdata('id');
		if(!empty($user_id))
		{
			$this->load->view('blog/blog');
		}
		else
		{
			return redirect('../');
		}
	
	}
	public function add()
	{
		$user_id = $this->session->userdata('id');
		
		if(!empty($user_id))
		{
			$this->load->view('blog/add');
		}
		else
		{
			return redirect('../');
		}
	
	}
	
}
