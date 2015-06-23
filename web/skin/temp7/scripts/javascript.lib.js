//*********************************************************************************************************
//******************************************* Test input **************************************************
function test_empty(s){if(s == ""){return true;}return false;}
// kiem tra ky tu dac biet, neu khong co ky tu dac biet => return true
function test_char(s){
	var the_array = new Array('~','`','!','@','#','$','%','^','&','*','(',')','-','+','=','|','[',']','{','}',':','"',',',"'",';','/','?','.','<','>','\\');
	for (var i = 0; i < 31; i++){if(s.indexOf(the_array[i])>=0){alert("Kh&ocirc;ng d&ugrave;ng k&yacute; t&#7921; : " + the_array[i]);return false;}}
	return true;
}
function test_length4(s){if(s.length < 4){return false;}return true;}
function test_length6(s){if(s.length < 6){return false;}return true;}
function checkEmail(s){var e = /^(?:\w+\.?)*\w+@(?:\w+\.)+\w+$/;return e.test(s);}
// Chi duoc nhap cac chu so tu nhien => return true
function test_integer(s){if (s.length>0 &&(s != parseInt(s))){return true;}return false;}
function test_Reset(s){return true;}
// Kiem tra 2 mat khau giong nhau => return true
function test_confirm_pass(pass1, pass2){if(pass1 == pass2){return true;}return false;}
// kiem tra ky tu dau tien cua chuoi la so => return true
function firstIsNum(s){for(var i=0; i<=9; i++){if(parseInt(s.substr(0,1))==i){return true;}}return false;}
// kiem tra trong chuoi co ton tai khoang trang => return true
function existSpace(s){if(s.indexOf(' ') > -1){return true;}return false;}
//*********************************************************************************************************
//*********************************** Expand - Collapse Detail ********************************************
if (document.getElementById){
	document.write('<style type="text/css">\n')
	document.write('.submenu{display: none;}\n')
	document.write('</style>\n')
}

function SwitchDetail(obj){
	if(document.getElementById){
		var el = getIdObj(obj);
		var ar = getIdObj("divDetail").getElementsByTagName("span");
		if(el.style.display != "block"){
			for (var i=0; i<ar.length; i++){
				if (ar[i].className=="submenu")
				ar[i].style.display = "none";
			}
			el.style.display = "block";
		}else{
			el.style.display = "none";
		}
	}
}
//*********************************************************************************************************
//*************************************** Double Listbox **************************************************
function GetIdListDes(obj){//get id of all options of combobox to array
	var arrId = new Array();
	for(var i=0; i<obj.options.length; i++){
		arrId[i] = obj.options[i].value;
	}
	return arrId;
}

function roles_listbox2arr(listId){
	var arr = new Array();
	l = getIdObj(listId);
	for(var i=0; i<l.length; i++){
		var t = l[i].text;
		strLen = t.indexOf(",,");
		str = t.substr(strLen+2);
		arr[arr.length] = str;
	}
	return arr;
}

function parseArrayRole(listId, checkPos, rolePos){
	var arr = roles_listbox2arr(listId);
	var ch = arr[checkPos];
	ch = ch.toString();
	var r = ch.charAt(rolePos);
	return r==1?true:false;
}

function AddTo(srcobj,desobj){
	var i=srcobj.selectedIndex,k;
	var bIns=false;
	if(i==-1) return 0;
	for(k=srcobj.options.length-1;k >=0; k--){
		bIns=false;
		if(srcobj.options(k).selected==true){
			var f1=srcobj.options(k).text;
			var f2=srcobj.options(k).value;
			var total=desobj.options.length;
			var option = document.createElement("OPTION");
			desobj.options.add(option);
			option.innerText=f1;
			option.value=f2;
			srcobj.options.remove(k);
			srcobj.options(k).selected=true;
		}
	}
	//SortItem(desobj);
}

function AddAllTo(srcobj,desobj){
	var k;
	var bIns=false;
	while(srcobj.options.length>=0){
		bIns=false;
		var f1=srcobj.options(0).text;
		var f2=srcobj.options(0).value;
		var total=desobj.options.length;
		var option = document.createElement("OPTION");
		desobj.options.add(option);
		option.innerText=f1;
		option.value=f2;
		srcobj.options.remove(0);
	}
	//SortItem(desobj);
}

function makeChecked(objId){//radio button
    var x = getIdObj(objId);
    x.checked = true;
}

function makeNoChecked(objId){//radio button
    var x = getIdObj(objId);
    x.checked = false;
}

function makeDisable(objId){
    var x = getIdObj(objId);
    x.disabled = true;
}

function makeEnable(objId){
    var x = getIdObj(objId);
    x.disabled = false;
}

