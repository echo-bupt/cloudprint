<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 系统一些配置常量 --by hills */
$config['printer_cat'] = array(
			'1' => array('id'=>1,'name'=>'打印机'),
			'2' => array('id'=>2,'name'=>'复印机'),
			'3' => array('id'=>3,'name'=>'彩印机'),
			'4' => array('id'=>4,'name'=>'其他')
		);
$config['printer_acl'] = array(
			'1' => array('id'=>1,'name'=>'仅自己可用'),
			'2' => array('id'=>2,'name'=>'任何人可用')
		);
$config['pager_size'] = array(
			'1' => array('id'=>1,'name'=>'A4'),
			'2' => array('id'=>2,'name'=>'B5'),
			'3' => array('id'=>3,'name'=>'A3')
		);
$config['pager_type'] = array(
			'1' => array('id'=>1,'name'=>'70g'),
			'2' => array('id'=>2,'name'=>'80g'),
			'3' => array('id'=>3,'name'=>'90g')
		);
$config['print_type'] = array(
			'1' => array('id'=>1,'name'=>'单面正常'),
			'2' => array('id'=>2,'name'=>'双面正常'),
			'3' => array('id'=>3,'name'=>'单面缩印'),
			'4' => array('id'=>3,'name'=>'双面缩印')
		);
$config['color_type'] = array(
			'1' => array('id'=>1,'name'=>'黑白'),
			'2' => array('id'=>2,'name'=>'彩色')
		);
$config['print_method'] = array(
			'1' => array('id'=>1,'name'=>'立即打印'),
			'2' => array('id'=>2,'name'=>'到店打印')
		);
$config['task_state'] = array(
			'0' => array('id'=>0,'name'=>'未提交订单','label'=>'info'),
			'1' => array('id'=>1,'name'=>'已提交，待分发','label'=>'info'),
			'2' => array('id'=>2,'name'=>'已分发，待下载','label'=>'info'),
			'3' => array('id'=>3,'name'=>'下载中','label'=>'info'),
			'4' => array('id'=>4,'name'=>'已下载,待打印','label'=>'info'),
			'5' => array('id'=>5,'name'=>'打印中','label'=>'warning'),
			'6' => array('id'=>6,'name'=>'打印完成','label'=>'success')
		);
$config['file_state'] = array(
			'0' => array('id'=>0,'name'=>'未下载','label'=>'info'),
			'1' => array('id'=>1,'name'=>'下载中','label'=>'info'),
			'2' => array('id'=>2,'name'=>'已下载,待打印','label'=>'info'),
			'3' => array('id'=>3,'name'=>'打印中','label'=>'warning'),
			'4' => array('id'=>4,'name'=>'打印完成','label'=>'success')
		);
/* End of file print_db.php */
/* Location: ./application/config/print_db.php.php */