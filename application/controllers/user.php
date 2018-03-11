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
 *	主要用于用户账户管理相关的前台交互
 *
 * @package		CloudPrint
 * @subpackage	Controllers
 * @category	Front-controllers
 * @author		hillsdong@163.com
 * @link		
 */
class User extends CI_Controller {
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
		$publick_action = array("login","is_client_login","client_login","register");
		if(!in_array($action,$publick_action)&&!$_SESSION['ID']) redirect('main/index', 'location', 301);		
		
    	$this->load->model('user_model');
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
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("用户首页","页面描述","页面关键字");

		$this->load->view('header', $data);
		$this->load->view('user/index');
		$this->load->view('footer');
	}
	 /**
     * source
     * 
     * @access public
     * @param  void
     * @return void
     */
        public function message()
        {
            //用于载入用户消息的页面:
            
            //加一个字段是否阅读!isRead!!!
            
            //删除
            
            //用户中心组件上传
            
            //cookie实现几次登录.
            $usid=$_GET['usid'];
            list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("用户首页","页面描述","页面关键字");
              $this->load->model("message_model");
             $message=$this->message_model->getusermessageByid($usid);
               $data['message']=$message;
                 $data['num']=count($message);
                 
                 //只要进了这个页面就表示已读，去修改message表里的状态!
                 foreach($message as $v)
                 {
                       $this->message_model->updateMessageById($v['mid']);
                 }
               
               $this->load->view("header",$data);
               $this->load->view("user/message");
            
        }
        
	public function source()
	{
                // exit();
                $this->load->model("message_model");
               
                if(isset($_SESSION['ID']))
                {
                    $usid=$_SESSION['ID'];
                }
                $message=$this->message_model->getusermessageByid($usid);
             //  $data['message']=$message;
               $data['num']=count($message);
		/** 页面初始化 */
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("我的资源","页面描述","页面关键字");
		$post_data = $this->input->post();
		if(isset($post_data['check'])){
			foreach($post_data['check'] as $key=>$val){
				$checked_ids[] = $post_data['check_value'][$key];
			}
			$this->session->set_flashdata('file_ids',$checked_ids);
			if($this->input->post('edit')) redirect("source/edit", 'location', 301);
			if($this->input->post('share')) redirect("source/share", 'location', 301);
			if($this->input->post('delete')) redirect("source/delete", 'location', 301);
			if($this->input->post('source_add')) redirect("task/source_add", 'location', 301);
		}
		$this->load->model('source_model');
		$data['file_info'] = $this->source_model->get_source_by_uid($_SESSION['ID'],$this->input->get('filter'));
		$data['current_filter'] = $this->input->get('filter');
		$this->load->view('header', $data);
		$this->load->view('user/source');
		$this->load->view('footer');
	}
	 /**
     * printer
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function printer()
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
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("我的设备","页面描述","页面关键字");

		$this->load->model('printer_model');
		$data['list'] = $this->printer_model->get_by_uid($_SESSION['ID']);
		
		//打印机分类、使用权限
		$this->config->load('print_db');
		$data['cat_info'] =  $this->config->item('printer_cat');
		$data['acl_info'] =  $this->config->item('printer_acl');
		
		$this->load->view('header', $data);
		$this->load->view('user/printer');
		$this->load->view('footer');
	}
	public function task()
	{
                // exit();
                $this->load->model("message_model");
               
              if(isset($_SESSION['ID']))
                {
                    $usid=$_SESSION['ID'];
                     $message=$this->message_model->getusermessageByid($usid);
             //  $data['message']=$message;
               $data['num']=count($message);
                }
		/** 页面初始化 */
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("我的设备","页面描述","页面关键字");

		/** 打印配置初始化 */
		$this->config->load('print_db');
		$data['print_method'] = $this->config->item('print_method');
		$data['pager_size'] = $this->config->item('pager_size');
		$data['pager_type'] = $this->config->item('pager_type');
		$data['print_type'] = $this->config->item('print_type');
		$data['color_type'] = $this->config->item('color_type');
		/** 任务状态配置项 */
		$data['task_state'] = $this->config->item('task_state');
		$data['file_state'] = $this->config->item('file_state');
		
		$this->load->model('task_model');
		$data['list'] = $this->task_model->get_by_uid($_SESSION['ID'],$this->input->get('filter'));
		$data['current_filter'] = $this->input->get('filter');
		//print_r($data);
                //exit();
		$this->load->view('header', $data);
		$this->load->view('user/task');
		$this->load->view('footer');
	}
 /**
     * login
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function login()
	{
		/** 页面初始化 */
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("用户登录","页面描述","页面关键字");
		/** 跳转回登录前页面*/
		$data['redirect'] = $this->input->get('redirect');
		if($data['redirect'] == 'user/login') $data['redirect'] = "main/index";

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->_username = $this->input->post('user_name');                //用户名
	  	if ($this->form_validation->run('login'))
	  	{
	  		$login_result = $this->user_model->login($this->input->post('user_name'),$this->input->post('password'));
	  		/** 登陆后的相关操作*/
	  		$this->login_do($login_result);
	  		//session存储提示，提示后自动删除session
	  		$this->session->set_flashdata('notic', '恭喜您，登录成功！');
	  		//跳转
  			$redirect_url = $data['redirect'];
  			redirect($redirect_url, 'location', 301);
	  	}

  		$this->load->view('header', $data);  
    	$this->load->view('user/login');
    	$this->load->view('footer');
	}
 //登录表单验证时自定义的函数
 /**
      * 提示用户名是不存在的登录
      * @param string $username
      * @return bool 
      */
	 function username_check($username)
	 {
	     if ($this->user_model->get_by_username($username))
	     {
	         return TRUE;
	     }
	     else 
	     {
	         $this->form_validation->set_message('username_check', '用户名不存在');
	         return FALSE;
	     }
	 }