function getIdObj(objId){
	return document.getElementById(objId);
}
//*********************************************************************************************************
//******************************************* Sort ********************************************************
function SortItem(obj){//Bubble Sort by Text on list
	var num = obj.options.length; 
	var i, j=0;
	var ArrayValue = new Array(num+1);
	var ArrayText = new Array(num+1);
	for(i=0; i<num; i++){
		ArrayText[i] = obj.options(i).text;
		ArrayValue[i] = obj.options(i).value;
	}
	var valueTemp = "";
	var textTemp = "";
	for(i=0; i<num; i++){
		textTemp = ArrayText[i];
		valueTemp = ArrayValue[i];
		for(j=i+1; j<num; j++){
			if(ArrayText[j] < textTemp){
				ArrayText[i] = ArrayText[j];
				ArrayText[j] = textTemp;
				ArrayValue[i] = ArrayValue[j];
				ArrayValue[j] = valueTemp;
				valueTemp = ArrayValue[i];
				textTemp = ArrayText[i];
			}
		}
	}
	for(i=num-1;i>=0;i--){
		obj.options.remove(i);
	}
	for(i=0;i<num;i++){
		var option=document.createElement("OPTION");
		obj.options.add(option);
		option.innerText=ArrayText[i];
		option.value=ArrayValue[i];
	}
}
//*********************************************************************************************************
//**************************************** Slide show image ***********************************************
function fillup(){
	if (iedom){
		cross_slide=document.getElementById? document.getElementById("test2") : document.all.test2;
		cross_slide2=document.getElementById? document.getElementById("test3") : document.all.test3;
		cross_slide.innerHTML=cross_slide2.innerHTML=leftrightslide;
		actualwidth=document.all? cross_slide.offsetWidth : document.getElementById("temp").offsetWidth;
		cross_slide2.style.left=actualwidth+slideshowgap+"px";
	}
	else if (document.layers){
		ns_slide=document.ns_slidemenu.document.ns_slidemenu2;
		ns_slide2=document.ns_slidemenu.document.ns_slidemenu3;
		ns_slide.document.write(leftrightslide);
		ns_slide.document.close();
		actualwidth=ns_slide.document.width;
		ns_slide2.left=actualwidth+slideshowgap;
		ns_slide2.document.write(leftrightslide);
		ns_slide2.document.close();
	}
	lefttime=setInterval("slideleft()",30);
}

function slideleft(){
	if (iedom){
		if (parseInt(cross_slide.style.left)>(actualwidth*(-1)+8))
			cross_slide.style.left=parseInt(cross_slide.style.left)-copyspeed2+"px";
		else cross_slide.style.left=parseInt(cross_slide2.style.left)+actualwidth+slideshowgap+"px";
		if (parseInt(cross_slide2.style.left)>(actualwidth*(-1)+8))
			cross_slide2.style.left=parseInt(cross_slide2.style.left)-copyspeed2+"px";
		else cross_slide2.style.left=parseInt(cross_slide.style.left)+actualwidth+slideshowgap+"px";
	}
	else if (document.layers){
		if (ns_slide.left>(actualwidth*(-1)+8)) ns_slide.left-=copyspeed2;
		else ns_slide.left=ns_slide2.left+actualwidth+slideshowgap;
		if (ns_slide2.left>(actualwidth*(-1)+8)) ns_slide2.left-=copyspeed2;
		else ns_slide2.left=ns_slide.left+actualwidth+slideshowgap;
	}
}
//*********************************************************************************************************
//********************************* Prohibit Without Login & Scroll Image *********************************
var isNS = (document.layers);
var _all = (isNS) ? '' : 'all.' ;
var _style = (isNS) ? '' : '.style' ;
var _visible = (isNS) ? 'show' : 'visible';
var w_x, w_y, item, okscroll = false, godown;
function getwindowsize() {
	w_x = (isNS) ? window.innerWidth - 5 : document.body.clientWidth;
	w_y = (isNS) ? window.innerHeight : document.body.clientHeight;
	(isNS) ? item.clip.width = 42 : item.width = 42;
	(isNS) ? item.clip.height = 20 : item.height = 20;
}
function initScroll(){
	item=eval('document.'+_all+'item'+_style);
	getwindowsize();
	item.visibility=_visible;
	scrollpage();
}
function moveitem() {
	if (isNS){
		item.moveTo((pageXOffset+w_x-42),(w_y+pageYOffset-25))
	}else{
		item.pixelLeft=document.body.scrollLeft+w_x-50;
		item.pixelTop=w_y+document.body.scrollTop-80;
   }
}
function scrollpage(){
	status = '';
	if (okscroll){
		if (godown){
			(isNS)? window.scrollBy(0,8) : window.scrollBy(0,8) ;
		}else{
			(isNS)? window.scrollBy(0,-8) : window.scrollBy(0,-8) ;
		}
	}
	moveitem();
	setTimeout('scrollpage()', 30);
}
function stoperror(){
	return true
}
//*********************************************************************************************************
//****************************************** No Bars ******************************************************
function wClose(){
	top.window.opener=top;
	top.window.close();
}
function wNoBar(){
	w = 800;
	h = 600;
	LeftPos = (screen.width) ? (screen.width-w)/2 : 0;
	TopPos = (screen.height) ? (screen.height-h)/2 : 0;
	settings ='width='+w+',height='+h+',top='+TopPos+',left='+LeftPos+',menubar=no,toolbar=no,scrollbar=no';
	if (document.location.href.indexOf("?_randomcode") == -1){
		window.open(document.location.href+"?_randomcode","",settings);
		wClose();
	}
}
//*********************************************************************************************************
//******************************************** Calendar ***************************************************
function basicCalendarVN(){
	var today = new Date();
	var year = today.getFullYear();
	var day = today.getDay();
	var month = today.getMonth();
	var daym = today.getDate();
	daym = daym<10 ? ("0"+daym) : daym;
	
	var dayarray = new Array("Chủ nhật","Thứ Hai","Thứ Ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bảy");
	var montharray = new Array("01","02","03","04","05","06","07","08","09","10","11","12");
	document.write(dayarray[day]+", ngày "+daym+" tháng "+montharray[month]+" năm "+year);

}
function basicCalendarEN(){
	var today = new Date();
	var year = today.getFullYear();
	var day = today.getDay();
	var month = today.getMonth();
	var daym = today.getDate();
	daym = daym<10 ? ("0"+daym) : daym;
	
	var th = daym=="01" ? "st" : (daym=="02" ? "nd" : (daym=="03" ? "rd" : "th"));
	
	var dayarray = new Array("Sunday","Monday","Tueday","Wednesday","Thuday","Friday","Satuday");
	var montharray = new Array("January","February","March","April","May","June","July","August","September","October","Nevember","December");
	document.write(dayarray[day]+", "+montharray[month]+" "+daym+" "+th+", "+year);
}

