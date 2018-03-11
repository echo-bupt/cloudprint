<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>字符云打印后台管理首页</title>
	<link rel="stylesheet" href="<?php echo base_url().'templates/css/admin.css'?>"/>
	<script type="text/javascript" src="<?php echo base_url().'templates/js/jquery-1.7.2.min.js' ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'templates/js/admin.js' ?>"></script>
<!--下面<jqueryui/>是为了载入框架中的日历插件-->
<jqueryui/>
<!-- 默认打开目标 -->
<base target="iframe"/>
</head>
<body>
<!-- 头部 -->
	<div id="top_box">
		<div id="top">
			<p id="top_font">字符云打印后台管理首页（V1.1）</p>
		</div>
		<div class="top_bar">
			<p class="adm">
				<span>管理员  :</span>
				<span class="adm_pic">&nbsp&nbsp&nbsp&nbsp</span>
				<span class="adm_people">[admin]</span>
			</p>
			<p class="now_time">
				今天是：<?php echo date("Y-m-d H:i:s")?>
				您的当前位置是：
				<span>首页</span>
			</p>
                    <p style="float: left" class="notice">
                       温馨提示: 目前您的打印任务,<a href="<?php echo site_url('admin/getDataOfNeed')?>" style="margin-left: 10px;"target="iframe">请注意查收</a>
                    </p>
			<p class="out">
				<span class="out_bg">&nbsp&nbsp&nbsp&nbsp</span>&nbsp
				<a href="<?php echo site_url('admin/logout'); ?>" target="_self">退出</a>
			</p>
		</div>
	</div>
<!-- 左侧菜单 -->
		<div id="left_box">
			<p class="use">常用菜单</p>
			<div class="menu_box">
				<h2>前台首页</h2>
				<div class="text">
					<ul class="con">
				        <li class="nav_u">
				        	<a href="<?php echo base_url()?>" class="pos" target="_bank">前台首页</a>				        	
				        </li> 
				    </ul>
				
				</div>
			</div>

			<div class="menu_box">
				<h2>文件打印管理</h2>
				<div class="text">	
				    <ul class="con">
				        <li class="nav_u">
				        	<a href="<?php echo site_url('admin/getDataOfNeed')?>" class="pos">需要打印的文件</a>
                                                                                            
				        </li> 
                                        
                                       
				    </ul>  
                                    <ul class="con">
				        <li class="nav_u">
				        	  <a href="<?php echo site_url('admin/hisroty')?>" class="pos">历史打印文件</a>      
                                                                                            
				        </li> 
                                            
                                           
				    </ul>  
				</div>
			</div>
            
			<div class="menu_box" style="display:<?php if($_SESSION['uname']!="admin") echo "none";?>">
				<h2>公告管理</h2>
				<div class="text">
					<ul class="con">
				        <li class="nav_u">
				        	<a href="<?php echo site_url('admin/newsList')?>" class="pos">公告列表</a>
                                               
				        </li>
                                            
                                           
				    </ul>  
				    <ul class="con">
				        <li class="nav_u">
				        	  <a href="<?php echo site_url('admin/newsAdd')?>" class="pos">增加公告</a>
                                               
				        </li>
				    </ul>
				</div>
			</div> 
  	
			 <div class="menu_box">
				<h2>用户通知管理</h2>
				<div class="text">
				    <ul class="con">
				        <li class="nav_u">
				        	<a href="<?php echo site_url('admin/useAll')?>" class="pos">所有用户短信息</a>				        	
				        </li> 
				    </ul>
				
				</div>
			</div>	
                        <div class="menu_box">
				<h2>系统管理</h2>
				<div class="text">
				    <ul class="con">
				        <li class="nav_u">
				        	<a href="<?php echo site_url('admin/user_center')?>" class="pos">密码修改</a>				        	
				        </li> 
				    </ul>
				
				</div>
			</div>			
		</div>
		<!-- 右侧 -->
		<div id="right">
			<iframe  frameboder="0" border="0" 	scrolling="yes" name="iframe" src="<?php echo site_url('admin/copy')?>"/></iframe>
		</div>
	<!-- 底部 -->
	<div id="foot_box">
		<div class="foot">
			<p>@Copyright © 2013-2014 燕大 All Rights Reserved. 河北ICP备0000000号</p>
		</div>
	</div>

</body>
</html>
<!--[if IE 6]>
    <script type="text/javascript" src="__PUBLIC__/js/iepng.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('.adm_pic, #left_box .pos, .span_server, .span_people', 'background');
    </script>
<![endif]-->
