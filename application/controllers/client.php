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
 *	主要用于客户端ajax
 *
 * @package		CloudPrint
 * @subpackage	Controllers
 * @category	Front-controllers
 * @author		hillsdong@163.com
 * @link		
 */
class Client extends CI_Controller {
	 /**
     * 解析函数
     * 
     * @access public
     * @return void
     */
  	public function __construct()
  	{
    	parent::__construct();
  	}
	/**
     * index
     * 
     * @access public
     * @param  void
     * @return void
     */
	public function login()
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
}

/* End of file client.php */
/* Location: ./application/controllers/client.php */