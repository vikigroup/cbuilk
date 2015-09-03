function emptySessionCategory(action){
    //action: trang yêu cầu
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
    //textid: id của thẻ input nhập mô tả trang
    //limit: số ký tự giới hạn nhập
    //infodiv: trả về thông tin khi thực hiện thao tác nhập (số ký tự còn lại)
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
    //id: id của thẻ input nhập giá trị link danh mục VN
    //idHidden: id của thẻ hidden lưu giá trị link danh mục VN
    var subject = optimizePostLink($("#"+id).val().trim().toLowerCase()).replace(/ /g, "-");
    var dataString = "string="+subject+"&functionName="+"removeUnicode";
    $.ajax({
        type: "POST",
        url: "../lib/functions.php",
        data: dataString,
        success: function(x){
            $("#"+id).val(x);
            $("#"+idHidden).val(x);
        }
    });
}

function removeStartWith(id, string){
    //id: id của thẻ input nhập tiêu đề trang
    //strng: giá trị thẻ input nhập tiêu đề trang
    var string = string;
    var str = string.trim();
    var start = str.substr(0, 1).replace(/["]/g, '');
    var rest = str.substr(1, str.length - 2);
    var end = str.substr(str.length - 1, 1).replace(/["]/g, '');
    $("#"+id).val(start+rest+end);
}

function optimizePostLink(string){
    return string.trim().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/g, '');
}

function setTimePost(idSelector, idDisplay, idSetTime, idHiddenStatus){
    //idSelector: id thẻ checkbox thực hiện sự kiện click
    //idDisplay: id thẻ checkbox lưu giá trị trạng thái bài viết (Ẩn/Hiện)
    //idSetTime: id thẻ <tr> dùng thực hiện ẩn/hiện khung cài đặt thời gian post bài
    //idHiddenStatus: id thẻ hidden lưu giá trị trạng thái cũ của bài viết (Ẩn/Hiện)
    var check = $("#"+idSelector).val();
    if(check == 0){
        if(!$("#"+idDisplay).is(":checked")){
            $("#"+idDisplay).prop("checked", true);
            $("#"+idDisplay).val('1');
        }
        $("#"+idDisplay).attr("disabled", true);
        $("#"+idSetTime).show();
        $("#"+idSelector).val('1');
    }
    else{
        if($("#"+idHiddenStatus).val() == 0){
            $("#"+idDisplay).prop("checked", false);
            $("#"+idDisplay).val('0');
        }
        $("#"+idDisplay).attr("disabled", false);
        $("#"+idSetTime).hide();
        $("#"+idSelector).val('0');
    }
}

function checkPostStyle(style){
    var myArr = new Array('1', '3');
    if(myArr.indexOf(style) == -1){
        $(".trPrice").show();
    }
    else{
        $(".trPrice").hide();
    }
}

function moneyString(id, div){
    var n = parseInt($('#'+id).val());
    var unit = $('#slCurrency option:selected').html();
    if(isNaN(n)){
        n = 0;
    }
    $('#'+div).html("<b>"+ n.toLocaleString() + " "+unit+"</b>");
}

function checkPermission(){
    var chosenPermiss = ""; //tạo chuỗi, insert vào bảng tbl_permiss
    var chosenCrud = ""; //tạo chuỗi, insert vào bảng tbl_crud
    var count = 0; //biến đếm số checkbox được chọn (thêm, sửa, xóa)
    for(var i = 1; i <= 31; i++){
        if($('#chkCreate'+i).is(':checked') == true || $('#chkUpdate'+i).is(':checked') == true || $('#chkDelete'+i).is(':checked') == true){
            var isCreate = $('#chkCreate'+i).is(':checked') == true ? 1 : 0;
            if(isCreate == 1){
                count++;
            }

            var isUpdate = $('#chkUpdate'+i).is(':checked') == true ? 1 : 0;
            if(isUpdate == 1){
                count++;
            }

            var isDelete = $('#chkDelete'+i).is(':checked') == true ? 1 : 0;
            if(isDelete == 1){
                count++;
            }

            if(count == 3){
                chosenPermiss += $('#hiddenPermissId'+i).val()+",";
            }
            else{ //khi có 1 trong 3 chức năng (thêm, sửa, xóa) không được active thì mới tạo chuỗi, thêm vào bảng tbl_crud
                chosenPermiss += $('#hiddenPermissId'+i).val()+",";
                chosenCrud += $('#hiddenPermissId'+i).val()+","+isCreate+","+isUpdate+","+isDelete+";";
            }
            count = 0;
        }
    }
    chosenPermiss = chosenPermiss.substring(0, chosenPermiss.length - 1);
    chosenCrud = chosenCrud.substring(0, chosenCrud.length - 1);
    $("#hiddenChosenPermiss").val(chosenPermiss);
    $("#hiddenChosenCrud").val(chosenCrud);
    return true; //thực hiện submit form
}

function setAllPermission(option){
    if(option == 0){
        var isCheckAll = $('#hiddenAllPermiss').val();
        if(isCheckAll == 0){
            $('input[type=checkbox]').prop('checked', true);
            $('#hiddenAllPermiss').val('1');
            $('#chkAllPermiss').prop('title', 'Nhấn để cài đặt về mặc định');
        }
        else{
            $('#reset').click();
            $('#hiddenAllPermiss').val('0');
            $('#chkAllPermiss').prop('title', 'Nhấn để cấp tất cả quyền cho thành viên này');
        }
    }
    else if(option == 1){
        var isCreateAll = $('#hiddenAllCreatePermiss').val();
        setCrudPermission(isCreateAll, 1);
    }
    else if(option == 2){
        var isUpdateAll = $('#hiddenAllUpdatePermiss').val();
        setCrudPermission(isUpdateAll, 2);
    }
    else{
        var isDeleteAll = $('#hiddenAllDeletePermiss').val();
        setCrudPermission(isDeleteAll, 3);
    }
}

function setCrudPermission(isCheck, crud){
    var string = "Create";
    var title = "thêm mới";
    if(crud == 2){
        string = "Update";
        title = "chỉnh sửa";
    }
    else if(crud == 3){
        string = "Delete";
        title = "xóa";
    }

    for(var i = 1; i <= 31; i++){
        if(isCheck == 0){
            $('#chk'+string+i).prop('checked', true);
        }
        else{
            $('#chk'+string+i).each(function(i,item){
                this.checked = item.defaultChecked; //cài đặt checkbox về trạng thái ban đầu
            });
        }
    }

    if(isCheck == 0){
        $('#hiddenAll'+string+'Permiss').val('1');
        $('#chkAll'+string+'Permiss').prop('title', 'Nhấn để cài đặt về mặc định');
    }
    else{
        $('#hiddenAll'+string+'Permiss').val('0');
        $('#chkAll'+string+'Permiss').prop('title', 'Nhấn để cấp quyền '+title+' cho thành viên này ở tất cả các trang quản trị');
    }
}

function positionSelector(selector){
    //selector: vị trí quảng cáo
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
    //id: id của thẻ input nhập liên kết ngoài
    //url: giá trị thẻ input nhập liên kết ngoài
    var pattern = /^((http|https):\/\/)/;
    if(!pattern.test(url)) {
        url = "http://" + url.trim();
    }
    $('#'+id).val(url);
}

function validate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
}

function isValidEmailAddress(emailAddress) {
    var regex = /^\S+@\S+\.\S+$/;
    return regex.test(emailAddress);
}

function isValidPhoneNumber(txtPhone) {
    var pattern = /^[0-9]{10,11}$/;
    return pattern.test(txtPhone);
}

function isValidIdNumber(txtIdNumber) {
    var pattern = /^[0-9]{9,12}$/;
    return pattern.test(txtIdNumber);
}

function removeUnicode(str) {
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    return str;
}

var popupWindow = null;
function positionedPopup(url,winName,w,h,t,l,scroll){
    settings = 'height='+h+',width='+w+',top='+t+',left='+l+',scrollbars='+scroll+',resizable';
    popupWindow = window.open(url,winName,settings);
}