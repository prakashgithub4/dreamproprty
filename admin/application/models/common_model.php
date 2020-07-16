<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class common_model extends CI_Model
{
	public function save($table,$data,$id="")
	{
		if(empty($id)){
			$this->db->insert($table,$data);
		}
		else{
			$this->db->where('id',$id);
			$this->db->update($table,$data);
		}
	 
	}
	public function common($table){
		$this->db->select("*");
		$this->db->from($table);
		$this->db->order_by('id','Desc');
		$query= $this->db->get();
		return $query->result_array();
	}
	public function deleteblog($id,$table)
	{
		$this->db->where('id', $id);
		$this->db->delete($table);
	}
	public function getfileName($id,$table)
	{
	   $this->db->select('image');
	   $this->db->where('id',$id);
	   $query=$this->db->get($table);
	   return $query->result_array();
	}
}
?>
