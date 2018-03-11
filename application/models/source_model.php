<?php
class Source_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	//通过用户id获取资源
	public function get_source_by_uid($uid = 0,$filter= null)
	{
		$this->db->order_by('weight desc, add_time desc');
		switch($filter){
			case "own":$filter_arr =  array('share'=>0);break;
			case "share":$filter_arr =  array('share'=>1);break;
			default :$filter_arr =  array();break;
		}
	  	$query = $this->db->get_where('source', array('user_id' => $uid)+$filter_arr);
	 	return $query->result_array();
	}
	//通过id获取一到多个资源
	public function get_source_by_ids($ids)
	{
	  if(is_array($ids)){
	  		$this->db->where_in('id',$ids);
	  		$query = $this->db->get('source');
	  		return $query->result_array();
	  }elseif(is_numeric($ids)){
	  		$query = $this->db->get_where('source', array('id' => $ids));
	  		return $query->result_array();
	  }
	  return false;
	  		
	}
	//创建资源
	public function save_source_bypost($data_post)
	{
		$date_time = date('Y-m-d H:i:s');
		$data_file = "";
		foreach($data_post['file_name'] as $key=>$val){
			//文件存在验证
			if(file_exists(iconv("utf-8","gbk",urldecode($data_post['file_dir'][$key])))){
				$data_file[$key] = array(
					'title' => $val,
					'dir' => urldecode($data_post['file_dir'][$key]),
					'img_dir' => $data_post['file_img_dir'][$key],
					'type' => $data_post['file_type'][$key],
					'size' => $data_post['file_size'][$key],
					'add_time' => $date_time,
					'visible' => 0,
					'share' => 0,
					'user_id' => $_SESSION['ID']?$_SESSION['ID']:session_id()
				);
			}

		}
		if(is_array($data_file)){
	  		if($this->db->insert_batch('source', $data_file))
	  			return $date_time;
	  	}
	  		return false;
	}
	//直接处理提交数据更新资源
	public function update_source_bypost($data_post)
	{
		foreach($data_post['id'] as $key=>$val){
			$data_file[$key] = array(
				'id' => $val,
				'title' => $data_post['title'][$key],
				'cat_id' => $data_post['cat_id'][$key],
				'description' => $data_post['description'][$key],
				'tag' => $data_post['tag'][$key],
				'share' => $data_post['share'][$key]?1:0,
				'download_score' => $data_post['score'][$key]
			);
		}	  
		if(is_array($data_file)){
	  		$this->db->update_batch('source', $data_file,'id');
	  		if($this->db->affected_rows()>0) return true;
	  	}
	  		return false;
	}
	//通过含有id的资源数组更新资源
	public function update_source_by_ids($arr_with_ids)
	{
		if(is_array($arr_with_ids)){
			if(isset($arr_with_ids['id'])){
				$update_arr[0] = $arr_with_ids; 			
			}else{
				$update_arr = $arr_with_ids;
			}
			$this->db->update_batch('source',$update_arr,'id');
			return true;
		}
		return false;
	}
	//通过id共享资源
	public function share_by_ids($ids){
		//先判断是否有未选分类的添加描述的资源
		$source_arr = $this->get_source_by_ids($ids);

		foreach($source_arr as $key=>$val){
			if(!$val['cat_id'] || !$val['description'])
				return -1;
		}
		if(is_array($ids)){
			foreach($ids as $val){
				$arr_with_ids[] = array('id'=>$val,'share'=>1);
			}
		}elseif(is_numeric($ids)){
			$arr_with_ids[0] = array('id'=>$ids,'share'=>1);
		}else{
			return false;
		}
		if($this->update_source_by_ids($arr_with_ids)) return true;
		
		return false;
		
	}
	//通过id删除资源
	public function delete_by_ids($ids){
		if(is_array($ids)){
			$arr_with_ids = $ids;
		}elseif(is_numeric($ids)){
			$arr_with_ids[0] = $ids;
		}else{
			return false;
		}
		//删除本地文件 查找不可删文件（已有任务）
		$result = $this->get_source_by_ids($arr_with_ids);
		$this->load->model('task_file_model');
		$no_delelte = array();
		foreach($result as $key=>$val){
			$val_tf = $this->task_file_model->get_by_sid($val['id']);
			if(empty($val_tf)){
				$dir = iconv("utf-8","gbk",urldecode($val['dir']));
				if(file_exists($dir)){
					unlink($dir);
				}
				$img_dir = iconv("utf-8","gbk",urldecode($val['img_dir']));
				if($val['img_dir']!='' && file_exists($img_dir)){
					unlink($img_dir);
				}
			}else{
				$no_delelte[] = $val['id'];
			}
		}
		//删除数据
		$arr_with_ids = array_diff($arr_with_ids,$no_delelte);
		if ($arr_with_ids){
			$this->db->where_in('id',$arr_with_ids);
			$this->db->delete('source');
		}
		if(isset($no_delelte[0])){
			return -1;
		}else{
			return true;
		}
		
		
	}
	public function get_source_by_time_uid($time,$uid)
	{
		if($time && $uid){
			$query =$this->db->get_where('source', array('add_time' => $time,'user_id' => $uid));
			return $query->result_array();
		}
		return false;
	}
	//获取公开的资源
	public function get_shared_source($order="",$cat_id=0){
		$order_by = "";
		if($order == "hot"){$order_by = "view_num desc";}
		if($cat_id){$this->db->where('cat_id',$cat_id);}
		$this->db->order_by($order_by.", weight desc, add_time desc");
		$this->db->select('source.*,s_cat.name AS cat_name');
		$this->db->join("s_cat","s_cat.id = source.cat_id");
		$query =$this->db->get_where('source', array('share' => 1));
		return $query->result_array();
	}
        public function get_shared_source_limit($order="")
        {
            $order_by = "";
		if($order == "hot"){$order_by = "view_num desc";}
                //这是指定排序
                $this->db->order_by($order_by.", add_time desc");
                //这是指定搜索内容
                $this->db->select('source.title,dir,s_cat.name AS cat_name');
                //设置两个表关联.
                $this->db->join("s_cat","s_cat.id = source.cat_id");
                //具体的查询语句
                $query =$this->db->get_where('source', array('share' => 1),5);
                //得到结果集。
                return $query->result_array();
        }
	//搜索公开的资源
	public function search_source($content= null){
		if($content){$this->db->where('title LIKE',"%".$content."%");}
		$this->db->order_by("weight desc, add_time desc");
		$this->db->select('source.*,s_cat.name AS cat_name');
		$this->db->join("s_cat","s_cat.id = source.cat_id");
		$query =$this->db->get_where('source', array('share' => 1));
		return $query->result_array();
	}
}