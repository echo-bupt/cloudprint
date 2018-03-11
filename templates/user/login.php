<div class="page-header text-center"><h2>用户登录</h2></div>
<div class="well" style="width:40%;margin:0 auto;">
<form class="form-horizontal" action="<?php echo site_url('user/login').'?redirect='.$redirect; ?>" method="POST">
		<?php echo validation_errors('<div class="alert alert-error">', '<a class="close" data-dismiss="alert" href="#">&times;</a></div>'); ?>
		<div class="control-group">
			<label class="control-label" for="login_name">用户名</label>
			<div class="controls">
				<input type="text" name="user_name" id="login_name" placeholder="用户名" value="<?php echo set_value('user_name'); ?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="login_password">密码</label>
			<div class="controls">
		  		<input type="password" name="password" id="login_password" placeholder="密码">
		  	</div>
	  	</div>
	  	<div class="control-group">
	  		<div class="controls">
	  			<input type="submit" name="login" class="btn" value="登录">
	  			<a href="<?php echo site_url('user/register').'?redirect='.$redirect; ?>" data-toggle="modal">注册</a>
	  		</div>
	  	</div>
</form>	
</div>