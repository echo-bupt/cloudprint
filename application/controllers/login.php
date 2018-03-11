<?php
/*云打印的后台控制器*/

class login extends CI_Controller {
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
        //后台首页载入页面:
        
        public function index()
        {
            
         $this->load->view("login/index");
        }
      
}
?>
