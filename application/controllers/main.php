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
 *	主要用于首页的交互
 *
 * @package		CloudPrint
 * @subpackage	Controllers
 * @category	Front-controllers
 * @author		hillsdong@163.com
 * @link		
 */
class Main extends CI_Controller {
	 /**
     * 解析函数
     * 
     * @access public
     * @return void
     */
  	public function __construct()
  	{
    	parent::__construct();
    	$this->load->model('source_model');
        $this->load->model('s_cat_model');
        $this->load->model("notice_model");
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
		$data['page_title'] = "首页";
		$data['page_description'] = "页面描述";
		$data['page_keywords'] = "页面关键字";
                $data['cat_info'] = $this->s_cat_model->get_s_cat_by_fid(0);
                $data['file_info'] = $this->source_model->get_shared_source_limit('hot');
                //这里动态添加一下通知公告信息。
                
                $data['notice_info']=$this->notice_model->get_limit_notice();
               // print_r( $data['notice_info']);
               // exit();
                $this->load->model("message_model");
               
                if(isset($_SESSION['ID']))
                {
                    $usid=$_SESSION['ID'];
                     $message=$this->message_model->getusermessageByid($usid);
             //  $data['message']=$message;
               $data['num']=count($message);
                }
               
		$this->load->view('header', $data);
              //  print_r($data);
              //  exit();
		$this->load->view('main/index');
		$this->load->view('footer');
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */