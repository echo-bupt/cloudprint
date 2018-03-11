
<div class="pagination pagination-large">
  <ul>
    <li class="<?php if($task_step==1) echo 'active_hills';else echo 'disabled';?>"><span><a href="<?php echo site_url('task/source_add');?>">打印文件设置 -></a></span></li>
    <li class="<?php if($task_step==2) echo 'active_hills';else echo 'disabled';?>"><span><a href="<?php echo site_url('task/printer_add');?>">选择打印设备 -></a></span></li>
    <li class="<?php if($task_step==3) echo 'active_hills';else echo 'disabled';?>"><span><a href="<?php echo site_url('task/submit');?>">提交任务</a></span></li>
  </ul>
</div>