<?php include('templates/task/nav.php')?>
<?php $this->load->helper('number');?>
<form class="clearfix" action="<?php echo site_url('task/source_add') ?>" method="POST">
<?php if(!empty($file_info)):?>
	<?php foreach($file_info as $val):?>
		<?php if(isset($val['source_id'])):?>
			<input type="hidden" name="tf_id[]" value="<?php echo $val['id'];?>" >
			<?php $val['id']=$val['source_id'];?>
		<?php endif?>
	<div class="well clearfix">
			<h2><?php echo $val['title'].'('.byte_format($val['size']).')'?></h2>
			<input type="hidden" name="s_id[]" value="<?php echo $val['id'];?>" >

			<label class="control-label">打印类型：</label>
			<select class="span1" name="pager_size[]" id="source_pager_size_<?php echo $val['id'];?>">
				<?php foreach($pager_size as $key=>$item):?>
				<option <?php if(isset($val['pager_size'])&&$val['pager_size']==$item['id']) echo "selected"?> value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
				<?php endforeach?>
			</select>
			<select class="span1" name="pager_type[]" id="source_pager_type_<?php echo $val['id'];?>">
				<?php foreach($pager_type as $key=>$item):?>
				<option <?php if(isset($val['pager_type'])&&$val['pager_type']==$item['id']) echo "selected"?> value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
				<?php endforeach?>
			</select>
			<select class="span2" name="print_type[]" id="source_print_type_<?php echo $val['id'];?>">
				<?php foreach($print_type as $key=>$item):?>
				<option <?php if(isset($val['print_type'])&&$val['print_type']==$item['id']) echo "selected"?> value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
				<?php endforeach?>
			</select>
			<select class="span1" name="color_type[]" id="source_color_type_<?php echo $val['id'];?>">
				<?php foreach($color_type as $key=>$item):?>
				<option <?php if(isset($val['color_type'])&&$val['color_type']==$item['id']) echo "selected"?> value="<?php echo $item['id'];?>"><?php echo $item['name'];?></option>
				<?php endforeach?>
			</select>
			<label class="control-label" for="source_number_<?php echo $val['id'];?>">打印数量：</label>
			<input class="span6" type="text" name="number[]" placeholder="大于0的整数" id="source_number_<?php echo $val['id'];?>" value="<?php echo isset($val['number'])?$val['number']:1;?>" >
			<label class="control-label" for="source_message_<?php echo $val['id'];?>">留言：</label>
			<textarea class="span6" name="message[]" placeholder="关于此文件的打印留言，200字以内" id="source_message_<?php echo $val['id'];?>"><?php echo isset($val['message'])?$val['message']:'';?></textarea>
	</div>
	<?php endforeach?>
<?php else:?>
	<div class="well">
		无待打印资源
	</div>
<?php endif?>	
	<div class="pull-right">
		<!--判断资源设置更新还是添加-->
		<input type="hidden" name="update_op" value="<?php echo isset($update_op)?1:0;?>" >
		<a class="btn" href="<?php echo site_url($redirect?$redirect:'main/index');?>">取消</a>
		<input type="submit" class="btn btn-primary" name="source_add" value="下一步" >
	</div>
</form>