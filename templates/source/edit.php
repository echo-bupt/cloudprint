<div class="page-header"><h2>资源更新</h2></div>
<form class="clearfix" action="<?php echo site_url('source/edit').'?redirect='.$redirect; ?>" method="POST">
	<?php foreach($file_info as $val):?>
	<div class="well clearfix">
		<div class="span6">
			<input type="hidden" name="id[]" value="<?php echo $val['id'];?>" >
			<label class="control-label" for="source_title_<?php echo $val['id'];?>">资源名称：</label>
			<input class="span6" type="text" name="title[]" id="source_title_<?php echo $val['id'];?>" value="<?php echo $val['title'];?>" >
			<label class="control-label" for="source_description_<?php echo $val['id'];?>">资源简述：</label>
			<textarea class="span6" name="description[]" id="source_description_<?php echo $val['id'];?>"><?php echo $val['description'];?></textarea>
			<label class="control-label" for="source_tag_<?php echo $val['id'];?>">资源标签：</label>
			<input class="span6" type="text" name="tag[]" placeholder="逗号(,)隔开" id="source_tag_<?php echo $val['id'];?>" value="<?php echo $val['tag'];?>" >
		    <label class="control-label" for="source_score_<?php echo $val['id'];?>">下载积分：</label>
             <select class="span1" name="score[]" id="source_score_<?php echo $val['id'];?>">
				<option value="0">免费</option>
				<?php for ($i=0; $i <11 ; $i++) { ?>
				<option  value="<?php echo $i;?>"><?php echo $i;?></option>
			    <?php }?>
			</select>

		</div>
		<div class="span6">
			<label class="control-label" for="source_cat_id_<?php echo $val['id'];?>">资源分类：</label>
			<select class="span6" name="cat_id[]" id="source_cat_id_<?php echo $val['id'];?>">
				<option value="0">无</option>
				<?php foreach($cat_info as $cat_val):?>
				<option <?php if($val['cat_id']==$cat_val['id']) echo "selected"?> value="<?php echo $cat_val['id'];?>"><?php echo $cat_val['name'];?></option>
				<?php endforeach?>
			</select>
			
			<label class="checkbox">
				<input class="" checked=""<?php echo $val['share']?"checked":"";?> type="checkbox" name="share[]" id="source_share_<?php echo $val['id'];?>" >共享资源
			</label>
			
		</div>

	</div>
	<?php endforeach?>
	<div class="pull-right">
		<a class="btn" href="<?php echo site_url($redirect?$redirect:'main/index');?>">取消</a>
		<input type="submit" class="btn btn-primary" name="edit" value="提交" >
	</div>
</form>