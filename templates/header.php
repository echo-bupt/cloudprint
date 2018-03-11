<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>字符云打印&raquo; <?php echo $page_title;?></title>
	<meta name="Keywords" content="<?php echo $page_keywords;?>" />
	<meta name="Description" content="<?php echo $page_description;?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="<?php echo base_url().'templates/css/bootstrap.min.css';?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url().'templates/css/bootstrap-responsive.min.css';?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url().'templates/css/hills.css';?>" rel="stylesheet" type="text/css" />
	<!-- Bootstrap CSS fixes for IE6 -->
	<!--[if lt IE 7]>
		<link rel="stylesheet" href="<?php echo base_url().'templates/css/bootstrap-ie6.min.css';?>">
	<script>alert("请更换非IE6版本浏览器！");</script>
	<![endif]-->
	<style type="text/css">

	</style>
           <script type="text/javascript" src="<?php echo base_url().'templates/js/jquery-1.7.2.min.js';?>"></script>
           
	<script type="text/javascript" src="<?php echo base_url().'templates/js/bootstrap.min.js';?>"></script>
         <script type="text/javascript" src="<?php echo base_url().'templates/js/miaov.js';?>"></script>
          <script type="text/javascript" src="<?php echo base_url().'templates/js/common.js';?>"></script>
         <script type="text/javascript" src="<?php echo base_url().'templates/js/gotoTop.js';?>"></script>
          <script type="text/javascript" src="<?php echo base_url().'templates/js/message.js';?>"></script>
</head>
<body>
<?php // var_dump($_SESSION);?>
<?php // var_dump($_COOKIE);?>
<?php if(isset($notic) || ($notic = $this->session->flashdata('notic'))):?>
<div id="alert_top" class="alert alert-<?php echo is_array($notic)?$notic[0]:"success"; ?> text-center fade in"><?php echo is_array($notic)?$notic[1]:$notic; ?><a class="close" data-dismiss="alert" href="#">&times;</a></div>
<?php endif?>	
<div id="top">
		<div class='position'>
			<div class='left'>
                            <?php if($this->session->userdata('ID')):?>
                             欢迎您:&nbsp;<span style="color:#cc0000;"><strong><?php echo $this->session->userdata('NAME');?></strong></span>,&nbsp;&nbsp;&nbsp;&nbsp;这是您第<span style="color:#cc0000"><strong>1</strong></span>次光临本站,&nbsp;&nbsp;&nbsp;&nbsp;上次登陆时间是:<span style="color:#cc0000"><strong></strong></span>&nbsp;&nbsp;祝您打印愉快。
                             
                            <?php else:?>	
				欢迎您,&nbsp;&nbsp;这是您<span style="color:#FF0000">1</span>次光临本站,祝您打印愉快!
                                <?php endif?>
                        
			</div>
			<div class='right'>
				<a href="javascript:addFavorite2();">收藏</a>
			</div>
		</div>
	</div>
  <div id="header">
		<div class='position'>
			<div class='logo'>
				<a style="line-height:60px;" href="<?php echo site_url('main/index');?>">字符云打印</a>
				<a style="font-size:16px;" href="">www.cloundprint.com</a>
			</div>
			<div class='search'>
				<div class='item'>
					<a href="">随意</a>
					<a href="">便捷</a>
					<a href="">共享</a>
					<a href="">丰富</a>
				</div>
				<div class='search-bar'>
                                    <form action="<?php echo site_url('source/index')?>" method="POST">
					<input class='s-text' type="text" name="s_content" value="请输入资源或文件名称等">
					<input class='s-submit' type="submit" value='搜索'>
                                    </form>
				</div>
			</div>
			<div class='commitment'>
					<?php if($this->session->userdata('ID')):?>
				<a href="#" class="btn btn-large btn-primary btn-block"  onclick="$('#source_upload_box').modal({backdrop:false,keyboard:false,show:true});$('#fileupload_add_hills').click();" >打印本地文档</a>
			<?php else:?>
				<a href="<?php echo site_url('user/login').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2).'?tip=1';?>" class="btn btn-large btn-primary btn-block">打印本地文档</a>
			<?php endif?>
		<div id="" class="span4">
			
		</div>
			</div>
		</div>
      </div>
