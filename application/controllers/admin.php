<?php
class admin extends CI_Controller {
   
  	public function __construct()
  	{
    	parent::__construct();
        //我们要获取的内容:
        
        //要打印的文件
  
        if(!isset($_SESSION['uname']) || !isset($_SESSION['uid']))
        {
        $this->load->model('source_model');
        $this->load->model('s_cat_model');
        $this->load->helper('captcha');
        $vals = array(
    'word' => rand(1000, 10000),
    'img_path' => './captcha/',
    'img_url' => 'http://localhost/cloudprint/captcha/',
    //'font_path' => './path/to/fonts/texb.ttf',
    'img_width' => '100',
    'img_height' => 30,
    'expiration' => 7200
    );

$cap = create_captcha($vals);


$data['img']=$cap['image'];
$data['code']=$cap['word'];

            $this->load->view("login/index",$data);
          
        }
         $this->load->model('task_model');
        
        //将数据库model载入进来.
        $this->load->model("admin_model");
        }
        public function index()
        {
            if(isset($_SESSION['uname']) && isset($_SESSION['uid']))
            {
                  $data['data']=$this->task_model->getAllNotprint();
                  $count['count']=count($data['data']);
                 $this->load->view("admin/index",$count);
            }
           
           
        }
        public function login()
        {
            //删除验证码图片!避免产生累赘!
                $dir="./captcha/";
                $dh=opendir($dir); 
                while ($file=readdir($dh)) { 
                if($file!="." && $file!="..") { 
                $fullpath=$dir."/".$file; 
                if(!is_dir($fullpath)) { 
                unlink($fullpath); 
                } else { 
                deldir($fullpath); 
                } 
                } 
                } 
                closedir($dh); 
          $uname=$_POST['userName'];
          if($_POST['verify']!=$_POST['code'])
          {
               echo "<script> alert('验证码输入错误!');</script>";
            echo "<script> history.go(-1);</script>";
            exit();
          }
          $uid=$this->admin_model->getDataByUname($uname);
        if(isset($uid[0]['id']))
        {
            if( $uid[0]['password'] == md5( $_POST['psd']) )
            {
               $_SESSION['uname']=$uname;
               $_SESSION['uid']=$uid[0]['id'];
               redirect("admin/index", 'location', 301);
          
            }else{
                echo "<script> alert('用户名或者密码错误2!');</script>";
            echo "<script> history.go(-1);</script>";
            }
          
        }else{
            echo "<script> alert('用户名或者密码错误1!');</script>";
            echo "<script> history.go(-1);</script>";
        }
        }
        public function copy()
        {
            $this->load->view("admin/copy");
        }

        public function user_center()
        {
            $this->load->view("admin/user_center");
        }
        
        //这里获取要打印的数据库信息。
        public function getDataOfNeed()
        {
            $this->load->model('printer_model');
            $array = $this->printer_model->get_pid($_SESSION['uid']);
            $data['task_list'] = $this->task_model->get_cart($array);
            $this->load->view("admin/need",$data);
       
        }
        public function user()
        {
            $uid=$_GET['uid'];
            
            //载写给用户用的模板.
            $data['uid']=$uid;
            $data['task_id']=$_GET['file_id'];
            $this->load->view("admin/user",$data);
        }
        public function user_add()
        {
          
           if($_POST['condition']==0)
           {
               echo "<script>alert('请选择此时文件的状态')</script>";
              echo "<script>history.go(-1);</script>";
              exit();
           }
            //接下来是去修改task表中打印任务的状态.
           $this->load->model("task_model");
           $bool=$this->task_model->update_task_By_id($_POST);
          
            $_POST['time']=date("Y-m-d H:i:s");
            $this->load->model("message_model");
            unset($_POST['condition']);
            unset($_POST['task_id']);
            $data[0]=$_POST;
          $return=$this->message_model->addMessageContent($data);
          if($return)
          {
              echo "<script>alert('发表成功')</script>";
              echo "<script>history.go(-2);</script>";
          }
        }
        public function hisroty()
        {
            //这是得到已经打印过了的文件.
              $data['data']=$this->task_model->getAllHavedprint();
         
              $this->load->view("admin/history",$data);
        }
        public function newsAdd()
        {
            $this->load->view("admin/news_add");
        }
        public function newsForAdd()
        {
           // print_r($_POST);
             $_POST['time']=date("Y-m-d H:i:s");
            $this->load->model("message_model");
             $data[0]=$_POST;
          $return=$this->message_model->addNoticeContent($data);
            if($return)
          {
              echo "<script>alert('发表成功')</script>";
              echo "<script>history.go(-1);</script>";
          }
        }
        public function newsList()
        {
           $this->load->model("message_model");
               $notice=$this->message_model->lists();
            // print_r($notice);
             $data['data']=$notice;
            $this->load->view("admin/list",$data);
        }
        public function delete()
        {
            $nid=$_GET['nid'];
            $this->load->model("message_model");
            $id=$this->message_model->delete($nid);
           
                echo "<script>alert('删除成功!')</script>";
              echo "<script>history.go(-1);</script>";
        }
        public function useAll()
        {
             $this->load->model("message_model");
            $message=$id=$this->message_model->getAllMessage();
            $data["data"]=$message;
            $this->load->view("admin/useall",$data);
           
        }
        public function deleteMessage()
        {
             $nid=$_GET['mid'];
            $this->load->model("message_model");
            $id=$this->message_model->deleteMessage($nid);
           
                echo "<script>alert('删除成功!')</script>";
              echo "<script>history.go(-1);</script>";
        }
        public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/index', 'lacation', 301);
	}

}
?>
