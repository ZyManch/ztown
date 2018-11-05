var last_x=-1;
var last_y=-1;
var w;
var obj;
var GET = _GET();

function pr(x){
	var s = '';
	for(var i in x){
		s+="----------------------"+i+"------------------\n"+x[i]+"\n";
	}
	alert(s);
}

function loadAjax(url,id){
	var s = 'index.php?action='+GET.action+'&x='+GET.x+'&y='+GET.y;
	if(url.length==0){
		url = s;
	}else if(url[0]=='&'){
		url = s + url;
	}
	jQuery.ajax(url);
	return false;
}


function inPoly(x,y, pnts){
	var i, j;
	pnts = [[0,24],[46,0],[92,24],[46,48]];
	var parity = false;
	var size  = pnts.length;
	for(i = 0, j = size - 1; i < size; j = i++){
		if ( ( (pnts[i][1] < y) && (y <= pnts[j][1]) || (pnts[j][1]< y) && (y <= pnts[i][1])) 
		&& (x > (pnts[j][0] - pnts[i][0]) * (y - pnts[i][1]) / (pnts[j][1] - pnts[i][1]) + pnts[i][0]))
			parity = !parity;
	}
	return parity;
}

function array_search( needle, haystack, strict ) {
	var strict = !!strict;
	for(var key in haystack){
		if( (strict && haystack[key] === needle) || (!strict && haystack[key] == needle) ){
			return key;
		}
	}
	return false;
}
function load_css(file) {
	var link = document.createElement('link');
	link.rel = 'stylesheet';
	link.type = 'text/css';
	link.href = 'template/'+file+'.css';
	document.getElementsByTagName('head')[0].appendChild(link);
};

function load_js(file){
	jQuery.getScript('template/'+file+'.js');
}
function get_hose_info(arr){
	var s = '<div class="tile'+arr.map_type_id+'" style="left:10px;top:10px;float:left"></div>';
	s+= '<div style="margin-left:130px;padding:5px;">';
	if(arr.map_type_id > 0){
		s+= '<h4>' + arr.name+'</h4>';
        if (arr.type == 'house') {
		    s+= arr.street + ' ' + arr.house + '<br/>';
        }
	}else{
		s+= 'Данный участок пуст. Вы можете возвести на этом месте любое доступной для Вас здание.';
	}
	s+='</div>';
	return s;
}
// принадлежит ли точка ромбу
function switch_parent_select(){
	$(this).parent('tr').children('td').toggleClass('hovered_td');
}
function switch_select(){
	$(this).toggleClass('hovered_input');
}

function confirm_ex(text,url){
	var d = document.createElement('div');
	d.className = 'confirm';
	document.body.appendChild(d);
	var s = document.createElement('div');
	s.innerHTML = text;
	s.style.height = '80%';
	var b = document.createElement('div');
	b.innerHTML = '<input type="button" value="OK" onclick="location.href=\''+url+'\';"> '+'<input type="button" value="Cancel" onclick="var d=this.parentNode.parentNode;d.parentNode.removeChild(d);">';
	d.style.height = '20%';
	d.appendChild(s);
	d.appendChild(b);
}
function open_house(e){
	var map = $('#map');
	var map_p = map.offset();
	var x = e.pageX - map_p.left;
	var y = e.pageY - map_p.top;
	var p = mouse_to_sprite(x-24*17,y);
	if(p[0]<0){
		location.href = 'maps/index?x='+(start_x+4)+'&y='+(start_y+3);
	}else if(p[1]<0){
		location.href = 'maps/index?x='+(start_x+3)+'&y='+(start_y+4);
	}else if(p[0]>=9){
		location.href = 'maps/index?x='+(start_x+4)+'&y='+(start_y+5);
	}else if(p[1]>=9){
		location.href = 'maps/index?x='+(start_x+5)+'&y='+(start_y+4);
	}else{
		location.href = map_array[p[0]][p[1]]['controller'] + '/view?x='+(p[1]+start_x)+'&y='+(p[0]+start_y);
	}
	return false;
}
/*
function show_hint(e){
	var map = $('#map');
	var map_p = map.offset();
	var map_h = map.height();
	var map_w = map.width();
	var x = e.pageX - map_p.left;
	var y = e.pageY - map_p.top;
	var max = 0;
	var p_x = 0;
	var p_y = 0;
	var n;
	for(i=0;i<map_array.length;i++){
		n = map_array[i].length;
		for(j=0;j<n;j++){
			if(inPoly(x-(9+i-j-1)*46,y-(i+j)*24,curves[map_array[i][j][0]])){
				p_x = i;
				p_y = j;
				max = i+j;
			}
		}
	}
	if((last_x!=p_x)||(last_y!=p_y)){
		$('#item'+last_x+'_'+last_y).animate({ opacity: '1.0' }, "slow");
	}

	if(max>0){
		if((last_x!=p_x)||(last_y!=p_y)){
			$('#info').css('display','block').html(get_hose_info(map_array[p_x][p_y]));
			$('#item'+p_x+'_'+p_y).show('fast').animate({ opacity: '0.5' }, "slow");
		}
	}else{
		$('#info').css('display','none');
	}
	last_x = p_x;
	last_y = p_y;
	if(map_w - x < 300) x -= 320; 	else x+=20; 
	if(map_h - y < 130) y -= 150;   else y+=10;
	$('#info').css('left',x+'px');
	$('#info').css('top',y+'px');
}
/**/

