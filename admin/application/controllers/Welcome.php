<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function login()
	{
		$data['email'] = $this->input->post('email');
		$data['password'] = $this->input->post('password');

		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);
		$query = $this->db->get();
		$login_data = $query->result_array();
		if (count($login_data) > 0) {
			$new_array = array(
				'id' => $login_data[0]['id'],
				'name' => $login_data[0]['name'],
				'email' => $login_data[0]['email']
			);
			$this->session->set_userdata($new_array);
			return redirect('../dashbord');
		} else {
			$this->session->set_flashdata('fail', 'Invalid email or Password');
			return redirect('../');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		return redirect('../');
	}
	public function changepassword()
	{

		$user = $this->session->userdata('id');
		if (!empty($user)) {
			$this->load->view('resetpass');
		} else {
			return redirect('/');
		}
	}
	public function changePasswordprocess()
	{
		$data['old'] = $this->input->post('old');
		$data['new'] = $this->input->post('new');
		$id = $this->session->userdata('id');
		$this->db->select("password");
		$this->db->from('admin');
		$this->db->where('id', $id);
		$query = $this->db->get();
		$result = $query->result_array();


		if (($data['old'] == "") && ($data['new'] == "")) {
			$this->session->set_flashdata('fail', "please enter each this fields");
			return redirect('../changepassword');
		} else if (($data['old'] == "") && ($data['new'] != '')) {
			$this->session->set_flashdata('fail', "old Password field is empty");
			return redirect('../changepassword');
		} else if (($data['old'] != "") && ($data['new'] == '')) {
			$this->session->set_flashdata('fail', "new Password field is empty");
			return redirect('../changepassword');
		} else if ($result[0]['password'] != $data['old']) {
			$this->session->set_flashdata('fail', "old Password is not matched in our database");
			return redirect('../changepassword');
		} else {

			$updata_array = array('password' => $data['new']);
			$this->db->where('id', $id);
			$this->db->update('admin', $updata_array);
			return redirect('../dashbord');
		}
	}
}
