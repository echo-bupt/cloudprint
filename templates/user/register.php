<div class="page-header text-center"><h2>用户注册</h2></div>
<div class="well" style="width:40%;margin:0 auto;">
<form class="form-horizontal" action="<?php echo site_url('user/register').'?redirect='.$redirect; ?>" method="POST">	
		<?php echo validation_errors('<div class="alert alert-error">', '<a class="close" data-dismiss="alert" href="#">&times;</a></div>'); ?>
		<div class="control-group">
			<label class="control-label" for="register_name">用户名</label>
			<div class="controls">
				<input type="text" name="user_name" id="register_name" placeholder="学号优先，5-12位" value="<?php echo set_value('user_name'); ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="register_password">密码</label>
			<div class="controls">
		  		<input type="password" name="password" id="register_password" placeholder="6-20位">
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
	        	<input name="agree" type="checkbox" <?php if(set_value('agree')) echo"checked";?> > 同意 &nbsp;<a href="#">字符云打印相关服务条款</a>
	      	</label>
	      	<input type="submit" name="register" class="btn" value="注册">
	  		<a href="<?php echo site_url('user/login'); ?>">已有账号，直接登录</a>
	        </div>
	    </div>
	  	
  	
</form>	
</div>