/**
     * 检查用户的密码正确性
     */
     function password_check($password)
     {
         if ($this->user_model->password_check($this->_username, $password))
         {
             return TRUE;
         }
         else 
         {
             $this->form_validation->set_message('password_check', '用户名或密码不正确');
             return FALSE;
         }
     }
 /**
     * login_do
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function login_do($u_info){

		$user_array = array('ID'=>$u_info['id'],'NAME'=>$u_info['name']);
		$this->session->set_userdata($user_array);
	}
 /**
     * logout
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('main/index', 'lacation', 301);
	}
	 /**
     * register
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function register()
	{
		/** 页面初始化 */
		list($data['page_title'],$data['page_description'],$data['page_keywords']) = array("用户注册","页面描述","页面关键字");
		/** 跳转回登录前页面*/
		$data['redirect'] = $this->input->get('redirect');
		if($data['redirect'] == 'user/register') $data['redirect'] = "main/index";

		$this->load->helper('form');
		$this->load->library('form_validation');

	  	if ($this->form_validation->run('register'))
	  	{
	  		$u_id = $this->user_model->register($this->input->post('user_name'),$this->input->post('password'));
	  		$this->login_do(array('id'=>$u_id,'name'=>$this->input->post('user_name')));
	  		//session存储提示，提示后自动删除session
	  		$this->session->set_flashdata('notic', '恭喜您，注册成功！已自动登录！');

	  		$redirect_url = $data['redirect'];
	  		redirect($redirect_url, 'location', 301);
	  	}

  		$this->load->view('header', $data);  
    	$this->load->view('user/register');
    	$this->load->view('footer'); 
	}
/**
     * client 手机客户端API**********************************************************************************
**/
	/**
     * client_login
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function client_login()
	{
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->_username = $this->input->post('user_name');  

        if ($this->form_validation->run('login'))
        {
            $login_result = $this->user_model->login($this->input->post('user_name'),$this->input->post('password'));
            /** 登陆后的相关操作*/
            $this->login_do($login_result);
            //session存储提示，提示后自动删除session
            $this->session->set_flashdata('notic', '恭喜您，登录成功！');
            echo 1;
        }else{
            echo validation_errors('<div class="alert alert-error">', '<a class="close" data-dismiss="alert" href="#">&times;</a></div>');
        }		
        
	}
	/**
     * is_login
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function is_client_login()
	{
       	if(!isset($_SESSION['ID'])) echo -1;
       	else echo json_encode($_SESSION);	

	}
 	/**
     * logout
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function client_logout()
	{
		$this->session->sess_destroy();
		echo 1;
	}

	 /**
     * client_source
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function client_source()
	{
		$post_data = $this->input->post();
		if(isset($post_data['check'])){
			foreach($post_data['check'] as $key=>$val){
				$checked_ids[] = $post_data['check_value'][$key];
			}
			$this->session->set_flashdata('file_ids',$checked_ids);
			if($this->input->post('edit')) redirect("source/edit", 'location', 301);
			if($this->input->post('share')) redirect("source/share", 'location', 301);
			if($this->input->post('delete')) redirect("source/delete", 'location', 301);
			if($this->input->post('source_add')) redirect("task/source_add", 'location', 301);
		}
		$this->load->model('source_model');
		$data['file_info'] = $this->source_model->get_source_by_uid($_SESSION['ID'],$this->input->get('filter'));
		$data['current_filter'] = $this->input->get('filter');
		echo json_encode($data);
	}
	 /**
     * client_printer
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function client_printer()
	{
		$this->load->model('printer_model');
		$data['list'] = $this->printer_model->get_by_uid($_SESSION['ID']);
		
		//打印机分类、使用权限
		$this->config->load('print_db');
		$data['cat_info'] =  $this->config->item('printer_cat');
		$data['acl_info'] =  $this->config->item('printer_acl');
		
		echo json_encode($data);
	}
	public function client_task()
	{
		/** 打印配置初始化 */
		$this->config->load('print_db');
		$data['print_method'] = $this->config->item('print_method');
		$data['pager_size'] = $this->config->item('pager_size');
		$data['pager_type'] = $this->config->item('pager_type');
		$data['print_type'] = $this->config->item('print_type');
		$data['color_type'] = $this->config->item('color_type');
		/** 任务状态配置项 */
		$data['task_state'] = $this->config->item('task_state');
		$data['file_state'] = $this->config->item('file_state');
		
		$this->load->model('task_model');
		$data['list'] = $this->task_model->get_by_uid($_SESSION['ID'],$this->input->get('filter'));
		$data['current_filter'] = $this->input->get('filter');
		echo json_encode($data);
	}

}
/* End of file user.php */
/* Location: ./application/controllers/user.php */