// JavaScript Document

  /***********************************************
        * Disable Text Selection script- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
        * This notice MUST stay intact for legal use
        * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
        ***********************************************/

        function disableSelection(target)
        {
        if (typeof target.onselectstart!="undefined") //IE route
	        target.onselectstart=function(){return false}
        else if (typeof target.style.MozUserSelect!="undefined") //Firefox route
	        target.style.MozUserSelect="none"
        else //All other route (ie: Opera)
	        target.onmousedown=function(){return false}
        target.style.cursor = "default"
        }
        //Sample usages
        // phan nay phai nam cuoi trang or cuoi div
        //disableSelection(document.getElementById("mydiv")) //Disable text selection on entire body
        //disableSelection(document.getElementById("mydiv")) //Disable text selection on element with id="mydiv"
        
     
      function disableRightClick(e)
        {
            if(!document.rightClickDisabled) // initialize
            {
                if(document.layers)
                {
                    document.captureEvents(Event.MOUSEDOWN);
                    document.onmousedown = disableRightClick;
                }
                else document.oncontextmenu = disableRightClick;
                return document.rightClickDisabled = true;
            }
            if(document.layers || (document.getElementById && !document.all))
            {
                if (e.which==2||e.which==3)
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        disableRightClick();