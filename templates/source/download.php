<?php
 if($score < $_GET["score"] ) {
 	echo "<script> alert('你的下载积分不够!');</script>";
    echo "<script> history.go(-1);</script>";
    exit();
 }
 $score -= $_GET["score"];
  /*<form class="clearfix" action="<?php echo site_url('task/source_add') ?>" method="POST">*/
 header("Content-Type: application/force-download");
 header("Content-Disposition: attachment; filename=".basename($_GET["url"])); 
 //var_dump($_GET["url"]);

 readfile( base_url().$_GET["url"]);

?>


