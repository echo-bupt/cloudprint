<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <script type="text/javascript" src="__PUBLIC__/js/jquery-1.7.2.min.js"></script>
     <jquery/>
       <hdui/>
              <jqueryui/>
<script type="text/javascript" src="__PUBLIC__/js/goods.js"></script>
<head>
    
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
   <link rel="stylesheet" href="<?php echo base_url().'templates/css/public.css'?>"/>
	<title></title>
</head>

<body>
    <form action="<?php echo site_url('admin/user_add')?>" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr >
                              <input type="hidden" value="<?php echo $uid ?>" name="user_id"/>
                              <input type="hidden" value="<?php echo $task_id ?>" name="task_id"/>
				<td class="th" colspan="2">通知用户文件的打印情况</td>
			</tr>
                    <tr >    
				<td class="th" colspan="2">当前文件状态</td>
                             
                              
			</tr>
                    <tr>
                    <td class="th" colspan="2">
                                <select id="select_choose" name="condition">
                                    <option value="0" name="condition" >请选择此时文件的状态</option>
                                     <option value="1" name="condition" >已提交，待分发</option>
                                     <option value="2" name="condition" >已分发，待下载</option>
                                      <option value="3" name="condition" >下载中</option>
                                       <option value="4" name="condition" >已下载,待打印</option>
                                        <option value="5" name="condition" >打印中</option>
                                         <option value="6" name="condition" >打印完成</option>
                                </select>
                        </td>
                    </tr>
                    <tr style="height:350px">
				<td>通知信息内容</td>
				<td >
                                   <textarea rows="15" cols="100" name="content">

                                   </textarea>
				</td>
			</tr>

			<tr>
				<td colspan="2">
					<input type="submit" value="发表" class="input_button"/>
					<input type="reset" class="input_button"/>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>