function mouse_to_sprite(x,y){
	var tx = y+24*x/46;
	var max = 8;
	tx = Math.floor(tx/48);
	var ty = y-24*x/46;
	ty = Math.floor(ty/48);
	return [tx,ty];
}

function show_hint(e){
	var map = $('#map');
	var map_p = map.offset();
	var map_h = map.height();
	var map_w = map.width();
	var x = e.pageX - map_p.left;
	var y = e.pageY - map_p.top;
	var p_x = 0;
	var p_y = 0;
	var n;
	var p = mouse_to_sprite(x-24*17,y);
	p_x = p[0];
	p_y = p[1];

	if(((last_x!=p_x)||(last_y!=p_y))&&(last_x>=0)&&(last_y>=0)&&(last_x<9)&&(last_y<9)){
		$('#item'+last_x+'_'+last_y).removeClass('hover');
        $('#item'+last_x+'_'+last_y).show('fast').animate({ opacity: '1.0' }, "slow");
	}

	if((p_x>=0)&&(p_y>=0)&&(p_y<9)&&(p_x<9)&&(map_array[p_x][p_y].map_type_id>=0)){
		if((last_x!=p_x)||(last_y!=p_y)){
            if (map_array[p_x][p_y].enabled) {
                $('#info').css('display','block').html(get_hose_info(map_array[p_x][p_y]));
                $('#item'+p_x+'_'+p_y).show('fast').animate({ opacity: '0.7' }, "slow");
                $('#item'+p_x+'_'+p_y).addClass('hover');
            }
		}
	}else{
		$('#info').css('display','none');
	}
	last_x = p_x;
	last_y = p_y;
	if(map_w - x < 300) x -= 320; 	else x+=20; 
	if(map_h - y < 130) y -= 150;   else y+=10;
	$('#info').css('left',x+'px');
	$('#info').css('top',y+'px');
}

function _GET() {
	var tmp = [];      // два вспомагательных
	var tmp2 = [];     // массива
	var param = [];
	var get = location.href.split('/').slice(5);  // == $_GET
	if(get.length) {
		for(var i=0; i < get.length; i+=2) {
			param[get[i]] = get[i + 1];
		}
	}
	return param;
}

function trackbar_light(el,input,min,max){
	var object = this;
	this.trackbar = $('#'+el);
	this.input = $('#'+input);
	this.min = min;
	this.max = max;
	this.position = min;
	this.set = function(pos){
		this.position = pos;
		this.checkposition();
		this.setprogress();
	};
	this.checkposition = function (){
		if(this.position<this.min){
			this.position = this.min;
		}else if(this.position>this.max){
			this.position = this.max;
		}
	};
	this.trackbar.mousedown(function (e){
		obj = $(this);
		var t = obj.offset();
		w = obj.width();
		last_x = t.left;
		last_y = t.top;
		document.onmousemove = function (e){
			var dx = (e.clientX-last_x)/w;
			if(dx<0){
				dx = 0;
			}else if(dx>1){
				dx=1;
			}
			object.set(Math.round(object.max*dx));
			return false;
		};
		document.onmouseup = function (){
			document.onmousemove = function (){}
			document.onmouseup = function (){}
			obj = false;
			return false;
		};
		document.onmousemove(e);
		return false;
		/**/
	});
	
	this.setprogress = function(){
		var x = Math.round(100*this.position/this.max);
		this.input.val(this.position);
		this.trackbar.children('.value').css('width',x+'%');
		this.trackbar.children('.value').html(this.position+'$');
	};
	this.setprogress();
}

