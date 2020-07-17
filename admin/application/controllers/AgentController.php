<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AgentController extends CI_Controller
{
	public function index()
	{
		$user_id = $this->session->userdata('id');
		if (!empty($user_id)) {
			$data['blogs'] = $this->common_model->common('tbl_agents');

			$this->load->view('agent/agents', $data);
		} else {
			return redirect('../');
		}
	}
	public function blogaddprocess()
	{
		$this->form_validation->set_rules('name', 'Nmae', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('agent/add');
		} else {
			$data['name'] = $this->input->post('name');
			$data['slug'] = $this->input->post('slug');
			$id = $this->input->post('id');
		
		
			$file_name = $this->do_upload('image', 'assets/uploads/agent');
			if (!empty($file_name)) {
				$data['image'] = $file_name;
				$file = $this->common_model->getfileName($id,'tbl_agents');
				@unlink('assets/uploads/agent/' . $file[0]['image']);
			}

			$data['user_id'] = $this->session->userdata('id');
			$data['craeted_on'] = date('y-m-d');
       
			if (!empty($id)) {

				$this->common_model->save('tbl_agents', $data, $id);
				$this->session->set_flashdata('success', 'Agent updated succesfully');
				return redirect('AgentController/index');
			} else {
				$this->common_model->save('tbl_agents', $data);
				$this->session->set_flashdata('success', 'Agent inserted succesfully');
				return redirect('AgentController/index');
			}
		}
	}
	public function add()
	{
		$user_id = $this->session->userdata('id');

		if (!empty($user_id)) {
			$id = $this->uri->segment(3);
			if (!empty($id)) {
				$data['blog'] = $this->common_model->common('tbl_agents', $id);
				$this->load->view('agent/add', $data);
			} else {
				$this->load->view('agent/add');
			}
		} else {
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
	public function deleteblog()
	{
		$id = $this->uri->segment(3);
		$file = $this->common_model->getfileName($id,'tbl_agents');
		unlink('assets/uploads/agent/' . $file[0]['image']);
		$this->common_model->deleteblog($id, 'tbl_agents');
		$this->session->set_flashdata('success', 'agent deleted successfully');
		return redirect('AgentController/index');
	}
	
}
