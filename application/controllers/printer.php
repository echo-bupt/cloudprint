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
 *	主要用于打印设备有关的前台交互
 *
 * @package		CloudPrint
 * @subpackage	Controllers
 * @category	Front-controllers
 * @author		hillsdong@163.com
 * @link		
 */
class Printer extends CI_Controller {
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
		$publick_action = array('index');
		if(!in_array($action,$publick_action)&&!$_SESSION['ID']) redirect('main/index', 'location', 301);			
		
    	$this->load->model('printer_model');
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
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("设备首页","页面描述","页面关键字");
		/** 打印配置初始化 */
		$this->config->load('print_db');
		$data['printer_cat'] = $this->config->item('printer_cat');
		
		$data['printer_info'] = $this->printer_model->get_shared_printer('hot');
                  $this->load->model("message_model");
               
            if(isset($_SESSION['ID']))
                {
                    $usid=$_SESSION['ID'];
                     $message=$this->message_model->getusermessageByid($usid);
             //  $data['message']=$message;
               $data['num']=count($message);
                }
		$this->load->view('header', $data);
		$this->load->view('printer/index');
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
            
             $this->load->model("message_model");
               
                if(isset($_SESSION['ID']))
                {
                    $usid=$_SESSION['ID'];
                     $message=$this->message_model->getusermessageByid($usid);
             //  $data['message']=$message;
               $data['num']=count($message);
                }
	  	$this->load->helper('form');
	  	$this->load->library('form_validation');

		/** 页面初始化 */
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("设备添加","页面描述","页面关键字");
		$data['redirect'] = $this->input->get('redirect');
		$data['redirect'] = $data['redirect']?$data['redirect']:'main/index';
		//更新
		if($this->input->get('id')){
			$data['is_creat'] = 0;
			$data['item'] = $this->printer_model->get_by_id($this->input->get('id'));
		//添加
		}else{
			$data['is_creat'] = 1;
			$data['item'] = array('id'=>'','name'=>'','location'=>'','brand'=>'','type'=>'','category_key'=>'','acl_state'=>'','weight'=>'','visible'=>'');
		}
		//打印机分类、使用权限
		$this->config->load('print_db');
		$data['cat_info'] =  $this->config->item('printer_cat');
		$data['acl_info'] =  $this->config->item('printer_acl');
		
		//存储跳转
	  	if ($this->form_validation->run('printer_edit') === FALSE)
	  	{
	  		if($this->input->post('printer_edit'))
	  		{
	  			$data['item'] = $this->input->post();
	  			$data['item']['visible'] = $this->input->post('visible')?1:0;
				$data['item']['acl_state'] = $this->input->post('acl_state');
	  		}
	  		$this->load->view('header', $data);  
	    	$this->load->view('printer/edit');
	    	$this->load->view('footer');	    	
	  	}
	  	else
	  	{
	  		if($this->input->post('id')==''){
	  			$op_name = '添加';
		  		$is_ok = $this->printer_model->create($this->input->post());
		  	}else{
		  		$op_name = '编辑';
		  		$is_ok = $this->printer_model->update($this->input->post());
		  	}

	    	//session存储提示，提示后自动删除session
	    	if($is_ok){
	    		$this->session->set_flashdata('notic', '恭喜您，设备'.$op_name.'成功！');
	    	}else{
	    		$this->session->set_flashdata('notic', '设备'.$op_name.'失败！');		
	    	}  		
	  		//跳转
  			redirect($data['redirect'], 'location', 301);    
	  	}

	}
	public function delete()
	{
		$data['redirect'] = $this->input->get('redirect');
		$data['redirect'] = $data['redirect']?$data['redirect']:'user/printer';
		if(($file_ids = $this->input->get('id')) || $file_ids = $this->session->flashdata('file_ids')){ 
			$is_ok = $this->printer_model->delete_by_ids($file_ids);
			if($is_ok === -1){
				//session存储提示，提示后自动删除session
				$this->session->set_flashdata('notic',array('warning', '打印机已关联相关任务，禁止删除！'));
			}elseif($is_ok){
				$this->session->set_flashdata('notic', array('success','恭喜您，删除成功！'));
			}else{
				$this->session->set_flashdata('notic',array('danger', '删除出现问题！'));
			}
	  		//跳转
  			redirect($data['redirect'], 'location', 301);
		}else{
			$this->session->set_flashdata('notic', array('warning','没有文件删除！'));
			redirect($data['redirect'], 'location', 301);
		}		
	}
}

/* End of file printer.php */
/* Location: ./application/controllers/printer.php */