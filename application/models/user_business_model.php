<?php
class User_business_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	//通过用户id获取行
	public function get_info_byuid($uid = FALSE)
	{
		if($uid){
			$query = $this->db->get_where('user_business', array('u_id' => $uid));
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加只有u_id的商业用户
	public function create_uid($uid)
	{
		if(isset($uid)){ 
		  $create_data = array(
		  	'id'=>'',
		    'u_id' => $uid,
		  );	  
		  $this->db->insert('user_business', $create_data);
		  return  $this->db->insert_id();
		}
		return false;
	}
}