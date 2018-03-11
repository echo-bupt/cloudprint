<?php
class Printer_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	//通过用户id获取
	public function get_by_uid($uid = 0)
	{
		$this->db->select('printer.*,user.name AS user_name,COUNT(task.printer_id) AS printing_row');
		$this->db->order_by("weight desc, add_time desc");
		$this->db->join('user','user.id = printer.user_id','left');
		$this->db->join('task','task.printer_id = printer.id AND task.state < 6 AND task.state >0','left');
		$this->db->where('printer.user_id',$uid);
		$this->db->group_by('printer.id');
		$query =$this->db->get('printer');
		return $query->result_array();
	}

	//通过用户id获取printer by haibo
	public function get_pid($uid = 0)
	{
		$this->db->select('printer.id');
		$this->db->where('printer.user_id',$uid);
		$query =$this->db->get('printer');
		$resultpre = $query->result_array();
		if( empty($resultpre)) return ;
		foreach ($resultpre as $key => $value) {
				$result[$key] = $value['id'];
		}
		return $result;
	}

	//获取公开的设备
	public function get_shared_printer($order=""){
		$order_by = "";
		$this->db->select('printer.*,user.name AS user_name,COUNT(task.printer_id) AS printing_row');
		if($order == "hot"){$order_by = "print_time desc, ";}
		$this->db->order_by($order_by."weight desc, add_time desc");
		$this->db->join('user','user.id = printer.user_id','left');
		$this->db->join('task','task.printer_id = printer.id AND task.state < 6 AND task.state >0','left');
		$this->db->where('printer.acl_state',2);
		$this->db->group_by('printer.id');
		$query =$this->db->get('printer');
		return $query->result_array();
	}
	//通过id获取
	public function get_by_id($id = 0)
	{
		if(!isset($id)) return false;
		$this->db->select('printer.*,user.name AS user_name,COUNT(task.printer_id) AS printing_row');
		$this->db->order_by("weight desc, add_time desc");
		$this->db->join('user','user.id = printer.user_id','left');
		$this->db->join('task','task.printer_id = printer.id','left');
		$this->db->where('printer.id',$id);
		$this->db->where('task.state <',6);
		$this->db->where('task.state >',0);
		//$this->db->group_by('task.printer_id');
		$query =$this->db->get('printer');
	 	return $query->row_array();
	}
	//添加打印机
	public function create($data)
	{
		$this->load->model('user_business_model');
		$is_user_business = $this->user_business_model->get_info_byuid($_SESSION['ID']);
		if(empty($is_user_business)){
			$this->user_business_model->create_uid($_SESSION['ID']);
		}
		if(is_array($data)){ 
		  $create_data = array(
		    'name' => $data['name'],
		    'user_id' => $_SESSION['ID'],
		    'location' => $data['location'],
		    'brand' => $data['brand'],
		    'type' => $data['type'],
		    'category_key' => $data['category_key'],
		    'acl_state' => $data['acl_state']?$data['acl_state']:0,
		    'visible' => $data['visible']?1:0,
		    'weight' => $data['weight']?$data['weight']:0,
		    'add_time' => date('Y-m-d H:i:s'),
		  );	  
		  $this->db->insert('printer', $create_data);
		  return  $this->db->insert_id();
		}
		return false;
	}
	//编辑打印机
	public function update($data)
	{
		if(is_array($data)){ 
		  $update_data = array(
		    'name' => $data['name'],
		    'location' => $data['location'],
		    'brand' => $data['brand'],
		    'type' => $data['type'],
		    'category_key' => $data['category_key'],
		    'acl_state' => $data['acl_state']?$data['acl_state']:0,
		    'visible' => $data['visible']?1:0,
		    'weight' => $data['weight']?$data['weight']:0,
		  );  
		  $this->db->update('printer', $update_data,array('id'=>$data['id']));
		  return true;
		}
		return false;
	}
	//通过id删除设备
	public function delete_by_ids($ids){
		if(is_array($ids)){
			$arr_with_ids = $ids;
		}elseif(is_numeric($ids)){
			$arr_with_ids[0] = $ids;
		}else{
			return false;
		}
		//删除本地文件 查找不可删文件（已有任务）
		$this->load->model('task_model');
		$no_delelte = array();
		foreach($arr_with_ids as $key=>$val){
			$val_t = $this->task_model->get_by_pid($val);
			if(!empty($val_t)){
				$no_delelte[] = $val;
			}
		}
		$arr_with_ids = array_diff($arr_with_ids,$no_delelte);
		//删除数据
		if ($arr_with_ids){
			$this->db->where_in('id',$arr_with_ids);
			$this->db->delete('printer');
		}
		if(isset($no_delelte[0])){
			return -1;
		}else{
			return true;
		}		
	}
}