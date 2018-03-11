<div class="page-header"><h2>设备<?php echo $is_creat?"添加":"编辑";?></h2></div>
<form class="clearfix" action="<?php echo site_url('printer/create').'?redirect='.$redirect; ?>" method="POST">
	 <?php echo validation_errors('<div class="alert alert-error">', '<a class="close" data-dismiss="alert" href="#">&times;</a></div>'); ?>
	<div class="well clearfix">
		<div class="span6">
			<input type="hidden" name="id" value="<?php echo $item['id'];?>" >
			<label class="control-label" for="item_name">设备名称：</label>
			<input class="span6" type="text" name="name" placeholder="45字以内" id="item_name" value="<?php echo $item['name'];?>" >
			<label class="control-label" for="item_location">设备地点简述：</label>
			<textarea class="span6" name="location" placeholder="45字以内" id="item_location"><?php echo $item['location'];?></textarea>
			<label class="control-label" for="item_brand">设备品牌：</label>
			<input class="span6" type="text" name="brand" placeholder="20字以内" id="item_brand" value="<?php echo $item['brand'];?>" >
			<label class="control-label" for="item_type">设备型号：</label>
			<input class="span6" type="text" name="type" placeholder="45字以内" id="item_type" value="<?php echo $item['type'];?>" >
		</div>
		<div class="span6">
			<label class="control-label" for="item_category_key">设备分类：</label>
			<select class="span6" name="category_key" id="item_category_key">
				<?php foreach($cat_info as $key=>$cat_item):?>
				<option value="<?php echo $cat_item['id'];?>" <?php if($item['category_key']==$cat_item['id']) echo "selected"?> ><?php echo $cat_item['name'];?></option>
				<?php endforeach?>
			</select>
			<label class="control-label" for="">使用范围：</label>
			<div style="padding:0 0 25px;">
			<?php foreach($acl_info as $key=>$acl_item):?>
			<label class="radio inline">
			  <input type="radio" name="acl_state" id="acl_state<?php echo $key;?>" value="<?php echo $acl_item['id'];?>" <?php echo ($item['acl_state']==$acl_item['id'])?"checked":"";?>>
			  <?php echo $acl_item['name'];?>
			</label>
			<?php endforeach?>
			</div>
			<label class="control-label" for="">使用状态：</label>
			<div style="padding:0 0 25px;">
			<label class="checkbox">
				<input class="" <?php echo $item['visible']?"checked":"";?> type="checkbox" name="visible" id="item_visible" >可见
			</label>
			</div>
			<label class="control-label" for="item_weight">显示排序：</label>
			<input class="span6" type="text" name="weight" id="item_weight" placeholder="-127至127" value="<?php echo $item['weight'];?>" >
			
		</div>

	</div>
	<div class="pull-right">
		<a class="btn" href="<?php echo site_url($redirect?$redirect:'main/index');?>">取消</a>
		<input type="submit" class="btn btn-primary" name="printer_edit" value="提交" >
	</div>
</form>