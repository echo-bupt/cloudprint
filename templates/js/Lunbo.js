  //轮播图:
  $(function()
{
    
      $(".Alink").click(function(){
        return false;
    })
    //下面是点击特色，什么的按钮执行的js文件，单独作用于首页，不写在common.js以免报错!

var special=document.getElementById("special");
var iHeight=$(window).height();
var zoom=getTop(special);
var scroll=zoom-iHeight;
var specialA=document.getElementById("specialA");
var selfHeight=$("#special").height();
specialA.onclick=function()
{
  //alert(scroll);
    window.scrollTo(0,scroll+selfHeight);
    return false;
}
var print_h=document.getElementById("print_h");
var print=document.getElementById("print");
var zoom2=getTop(print);
var scroll2=zoom2-iHeight;
var self2Height=$("#print").height();
print_h.onclick=function()
{
   // alert(zoom2);
       window.scrollTo(0,scroll2+self2Height);
    return false;
}

    
     var oUl=document.getElementById("navs").getElementsByTagName("ul")[0 ];
  var aLi=document.getElementById("navs").getElementsByTagName("li");
  var oneSize=aLi[0].offsetWidth;
  var aA=document.getElementById("aA").getElementsByTagName("a");
  var iNow=0;
  var iNow2=0;
  function fixUl()
  {
      oUl.style.width=aLi.length*oneSize+"px";
  }
  fixUl();
  //点击:
  function autoPlay()
  {
      for(var i=0;i<aA.length;i++)
                  {
                      aA[i].className=""
                  }
                //  alert(this.index);
                 
  }
       for(var i=0;i<aA.length;i++)
      {
          aA[i].index=i;
          aA[i].onclick=function()
          {
               autoPlay();
               aA[this.index].className="show";
                  iNow=this.index;
                  iNow2=this.index;
             
          }
      }
  
  
  //定时器:
  function autoMove()
  {
      iNow++;//这是控制className自动运动的！因为iNow2与iNow不同，iNow2需要继续++,而不是将其拉回！
      if(iNow==aA.length)
          {
              iNow=0;
              aLi[0].style.position="relative";
              aLi[0].style.left=aA.length*oneSize+"px";//注意这是相当于ul的left值！！是正的！！
          }
           autoPlay();
          aA[iNow].className="show";
          iNow2++;
          miaovStartMove(oUl,{left:-iNow2*oneSize},MIAOV_MOVE_TYPE.BUFFER,function()
  {
      if(iNow==0)
          {
              //还原，进行完缓冲运动后要进行还原！
               aLi[0].style.position="static";
               iNow2=0;
               oUl.style.left=0;
          }
  }    
  )
          
          
  }
  var timer=setInterval(autoMove,3000);

})
 

