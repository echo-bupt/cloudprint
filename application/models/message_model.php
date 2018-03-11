<?php
class message_model extends CI_Model{
    public function __construct()
	{
		$this->load->database();
	}
        public function addMessageContent($data)
        {
         $str = $this->db->insert_batch('message', $data); 
         return $str;
        }
          public function addNoticeContent($data)
        {
         $str = $this->db->insert_batch('notice', $data); 
         return $str;
        }
       public function lists()
       {
            $this->db->order_by("time desc");
           $query=$this->db->get("notice");
           return $query->result_array();
       }
       public function delete($nid)
       {
           $this->db->where("nid",$nid);
           $nid=$this->db->delete("notice");
       }
       public function getAllMessage()
       {
            $this->db->order_by("time desc");
          
           $this->db->join("user","user.id= message.user_id");
            $query=$this->db->get("message");
           return $query->result_array();
       }
        public function deleteMessage($nid)
       {
           $this->db->where("mid",$nid);
           $nid=$this->db->delete("message");
       }
       public function getusermessageByid($uid)
       {
           $where=array(
               "user_id"=>$uid,
               "is_read"=>0
           );
           $this->db->where($where);
            $query=$this->db->get("message");
           return $query->result_array();
       }
       public function updateMessageById($usid)
       {
            $this->db->where("mid",$usid);
            $update_arr=array(
              "is_read"=>1  
            );
           	$this->db->update('message',$update_arr);
       }
}
?>