function trackbar(el,el2,el3,num1,num2){
	var object = this;
	this.trackbar = $('#'+el);
	this.value1bar = $('#'+el2);
	this.value2bar = $('#'+el3);
	this.timediv = $('#'+el+'_time');
	this.button = $('#'+el+'_button');
	this.onchange = function () {}
	this.num1 = num1;
	this.num2 = num2;
	this.summ = 0;
	this.delay = 0;
	this.setdelay = function (x){
		this.timediv.removeClass('timecurseout');
		this.button.attr('disabled',false);
		this.delay = x;
	}
	this.timechange = function (){
		if(this.delay!=-1){
			this.delay--;
		}
		if(this.delay==0){
			
		}else if (this.delay==5){
			this.timediv.addClass('timecurseout');
			this.button.attr('disabled',true);
			
		}else if (this.delay<5){

		}else{

		}
		this.timediv.html(this.delay);
		return this.delay;
	}
	this.value1bar.keyup(function (){
		object.num1[0] = $(this).val();
		object.math_num2();
		object.updatevalue();
	});
	this.checknum1 = function (){
		if(this.num1[0]<0){
			this.num1[0] = 0;
		}else{
			var s = this.summ/this.num1[1];
			if(this.num1[0]>s) this.num1[0] = Math.ceil(s)-1;
		}
	}
	this.math_num2=function(){
		this.checknum1();
		this.num2[0] = Math.round((this.summ-this.num1[0]*this.num1[1])/this.num2[1]);
	}
	this.set_new_curse = function (x){
		this.num1[1] = x;
		this.updatevalue();
	}
	this.trackbar.mousedown(function (e){
		obj = $(this);
		var t = obj.offset();
		w = obj.width();
		last_x = t.left;
		last_y = t.top;
		document.onmousemove = function (e){
			var dx = (e.clientX-last_x)/w;
			if(dx<0){
				dx = 0;
			}else if(dx>1){
				dx=1;
			}
			var s = object.summ;
			object.num1[0] = Math.round(s*dx/object.num1[1]);
			object.math_num2();
			object.update_valuebar();
			object.updatevalue();
			return false;
		}
		document.onmouseup = function (){
			document.onmousemove = function (){}
			document.onmouseup = function (){}
			obj = false;
			return false;
		}
		document.onmousemove(e);
		return false;
		/**/
	});
	
	this.update_valuebar = function (){
		this.value1bar.val(this.num1[0]);
		this.value2bar.val(this.num2[0]);
	}
	this.getsumm = function (){
		return (this.num1[0]*this.num1[1]+this.num2[0]*this.num2[1]);
	}
	this.summ = this.getsumm();
	this.setprogress = function(per){
		var x = Math.round(100*per);
		if(x<0){
			x = 0;
		}else if(x>100){
			x = 100;
		}
		this.trackbar.children('.value').css('width',x+'%');
		if(x>90){
			this.trackbar.children('.de_value').css({'left':'90%','width':'10%'});
		}else{
			this.trackbar.children('.de_value').css({'left':(x+'%'),'width':(100-x)+'%'});
		}
		this.trackbar.children('.value').html(this.num1[0]+this.num1[2]);
		this.value1bar.val(this.num1[0]);
		this.trackbar.children('.de_value').html(this.num2[0]+this.num2[2]);
		this.value2bar.val(this.num2[0]);
	}
	this.updatevalue = function (){
		this.setprogress(this.num1[0]*this.num1[1]/this.summ);
		this.onchange();
	}
}

