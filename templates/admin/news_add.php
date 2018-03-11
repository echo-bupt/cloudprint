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
    <form action="<?php echo site_url('admin/newsForAdd')?>" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr >
                              
				<td class="th" colspan="2">发布公告</td>
			</tr>
                    <tr style="height:350px">
				<td>通告内容</td>
				<td >
                                   <textarea rows="10" cols="100" name="content">

                                   </textarea>
                                    <span>(不超过30字)</span>
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
