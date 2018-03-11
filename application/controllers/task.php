<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CloudPrint
 *
 * 基于Codeigniter的云打印平台
 * 
 *
 * @package		CloudPrint
 * @author		hillsdong@163.com
 * @copyright	Copyright (c) 2013 - 2013, zifuyun.com.
 * @license		GNU General Public License 2.0
 * @link		
 * @version		0.1.0
 */
 
// ------------------------------------------------------------------------

/**
 * CloudPrint 内容控制器
 *
 *	主要用于用户订单相关的前台交互
 *
 * @package		CloudPrint
 * @subpackage	Controllers
 * @category	Front-controllers
 * @author		hillsdong@163.com
 * @link		
 */
class Task extends CI_Controller {
	 /**
     * 解析函数
     * 
     * @access public
     * @return void
     */	
  	public function __construct()
  	{
    	parent::__construct();
		//权限验证
		$action = $this->uri->rsegment(2);
		$publick_action = array();
		if(!in_array($action,$publick_action)&&!$_SESSION['ID']) redirect('main/index', 'location', 301);		
		
    	$this->load->model('task_model');
  	}
	 /**
     * source_add
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function source_add(){
            /** 页面初始化 */
                $this->load->model("message_model");
            if(isset($_SESSION['ID']))
                {
                    $usid=$_SESSION['ID'];
                     $message=$this->message_model->getusermessageByid($usid);
             //  $data['message']=$message;
               $data['num']=count($message);
                }
		/** 页面初始化 */
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("打印设置","页面描述","页面关键字");
		$data['redirect'] = $this->input->get('redirect');
		$data['task_step'] = 1;
	  	//获取状态为0的task，即用户购物车，每个用户只有一个
	  	$data['task_id'] = $this->task_model->get_cart_id();
     //   $data['task']  = $this->task_model->get_cart();
		/** 打印配置初始化 */
		$this->config->load('print_db');
		$data['pager_size'] = $this->config->item('pager_size');
		$data['pager_type'] = $this->config->item('pager_type');
		$data['print_type'] = $this->config->item('print_type');
		$data['color_type'] = $this->config->item('color_type');

		$data_post = $this->input->post();
	  	if ($this->input->post('source_add')&&!empty($data_post['s_id']))
	  	{
	  		//商品存入购物车
	  		$this->load->model('task_file_model');
	  		if($this->input->post('update_op')==1){
	  			$is_ok = $this->task_file_model->update_all($data_post);
	  		}else{
	  			$is_ok = $this->task_file_model->create_all($data['task_id'],$data_post);
	  		}
	    	if($is_ok){
		    	//跳转至打印机选择界面
		    	//session存储提示，提示后自动删除session
		  		$this->session->set_flashdata('notic', '恭喜您，打印资源添加成功！');
		    	redirect('task/printer_add', 'location', 301);
		    }
		    $this->session->set_flashdata('notic', '打印资源添加失败！');
	  	}
  		if((isset($_REQUEST['s_id']) && $file_ids = $_REQUEST['s_id'])|| $file_ids = $this->session->flashdata('file_ids')){
			$this->load->model('source_model');
			$data['file_info'] = $this->source_model->get_source_by_ids($file_ids);
		}elseif($data_file = $this->session->flashdata('data_file')){
			$data['file_info'] = $data_file;
		}else{
			//获取已添加的打印资源
		  	$this->load->model('task_file_model');
			$data['file_info'] = $this->task_file_model->get_by_tid($data['task_id']);
			$data['update_op'] = 1;
			$this->load->model('printer_model');
		}

