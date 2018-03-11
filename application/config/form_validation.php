<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config = array(
                 'login' => array(
                                    array(
                                            'field' => 'user_name',
                                            'label' => '用户名',
                                            'rules' => 'trim|required|min_length[5]|max_length[12]|xss_clean|callback_username_check'
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => '密码',
                                            'rules' => 'trim|required|min_length[6]|max_length[20]|md5|callback_password_check'
                                         ),  
                                     ),  
                 'register' => array(
                                    array(
                                            'field' => 'user_name',
                                            'label' => '用户名',
                                            'rules' => 'trim|required|min_length[5]|max_length[12]|is_unique[user.name]|xss_clean'
                                         ),
                                    array(
                                            'field' => 'password',
                                            'label' => '密码',
                                            'rules' => 'trim|required|min_length[6]|max_length[20]|matches[passconf]|md5'
                                         ),  
                                    array(
                                            'field' => 'passconf',
                                            'label' => '重复密码',
                                            'rules' => 'trim|required|min_length[6]|max_length[20]|md5'
                                         ), 
                                     array(
                                            'field' => 'agree',
                                            'label' => '服务条款',
                                            'rules' => 'required'
                                         ),  
                                     ),  
                'printer_edit' => array(
                            array(
                                    'field' => 'name',
                                    'lable' => '设备名称',
                                    'rules' => 'trim|required|min_length[5]|max_length[45]'
                                ),
                        ),  
                'task_source' => array(
                            array(
                                    'field' => 'number',
                                    'lable' => '打印数量',
                                    'rules' => 'is_natural_no_zero'
                                ),
                        ),                  
               );

/* End of file foreign_chars.php */
/* Location: ./application/config/foreign_chars.php */