<?php

class admin_model extends CI_Model{
    public function __construct()
	{
		$this->load->database();
	}
        public function getDataByUname($name)
        {
            $this->db->select("user.*");
            $this->db->where("name",$name);
            $query=$this->db->get("user");
            return $query->result_array();
        }
}
?>
