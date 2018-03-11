<?php include('templates/task/nav.php');?>
<h2>打印资源清单</h2>
<?php if(!empty($file_info)): ?>
<table class="table table-bordered">
    <caption class="hide">打印资源清单</caption>
      <thead>
        <tr >
          <th><input id="checkall" type="checkbox"></th>
          <th>资源信息</th>
          <th>数量</th>
          <th>设置</th>
		  <th>留言</th>
          <th>操作</th>
        </tr>
      </thead>
      <tbody>
  <?php  foreach($file_info as $key=>$val):?>
        <tr>
          <td><input id="check_<?php echo $key;?>" type="checkbox"></td>
          <td>
               <div class="media">
                  <span class="pull-left">
                    <img class="media-object" style="height:40px !important;" data-src="holder.js/64x64" src="<?php echo base_url().(isset($val['img_dir'])?$val['img_dir']:"templates/img/file_defalt/".$val['type'].".png");?>">
                  </span>
                  <div class="media-body">
                    <h4 class="media-heading"><?php echo $val['title']?></h4>
                    <?php echo $val['description']?>
                  </div>
                </div>
          </td>
          <td><?php echo $val['number']?></td> 
          <td>
			  <table class="table-condensed">
				<tr>
				<td>纸张大小：<?php echo $pager_size[$val['pager_size']]['name']?> </td>
				<td>纸张类型：<?php echo $pager_type[$val['pager_type']]['name']?> </td>
				</tr>
				<tr>
				 <td>打印类型：<?php echo $print_type[$val['print_type']]['name']?></td>
				 <td>打印类型：<?php echo $color_type[$val['color_type']]['name']?></td>
				</tr>
			  </table>
          </td>
		   <td><?php echo $val['message']?></td> 
          <td><a class="btn" href="<?php echo site_url('task/file_cancle').'?redirect='.$this->uri->rsegment(1).'/'.$this->uri->rsegment(2).'&tf_id='.$val['id'];?>">取消打印</a></td>
        </tr>
  <?php endforeach?>
      </tbody>
</table>
<?php else:?>
   <div class="well">
      无待打印资源
    </div>
  <?php endif?>
<h2>打印设备</h2>
 <div class="well">
  <?php if(is_array($printer_info)): ?>
   <?php $val=$printer_info;?>
        <h3><?php echo $val['name'];?></h3>
			<p><?php echo $val['location'];?>
				<span class="label label-warning">打印队列：<?php echo $val['printing_row'];?></span>			
				<span class="label label-warning">总打印量：<?php echo $val['print_time'];?></span>	
								
				<span class="label label-info">类别：<?php echo $printer_cat[$val['category_key']]['name'];?></span>	
							
				<span class="label label-info">品牌：<?php echo $val['brand'];?></span>
				<span class="label label-info">型号：<?php echo $val['type'];?></span>
				
				<span class="label label-inverse">所有者：<?php echo $val['user_name'];?></span>
				
			</p>
   
  <?php else:?>
      无打印设备
  <?php endif?>
 </div>
<form class="clearfix" action="<?php echo site_url('task/submit') ?>" method="POST">
<h2>订单配置</h2>
<div class="well">
    <label class="control-label" for="print_method">打印方式：</label>
    <select class="" name="print_method" id="print_method">
      <?php foreach($print_method as $key=>$val):?>
        <option value="<?php echo $key?>"><?php echo $val['name']?></option>
      <?php endforeach?>
    </select>
</div>
    <div class="pull-right">
        <input type="hidden" name="task_id" value="<?php echo $task_id;?>" >
        <input type="submit" class="btn btn-primary" name="submit" value="提交打印" >
    </div>
</form>