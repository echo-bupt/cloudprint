<?php

class notice_model extends CI_Model{
    public function __construct()
	{
		$this->load->database();
	}
          public function get_limit_notice()
       {
            $this->db->order_by("time desc");
           $query=$this->db->get("notice",9);
           return $query->result_array();
       }
}
?>
