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
			<td class="th" colspan="10">发给用户的短信息</td>
		</tr>
		<tr>
			<td class="tdLittle1">MID</td>
                        <td class="tdLittle1">接受消息的用户</td>
			<td style="width:90px";>发布时间</td>
                        <td style="width:200px";>消息内容</td>
			<td class="tdLtitle7" >操作</td>
		</tr>
         <?php foreach($data as $v):?>
		<tr>
			<td ><?php echo $v['mid']?></td>
                        <td ><?php echo $v['name']?></td>
			<td><?php echo $v['time']?></td>
                        <td><?php echo $v['content']?></td>
			<td>
				<a href="<?php echo site_url("admin/deleteMessage").'?mid='.$v['mid']?>" class="del">[删除]</a>
			</td>
		</tr>
         <?php endforeach;?>
            </list>
	</table>
	<div class="page">
		
	</div>
</body>
</html>



