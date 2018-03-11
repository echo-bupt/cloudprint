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
 *	主要用于打印资源有关的前台交互
 *
 * @package		CloudPrint
 * @subpackage	Controllers
 * @category	Front-controllers
 * @author		hillsdong@163.com
 * @link		
 */
class Source extends CI_Controller {
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
		$publick_action = array("index");
		if(!in_array($action,$publick_action)&&!$_SESSION['ID']) redirect('main/index', 'location', 301);
		
  
        $this->load->model('source_model');
    	$this->load->model('s_cat_model');
    	$this->edit_data = array();
  	}
	 /**
     * index
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function index()
	{
		/** 页面初始化 */
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("资源首页","页面描述","页面关键字");
		
		$data['cat_info'] = $this->s_cat_model->get_s_cat_by_fid(0);
		$data['cat_id'] = $this->input->get('cat_id');
		if($this->input->post('s_content')){
			$data['file_info'] = $this->source_model->search_source($this->input->post('s_content'));
		}else{		
			$data['file_info'] = $this->source_model->get_shared_source('hot',$this->input->get('cat_id'));		
		}
        
		//$this->load->view('header', $data);
               // var_dump($data['file_info']);
               // exit();
                  $this->load->model("message_model");
                 if(isset($_SESSION['ID']))
                {
                    $usid=$_SESSION['ID'];
                     $message=$this->message_model->getusermessageByid($usid);
             //  $data['message']=$message;
                   $data['num']=count($message);
                }
		$this->load->view('source/index',$data);
		$this->load->view('footer');
	}
	 /**
     * create
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function create()
	{
	  	$this->load->helper('form');
	  	$this->load->library('form_validation');
	  
	 	 $data['title'] = '添加资源';
	  
	  	$this->form_validation->set_rules('title', '资源标题', 'required');
	  	$this->form_validation->set_rules('dir', '资源地址', 'required');

		/** 页面初始化 */
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("资源上传","页面描述","页面关键字");

	  	if ($this->form_validation->run() === FALSE)
	  	{
	    	$this->load->view('header', $data);  
	    	$this->load->view('source/create');
	    	$this->load->view('footer');
	    
	  	}
	  	else
	  	{
	  		$this->source_model->set_source();
	    	echo "添加成功！";
	  	}
	}


   // by 海波
    public function download()
	{
	  $this->load->model('user_model');
    //  $this->load->model('user_file_model');
      $data = $this->user_model->get_by_uid($_SESSION['ID']);
	  $this->load->view('source/download',$data);
	  $this->load->view('footer');
	}

	 /**
     * upload
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function upload()
	{
	  	$this->load->helper('form');
	  	$this->load->library('form_validation');
	  
	 	$data['title'] = '添加资源';
	  
	  	$this->form_validation->set_rules('title', '资源标题', 'required');
	  	$this->form_validation->set_rules('dir', '资源地址', 'required');

		/** 页面初始化 */
		list($data['page_title'],$data['page_description'],$data['page_keywords'],$data['page_score']) = array("资源上传","页面描述","页面关键字","下载积分");

	  	if ($this->form_validation->run() === FALSE)
	  	{
	    	$this->load->view('header', $data);  
	    	$this->load->view('source/upload');
	    	$this->load->view('footer');
	    
	  	}
	  	else
	  	{
	  		$this->source_model->set_source();
	    	echo "添加成功！";
	  	}
	}
	public function upload_ajax()
	{
		error_reporting(E_ALL | E_STRICT);
		require('/system/libraries/UploadHandler.php');
		$upload_handler = new UploadHandler();
	}
	public function upload_save()
	{
		//保存
		$insert_time = $this->source_model->save_source_bypost($this->input->post());
		//查询出刚添加的文件
		if($insert_time){
			$data_file = $this->source_model->get_source_by_time_uid($insert_time,$_SESSION['ID']);	
			if($this->input->post('print_now')){
				#批量打印
				$this->session->set_flashdata('data_file',$data_file);
				redirect('task/source_add', 'location', 301);
			}
		}else{
			$data_file = array();
		}
		$this->edit_data = $data_file;
		$this->edit();
	}
	public function edit()
	{
		/** 页面初始化 */
                $this->load->model("message_model");
            if(isset($_SESSION['ID']))
                {
                    $usid=$_SESSION['ID'];
                     $message=$this->message_model->getusermessageByid($usid);
             //  $data['message']=$message;
               $data['num']=count($message);
                }
		list($data['page_title'],$data['page_description'],$data['page_keywords'],$data['page_score']) = array("资源编辑","页面描述","页面关键字","下载积分");
		$data['redirect'] = $this->input->get('redirect');
		$data['redirect'] = ($data['redirect']=="source/index")?"user/source":$data['redirect'];
		$data['redirect'] = $data['redirect']?$data['redirect']:'user/source';
		if($this->input->post('edit')){
	  		$login_result = $this->source_model->update_source_bypost($this->input->post());
	  		//session存储提示，提示后自动删除session
	  		$this->session->set_flashdata('notic', '恭喜您，编辑成功！');
	  		//跳转
  			redirect($data['redirect'], 'location', 301);
  		}
		//如果没有参数 则去数据库查询
		$data['file_info'] = $this->edit_data;
		if(!$data['file_info']){
			if(($file_ids = $this->input->get('id')) || $file_ids = $this->session->flashdata('file_ids')){
				$data['file_info'] = $this->source_model->get_source_by_ids($file_ids);
			}else{
				$this->session->set_flashdata('notic', '没有文件上传！');
				redirect($data['redirect'], 'location', 301);
			}
		}
		$data['cat_info'] =  $this->s_cat_model->get_s_cat_by_fid();
    	$this->load->view('header',$data); 
    	$this->load->view('source/edit');  	
    	$this->load->view('footer');
	}
	public function share()
	{
		$data['redirect'] = $this->input->get('redirect');
		$data['redirect'] = $data['redirect']?$data['redirect']:'user/source';
		if(($file_ids = $this->input->get('id')) || $file_ids = $this->session->flashdata('file_ids')){ 
			$is_ok = $this->source_model->share_by_ids($file_ids);
			//如果没有资源描述及分类信息,则跳到编辑页
			if($is_ok === -1){
				$this->edit();
			}else{
				if($is_ok) $this->session->set_flashdata('notic', '恭喜您，共享成功！');
				else $this->session->set_flashdata('notic', '共享出错！');
				redirect($data['redirect'], 'location', 301);
			}
		}else{
			$this->session->set_flashdata('notic', '没有文件共享！');
			redirect($data['redirect'], 'location', 301);
		}		
	}
	public function delete()
	{
		$data['redirect'] = $this->input->get('redirect');
		$data['redirect'] = $data['redirect']?$data['redirect']:'user/source';
		if(($file_ids = $this->input->get('id')) || $file_ids = $this->session->flashdata('file_ids')){ 
			$is_ok = $this->source_model->delete_by_ids($file_ids);
			if($is_ok === -1){
				//session存储提示，提示后自动删除session
				$this->session->set_flashdata('notic', array('warning','部分文件正在打印，删除失败！'));
			}elseif($is_ok){
				$this->session->set_flashdata('notic', array('success','恭喜您，删除成功！'));
			}else{
				$this->session->set_flashdata('notic',array('danger', '删除出现问题！'));
			}
	  		//跳转
  			redirect($data['redirect'], 'location', 301);
		}else{
			$this->session->set_flashdata('notic',array('warning','没有文件删除！'));
			redirect($data['redirect'], 'location', 301);
		}		
	}

/**
     * client 手机客户端API**********************************************************************************
**/
	public function client_index()
	{
		$data['cat_info'] = $this->s_cat_model->get_s_cat_by_fid(0);
		$data['cat_id'] = $this->input->get('cat_id');
		
		if($this->input->post('s_submit')){
			$data['file_info'] = $this->source_model->search_source($this->input->post('s_content'));
		}else{		
			$data['file_info'] = $this->source_model->get_shared_source('hot',$this->input->get('cat_id'));		
		}
		echo json_encode($data);
	}

}

/* End of file source.php */
/* Location: ./application/controllers/source.php */