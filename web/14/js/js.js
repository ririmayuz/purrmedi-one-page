// JavaScript Document
$(document).ready(function(e) {
    $(".mainmu").mouseover(
		function()
		{
			$(this).children(".mw").stop().show()
		}
	)
	$(".mainmu").mouseout(
		function ()
		{
			$(this).children(".mw").hide()
		}
	)
	$(".mw").hover(
		function(){
			$(this).show();
		}
	)
});
function lo(x)
{
	location.replace(x)
}
function op(x,y,url)//open
{
	$(x).fadeIn()//fadein淡入
	if(y){//可能是T或F，只要y有非null、負數都算true
		$(y).fadeIn()
	}
	//if else簡寫
	if(y&&url)//url的對象載入後放到y
	$(y).load(url)
}
function cl(x)//close
{
	$(x).fadeOut();
}