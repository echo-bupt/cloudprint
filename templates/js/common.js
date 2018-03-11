/**
 * 添加收藏
 */

function addFavorite2() {
    var url = window.location;
    var title = document.title;
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf("360se") > -1) {
        alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
    }
    else if (ua.indexOf("msie 8") > -1) {
        window.external.AddToFavoritesBar(url, title); //IE8
    }
    else if (document.all) {
    	try{
    		window.external.addFavorite(url, title);
    	}catch(e){
    		alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    	}
    }
    else if (window.sidebar) {
       try{
    		window.external.addFavorite(url, title);
    	}catch(e){
    		alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    	}
    }
    else {
    	alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    }
}
function getTop(e){ 
var offset=e.offsetTop; 
if(e.offsetParent!=null) offset+=getTop(e.offsetParent); 
return offset; 
} 

/**
 * 导航字菜单
 */

$(function(){
  
 var btn=true;
  $(".s-text").focus(function()
{
    $(this).val("");
})
 $(".s-text").blur(function()
{
    if($(this).val()=="")
        {
            $(this).val("请输入资源或文件名称等");
        }
})


})