var div;
var img = null;
function drag_map(e){
	if(img == null){
		img = document.createElement('div');

	}
	var im = this.getAttribute('im');
	img.className = 'moved_tile';
    img.innerHTML = '<div class="tile tile'+im+'"></div>';
	document.body.appendChild(img);
	document.body.onmousemove = function (e){
		img.style.left = (e.clientX+10)+'px';
		img.style.top = (e.clientY+10)+'px';
	}
	document.body.onclick = function(e){
		var map = $('#map');
		var map_p = map.offset();
		var map_h = map.height();
		var map_w = map.width();
		var x = e.pageX - map_p.left;
		var y = e.pageY - map_p.top;
		var p_x = 0;
		var p_y = 0;
		var n;
		var p = mouse_to_sprite(x-24*17,y);
		p_x = p[0];
		p_y = p[1];
		//alert(p_x+' '+p_y);
		if((p_x>=0)&&(p_y>=0)&&(p_x<9)&&(p_y<9)){
			var list = document.getElementById('item'+p_x+'_'+p_y).children;
			var par;
			for(var i=0;i<list.length;i++){
				if((list[i].className) && (list[i].className.indexOf('removed_tile')!=-1)){
					par = list[i];
				}
			}
			var s;
			par.className = 'tile tile'+im+' removed_tile';
			$.getScript('/maps/update?type='+im+'&x='+par.getAttribute('x')+'&y='+par.getAttribute('y')+'&cache='+Math.random(),function (){});
			return false;
		}
	}
	document.body.oncontextmenu = function (e){
		document.body.onmousemove = function (){}
		document.body.removeChild(img);
		img = null;
		return false;
	}
}

function autoshow_hint(){
	var hint = $(this).children('.autohint');
	$('.autohint').hide();
	hint.animate({opacity:'show'},'fast');
	event.stopPropagation();
}

function autohide_hint(){
	var hint = $(this).children('.autohint');
	hint.animate({opacity:'hide'},'fast');
}

function format_time(t){
	var m = Math.floor(t/60);
	var h = Math.floor(m/60);
	var m = m%60;
	var s = t%60;
	if(s<10) s = '0'+s;
	if(h){
		if(m<10) m = '0'+m;
		return h+':'+m+':'+s;
	}else{
		return m+':'+s;
	}
}

function smarty_show(obj){
	var list = document.getElementById('smarty_ul').all;
	for(var i=0;i<list.length;i++){
		if(list[i].tagName=='A') list[i].className = '';
	}
	obj.className = 'smarty_selected';
	var list = document.getElementById('table_assigned_vars').getElementsByTagName('TBODY');
	for(i=0;i<list.length;i++){
		list[i].style.display = 'none';
	}
	document.getElementById(obj.innerText).style.display = '';
	return false;
}

function nextatack(){
	if(window.pos==-1){
		clearInterval(window.interval);
	}else{
		$('.td'+(window.pos*2-2)).slideDown('fast');
		$('.td'+(window.pos*2-1)).slideDown('fast');
		for(var i=0;i<=1;i++){
			//alert(atacks.length-pos);
            window.cur_hp[i] = Math.max(window.cur_hp[i]-window.atacks[window.atacks.length-window.pos-1][i],0);
			$('#u'+i+'_txt').html(window.cur_hp[i]+'/'+window.max_hp[i]);
			$('#u'+i).css('width',Math.round(100*window.cur_hp[i]/window.max_hp[i])+'%');
		}
        window.pos--;
	}
}

$(document).ready(function(){
	$('table.default td').hover(switch_parent_select,switch_parent_select);
	$('table.default input,table.default textarea,table.default select').hover(switch_select,switch_select);
	$('.user_menu .item').hover(function (){
		$(this).children('.submenu').slideDown('fast');
	},function (){
		$(this).children('.submenu').slideUp('fast');
	});
	if(location.href.indexOf('admin')==-1){
		//$('#map').mousemove(show_hint);
		//$('#map').click(open_house);
	}else{
		//$('#map').click(change_house);
	}
	$('.default tr').each(function (){$(this).children('th:first').css('border-left','1px solid #aaaaaa')});
	$('.autohint').parent().hover(autoshow_hint,autohide_hint);
});