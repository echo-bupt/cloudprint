<div id="" class="row-fluid">
	<div class="tabbable tabs-left">
	  <?php include('templates/user/left_nav.php'); ?>
	  <div class="tab-content">
		<ul class="nav nav-pills pull-left">
		  <li class="active">
		    <a href="<?php echo site_url('user/printer')."";?>"><strong>所有</strong></a>
		  </li>
<!--
		  <li><a href="<?php echo site_url('user/printer')."/favo";?>">收藏的设备</a></li>
		  -->
		</ul>
        <a href="<?php echo site_url('printer/create').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2);?>" class="btn btn-success pull-right"> 
        	<i class="icon-plus icon-white"></i>
        	<span>添加设备</span>
        </a>
		<table class="table table-hover talbe_tooltip">
			  <caption class="hide">我的设备列表</caption>
			  <thead class="th_hills">
			    <tr >
			      <th><input id="checkall" type="checkbox"></th>
			      <th>名称</th>
			      <th>位置</th>
			      <th>分类</th>
				  <th>品牌型号</th>
				  <th>关联设备</th>
				   <th>使用权限</th>
			      <th>显示状态</th>
				  <th>排序</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach($list as $key=>$val):?>
			    <tr data-toggle="tooltip">
			      <td><input id="check_<?php echo $key;?>" type="checkbox"></td>
			      <td>
			      	<?php echo $val['name']?>
			      	<div class="pull-right">
			      		<a href="<?php echo site_url('printer/create').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2).'&id='.$val['id'];?>" title="编辑"><i class="icon-edit"></i></a>
			      		<a href="<?php echo site_url('printer/delete').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2).'&id='.$val['id'];?>" title="删除"><i class="icon-remove"></i></a>
			     	 </div>
			      </td>
			      <td><?php echo $val['location'];?></td>
			      <td><?php echo $cat_info[$val['category_key']]['name'];?></td>
				  <td><?php echo $val['brand']."&nbsp;".$val['type'];?></td>
			      <td><?php echo $val['driver_id']?$val['driver_id']:"无";?></td>
				  <td><?php echo $acl_info[$val['acl_state']]['name'];?></td>
			      <td><?php echo $val['visible']?"可见":"不可见";?></td>
				  <td><?php echo $val['weight'];?></td>
			    </tr>
				<?php endforeach?>
			  </tbody>
		</table>
	  </div>
	</div>
</div>
