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
			<td class="th" colspan="10">查看打印任务</td>
		</tr>
		<tr>
			<td class="tdLittle1">用户名</td>
			<td style="width:90px";>任务提交时间</td>
                        <td class="tdLittle2" style="width:30px;">打印文件名称</td>
			
                        <td class="tdLtitle7'" >操作</td>
		</tr>
        <?php if( !empty($task_list)) { foreach($task_list as $v){?>
		<tr>
			<td ><?php echo $v['user_c_id'];?></td>
			<td><?php echo $v['submit_time']?></td>
            <td>
              <a href="<?php echo base_url().$v['dir']?>"><?php echo $v['title']?></a></td>
                       
			<td>
                <a href="<?php echo base_url().$v['dir']?>" type="application/octet-stream">[下载]</a>
				<a href="<?php echo base_url().$v['dir']?>" class="del">[打印]</a>
                <a href="<?php echo site_url('admin/user').'?uid='.$v['user_c_id'].'&file_id='.$v['id']?>" class="del">[通知用户]</a>
			</td>
		</tr>
         <?php }};?>
            </list>
	</table>
	<div class="page">
		
	</div>
</body>
</html>
