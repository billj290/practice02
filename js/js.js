// JavaScript Document
function lo(th,url)
{
	$.ajax(url,{cache:false,success: function(x){$(th).html(x)}})
}

$(document).ready(()=>{

	$('.goods').on("click", function(){
		let user = $(this).data('user');
		let news = $(this).data('news');
		let num = parseInt($(this).siblings('.num').text());
		console.log(user,news,num);
		$.post("./api/good.php",{user,news},()=>{
			
			if($(this).text()=="讚")
			{	
				$(this).text("收回讚");
				$(this).siblings('.num').text(num+1);

			}else
			{
				$(this).text("讚");
				$(this).siblings('.num').text(num-1);
			}
			// location.reload();
		})
		

	})
})