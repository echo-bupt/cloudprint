<?php
class Task_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	//通过用户id获取已提交订单
	public function get_by_uid($uid = 0,$filter = null)
	{
		$this->db->from('task');
		switch($filter){
			case "now":$filter_arr =  array('state <'=>6);break;
			case "history":$filter_arr =  array('state >'=>5);break;
			default :$filter_arr =  array();break;
		}
		$this->db->select('task.*,printer.name AS printer_name,printer.location AS printer_location');
		$this->db->order_by('task.submit_time desc');
		$this->db->join('printer','printer.id=task.printer_id');
	  	$this->db->where(array('user_c_id' => $uid,'state !='=>0)+$filter_arr);
	  	$query = $this->db->get();
	 	$task_result = $query->result_array();
		$this->load->model('task_file_model');
		foreach($task_result as $key=>$val){
			$task_result[$key]['source'] = $this->task_file_model->get_by_tid($val['id']);
		}
               // print_r($task_result);
		return $task_result;
                
	}
        public function getAllNotprint()
        {
            $this->db->from('task');
            $filter_arr =array('state <'=>6);
            $this->db->select('task.*,printer.name AS printer_name,printer.location AS printer_location');
		$this->db->order_by('task.submit_time desc');
		$this->db->join('printer','printer.id=task.printer_id');
	  	$this->db->where(array('state !='=>0)+$filter_arr);
	  	$query = $this->db->get();
	 	$task_result = $query->result_array();
		$this->load->model('task_file_model');
		foreach($task_result as $key=>$val){
			$task_result[$key]['source'] = $this->task_file_model->get_by_tid($val['id']);
		}
               // print_r($task_result);
		return $task_result;
        }
        
        public function getAllHavedprint()
        {
             $this->db->from('task');
            $filter_arr =array('state ='=>6);
            $this->db->select('task.*,printer.name AS printer_name,printer.location AS printer_location');
		$this->db->order_by('task.submit_time desc');
		$this->db->join('printer','printer.id=task.printer_id');
	  	$this->db->where(array('state !='=>0)+$filter_arr);
	  	$query = $this->db->get();
	 	$task_result = $query->result_array();
                //这个是应该用于关联的!
		$this->load->model('task_file_model');
		foreach($task_result as $key=>$val){
			$task_result[$key]['source'] = $this->task_file_model->get_by_tid($val['id']);
		}
               // print_r($task_result);
		return $task_result;
        }
        //改变task的state字段状态。
     public function update_task_By_id($data)
     {
           $update_data = array(
		    'state' => $data['condition'],
		  );  
		  $this->db->update('task', $update_data,array('id'=>$data['task_id']));
		  if($this->db->affected_rows()>0)
			return true;
     }
        
	//通过打印机id获取已提交订单
	public function get_by_pid($pid = 0)
	{
		if(!$pid) return false;
	  	$query = $this->db->get_where('task', array('printer_id' => $pid));
	 	return $query->row_array();
	}
	//获取用户购物车id
	public function get_cart_id($print_id=NULL,$user_b_id=NULL,$user_i_id=NULL)
	{
		 $this->db->where('user_c_id', $_SESSION['ID']);
		 $this->db->where('state = 0');
         $query = $this->db->get('task');
         $reslut = $query->row_array();
         if(isset($reslut['id'])){
         	return $reslut['id'];
         }else{
         	return $this->create_cart($print_id,$user_b_id,$user_i_id);
         }
	}

    //打印端通过pid获取打印任务列表  --haibo
	public function get_cart($array=NULL)
	{   
         if($array == NULL) return ;
         $this->db->select('a.*,'
                           .' b.dir as dir,b.title as title');
         $this->db->from('task as a');
         $this->db->join('task_file as c', 'c.task_id = a.id');
         $this->db->join('source as b', 'b.id = c.source_id');
		 $this->db->where('a.state = 1');
		 $this->db->where_in("a.printer_id",$array);
		 $query  = $this->db->get();
         $reslut = $query->result_array();
        // var_dump($reslut);
         //var_dump($query);
		 return $reslut;
	}


	//获取用户订单信息
	public function get($task_id=NULL)
	{
		if(!$task_id) return false;

		 $this->db->where('id', $task_id);
         $query = $this->db->get('task');
         return $query->row_array();
	}
	//创建
	public function create_cart($print_id=NULL,$user_b_id=NULL,$user_i_id=NULL)
	{
	  $data = array(
	    'printer_id' => $print_id,
	    'user_c_id' => $_SESSION['ID'],
	    'user_b_id' => $user_b_id,
	    'user_i_id' => $user_i_id,
	    'add_time' => date('Y-m-d H:i:s'),
	    'state' => 0,
	  );
	  if($this->db->insert('task', $data))	  
	  	return $this->db->insert_id();
	  return false;
	}
	//更新打印机id
	public function update_printer_id($task_id=NULL,$print_id=NULL,$user_b_id=NULL)
	{
		if($task_id&&$print_id){ 
		  $update_data = array(
		    'printer_id' => $print_id,
		    'user_b_id' => $user_b_id,
		  );  
		  $this->db->update('task', $update_data,array('id'=>$task_id));
		  if($this->db->affected_rows()>0)
			return true;
		}
		return false;
	}
	//更新任务状态
	public function update_state($task_id=NULL,$state)
	{
		if($task_id&&$state){ 
		  $update_data = array(
		    'state' => $state,
		  );  
		  $this->db->update('task', $update_data,array('id'=>$task_id));
		  if($this->db->affected_rows()>0)
			return true;
		}
		return false;
	}
	//提交任务
	public function submit($task_id=NULL,$print_method=NULL){
		if(!$task_id) return false;
		//如果未选打印设备
		$task_info = $this->get($task_id);
		if(!$task_info['printer_id']) return false;
		//如果未选打印资源
		$task_file_query = $this->db->get_where('task_file',array('task_id'=>$task_id));
		$task_file_info = $task_file_query->result_array();
		if(empty($task_file_info)) return false;

		$update_data = array(
			'submit_time' => date('Y-m-d H:i:s'),
			'print_method' => $print_method,
			'state' => 1
		);
		$this->db->update('task', $update_data,array('id'=>$task_id));
		if($this->db->affected_rows()>0){
			#打印机打印总量+1
			$this->db->set('print_time',"print_time+1",false);
			$this->db->where('id',$task_info['printer_id']);
			$this->db->update('printer');
			return true;
		}
		return false;
	}
}