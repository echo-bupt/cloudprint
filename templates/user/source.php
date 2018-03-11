<?php $this->load->helper('date');?>
<?php $this->load->helper('number');?>
<div id="" class="row-fluid">
	<div class="tabbable tabs-left">
	  <?php include('templates/user/left_nav.php'); ?>
	  <div class="tab-content">
		<ul class="nav nav-pills pull-left">
		  <li class="<?php if($current_filter=="") echo "active";?>">
		    <a href="<?php echo site_url('user/source');?>"><strong>所有</strong>：</a>
		  </li>
		  <li class="<?php if($current_filter=="own") echo "active";?>">
		    <a href="<?php echo site_url('user/source')."?filter=own";?>">私有资源</a>
		  </li>
		  <li class="<?php if($current_filter=="share") echo "active";?>">
			<a href="<?php echo site_url('user/source')."?filter=share";?>">公开资源</a>
		</li>
		<!--
		  <li class="<?php if($current_filter=="favo") echo "active";?>">
			<a href="<?php echo site_url('user/source')."?filter=favo";?>">收藏资源</a>
		</li>
		-->
		</ul>
		<div class="pull-right">
                <button class="btn btn-success" onclick="$('#source_upload_box').modal({backdrop:false,keyboard:false,show:true});$('#fileupload_add_hills').click();" > 
                	<i class="icon-plus icon-white"></i>
                	<span>上传资源</span>
                </button>
        </div>
		<table class="table table-hover talbe_tooltip">
		<form action="<?php echo site_url('user/source');?>" method="POST">
			  <caption class="hide">我的资源列表</caption>
			  <thead class="th_hills">
			    <tr >
			      <th><input id="checkall" name="checkall" type="checkbox" is_checked="0" ></th>
			      <th>名称</th>
			      <th>上传日期</th>
			      <th>大小</th>
			      <th>来源</th>
			      <th>状态</th>
			      <th>操作</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach($file_info as $key=>$val):?>
			    <tr data-toggle="tooltip" title="简述：<?php echo $val['description']?>">
			      <td>
						<input name="check_value[<?php echo $key?>]" value="<?php echo $val['id']?>" type="hidden">
						<input class="check_item" name="check[<?php echo $key?>]" type="checkbox">
					</td>
			      <td>
			      	<?php echo $val['title']?>
			      	<div class="pull-right">
			      		<a href="<?php echo site_url('source/edit').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2).'&id='.$val['id'];?>" title="编辑"><i class="icon-edit"></i></a>
			      		<a href="<?php echo site_url('source/share').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2).'&id='.$val['id'];?>" title="共享"><i class="icon-share"></i></a>
			      		<a href="<?php echo site_url('source/delete').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2).'&id='.$val['id'];?>" title="删除"><i class="icon-remove"></i></a>
			     	 </div>
			      </td>
			      <td><span title="<?php echo $val['add_time'];?>"><?php echo timeFromNow($val['add_time'])?></span></td>
			      <td><?php echo byte_format($val['size'])?></td>
			      <td>上传</td>
			      <td><?php echo $val['share']?"共享":"私有";?></td>
			      <td><a href="<?php echo site_url('task/source_add').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2).'&s_id='.$val['id']?>" class="btn">打印</a></td>
			    </tr>
				<?php endforeach?>
			  </tbody>
				<div class="pull-right mr_10_hills">
					批量操作：
					<input type="submit" name="edit" class="btn mr_10_hills" value="编辑">
					<input type="submit" name="share" class="btn mr_10_hills" value="分享">
					<input type="submit" name="delete" class="btn mr_10_hills" value="删除">
					<input type="submit" name="source_add" class="btn mr_10_hills" value="打印">
				</div>
		</form>
		</table>
	  </div>
	</div>
</div>
<div id="source_upload_box" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3>资源上传</h3>
  </div>
  <div class="modal-body no_scroll_hills">
   <?php include('templates/source/upload.php');?>
  </div>
  <div class="modal-footer">
  	<button class="btn" type="button" onclick="$('#fileupload_cancle_hills').click();" class="close" data-dismiss="modal" aria-hidden="true">取消</button>
    <a href="#" onclick="$('#file_info_for_save').append('<input type=hidden name=is_ucenter value=1>').submit();" class="btn btn-primary">保存</a>
  </div>
</div>
<script>
	$('#checkall').click(function(){
		if($(this).attr("is_checked") == "0"){
			$('.check_item').attr('checked',true);
			$(this).attr("is_checked","1");
		}else{
			$('.check_item').attr('checked',false);
			$(this).attr("is_checked","0");
		}
	});
</script>