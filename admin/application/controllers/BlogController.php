<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogController extends CI_Controller {

	public function index()
	{
		$user_id = $this->session->userdata('id');
		if(!empty($user_id))
		{
			$data['blogs'] = $this->common_model->common('tbl_blog');
			
			$this->load->view('blog/blog',$data);
		}
		else
		{
			return redirect('../');
		}
	
	}
	public function blogaddprocess()
	{
		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('blog/add');
		}
		else
		{
			$data['title']=$this->input->post('title');
			$data['slug']=$this->input->post('slug');
			$data['image'] = $this->do_upload('image','assets/uploads');
			$data['description']=$this->input->post('description');
			$data['status'] = $this->input->post('status');
			$data['user_id'] = $this->session->userdata('id');
			$data['created_on'] = date('y-m-d');
			$this->common_model->save('tbl_blog',$data);
			$this->session->set_flashdata('success','Blog inserted succesfully');
			return redirect('../blog');
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

	public function do_upload($image, $path)
	{

		$config['upload_path']          = $path;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 1024;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$new_name = time();
		$config['file_name'] = $new_name;


		$this->load->library('upload', $config);

		if ($this->upload->do_upload($image)) {
			$data = array($this->upload->data());
			$file_name = $data[0]['file_name'];
			return  $file_name;
		}
	}
	public function deleteblog(){
	   $id = $this->uri->segment(3);
	   $file=$this->common_model->getfileName($id,'tbl_blog');
	   unlink('assets/uploads/'.$file[0]['image']);
	   $this->common_model->deleteblog($id,'tbl_blog');
	   $this->session->set_flashdata('success','Blog deleted successfully');
	   return redirect('../blog');
	}
}
