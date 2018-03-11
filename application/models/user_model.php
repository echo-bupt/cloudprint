<?php
class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	//获取用户信息by user_name
	function get_by_username($username)
     {
         $this->db->where('name', $username);
         $query = $this->db->get('user');                            //不判断获得什么直接返回
         if ($query->num_rows() == 1)
         {
             return $query->row();
         }
         else
         {
             return FALSE;
         }
     }
     //获取用户信息by user_id
	function get_by_uid($username=0)
     {
         $this->db->where('id', $username);
         $query = $this->db->get('user');                            //不判断获得什么直接返回
         if ($query->num_rows() == 1)
         {
             return $query->row();
         }
         else
         {
             return FALSE;
         }
     }
/**
      * 用户名不存在时,返回false
      * 用户名存在时，验证密码是否正确
      */
     function password_check($username, $password)
     {                
         if($user = $this->get_by_username($username))
         {
             return $user->password == $password ? TRUE : FALSE;
         }
         return FALSE;                                    //当用户名不存在时
     }
	//用户登录
	public function login($user_name="",$password="")
	{
		$query = $this->db->get_where('user', array('name' => $user_name));
		$result = $query->first_row('array');
	  	return $result;
	}
	//用户注册
	public function register($user_name="",$password="")
	{ 
	  $this->db->insert('user_commen', array('id'=>''));
	  $role_id = $this->db->insert_id();
	  $data = array(
	    'name' => $user_name,
	    'password' => $password,
	    'add_time' => date('Y-m-d H:i:s'),
	    'ip' => $this->input->ip_address(),
	    'grad' => 1,
	    'role' => 1,
	    'role_id' => $role_id
	  );	  
	  $this->db->insert('user', $data);
	  return  $this->db->insert_id();
	}
}