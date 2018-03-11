<?php
class Task_file_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	//创建
	public function create_all($task_id=0,$data_post)
	{
		if($task_id == 0 || !is_numeric($task_id)) return false;
		foreach($data_post['s_id'] as $key=>$val){
			$data_insert[$key] = array(
				'task_id' => $task_id,
				'source_id' => $val,
				'number' => isset($data_post['number'][$key])?$data_post['number'][$key]:1,
				'pager_size' => isset($data_post['pager_size'][$key])?$data_post['pager_size'][$key]:1,
				'pager_type' => isset($data_post['pager_type'][$key])?$data_post['pager_type'][$key]:1,
				'print_type' => isset($data_post['print_type'][$key])?$data_post['print_type'][$key]:1,
				'color_type' => isset($data_post['color_type'][$key])?$data_post['color_type'][$key]:1,
				'message' => isset($data_post['message'][$key])?$data_post['message'][$key]:""
			);
		}
		if(is_array($data_insert)){
	  		$this->db->insert_batch('task_file', $data_insert);
	  		if($this->db->affected_rows()>0) return true;
	  	}
	  		return false;
	}
	//更新
	public function update_all($data_post)
	{
		foreach($data_post['s_id'] as $key=>$val){
			$data_update[$key] = array(
				'id' => $data_post['tf_id'][$key],
				'source_id' => $val,
				'number' => $data_post['number'][$key]?$data_post['number'][$key]:1,
				'pager_size' => $data_post['pager_size'][$key],
				'pager_type' => $data_post['pager_type'][$key],
				'print_type' => $data_post['print_type'][$key],
				'color_type' => $data_post['color_type'][$key],
				'message' => $data_post['message'][$key]
			);
		}
		if(is_array($data_update)){
	  		$this->db->update_batch('task_file', $data_update,'id');
	  		if($this->db->affected_rows()>0) return true;
	  	}
	  		return false;
	}
	//按订单查找
	public function get_by_tid($tid = 0){
		if(!$tid) return false;
		$this->db->from('task_file');	
		$this->db->select('task_file.id,task_file.source_id,task_file.number,task_file.pager_size,task_file.pager_type,task_file.print_type,task_file.color_type,task_file.message,task_file.state,source.title,source.size,source.description,source.dir,source.type');		
		$this->db->where(array('task_id'=>$tid));
		$this->db->join('source','source.id = task_file.source_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	public function get_by_sid($sid = 0){
		if(!$sid) return false;
		$this->db->from('task_file');	
		$this->db->where(array('source_id'=>$sid));
		$query = $this->db->get();
		return $query->result_array();
	}
	//删除
	public function delete_by_tf_id($tf_id = 0){
		if(!$tf_id) return false;
		if($this->db->delete('task_file', array('id' => $tf_id))) return true;
		return false;
	}
}