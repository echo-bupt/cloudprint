<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
   <link rel="stylesheet" href="<?php echo base_url().'templates/css/public.css'?>"/>
	
</head>
<body>
	<table class="table">
		<tr>
			<td class="th" colspan="10">用户个人中心</td>
		</tr>
		<tr>
			<td class="tdLittle1">用户名</td>
			<td style="width:90px";>用户密码</td>
                        <td class="tdLittle2" style="width:30px;">邮箱</td>
			
                        <td class="tdLtitle7'" >其他</td>
		</tr>

		<tr>
			<td ><?php echo $_SESSION['uname'];?></td>
			<td><?php echo $_SESSION['uname']?></td>
            <td>
              <a href="<?php echo $_SESSION['uid']?>"><?php echo $_SESSION['uname']?></a></td>
                   
		</tr>

            </list>
	</table>
	<div class="page">
		
	</div>
</body>
</html>
