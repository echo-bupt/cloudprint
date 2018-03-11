<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div id="bottom" class="" style="clear: both;">
    
    <p>Copyright © 2014 YSU.Com All Rights Reserved cloudprint</p>
	<!--<p class="footer">页面加载时间：<strong>{elapsed_time}</strong> seconds</p>-->
    <p>
河北公安网备ICP0810402442号
<wbr></wbr>
</p>
</div>

	<script>		
		<?php if(isset($notic) || $this->session->flashdata('notic')):?> 
			setTimeout(function(){$(".alert").alert('close');},3000);
		<?php endif?>

		$('.talbe_tooltip').tooltip(option);
		$('#myModal').modal(option);
	</script>
</body>
</html>