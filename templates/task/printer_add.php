<?php include('templates/task/nav.php');?>
<h2>打印设备</h2>
<form class="clearfix" action="<?php echo site_url('task/printer_add') ?>" method="POST">
 <div class="well">
  <?php if(is_array($printer_info)): ?>
   <?php $val = $printer_info;?>
        <h3><?php echo $val['name'];?></h3>
        <p><?php echo $val['location'];?>
				<span class="label label-warning">打印队列：<?php echo $val['printing_row'];?></span>			
				<span class="label label-warning">总打印量：<?php echo $val['print_time'];?></span>	
								
				<span class="label label-info">类别：<?php echo $printer_cat[$val['category_key']]['name'];?></span>	
							
				<span class="label label-info">品牌：<?php echo $val['brand'];?></span>
				<span class="label label-info">型号：<?php echo $val['type'];?></span>
				
				<span class="label label-inverse">所有者：<?php echo $val['user_name'];?></span>
				
			</p>
   		<input type="hidden" name="now_printer_id" value="<?php echo $printer_info['id'].','.$printer_info['user_id']?>">
  <?php else:?>
      无打印设备
  <?php endif?>
 </div>
	<ul id="printer_add_nav" class="nav nav-tabs">	  
	  <li class="active">
	  	<a href="#share_printer">共享设备</a>
	  </li>
	  <!--<li><a href="#favo_printer">收藏的设备</a></li>-->
	  <li>
	  	  <a href="#my_printer">我的设备</a>
	  </li>
	</ul>
	<div class="tab-content">
	  <div class="tab-pane fade" id="my_printer">
		<?php foreach($my_printer as $val):?>
		<div class="well span3">
			<label class="radio inline" for="printer_<?php echo $val['id']?>">
				<input type="radio" id="printer_<?php echo $val['id']?>" name="printer_id" value="<?php echo $val['id'].','.$val['user_id']?>">
				<h3><?php echo $val['name'];?></h3>
				<p><?php echo $val['location'];?></p>
				<p>
					<span class="label label-warning">打印队列：<?php echo $val['printing_row'];?></span>			
					<span class="label label-warning">总打印量：<?php echo $val['print_time'];?></span>	
					<p>					
					<span class="label label-info">类别：<?php echo $printer_cat[$val['category_key']]['name'];?></span>	
					<br >				
					<span class="label label-info">品牌：<?php echo $val['brand'];?></span>
					<span class="label label-info">型号：<?php echo $val['type'];?></span>
					</p>
					<p>
					<span class="label label-inverse">所有者：<?php echo $val['user_name'];?></span>
					</p>
				</p>
			</label>
		</div>
		<?php endforeach?>	  	
	  </div>
	 <!-- <div class="tab-pane fade" id="favo_printer">...</div> -->
	  <div class="tab-pane  active  fade in" id="share_printer">
		<?php foreach($shared_printer as $val):?>
		<div class="well span3">
			<label class="radio inline" for="printer_share_<?php echo $val['id']?>">
				<input type="radio" id="printer_share_<?php echo $val['id']?>" name="printer_id" value="<?php echo $val['id'].','.$val['user_id']?>">
				<h3><?php echo $val['name'];?></h3>
				<p><?php echo $val['location'];?></p>
				<p>
					<span class="label label-warning">打印队列：<?php echo $val['printing_row'];?></span>			
					<span class="label label-warning">总打印量：<?php echo $val['print_time'];?></span>	
					<p>					
					<span class="label label-info">类别：<?php echo $printer_cat[$val['category_key']]['name'];?></span>	
					<br >				
					<span class="label label-info">品牌：<?php echo $val['brand'];?></span>
					<span class="label label-info">型号：<?php echo $val['type'];?></span>
					</p>
					<p>
					<span class="label label-inverse">所有者：<?php echo $val['user_name'];?></span>
					</p>
				</p>
			</label>
		</div>
		<?php endforeach?>	 	    
	  </div>
	</div>
	<input type="hidden" name="task_id" value="<?php echo $task_id?>">
	<div class="pull-right">
		<a class="btn" href="<?php echo site_url($redirect?$redirect:'main/index');?>">上一步</a>
		<input type="submit" class="btn btn-primary" name="printer_add" value="下一步" >
	</div>
</form>

<script>
	$('#printer_add_nav a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});
</script>