    	$this->load->view('header', $data);  
    	$this->load->view('task/source_add');
    	$this->load->view('footer');		
	}


	
	public function printer_add(){
            /** 页面初始化 */
                $this->load->model("message_model");
            if(isset($_SESSION['ID']))
                {
                    $usid=$_SESSION['ID'];
                     $message=$this->message_model->getusermessageByid($usid);
             //  $data['message']=$message;
               $data['num']=count($message);
                }
		/** 页面初始化 */
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("选择打印机","页面描述","页面关键字");
		$data['redirect'] = $this->input->get('redirect');
		$data['task_step'] = 2;
		$data['task_id'] = $this->task_model->get_cart_id();
		/** 打印配置初始化 */
		$this->config->load('print_db');
		$data['printer_cat'] = $this->config->item('printer_cat');
		//购物车信息
		$data['task_info'] = $this->task_model->get($data['task_id']);
		//打印设备信息
		$this->load->model('printer_model');
		$data['printer_info'] =$this->printer_model->get_by_id($data['task_info']['printer_id']);
		//我的设备
		$this->load->model('printer_model');
		$data['my_printer'] = $this->printer_model->get_by_uid($_SESSION['ID']);
		//共享设备
		$data['shared_printer'] = $this->printer_model->get_shared_printer($order="");
		//处理添加事件
		if($this->input->post('printer_add')){
			$is_ok = false;
			if($this->input->post('printer_id')){
				$printer_id_uid = explode(',',$this->input->post('printer_id'));
				if($printer_id_uid[0] == $data['task_info']['printer_id']){
					$is_ok = true;
				}else{
					$is_ok = $this->task_model->update_printer_id($this->input->post('task_id'),$printer_id_uid[0],$printer_id_uid[1]);
				}
			}elseif($this->input->post('now_printer_id')){
				$is_ok = true;
			}
			if($is_ok){
				//session存储提示，提示后自动删除session
	  			$this->session->set_flashdata('notic', '恭喜您，打印设备添加成功！');
	  		 	redirect('task/submit', 'location', 301);
	  		}	
			$data['notic'] = array('danger','打印设备添加失败！');			
		}		
		
    	$this->load->view('header', $data);  
    	$this->load->view('task/printer_add');
    	$this->load->view('footer');
	}
	public function submit(){
		/** 页面初始化 */
            /** 页面初始化 */
                $this->load->model("message_model");
            if(isset($_SESSION['ID']))
                {
                    $usid=$_SESSION['ID'];
                     $message=$this->message_model->getusermessageByid($usid);
             //  $data['message']=$message;
               $data['num']=count($message);
                }
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("提交任务","页面描述","页面关键字");
		$data['redirect'] = $this->input->get('redirect');
		$data['task_step'] = 3;
		$data['task_id'] = $this->task_model->get_cart_id();
		/** 打印配置初始化 */
		$this->config->load('print_db');
		$data['print_method'] = $this->config->item('print_method');
		$data['pager_size'] = $this->config->item('pager_size');
		$data['pager_type'] = $this->config->item('pager_type');
		$data['print_type'] = $this->config->item('print_type');
		$data['color_type'] = $this->config->item('color_type');
		$data['printer_cat'] = $this->config->item('printer_cat');

		//相关信息
		$data['task_info'] = $this->task_model->get($data['task_id']);
		$this->load->model('task_file_model');
		$data['file_info'] = $this->task_file_model->get_by_tid($data['task_id']);
		$this->load->model('printer_model');
		$data['printer_info'] =$this->printer_model->get_by_id($data['task_info']['printer_id']);
		//处理提交事件
		if($this->input->post('submit')&&$this->input->post('task_id')){
			$is_ok = $this->task_model->submit($this->input->post('task_id'),$this->input->post('print_method'));
			if($is_ok)
			{
				//通知python打印
				$this->load->model('user_business_model');
				$user_b_info = $this->user_business_model->get_info_byuid($data['task_info']['user_b_id']);
				if (isset($user_b_info['socket_port']) && $user_b_info['socket_port'] != -1) //如果打印机所在ip不是本地ip，进行socket通讯，否则等待客户端程序轮询
					$this->socket($user_b_info['socket_ip'],$user_b_info['socket_port'],$this->input->post('task_id'));
				//session存储提示，提示后自动删除session
				$this->session->set_flashdata('notic', array('success','恭喜您，打印任务提交成功！'));
				redirect('user/task', 'location', 301);
			}			
			$data['notic'] = array('danger','打印任务提交失败！');
		}


    	$this->load->view('header', $data);  
    	$this->load->view('task/submit');
    	$this->load->view('footer');
	}
	public function file_cancle(){
		$data['redirect'] = $this->input->get('redirect')?$this->input->get('redirect'):'main/index';
		

		$this->load->model('task_file_model');

		if($this->task_file_model->delete_by_tf_id($this->input->get('tf_id'))){
			$this->session->set_flashdata('notic', '成功取消打印文件！');
		}else{
			$this->session->set_flashdata('notic', '未能取消打印文件！');
		}
		
	  	redirect($data['redirect'], 'location', 301);
	}

	public function socket($ip,$port,$task_id=0){
		header ( 'Content-type:text/html;charset=utf8' );
		$host = 'tcp://'.$ip.':'.$port;

		$fp = stream_socket_client($host,$errno, $error,20);
		if (! $fp){
			echo "$error ($errno)";
		}else{
		    fwrite ($fp, $task_id);
		    while (!feof($fp))
		    {
				$result = fgets ( $fp ); #获取服务器返回的内容
				echo "接收到:"+$result;
				if($result == "1")
					$this->task_model->update_state($task_id,2);
		    }
		    fclose ($fp);
		}
	}
