<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url().'templates/css/login.css';?>" />
 <script type="text/javascript" src="<?php echo base_url().'templates/js/jquery-1.7.2.min.js';?>"></script>
 <script type="text/javascript" src="<?php echo base_url().'templates/js/login.js';?>"></script>

	<title></title>
</head>
<body>
	<div id="divBox">
            <form action="<?php echo site_url('admin/login').'?redirect='?>" method="POST" id="login">
			<input type="text" id="userName" name="userName"/>
			<input type="password" id="psd" name="psd"/>
			<input type="" value="" id="verify" name="verify"/>
			<input type="submit" id="sub" value=""/>
			<span id="verify_img"><?php echo $img?></span>
                        <input type="hidden" value="<?php echo $code?>" name="code"/>
		</form>
		<div class="four_bj">
			
			<p class="f_lt"></p>
			<p class="f_rt"></p>
			<p class="f_lb"></p>
			<p class="f_rb"></p>
		</div>

		<ul id="peo">
			
		</ul>
		<ul id="psd">
			
		</ul>
		<ul id="ver">
			
		</ul>
	</div>
<!--[if IE 6]>
    <script type="text/javascript" src="__PUBLIC__/Js/iepng.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('form','background');
    </script>
<![endif]-->
</body>
</html>
