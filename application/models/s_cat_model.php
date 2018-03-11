<?php
class S_cat_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	//获取下一级分类
	public function get_s_cat_by_fid($fid = 0)
	{
	  $query = $this->db->get_where('s_cat', array('f_id' => $fid));
	  return $query->result_array();
	}
}