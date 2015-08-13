function emptySessionCategory(action){
    var action = action;
    var dataString = "functionName="+"emptySessionCategory";
    $.ajax({
        type: "POST",
        url: "../lib/functions.php",
        data: dataString,
        success: function(x){
            window.location.href = "admin.php?act="+action;
        }
    });
}

function limitChars(textid, limit, infodiv) {
    var text = $('#'+textid).val();
    var textlength = text.length;
    if(textlength > limit) {
        $('#' + infodiv).html('You cannot write more then '+limit+' characters!');
        $('#'+textid).val(text.substr(0,limit));
        return false;
    }
    else {
        $('#' + infodiv).val(limit - textlength);
        return true;
    }
}

function optimizeSubjectLink(id, idHidden){
    var subject = $("#"+id).val().trim();
    var dataString = "string="+subject+"&functionName="+"removeUnicode";
    $.ajax({
        type: "POST",
        url: "../lib/functions.php",
        data: dataString,
        success: function(x){
            var subjectAfter = x.toLowerCase().replace(/ /g, "-");
            $("#"+id).val(subjectAfter);
            $("#"+idHidden).val(subjectAfter);
        }
    });
}

function positionSelector(selector){
    $("#slPageCreateAdminBanner option").remove();
    if(selector == 0){
        $("#slPageCreateAdminBanner").append("<option value='0'>TOP (190x330)</option>");
        for(var i = 1; i <= 12; i++){
            $("#slPageCreateAdminBanner").append("<option value='"+i+"'>"+i+"C (187x67)</option>");
        }
    }
    if(selector == 1){
        for(var j = 1; j <= 4; j++){
            $("#slPageCreateAdminBanner").append("<option value='"+(j+12)+"'>TOP - HÀNG "+j+" (90x45)</option>");
        }

        for(var i = 1; i <= 12; i++){
            $("#slPageCreateAdminBanner").append("<option value='"+i+"'>"+i+"C (390x420)</option>");
        }
    }
    if(selector == 2){
        for(var i = 1; i <= 12; i++){
            $("#slPageCreateAdminBanner").append("<option value='"+i+"'>"+i+"C (1210x60)</option>");
        }
    }
    if(selector == 3){
        $("#slPageCreateAdminBanner").append("<option value='0'>TOP (190x330)</option>");
    }
}

function addhttp(id, url) {
    var pattern = /^((http|https):\/\/)/;
    if(!pattern.test(url)) {
        url = "http://" + url;
    }
    $('#'+id).val(url);
}