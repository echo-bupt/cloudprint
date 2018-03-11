$(function()
{
   $(".deleteofA").click(function()
{
    $(this).parents("li").remove();
    //同时将用户信息进行修改!
    
       var pre=$("#text").text();
       var pre1=pre.substring(1,2);
       var  pre2=parseInt(pre1);
        var preNow=pre2-1;
         $("#text").html("("+preNow+")");
    return false;
})
})

