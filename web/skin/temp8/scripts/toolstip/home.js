function tabOver(e)
{
	if (e.className=='HomeTabStrip')
		e.className='HomeTabStripHover';
	else
		e.className='HomeTabStripHover1';
}
function tabOut(e)
{
	if (e.className=='HomeTabStripHover')
		e.className='HomeTabStrip';
	else
		e.className='HomeTabStrip1';
}

function menuItemOver(e)
{
	e.className='HomeMenuItem2Hover';
}
function menuItemOut(e)
{
	e.className='HomeMenuItem2';
}
var offsetxpoint = -60; //Customize x offset of tooltip
var offsetypoint = 20; //Customize y offset of tooltip
var ie = document.all;
var ns6 = document.getElementById && !document.all;
var enabletip = false;

var tipobj;

function ietruebody()
{
	return (document.compatMode && document.compatMode != "BackCompat")? document.documentElement : document.body;
}

// Ajax Show Tooltip
function AJAXShowToolTip(externalFile)
{	
	if((document.readyState == "complete") || (!ie))
	{
		if(!document.getElementById('ShowToolTip'))
		{
			try
			{		
				/* Create tooltip content div */
				tipobj = document.createElement('DIV'); 
				tipobj.className = 'ShowToolTip';
				tipobj.id = 'ShowToolTip';		
				tipobj.style.display='block';
				tipobj.style.position = 'absolute';
				document.body.appendChild(tipobj);
			}
			catch(e)
			{	
				return;		
			}
		}		
		
		ajax_loadContent('ShowToolTip',externalFile);	
		
		enabletip = true;
	}
}

// Positioning Tooltip
function VietAd_PositionTooltip(e)
{
	if (enabletip)
	{
		var curX = (ns6) ? e.pageX : event.clientX+ietruebody().scrollLeft;
		var curY = (ns6) ? e.pageY : event.clientY+ietruebody().scrollTop;
		
		//Find out how close the mouse is to the corner of the window
		var rightedge  = ie&&!window.opera ? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20;
		var bottomedge = ie&&!window.opera ? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20;

		var leftedge = (offsetxpoint<0) ? offsetxpoint*(-1) : -1000;

		//if the horizontal distance isn't enough to accomodate the width of the context menu
		if (rightedge < tipobj.offsetWidth)
		{
			//move the horizontal position of the menu to the left by it's width
			tipobj.style.left = ie ? ietruebody().scrollLeft + event.clientX-tipobj.offsetWidth + "px" : window.pageXOffset + e.clientX - tipobj.offsetWidth + "px";
		}
		else if (curX < leftedge)
		{
			tipobj.style.left = "5px";
		}
		else
		{
			//position the horizontal position of the menu where the mouse is positioned
			tipobj.style.left = curX + offsetxpoint + "px";
		}

		//same concept with the vertical position
		if (bottomedge < tipobj.offsetHeight)
		{
			tipobj.style.top = ie ? ietruebody().scrollTop + event.clientY-tipobj.offsetHeight - offsetypoint + "px" : window.pageYOffset + e.clientY - tipobj.offsetHeight - offsetypoint + "px";
		}
		else
		{
			tipobj.style.top = curY + offsetypoint + "px";
		}
			
		tipobj.style.visibility = "visible";
	}
}

// Hide Tooltip
function AJAXHideTooltip()
{
	if ((ns6||ie) && (tipobj))
	{
		enabletip = false;
		
		tipobj.style.visibility = "hidden";
		tipobj.style.left = "-1000px";
		tipobj.style.backgroundColor = '';
		tipobj.style.width = '';
	}
}

document.onmousemove = VietAd_PositionTooltip;
function subMenuItemOver(e)
{
	e.className='HomeMenuItem3Hover';
}
function subMenuItemOut(e)
{
	e.className='HomeMenuItem3';
}

/*function showDialog(url)
{
	window.showModalDialog(url,window,"dialogWidth:500px; dialogHeight:400px; center:yes");
}*/


function showSendToFriendDialog(url)
{
	return showDialog(url,450,260);
}

function showDialog(url, width, height)
{
	return showWindow(url, false, false, false, false, false, false, true, true, width, height, 0, 0);
}

