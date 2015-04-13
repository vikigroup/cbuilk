function addAD(list, index, frame, source, link, tooltip, target)
{
    if(!list)
		list = new Array();
    if(!list[index]) list[index] = new Array();
    var newAd = new Object();
    newAd.source = source;
    newAd.link = link;
    newAd.tooltip = tooltip;
    newAd.target = target;
    list[index][frame] = newAd;
}

function showAd(list, id)
{
    if(document.body.clientWidth < 1000) return;
    var html = "";
    var adHTML = "<a href=\"{link}\" target='{target}' title='{tooltip}'><img src='{source}' alt='' style='border: none'/>";
    
    html += "<table border='0' cellpadding='0' cellspacing='0'>";
    for(var i in list)
    {
        html += "<tr><td style='border: 1px solid #ccc;'>";
        for(var j in list[i])
        {
            var ad = list[i][j];
            html += adHTML.replace("{link}", (ad.link)).replace("{target}", ad.target).replace("{source}", ad.source).replace("{tooltip}", ad.tooltip);
        }
        html += "</td></tr>";
    }
    html += "</table>";
    var divAd = document.createElement("DIV");
    divAd.style.position = "absolute";
    divAd.id = id;
    divAd.innerHTML = html;
    document.body.appendChild(divAd);
    return divAd;
}

function initAd(container)
{
    container.style.top = 0;
    container.style.display = "none";
}

function scrollAd()
{
	var floatLeft, floatRight;
	var scrollTop;
	var offsetLeft;
	var theWidth;
	var centerX = document.body.clientWidth / 2;
	
	floatLeft = window.floatLeft;
	floatRight = window.floatRight;
	
	floatLeft.style.display = "";
	floatRight.style.display = "";
	
	floatLeft.style.left = centerX - (980 / 2) - floatLeft.offsetWidth - 2+'px';
	floatRight.style.left = centerX + (980 / 2) + 2+'px';
	var offset;
	var pixelAmount;
	if (window.pageYOffset)
		scrollTop = window.pageYOffset
	else if (document.documentElement && document.documentElement.scrollTop)
		scrollTop = document.documentElement.scrollTop
	else if (document.body)
		scrollTop = document.body.scrollTop
	if(scrollTop < minTop) scrollTop = minTop;
	offset = scrollTop - parseInt(floatLeft.style.top);

	pixelAmount = Math.round(Math.abs(offset) / 8);

	if(offset < 0)
	{
		if(parseInt(floatLeft.style.top) - pixelAmount > scrollTop)
		{
			floatLeft.style.top = parseInt(floatLeft.style.top) - pixelAmount+'px';
			floatRight.style.top = parseInt(floatRight.style.top) - pixelAmount+'px';
		}
		else
		{
			floatLeft.style.top = scrollTop+'px';
			floatRight.style.top = scrollTop+'px';
		}
	}
	if(offset > 0)
	{
		if(parseInt(floatLeft.style.top) + pixelAmount < scrollTop)
		{
			floatLeft.style.top = parseInt(floatLeft.style.top) + pixelAmount+'px';
			floatRight.style.top = parseInt(floatRight.style.top) + pixelAmount+'px';
		}
		else
		{
			floatLeft.style.top = scrollTop+'px';
			floatRight.style.top = scrollTop+'px';
		}
	}
}

function startScroll()
{
    if(document.body.clienWidth < 1000) return;
    if(window.floatLeft == null && window.floatRight == null) return;
    window.setInterval("scrollAd()", delayTime);
}