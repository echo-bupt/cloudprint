
   <script type="text/javascript" src="<?php echo base_url().'templates/js/lunbo.js';?>"></script>
<!--接下来是内容主体-->

	<div id="filter">
		<div class='hots'>
			<span>我们的宗旨：</span>
			<div class='box'>	
                            <a href="#">让打印更加随意!</a>
			</div>	
		</div>
		
		<div class='filter-box'>
			<div class='cates filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>热门打印分类：</span>
					<div class='box'>
                                             <a href="#" class="active">全部</a>
                                             <!--这与if,else是一样的，都是在语句后面加一个冒号-->
                                            <?php foreach($cat_info as $v):?>
                                             <a href="<?php echo site_url('source/index').'?cat_id='.$v['id'];?>"><?php echo $v['name']?></a>
                                             <?php endforeach;?>
					</div>
				</div>
				
			</div>
			<div class='locality filter-label'>
				<div class='filter-label-level-1'>
					<span><b></b>热门打印资源：</span>
					<div class='box'>
                                            <a href="#" class="active">全部</a>
					 <?php foreach($file_info as $v):?>
                                            <a href="<?php echo site_url('source/index')?>"><?php echo $v['title']?></a>
                                             <?php endforeach;?>
					</div>
				</div>
				
			</div>
					</div>	
	</div>

<!--轮播图-->
<div id="main">
    <div id="navs">
               <ul class="nav_s">
              
                 <li><a href="__APP__/detail/show/id/{$v.goods_id}"><img src="<?php echo base_url().'templates/img/yun1.jpg';?>"/></a></li>
                 <li><a href="__APP__/detail/show/id/{$v.goods_id}"><img src="<?php echo base_url().'templates/img/yun2.jpg';?>"/></a></li>
                 <li><a href="__APP__/detail/show/id/{$v.goods_id}"><img src="<?php echo base_url().'templates/img/yun3.jpg';?>"/></a></li>
                  <li><a href="__APP__/detail/show/id/{$v.goods_id}"><img src="<?php echo base_url().'templates/img/yun4.jpg';?>"/></a></li>
                  <li><a href="__APP__/detail/show/id/{$v.goods_id}"><img src="<?php echo base_url().'templates/img/yun4.npg';?>"/></a></li>
              
               </ul>
           
        <!--下面是显示那一串a的div-->
           <div class="important_d3">
               <div id="aA">
                   <center>
               <a href="javascript:void(0)" class="show"></a>
               <a href="javascript:void(0)"></a>
               <a href="javascript:void(0)"></a>
                <a href="javascript:void(0)"></a>
                <a href="javascript:void(0)"></a>
                   </center>
               </div>
           </div>
           </div>
<!--轮播图结束-->
<!--网站公告-->
<div id="news">
    <div class="notic">
        <p>公告通知</p>
    </div>
    <div class="notic_con">
        <ul>
            <?php foreach($notice_info as $k=>$v):?>
           <li>
<a href="#" onclick="javascript:void(0);" class="Alink">
<i class="rank r<?php echo ($k+1)?>"></i>
<span><?php echo $v['content']?></span>
</a>
</li>
<?php endforeach;?>

        </ul>
    </div>
</div>

</div>

<!--下面是关于打印特色与打印帮助两方面的内容-->


<div class="special" id="special">
    <div class="by_head">
        <p id="oP">云打印的特色？</p>
    </div>
    <div class="by_con">
        <div class="true_con">
          <p>这是一套共享式在线打印平台，使用户通过共享大量在线资料、联网打印设备，轻松享受在线打印的方便。</p>
          <p> 其基本内容可概括为：基于web技术实现一个共享的C2C形式的在线打印服务。
            其中的"共享"既包括普通用户打印资料的共享，也包括打印设备的共享。普通用户可通过共享自己的打印资料，获取浏览以及打印其他用户共享资料的权利。具有打印机的用户也可通过安装客户端程序共享自己的打印设置，开展在线打印业务。
            其中的"C2C"原是电子商务的专业用语，意指个人与个人之间的电子商务。这里指在线打印的最终服务群体为众多普通消费者，而打印机提供者亦为众多普通的打印机拥有者。由此区别于网易印像派等B2C形式的商城对用户的服务模式。          </p>
      </div>
    </div>
</div>
<div class="special" id="print">
    <div class="by_head">
        <p id="oP">云打印的存在感？</p>
    </div>
    <div class="by_con">
        <div class="true_cons">
            <div class="con_left">
                <div class="ps">
                <p>为什么要使用云打印？</p>
                </div>
              <p>便捷 ：
              <p>由于云端打印机可以通过您家中或办公室的无线网络直接注册云打印服务，因此能随时使用。此外，因为云端打印机总是会连接到网络，所以其驱动程序和固件无需您的干预即可更新至最新状态。云打印还支持传统的非云端打印机，因此您可以使用现有的任意打印机立即开始体验。                            
<p> 可与朋友共享 ：
<p>
                 借助云打印，您可以轻松地与朋友、家人或同事共享打印机，这非常适合资源缺乏者。您只需在云打印管理页上点击一下相应按钮，即可与信任的人共享打印机。您也可以跟踪共享打印机上的打印作业，并随时修改或撤消共享权限
            </div>
            <div class="con_right">
                <div class="img_cun">
                    <div class="text">
                       <p> 我们的工作时间</p>
                       <p>8:00-23:00</p>
                       <div class="true_img">
                           <a href="http://wpa.qq.com/msgrd?v=3&uin=863511096&site=qq&menu=yes">
<img src="<?php echo base_url().'templates/img/pa.gif';?> "/></a>
                           </div>
                            <div class="true_img">
                           <a href="http://wpa.qq.com/msgrd?v=3&uin=171933346&site=qq&menu=yes">
<img src="<?php echo base_url().'templates/img/pa.gif';?> "/></a>
                           </div>
                       <p class="call">联系热线:18332550187</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


	
