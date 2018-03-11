<div id="all-answer">
   <div class='ans-icon'><p>全部消息</p></div>
					<p class='title'>共 <strong><?php echo $num?></strong> 条消息</p>
					<ul id="ul1">
                                            <?php foreach($message as $v):?>
                                            <li class="oLi">
							<div class='face'>
								<a href="">
									<img src="<?php echo base_url().'templates/img/noface.gif';?>" width='48' height='48'/>
								</a>
                                                            <a href="#">管理员</a>
							</div>
							<div class='cons blue'>
								<p><span style='color:#888;font-size:12px'><?php echo $v['content']?>&nbsp;&nbsp;(<?php echo $v['time']?>)</span>
                                                                     <span style="margin-top: 20px;display: inline-block;color:#888;font-size:12px"><a href="" class="deleteofA">删除</a></span>
                                                                </p>
							</div>
							
							
                                                </li>
                                                <?php endforeach;?>
                                               
					</ul>
</div>