/**
     * client 手机客户端API**********************************************************************************
**/
	public function client_source_add(){
	  	//获取状态为0的task，即用户购物车，每个用户只有一个
	  	$data['task_id'] = $this->task_model->get_cart_id();

		$data_post = $this->input->post();
	  	if (isset($data_post['source_add'])&&isset($data_post['s_id']))
	  	{
	  		//商品存入购物车
	  		$this->load->model('task_file_model');
	  		if($this->input->post('update_op')==1){
	  			$is_ok = $this->task_file_model->update_all($data_post);
	  		}else{
	  			$is_ok = $this->task_file_model->create_all($data['task_id'],$data_post);
	  		}
	    	if($is_ok){
		    	//跳转至打印机选择界面
		    	//session存储提示，提示后自动删除session
		  		$this->session->set_flashdata('notic', '恭喜您，打印资源添加成功！');
		    	echo json_encode('1');
		    }else{
		    	echo json_encode('-1');
		    }	    
	  	}else{
	  		echo json_encode('-1');
	  	}	
	}
	public function client_printer_add(){
		$data['task_id'] = $this->task_model->get_cart_id();
		/** 打印配置初始化 */
		$this->config->load('print_db');
		$data['printer_cat'] = $this->config->item('printer_cat');
		//购物车信息
		$data['task_info'] = $this->task_model->get($data['task_id']);
		//打印设备信息
		$this->load->model('printer_model');
		$data['printer_info'] =$this->printer_model->get_by_id($data['task_info']['printer_id']);
		//我的设备
		$this->load->model('printer_model');
		$data['my_printer'] = $this->printer_model->get_by_uid($_SESSION['ID']);
		//共享设备
		$data['shared_printer'] = $this->printer_model->get_shared_printer($order="");
		//处理添加事件
		if($this->input->post('printer_add')){
			$is_ok = false;
			if($this->input->post('printer_id')){
				$printer_id_uid = explode(',',$this->input->post('printer_id'));
				if($printer_id_uid[0] == $data['task_info']['printer_id']){
					$is_ok = true;
				}else{
					$is_ok = $this->task_model->update_printer_id($this->input->post('task_id'),$printer_id_uid[0],$printer_id_uid[1]);
				}
			}elseif($this->input->post('now_printer_id')){
				$is_ok = true;
			}
			if($is_ok){
				//session存储提示，提示后自动删除session
	  			$this->session->set_flashdata('notic', '恭喜您，打印设备添加成功！');
	  		 	echo json_encode('1');
	  		}else{
	  			echo json_encode('-1');
	  		}
						
		}else{
			echo json_encode($data);		
		}		
	}
	public function client_submit(){
		$data['task_id'] = $this->task_model->get_cart_id();
		/** 打印配置初始化 */
		$this->config->load('print_db');
		$data['print_method'] = $this->config->item('print_method');
		$data['pager_size'] = $this->config->item('pager_size');
		$data['pager_type'] = $this->config->item('pager_type');
		$data['print_type'] = $this->config->item('print_type');
		$data['color_type'] = $this->config->item('color_type');
		$data['printer_cat'] = $this->config->item('printer_cat');
		//我的设备
		$this->load->model('printer_model');
		$data['my_printer'] = $this->printer_model->get_by_uid($_SESSION['ID']);
		//共享设备
		$data['shared_printer'] = $this->printer_model->get_shared_printer($order="");
		//相关信息
		$data['task_info'] = $this->task_model->get($data['task_id']);
		$this->load->model('task_file_model');
		$data['file_info'] = $this->task_file_model->get_by_tid($data['task_id']);
		$this->load->model('printer_model');
		$data['printer_info'] =$this->printer_model->get_by_id($data['task_info']['printer_id']);
		//处理提交事件
		if($this->input->post('submit')&&$this->input->post('task_id')){
			if($this->input->post('printer_id')){
				$printer_id_uid = explode(',',$this->input->post('printer_id'));
				if($printer_id_uid[0] != $data['task_info']['printer_id']){
					$this->task_model->update_printer_id($this->input->post('task_id'),$printer_id_uid[0],$printer_id_uid[1]);
				}
			}

			$is_ok = $this->task_model->submit($this->input->post('task_id'),$this->input->post('print_method'));
			if($is_ok)
			{
				//通知python打印
				$this->load->model('user_business_model');
				$user_b_info = $this->user_business_model->get_info_byuid($data['task_info']['user_b_id']);
				//if (isset($user_b_info['socket_port']) && $user_b_info['socket_port'] != -1) //如果打印机所在ip不是本地ip，进行socket通讯，否则等待客户端程序轮询
				//	$this->socket($user_b_info['socket_ip'],$user_b_info['socket_port'],$this->input->post('task_id'));
				//session存储提示，提示后自动删除session
				$this->session->set_flashdata('notic', array('success','恭喜您，打印任务提交成功！'));
				echo json_encode('1');
			}else{
				echo json_encode('-1');
			}			
			
		}else{
			echo json_encode($data);
		}
	}
	public function client_file_cancle(){
		$this->load->model('task_file_model');

		if($this->task_file_model->delete_by_tf_id($this->input->post('tf_id'))){
			$this->session->set_flashdata('notic', '成功取消打印文件！');
			echo 1;
		}else{
			$this->session->set_flashdata('notic', '未能取消打印文件！');
			echo -1;
		}
	}
}

/* End of file task.php */
/* Location: ./application/controllers/task.php */