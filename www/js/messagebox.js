var last_x;
var last_y;
$(document).ready(function(){
	var b = $('#message_box').css('left',$(document.body).width());
	var str = '<div class="title"><div class="close"></div>Новые сообщения</div><div style="padding:5px;">';
	for(var id in messages){
		str+= '<div class="new_message"><div class="head">';
		str+= messages[id][0]+'</div><div class="body">';
		
		str+= messages[id][1]+'<br><button onclick="location.href=\'index.php?action=message&event=read&id='+messages[id][3]+'\'"><img src="images/info/letter.png"> Оригинал письма</button><br>';
		str+= '<button onclick="location.href=\'index.php?action=user&id='+messages[id][4]+'\'"><img src="images/info/friend.png"> '+messages[id][2]+'</button> ';
		str+= '</div></div>';
	}
	str+= '</div>';
	b.html(str).addClass('message_box').css('display','block').animate({ left: $(document.body).width()-300 }, 'fast');
	$('.message_box .new_message .head').click(function(){$(this).next().slideToggle('fast');});
	$('.message_box .new_message .head:first').next().slideToggle('fast');
	$('.message_box .title').mousedown(function (e){
		last_x = e.pageX;
		last_y = e.pageY;
		document.onmouseup = function (){
			document.onmouseup = function (){};
			document.onmousemove = function (){};
			return false;
		};
		document.onmousemove = function (e){
			var o = b.offset();
			//b.css({'left':(o.left+e.pageX-last_x),'top':(o.top+e.pageY-last_y)});
			b.css({'left':(o.left+e.pageX-last_x),'top':(o.top+e.pageY-last_y)});
			last_x = e.pageX;
			last_y = e.pageY;
			return false;
		};
		return false;
	});
	$('.message_box .close').click(function (){$('#message_box').css('display','none'); } );
});