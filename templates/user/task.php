<?php $this->load->helper('date');?>
<div id="" class="row-fluid">
	<div class="tabbable tabs-left">
	  <?php include('templates/user/left_nav.php'); ?>
	  <div class="tab-content">
		<ul class="nav nav-pills pull-left">
		  <li class="<?php if($current_filter=="") echo "active";?>">
		    <a href="<?php echo site_url('user/task');?>"><strong>所有</strong>：</a>
		  </li>
		  <li class="<?php if($current_filter=="now") echo "active";?>">
		    <a href="<?php echo site_url('user/task')."?filter=now";?>">当前任务</a>
		  </li>
		  <li class="<?php if($current_filter=="history") echo "active";?>">
			<a href="<?php echo site_url('user/task')."?filter=history";?>">历史任务</a>
		</li>
		</ul>
		<table class="table table-hover talbe_tooltip">
			  <caption class="hide">我的任务列表</caption>
			  <thead class="th_hills">
			    <tr >
			      <th><input id="checkall" type="checkbox"></th>
			      <th>打印资源</th>
			      <th>打印设备</th>
					<th>设备位置</th>				  
			      <th>打印方式</th>
				  <th>提交时间</th>
			      <th>打印时间</th>			      
			      <th>状态</th>			     
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach($list as $key=>$val):?>
			    <tr data-toggle="tooltip">
			      <td><input id="check_<?php echo $key;?>" type="checkbox"></td>
			      <td>
                                  <!--三木表达式来判断是不是有多个文件要打印以便来加等这个字-->
					<?php echo $val['source'][0]['title']."&nbsp;&nbsp;".(isset($val['source'][1])?"等":"").count($val['source'])."个";?>
					<a href="#source_detail_<?php echo $key?>" role="button" class="btn pull-right" data-toggle="modal" data-backdrop="false">详情</a>
					<!-- Modal -->
					<div id="source_detail_<?php echo $key?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">打印资源详情</h3>
					  </div>
					  <div class="modal-body">
						<table class="table table-hover">
							<thead class="th_hills">
								<tr >
								  <th>资源名称</th>
								  <th>数量</th>
								  <th>打印设置</th>				  
								  <th>留言</th>
								  <th>状态</th>	     
								</tr>
							</thead>
							<tbody>
							<?php
								foreach($val['source'] as $source_key=>$source_val){
									echo "<tr>";
									echo "<td>".$source_val['title']."</td>";
									echo "<td>".$source_val['number']."</td>";
									echo "<td>".$pager_size[$source_val['pager_size']]['name'];
									echo "&nbsp;&nbsp;".$pager_type[$source_val['pager_type']]['name'];
									echo "&nbsp;&nbsp;".$print_type[$source_val['print_type']]['name'];
									echo "&nbsp;&nbsp;".$color_type[$source_val['color_type']]['name']."</td>";
									echo "<td>".$source_val['message']."</td>";
									echo "<td><span class='label label-".$file_state[$source_val['state']]['label']."'>".$file_state[$source_val['state']]['name']."</td>";
									echo "</tr>";
								}
							?>
							</tbody>
						</table>
					  </div>
					  <div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
					  </div>
					</div>
					<script>
						$('#source_detail_'+<?php echo $key?>).tooltip().popover();
					</script>
			      </td>
			      <td>
						<span title="<?php echo $val['printer_location']?>"><?php echo $val['printer_name']?></span>
			      </td>
				  <td>
					<?php echo $val['printer_location']?>
				  </td>
			      <td>
			      	<?php echo $print_method[$val['print_method']]['name'];?>
			      </td>
			      <td>
			      	<span title="<?php echo $val['submit_time'];?>"><?php echo timeFromNow($val['submit_time'])?></span>
			      </td>
			      <td>
			      	<span title="<?php echo $val['print_time'];?>"><?php echo timeFromNow($val['print_time'])?></span>
			      </td>
			    <td>
                                <!--实际上这里的数据都是从配置文件里面读取出来的,数据库的作用就是读取配置文件中的哪一个数组!!!-->
                                <!--比如下面这个就是将所有的状态存在了$task_state这个数组里,我们就是读取数据库看看是对应这个总数组里面的哪一个数组-->
                                <!--在配置文件中小于6的就是未打印完成的，而当期任务就是在get的提交数据里面加了filter=now参数，那么提交到控制器后根据这个now去查找<6的表示未打印完成的-->
                                <!--历史任务是查找>=5的表示正在打印和打印中的-->
                                
                                <!--到时候我们去修改打印文件的状态的时候仅仅去修改这个数据库state对应的数字即可，这个数字对应的数组就会改变，那么读取出来的状态什么的数据就会改变的-->
					<span class="label label-<?php echo $task_state[$val['state']]['label'];?>">
						<?php echo $task_state[$val['state']]['name'];?>
					</span>
				</td>
			     
			    </tr>
				<?php endforeach?>
			  </tbody>
		</table>
	  </div>
	</div>
</div>