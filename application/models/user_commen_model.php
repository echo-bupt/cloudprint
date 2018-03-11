<?php
class User_commen_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	//获取资源
	public function get_source($id = FALSE)
	{
	  if ($id === FALSE)
	  {
		$query = $this->db->get('source');
		return $query->result_array();
	  }
	  
	  $query = $this->db->get_where('source', array('id' => $id));
	  return $query->row_array();
	}
	//创建资源
	public function set_source()
	{
	  $this->load->helper('url');
	  
	 // $slug = url_title($this->input->post('title'), 'dash', TRUE);
	  
	  $data = array(
	    'title' => $this->input->post('title'),
	    'dir' => $this->input->post('dir')
	  );
	  
	  return $this->db->insert('source', $data);
	}
}