<div id="nav">
		<div class='position'>
			<!-- 分类相关 -->
			<div class='category'>
				<a class='active' href="<?php echo site_url('main/index');?>">首页</a>
                                 <a href="<?php echo site_url('source/index');?>">打印资源</a>
                                 <a href="<?php echo site_url('printer/index');?>">打印设备</a>
        <a href="#" id="specialA">打印特色</a></div>
			<!-- 用户相关 -->
			<div id="user-relevance" class='user-relevance'>
				
                            <!--下面的登录注册的显示是在用户没登陆的条件下显示的-->
                            
				<!--登录注册--> 
                                  <?php if(!$this->session->userdata('ID')):?>
					<div class='user-nav login-reg'>
						<a class='title' class="btn" data-toggle="modal" role="button" href="#myModal">注册</a>
					</div>
                                
                                <!--这是用于用户注册的弹出窗口，一开始是隐藏的-->
                                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <form class="form-horizontal" action="<?php echo site_url('user/register').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2); ?>" method="POST">
			  <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			    <h3 id="registerLabel">用户注册</h3>
			  </div>
			  <div class="modal-body">  
				  <div class="control-group">
				    <label class="control-label" for="input_name">用户名</label>
				    <div class="controls">
				      <input type="text" name="user_name" id="input_name" placeholder="学号优先，5-12位">
				    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="input_password">密码</label>
				    <div class="controls">
				      <input type="password" name="password" id="input_password" placeholder="6-20位">
				    </div>
				  </div>
					<div class="control-group">
						<label class="control-label" for="register_passconf">重复密码</label>
						<div class="controls">
					  		<input type="password" name="passconf" id="register_passconf" placeholder="再写一遍">
					  	</div>
				  	</div>
				  <div class="control-group">
				    <div class="controls">
				      <label class="checkbox">
				        <input name="agree" type="checkbox"> 同意 &nbsp;<a href="#">字符云打印相关服务条款</a>
				      </label>
				    </div>
				  </div>
				

			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
			    <input type="submit" name="register" class="btn btn-primary" value="注册">
			  </div>
			  </form>
			</div>
                                
					<div class='user-nav login-reg'>	
						<a class="title" href="<?php echo site_url('user/login'); ?>">登录</a>
					</div>
                              
                   <!--这里是在用户没登陆的条件下显示的结束-->
			</div>
                          <?php else:?>
                         <div class='user-nav login-reg'>	
						<a class="title" href="<?php echo site_url('user/logout'); ?>">退出</a>
					</div>
                         <div class='user-nav login-reg'>	
						<a class="title" href="<?php echo site_url('user/task')."?filter=now"; ?>">当前任务</a>
					</div>
                         <div class='user-nav login-reg' style="width:80px;">	
                             <a class="title" href="<?php echo site_url('user/message').'?usid='.$this->session->userdata('ID')?>">用户消息<span style="color:#f00;" id="text">(<?php echo $num?>)</span></a>
					</div>
                         <div class='user-nav login-reg'>	
						<a class="title" href="<?php echo site_url('user/source'); ?>">个人中心</a>
					</div>
                        
                        <div class='user-nav my-hdtg '>
						<a class='title more' href="">当前用户:&nbsp;&nbsp;<sapn style="color:#cc0000"><?php echo $this->session->userdata('NAME');?></span></a>
						<ul class="menu">
							<li><a href="<?php echo site_url('user/source'); ?>">我的资源</a></li>	
							<li><a href="<?php echo site_url('user/print'); ?>">我的设备</a></li>
                                                        <li><a href="<?php echo site_url('user/task'); ?>">我的打印</a></li>
							
						</ul>
					</div>
                       
                        <?php endif?>
		</div>
	</div> 
<div id="source_upload_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3>资源上传</h3>
  </div>
  <div class="modal-body no_scroll_hills">
   <?php include('templates/source/upload.php');?>
  </div>
  <div class="modal-footer">
  	<button class="btn" type="button" onclick="$('#fileupload_cancle_hills').click();" class="close" data-dismiss="modal" aria-hidden="true">取消</button>
    <a href="#" onclick="$('#file_info_for_save').append('<input type=hidden name=print_now value=1>').submit();" class="btn btn-primary">完成</a>
  </div>
</div>