function startClockVN(){
	var curTime=new Date();
	var nhours=curTime.getHours() + 12;
	var nmins=curTime.getMinutes();
	var nsecn=curTime.getSeconds();
	var nday=curTime.getDay();
	var nmonth=curTime.getMonth();
	var ntoday=curTime.getDate();
	var nyear=curTime.getYear();
	var AMorPM=" ";

	if (nhours>=12) AMorPM="Chiều";
	else AMorPM="Sáng";
	if (nhours>=13) nhours-=12;
	if (nhours==0) nhours=12;
	if (nsecn<10) nsecn="0"+nsecn;
	if (nmins<10) nmins="0"+nmins;

	var dayarray = new Array("Chủ nhật","Thứ Hai","Thứ Ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bảy");
	nmonth+=1;
	if (nyear<=99) nyear= "19"+nyear;
	if ((nyear>99) && (nyear<2000)) nyear+=1900;
	nmonth = nmonth<10 ? ("0"+nmonth) : nmonth;
	ntoday = ntoday<10 ? ("0"+ntoday) : ntoday;
	var d = document.getElementById("theClock");
	d.innerHTML=dayarray[nday]+", " + ntoday +"/" + nmonth +"/"+nyear + " &minus; " + nhours+":"+nmins+":"+nsecn;
	setTimeout('startClockVN()',1000);
}
function startClockEN(){
	var curTime=new Date();
	var nhours=curTime.getHours() + 12;
	var nmins=curTime.getMinutes();
	var nsecn=curTime.getSeconds();
	var nday=curTime.getDay();
	var nmonth=curTime.getMonth();
	var ntoday=curTime.getDate();
	var nyear=curTime.getYear();
	var AMorPM=" ";
	var th = ntoday=="01" ? "st" : (ntoday=="02" ? "nd" : (ntoday=="03" ? "rd" : "th"));
	if (nhours>=12) AMorPM="PM";
	else AMorPM="AM";
	if (nhours>=13) nhours-=12;
	if (nhours==0) nhours=12;
	if (nsecn<10) nsecn="0"+nsecn;
	if (nmins<10) nmins="0"+nmins;

	var dayarray = new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
	var montharray = new Array("Jan","Feb","Mar","Apr","May","June","July","Aug","Sep","Oct","Nov","Dec");
	if (nyear<=99) nyear= "19"+nyear;
	if ((nyear>99) && (nyear<2000)) nyear+=1900;
	ntoday = ntoday<10 ? ("0"+ntoday) : ntoday;
	var d = document.getElementById("theClock");
	d.innerHTML=dayarray[nday]+","+ntoday+" "+montharray[nmonth]+" "+nyear+" &minus; "+nhours+":"+nmins+":"+nsecn;
	setTimeout('startClockEN()',1000);
}
//*********************************************************************************************************
//***************************************** Show - hide menu **********************************************
var theoldcell = ""
function showhideProduct(thecell,noChild){	
	if(noChild==1) return true;
	if(theoldcell == thecell){
		eval('document.all.'+thecell).style.display = 'none';
		theoldcell = "";
	}else{
		if(theoldcell != thecell){
			if(theoldcell != "")
				eval('document.all.'+theoldcell).style.display = 'none';
			eval('document.all.'+thecell).style.display = '';
			theoldcell = thecell;
		}
	}
	return false;
}
//*********************************************************************************************************
//*********************************************************************************************************