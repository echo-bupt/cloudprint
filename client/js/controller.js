$(function(){
  /*定义*/
  $.support.cors = true;
  $.mobile.allowCrossDomainPages = true;  
  var host = 'http://zifuyun.com';
  //var host = 'http://127.0.0.1';
  //var host = 'http://192.168.1.108:81';
  var updatePage = function(page_name){
      $('#'+page_name).siblings().css('-webkit-transform', 'translateX(100%)');
      $('#'+page_name).siblings().hide();
      $('#'+page_name).show();
      window.scrollTo(0, 0);
      setTimeout(function(){
        $('#'+page_name).css('-webkit-transform', 'translateX(0)');
      }, 0);

      setTimeout(function(){
        myscroll=new iScroll("index_scroll");
      },100 );
  }
  var __ajax__ = function(url,data,success_do,datatype){
    datatype = datatype?datatype:'text';
    $.ajax({
        type:'POST',
        url:host+url,
        // data to be added to query string:
        data:data,
		crossDomain: true,
        // type of data we are expecting in return:
        dataType:datatype,
        success: success_do,
        error:function(xhr,type){
          alert('error'+type);
        }
    }); 
  }
  var is_login = function(){
     __ajax__(
        '/user/is_client_login',
        {user_name:'hills'},
        function(data){
          if(data!='-1'){
            updatePage('index_page');
            load_source();
          }else{
            updatePage('login_page');
          }
          
        }
     );    
  }
  var load_source = function(){
       __ajax__(
          '/source/client_index',
          {user_name:'hills'},
          function(data){
            if(data!='-1'){
              var list_len = data.file_info.length;
              var file_info ="";
              var str = '<li class="data-list-li">';
                str += '<img class="data-list-img" src="'+host+'/<%=img_dir%>" width="60px" height="60px" />';
                str += '<h3 class="data-list-h3"><%=title%></h3>';
                str += '<p class="data-list-p"><span class="badge badge-info">类别：<%=cat_name%></span><span>格式：<%=type%></span></p>';
                str += '<a href="#print" source_id="<%=id%>"  class="print-a btn btn-min data-list-print-a">打印</a>';
                str += '</li>';
              data_re = "";
              for(var i=0;i<list_len;i++){
                file_info = data.file_info[i];          
                file_info.img_dir = file_info.img_dir?file_info.img_dir:"templates/img/file_defalt/"+file_info.type+".png";
                obj = file_info;
                data_re += $.parseTpl(str,obj);
              }
              $('#source-list').html(data_re);
              source_add_fun();
              updatePage('index_source');
            }else{
              alert(data);
            }  
          },'json'
       );    
  };
  var source_add_fun = function(){
    //资源打印
    $('a.print-a').on('click',function(){
         __ajax__(
            '/task/client_source_add',
            {source_add:1,s_id:[$(this).attr('source_id')]},
            function(data){
              if(data!='-1'){
                load_task_now();
              }else{
                alert(data);
              }  
            },'text'
         );   
    });
  };
  var source_cancle_fun = function(){
    //资源打印
    $('a.print-cancle-a').on('click',function(){
         __ajax__(
            '/task/client_file_cancle',
            {tf_id:$(this).attr('source_id')},
            function(data){
              if(data!='-1'){
                load_task_now();
              }else{
                alert(data);
              }  
            },'text'
         );   
    });
  };
  var task_submit_fun = function(){
      //任务提交
    $('#task_submit_a').click(function(){
      __ajax__(
          '/task/client_submit',
          {submit:1,task_id:$("input#task_id").val(),printer_id:$('input[name=printer_id]:checked').val()},
          function(data){
            if(data!='-1'){
              load_user_task();
            }else{
              alert(data);
            }  
          },'text'
       );
    }); 
  }
  var load_task_now = function(){
       __ajax__(
          '/task/client_submit',
          {user_name:'hills'},
          function(data){
            if(data!='-1'){
              var list_len = data.file_info.length;
              var file_info ="";
              
              var str = '<li class="data-list-li clearfix">';
                str += '<img class="data-list-img" src="'+host+'/<%=img_dir%>" width="60px" height="60px" />';
                str += '<h3 class="data-list-h3"><%=title%></h3>';
                str += '<p class="data-list-p"><span class="badge badge-info">数量：<%=number%></span><span>暂时只支持单面A4黑白打印</span></p>';
                str += '<a href="#print" source_id="<%=id%>"  class="btn btn-min data-list-print-a print-cancle-a">取消</a>';
                str += '</li>';
              var source_re = "";
              for(var i=0;i<list_len;i++){
                file_info = data.file_info[i];
                file_info.img_dir = file_info.img_dir?file_info.img_dir:"templates/img/file_defalt/"+file_info.type+".png";
                obj = file_info;
                source_re += $.parseTpl(str,obj);
              }
              $('#task-source-list').html(source_re?source_re:'<li class="data-list-li clearfix">无待打印文件，请添加！</li>');

              source_cancle_fun();

              var printer_re = '<li class="data-list-li clearfix">'+data.printer_info.name+'</li>';
              $('#task-printer-list').html(data.printer_info.name?printer_re:'<li class="data-list-li clearfix">无打印设备，请选择！</li>');

              task_submit_fun();

              var str2 = '<input type="radio" <%=select%> name="printer_id" printer_name="<%=name%>"  value="<%=id%>,<%=user_id%>"><%=name%>';
                str2 += '<p class="data-list-p" style="margin-top:-3px;"><span class="badge badge-info"><%=location%></span></p>';
                str2 += '<hr style="margin:0 0 5px;" />';
              var list_len2 = data.my_printer.length;
              var list_len3 = data.shared_printer.length;
              var printer_list_re = '我的设备<hr style="margin:0 0 5px;"/>';
              var my_printer= "";
              var shared_printer = "";
              for(var i=0;i<list_len2;i++){
                my_printer = data.my_printer[i];
                my_printer.select =  data.printer_info.id == my_printer.id?"checked":"";     
                obj = my_printer;
                printer_list_re += $.parseTpl(str2,obj);
              }
              printer_list_re += '共享设备<hr style="margin:0 0 5px;"/>';
              for(var i=0;i<list_len3;i++){
                shared_printer = data.shared_printer[i];
                shared_printer.select =  data.printer_info.id == shared_printer.id?"checked":"";     
                obj = shared_printer;
                printer_list_re += $.parseTpl(str2,obj);
              }
              $('#printer-list-dialog').html(printer_list_re);

              $('input#task_id').val(data.task_id);
              updatePage('index_task');
            }else{
              alert(data);
            }  
          },'json'
       );   
  }; 
  var load_user_task = function(){
       __ajax__(
          '/user/client_task',
          {user_name:'hills'},
          function(data){
            if(data!='-1'){
              var list_len = data.list.length;
              var list_info ="";
              var str = '<li class="data-list-li">';
                str += '<h3 class="data-list-h3"><span class="print-state label label-<%=badge_state%>" ><%=state%></span><%=title%></h3>';
                str += '<p class="data-list-p"><span class="badge badge-info">打印机：<%=printer_name%></span>';
                str += '地点：<%=printer_location%></span></p>';
                str += '<p class="data-list-p"><span>提交时间：<%=submit_time%></span>';
                str += '<span>打印时间：<%=print_time%></span></p>';
                str += '</li>';
              data_re = "";
              for(var i=0;i<list_len;i++){
                list_info = data.list[i];    
                list_info.badge_state = data.task_state[list_info.state].label;        
                list_info.title = list_info.source[0].title+"等"+list_info.source.length+"个文件";
                list_info.state = data.task_state[list_info.state].name;
                obj = list_info;
                data_re += $.parseTpl(str,obj);
              }
              $('#task-list').html(data_re);

              updatePage('user_task');
            }else{
              alert(data);
            }  
          },'json'
       );    
  };
  var __init__ = function(){
    $('.__page__').css('-webkit-transition', 'all .3s ease-in-out');
    $('.__index_page__').css('-webkit-transition', 'all .3s ease-in-out');
    is_login();
  }
  __init__();

  /*事件*/
  //登录
  $('#login_a').click(function(){
     __ajax__(
        '/user/client_login',
        {user_name:$('#login_name').val(),password:$('#login_password').val()},
        function(data){
          if(data=='1'){
            updatePage('index_page');
            load_source();
            updatePage('index_source');
          }else{
            alert(data);
          }
          
        }
     );
     return false;
  });
  //登出
  $('.ui-dropmenu-items li').eq(4).on('click',
    function(){
       __ajax__(
          '/user/client_logout',
          {user_name:'hills'},
          function(data){
            if(data=='1'){
              updatePage('login_page');
            }else{
              alert(data);
            }  
          }
       );
    }
  );
  //主页
  $('#index_a').click(function(){
    updatePage('index_index');
  });
  //资源
  $('#source_a').click(function(){load_source();});
  //当前任务
  $('#task_a').click(function(){load_task_now();});
  //任务
  $('.ui-dropmenu-items li').eq(0).on('click',function(){load_user_task()});
  //用户资源
  $('.ui-dropmenu-items li').eq(2).on('click',function(){
       __ajax__(
          '/user/client_source',
          {user_name:'hills'},
          function(data){
            if(data!='-1'){
              var list_len = data.file_info.length;
              var file_info ="";
              var str = '<li class="data-list-li">';
                str += '<h3 class="data-list-h3"><%=title%></h3>';
                str += '<p class="data-list-p"><span class="badge badge-info">状态：<%=state%></span><span>大小：<%=size%></span><span>上传日期：<%=add_time%></span></p>';
                str += '<a href="#print" source_id="<%=id%>"  class="btn btn-min data-list-print-a print-a">打印</a>';
                str += '</li>';
              data_re = "";
              for(var i=0;i<list_len;i++){
                file_info = data.file_info[i];       
                file_info.state = file_info.share?"共享":"私有";
                obj = file_info;
                data_re += $.parseTpl(str,obj);
              }
              $('#usource-list').html(data_re);
              source_add_fun();
              updatePage('user_source');
            }else{
              alert(data);
            }  
          },'json'
       );    
  });

});