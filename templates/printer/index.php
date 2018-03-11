<div class="clearfix">
	<h2 class="text-left pull-left">热门设备</h2>

	<div class="pull-right">
		
	</div>
<div>
<div class="clearfix"></div>
<div class="clearfix">
	<?php foreach($printer_info as $val):?>
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
