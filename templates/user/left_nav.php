	  <ul class="nav nav-tabs">
	    <li class="<?php if($this->uri->rsegment(2)=='source') echo 'active'?>"><a href="<?php echo site_url('user/source');?>" >我的资源</a></li>
	    <li class="<?php if($this->uri->rsegment(2)=='printer') echo 'active'?>"><a href="<?php echo site_url('user/printer');?>" >我的设备</a></li>
	    <li class="<?php if($this->uri->rsegment(2)=='task') echo 'active'?>"><a href="<?php echo site_url('user/task');?>" >我的打印</a></li>
	  </ul>