function showWindow(url, isStatus, isResizeable, isScrollbars, isToolbar, isLocation, isFullscreen, isTitlebar, isCentered, width, height, top, left)
{
	if (isCentered)
	{
		top = (screen.height - height) / 2;
		left = (screen.width - width) / 2;
	}

	open(url, '_blank', 'status=' + (isStatus ? 'yes' : 'no') + ','
	+ 'resizable=' + (isResizeable ? 'yes' : 'no') + ','
	+ 'scrollbars=' + (isScrollbars ? 'yes' : 'no') + ','
	+ 'toolbar=' + (isToolbar ? 'yes' : 'no') + ','
	+ 'location=' + (isLocation ? 'yes' : 'no') + ','
	+ 'fullscreen=' + (isFullscreen ? 'yes' : 'no') + ','
	+ 'titlebar=' + (isTitlebar ? 'yes' : 'no') + ','
	+ 'height=' + height + ',' + 'width=' + width + ','
	+ 'top=' + top + ',' + 'left=' + left);
}

function writeTime(s)
{
	var mydate=new Date(s)
	
	var year = mydate.getYear()
	if (year < 1000)
		year += 1900
	var month = mydate.getMonth() + 1
	if (month < 10)
		month = "0" + month
	var day = mydate.getDate()
	if (day < 10)
		day = "0" + day

	var dayw = mydate.getDay()
	
	var hour = mydate.getHours()
	if (hour < 10)
		hour = "0" + hour
	
	var minute=mydate.getMinutes()
	if (minute < 10)
		minute = "0" + minute
	var dayarray=new Array("Ch&#7911; Nh&#7853;t","Th&#7913; Hai","Th&#7913; Ba","Th&#7913; T&#432;","Th&#7913; N&#259;m","Th&#7913; S&#225;u","Th&#7913; B&#7843;y")
	document.open();
    document.write (dayarray[dayw]+", "+day+"/"+month+"/"+year+",&nbsp;"+hour+":"+minute+" (GMT+7)");
    document.close();
}

function SetMenu()
{
        href = window.location.href;
        for(i=1;i<15;i++)
        {
            st="";
            if(i < 10)
                st= "0" + i;
            else
                st = i;    
            MenuLink = document.getElementById("Menu" + st);            
            if(MenuLink != null)
            {
                if (href.indexOf(MenuLink.href) >= 0)
                    document.getElementById("Menu" + st).className = "current";
            }
        }
}    

function URLEncode (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return escape(utftext);
}
function ChangeIndexVideoPlayer(path,imagesrc,index,width)
{   
    for(var i=1; i<6; i++)
    {
        if(i==index)
        {
           document.getElementById('media_' + i).style.fontWeight = 'bold'; 
        }
        else
        {
            try
            {
                document.getElementById('media_' + i).style.fontWeight = 'normal';  
            }
            catch(err){}     
        }
    }
    var link = "videoplayer.php?path=" + path + "&imagesrc=" + imagesrc+ "&width=" + width;              
    ajax_loadContent('showVideoPlayer', link);
}

function ChangeIndexSlideShow(index)
{   
    for(var i=1; i<6; i++)
    {
        if(i==index)
        {
           var obj = document.getElementById('slideshow_' + i);
           document.getElementById('picture_' + i).style.fontWeight = 'bold'; 
           
           switch (index)
           {
                case 1: 
                        if (!startSlideShow1)
                            new fadeshow(obj, fadeimages1, 296, 226, 0, 3000, 1);
                        startSlideShow1 = true;
                        break;
                case 2: 
                        if (!startSlideShow2)
                            new fadeshow(obj, fadeimages2, 296, 226, 0, 3000, 1);
                        startSlideShow2 = true;
                        break;
                case 3: 
                        if (!startSlideShow3)
                            new fadeshow(obj, fadeimages3, 296, 226, 0, 3000, 1);
                        startSlideShow3 = true;
                        break;
                case 4: 
                        if (!startSlideShow4)
                            new fadeshow(obj, fadeimages4, 296, 226, 0, 3000, 1);
                        startSlideShow4 = true;
                        break;
                case 5: 
                        if (!startSlideShow5)
                            new fadeshow(obj, fadeimages5, 296, 226, 0, 3000, 1);
                        startSlideShow5 = true;
                        break;
                                
           }
           obj.style.display = 'inline';  
        }
        else
        {
           document.getElementById('picture_' + i).style.fontWeight = 'normal';  
           document.getElementById('slideshow_' + i).style.display = 'none';
        }
    }
}
