$(function(){
    $(".m-slider, .dmsp, .ads-logo, .dmsp1, .divAds, .ads-floors, .dmsp4-2").on("contextmenu", "img", function(e) {
        return false;
    });
});

$(document).ready(function(){
    $('select.select22').each(function(){
        var title = $(this).attr('title');
        if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
        $(this)
            .css({'z-index':10,'opacity':0,'-khtml-appearance':'none','display':'block'})
            .after('<span class="sp2_select">' + title + '</span>')
            .change(function(){
                var val = $('option:selected',this).text();
                $(this).next().text(val);
            });
    });
});

$('.ipt_s').focus(function(){
    $('.search_top_header').css('box-shadow', '#FF7519 0px 0px 8px');
});

$('.ipt_s').blur(function(){
    $('.search_top_header').css('box-shadow', 'initial');
});

$('#btnSearchTopHeader').click(function(){
    if($('#keyword'). val() == ''){
        alert("Ops! Bạn chưa nhập từ khóa... :-)");
        $('#keyword').focus();
        return false;
    }
});

$('#btnConfirmPopup').click(function(){
    var name = $('#txtNamePopup').val();
    var phone = $('#txtPhonePopup').val();
    var address = $('#txtAddressPopup').val();
    var email = $('#emailPopup').val();
    var idProduct = $("#id").val();
    var amount = $('#qtyPopup').val();
    var unit = $('#hiddenProductPrice').val();
    var idShop = $('#hiddenShopID').val();
    var total = amount*unit;
    var idCustomer = $('#customerID').val();

    if(phone == '' || email == ''){
        alert("Điện thoại và email là các thông tin bắc buộc. Xin vui lòng không được để trống...");
    }
    else if($('#popupAccept').is(':checked') == false){
        alert("Bạn chưa đồng ý với chính sách của chúng tôi...");
    }
    else{
        var dataString = "name="+name+"&phone="+phone+"&address="+address+"&email="+email+"&idProduct="+idProduct+"&amount="+amount+"&unit="+unit
            +"&idShop="+idShop+"&total="+total+"&idCustomer="+idCustomer;
        insertOrder(dataString);
    }
});

function setMoney(){
    var money = $('#qtyPopup').val();
    if(money < 1){
        $('.popup-price').html($('#hiddenProductPrice').val()+' VND');
        $('#qtyPopup').val('1');
    }else{
        money = (money * $('#hiddenProductPrice').val()).toCurrencyString();
        $('.popup-price').html(money + ' VND');
    }
}

Number.prototype.toCurrencyString=function(){
    return this.toFixed(0).replace(/(\d)(?=(\d{3})+\b)/g,'$1,');
}

function setDefault(id){
    if($('#'+id).val() < 1){
        $('#'+id).val(1);
    }
}

function insertOrder(dataString){
    var dataString = dataString+"&functionName="+"insertOrder";
    $.ajax({
        type: "POST",
        url: "lib/functions.php",
        data: dataString,
        success: function(x){
            if(x == 1){
                alert("Cám ơn bạn đã đặt mua. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.");
                window.location.href = "#closed";
            }
            else{
                alert("Lỗi! Xin vui lòng tải lại trang và thử lại...");
            }
        }
    });
}

//dinh dang lai duong dan trang chi tiet
$(function(){
    var length = $('#divProductPag a').length;
    if(length > 0){
        $('.f-sty-P1').trigger('click');
        var link = $('#divProductPag a').attr('href');
        var myArr = link.split("/");
        var filter = parseInt($('#hiddenProductPageFilter').val());
        var pageNum = parseInt($('#hiddenProductPageNum').val());
        if(filter == ''){
            filter = 1;
        }
        var getPage = myArr[2].substr(1, myArr[2].length);
        var linkAfter = "/"+myArr[1]+"?filter1="+filter+"&"+getPage;
        for(var i = 0; i < length - 1; i++){
            $('#divProductPag a:nth-child('+(i+1)+')').attr('href', linkAfter+(i+1));
        }

        $('#divProductPag').find('span').remove();
        var firstPage = "/"+myArr[1]+"?filter1="+filter+"&"+getPage+1;
        var previous = "/"+myArr[1]+"?filter1="+filter+"&"+getPage+(pageNum-1);
        var next = "/"+myArr[1]+"?filter1="+filter+"&"+getPage+(pageNum+1);
        var lastPage = "/"+myArr[1]+"?filter1="+filter+"&"+getPage+(length-1);
        if(pageNum == length - 1){
            next = lastPage;
        }
        if(pageNum-1 == 0){
            previous = "/"+myArr[1]+"?filter1="+filter+"&"+getPage+1;
        }

        $('#divProductPag').prepend("<a href="+firstPage+">1</a>");
        $('#divProductPag').prepend("<a href="+previous+">&lsaquo;</a>");
        $('#divProductPag').prepend("<a href="+firstPage+">&#171;</a>");

        $('#divProductPag a:nth-child('+(length+2)+')').attr('href', next);
        $('#divProductPag a:nth-child('+(length+3)+')').attr('href', lastPage);

        $('#divProductPag a:nth-child('+(pageNum+2)+')').css('color', '#ffffff');
        $('#divProductPag a:nth-child('+(pageNum+2)+')').css('background-color', '#F96D29');
    }
});

//dinh dang lai duong dan trang tim kiem
$(function(){
    var length = $('#divSearchPag a').length;
    if(length > 0){
        $('.f-sty-P1').trigger('click');
        var link = $('#divSearchPag a').attr('href');
        var myArr = link.split("/");
        var page = myArr[5].substr(0,1);
        var pageNum = parseInt($('#hiddenSearchPageNum').val());
        var linkAfter = myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page=";
        for(var i = 0; i < length - 1; i++){
            $('#divSearchPag a:nth-child('+(i+1)+')').attr('href', linkAfter+(i+1));
        }

        $('#divSearchPag').find('span').remove();
        var firstPage = myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page=1";
        var previous =  myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page="+(parseInt(pageNum)-1);
        var next = myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page="+(parseInt(pageNum)+1);
        var lastPage = myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page="+(length-1);
        if(pageNum == length - 1){
            next = lastPage;
        }
        if(pageNum-1 == 0){
            previous = myArr[0]+"/"+myArr[1]+"/"+myArr[2]+"/"+myArr[3].replace("-", "%20")+"html?page=1";
        }

        $('#divSearchPag').prepend("<a href="+firstPage+">1</a>");
        $('#divSearchPag').prepend("<a href="+previous+">&lsaquo;</a>");
        $('#divSearchPag').prepend("<a href="+firstPage+">&#171;</a>");

        $('#divSearchPag a:nth-child('+(length+2)+')').attr('href', next);
        $('#divSearchPag a:nth-child('+(length+3)+')').attr('href', lastPage);

        $('#divSearchPag a:nth-child('+(pageNum+2)+')').css('color', '#ffffff');
        $('#divSearchPag a:nth-child('+(pageNum+2)+')').css('background-color', '#F96D29');
    }
});

$("#popBrandForm").on('submit',function(e) {
    e.preventDefault();
});

$("#popBrandSubmit").click(function(){
    var popBrandName = $("#popBrandName").val();
    var popBrandLink = $("#popBrandLink").val();
    if(popBrandName != '' && popBrandLink != ''){
        var popBrandID = $("#id").val();
        var popBrandBG = $("#popBrandBG").val();
        var popBrandFC = $("#popBrandFC").val();
        var popBrandStyle = popBrandBG+","+popBrandFC;

        var dataString = "popBrandID="+popBrandID+"&popBrandName="+popBrandName+"&popBrandLink="+popBrandLink+"&popBrandStyle="+popBrandStyle+"&functionName="+"updateBrand";
        $.ajax({
            type: "POST",
            url: "lib/functions.php",
            data: dataString,
            success: function(x){
                if(x == 1){
                    alert("Chúc mừng! Bạn đã cập nhật thành công :-)");
                    $('#aBrand').attr("href", popBrandLink);
                    $('#aBrand').attr("title", popBrandName);
                    $('#aBrand').html(popBrandName);
                    $('#divBrand').css("background-color", popBrandBG);
                    $('#aBrand').css("color", popBrandFC);
                    $('#popBrandClose').click();
                }
                else{
                    alert("Lỗi! Xin vui lòng tải lại trang và thử lại...");
                }
            }
        });
    }
});

function lightbox_open(idLight, idFade){
    window.scrollTo(0,0);
    document.getElementById(idLight).style.display='block';
    document.getElementById(idFade).style.display='block';
}

function lightbox_close(idLight, idFade){
    document.getElementById(idLight).style.display='none';
    document.getElementById(idFade).style.display='none';
}

$("#aResend").click(function(){
    openConfirmPopup('<p>Đang kiểm tra thông tin...</p>');
    window.setTimeout(function () {
        var userName = $("#hiddenLoginUserName").val();
        var dataString = "userName="+userName+"&functionName="+"selectUserEmail";
        $.ajax({
            type: "POST",
            url: "lib/functions.php",
            data: dataString,
            success: function(x){
                resendActiveLink(x);
            }
        });
    }, 2000)
});

function resendActiveLink(email){
    openConfirmPopup('<p>Đang xử lý, xin vui lòng chờ...</p>');
    var email = email;
    var dataString = "email="+email;
    $.ajax({
        type: "POST",
        url: "lib/phpmailer/external/register_resend.php",
        data: dataString,
        success: function(x){
            closeConfirmPopup('<p>Hệ thống đã gửi lại đường dẫn kích hoạt qua <b>'+email+'</b>, vui lòng kiểm tra email và làm theo hướng dẫn.</p>');
        }
    });
}

$('#txtFPEmail').keypress(function(e) {
    if (e.which == 13) {
        forgetPassword();
    }
});

$('#btn_doipass').click(function(){
    forgetPassword();
});

function forgetPassword(){
    var email = $("#txtFPEmail").val();
    if(email == ""){
        alert("Bạn chưa nhập email!");
    }
    else if(isValidEmailAddress(email) == false){
        alert("Địa chỉ email bạn vừa nhập không đúng định dạng!");
    }
    else{
        openConfirmPopup('<p>Đang kiểm tra thông tin...</p>');
        window.setTimeout(function () {
            var dataString = "email="+email+"&functionName="+"checkUserEmail";
            $.ajax({
                type: "POST",
                url: "lib/functions.php",
                data: dataString,
                success: function(x){
                    if(x == 2) {
                        closeConfirmPopup('<p>Tài khoản đăng ký qua <b>'+email+'</b> của bạn chưa được kích hoạt.<br/>' +
                        'Vui lòng kiểm tra email và nhấn vào đường dẫn chúng tôi đã gửi cho bạn trong lúc đăng ký.<br/> Hoặc, bạn có thể nhấn <a class="aResendActiveLink" id="aResendFP">vào đây</a> để hệ thống gửi lại đường dẫn kích hoạt cho bạn.</p>');
                        $("#aResendFP").click(function(){
                            resendActiveLink(email);
                        });
                    }else if(x == 1){
                        resendChangePassLink(email);
                    }
                    else{
                        closeConfirmPopup('<p>Hệ thống không thể xác thực được email <b>'+email+'</b> của bạn.<br/> Hãy chắc chắn rằng email này đã được đăng ký!<br/> Vui lòng kiểm tra và thử lại.</p>');
                    }
                }
            });
        }, 2000)
    }
}

function resendChangePassLink(email){
    openConfirmPopup('<p>Đang xử lý, xin vui lòng chờ...</p>');
    var email = email;
    var dataString = "email="+email;
    $.ajax({
        type: "POST",
        url: "lib/phpmailer/external/login_forget.php",
        data: dataString,
        success: function(x){
            closeConfirmPopup('<p>Kiểm tra hộp thư của bạn. Chúng tôi đã gửi cho bạn một đoạn mã với 6 chữ số xác nhận. Nhập nó vào khung bên dưới để tiếp tục cài đặt lại mật khẩu.</p>' +
            '<p><input type="text" class="input-text" placeholder="Nhập mã xác nhận (6 chữ số ######)" id="txtCodeFP"></p>' +
            '<p><span class="error hidden" id="spanInputCodeFP"></span></p>' +
            '<p><span class="button-warning pure-button" onclick="checkCode();">Tiếp tục</span></p>');
        }
    });
}

function checkCode(){
    $("#spanInputCodeFP").addClass("hidden");
    $("#spanInputCodeFP").html("");
    var email = $("#txtFPEmail").val();
    var code = $("#txtCodeFP").val();
    var dataString = "email="+email+"&code="+code+"&functionName="+"checkCodeFP";
    $.ajax({
        type: "POST",
        url: "lib/functions.php",
        data: dataString,
        success: function(x){
            if(x == 0){
                $("#spanInputCodeFP").removeClass("hidden");
                $("#spanInputCodeFP").html("Mã xác nhận không đúng!<br/> Xin vui lòng kiểm tra và thử lại.");
            }
            else{
                openChangePassWordPopup();
            }
        }
    });
}

function openChangePassWordPopup(){
    closeConfirmPopup('<p>Cài đặt Mật khẩu mới</p>' +
    '<p>Mật khẩu mạnh là mật khẩu bao gồm các chữ cái và dấu chấm câu. Nó phải có ít nhất 6 ký tự.<br/>(ví dụ: 4pRte!ai@3)</p>' +
    '<p><input type="password" class="input-text" placeholder="Nhập mật khẩu mới" id="txtPassWordFP" onkeypress="getPassWordStrength();"></p>' +
    '<p><span id="strength_human"></span></p>' +
    '<p><input type="password" class="input-text" placeholder="Xác nhận mật khẩu" id="txtRePassWordFP"></p>' +
    '<p><span class="error hidden" id="spanCheckCodeFP"></span></p>' +
    '<p><span class="button-warning pure-button" onclick="changePassWord();">Đổi mật khẩu</span></p>');
}

function changePassWord(){
    $("#spanCheckCodeFP").addClass("hidden");
    $("#spanCheckCodeFP").html("");
    var passWord = $("#txtPassWordFP").val();
    var rePassWord = $("#txtRePassWordFP").val();
    if(passWord.length < 6){
        $("#spanCheckCodeFP").removeClass("hidden");
        $("#spanCheckCodeFP").html("Mật khẩu phải có ít nhất 6 ký tự!");
    }
    else if(rePassWord == ""){
        $("#spanCheckCodeFP").removeClass("hidden");
        $("#spanCheckCodeFP").html("Bạn chưa xác nhận mật khẩu!");
    }
    else if(rePassWord != passWord){
        $("#spanCheckCodeFP").removeClass("hidden");
        $("#spanCheckCodeFP").html("Mật khẩu xác nhận không khớp!");
    }
    else{
        var email = $("#txtFPEmail").val();
        var isRestorePassWord = parseInt($("#hiddenRestorePassWord").val());
        if(isRestorePassWord == 1){
            email = $("#hiddenCustomerRestoreEmail").val();
        }
        var dataString = "email="+email+"&passWord="+passWord+"&functionName="+"changePassWord";
        $.ajax({
            type: "POST",
            url: "lib/functions.php",
            data: dataString,
            success: function(x){
                if(x == 0){
                    $("#spanCheckCodeFP").removeClass("hidden");
                    $("#spanCheckCodeFP").html("Đã xảy ra lỗi!<br/>Xin vui lòng tải lại trang và thử lại.");
                }else{
                    openConfirmPopup('<p>Đang cập nhật thông tin...</p>');
                    if(isRestorePassWord == 1){
                        var data = "email="+email+"&functionName="+"updateRandomKey";
                        $.ajax({
                            type: "POST",
                            url: "lib/functions.php",
                            data: data,
                            success: function(y){
                                if(y == 0){
                                    $("#spanCheckCodeFP").removeClass("hidden");
                                    $("#spanCheckCodeFP").html("Đã xảy ra lỗi!<br/>Xin vui lòng tải lại trang và thử lại.");
                                }else{
                                    closeConfirmPopup('<p>Khôi phục mật khẩu thành công! <br/>Hệ thống đang chuyển về trang chủ hoặc nhấn <a class="aResendActiveLink" onclick="backHomePage();">vào đây</a></p>');
                                    $('.pCloseConfirm').hide();
                                    window.setTimeout(function () {
                                        location.href = $("#hiddenHomeLink").val();
                                    }, 10000)
                                }
                            }
                        });
                    }
                    else{
                        var data = "email="+email+"&key="+x;
                        $.ajax({
                            type: "POST",
                            url: "lib/phpmailer/external/password_change.php",
                            data: data,
                            success: function(y){
                                closeConfirmPopup('<p>Cài đặt mật khẩu mới thành công! <br/>Hệ thống đang chuyển về trang đăng nhập hoặc nhấn <a class="aResendActiveLink" onclick="backLoginPage();">vào đây</a></p>');
                                $('.pCloseConfirm').hide();
                                window.setTimeout(function () {
                                    location.href = $("#hiddenHomeLink").val()+"/dang-nhap.html";
                                }, 10000)
                            }
                        });
                    }
                }
            }
        });
    }
}

function backLoginPage(){
    var homeLink = $("#hiddenHomeLink").val();
    window.location.href = homeLink+"/dang-nhap.html";
}

function backHomePage(){
    var homeLink = $("#hiddenHomeLink").val();
    window.location.href = homeLink;
}

function getPassWordStrength(){
    var pass = $("#txtPassWordFP").val();
    var strength = checkPassStrength(pass);
    if(strength == ""){
        $("#strength_human").html('<p style="color: orange;">Độ mạnh: '+strength+'</p>');
    }
    if(strength == "yếu"){
        $("#strength_human").html('<p style="color: gray;">Độ mạnh: '+strength+'</p>');
    }
    if(strength == "tốt"){
        $("#strength_human").html('<p style="color: blue;">Độ mạnh: '+strength+'</p>');
    }
    if(strength == "mạnh"){
        $("#strength_human").html('<p style="color: green;">Độ mạnh: '+strength+'</p>');
    }
}

function scorePassword(pass) {
    var score = 0;
    if (!pass)
        return score;

    // award every unique letter until 5 repetitions
    var letters = new Object();
    for (var i=0; i<pass.length; i++) {
        letters[pass[i]] = (letters[pass[i]] || 0) + 1;
        score += 5.0 / letters[pass[i]];
    }

    // bonus points for mixing it up
    var variations = {
        digits: /\d/.test(pass),
        lower: /[a-z]/.test(pass),
        upper: /[A-Z]/.test(pass),
        nonWords: /\W/.test(pass)
    }

    variationCount = 0;
    for (var check in variations) {
        variationCount += (variations[check] == true) ? 1 : 0;
    }
    score += (variationCount - 1) * 10;

    return parseInt(score);
}

function checkPassStrength(pass) {
    var score = scorePassword(pass);
    if (score > 80)
        return "mạnh";
    if (score > 60)
        return "tốt";
    if (score >= 30)
        return "yếu";

    return "";
}

function moveToMainCategory(id, mainCategory){
    window.location.href = "#"+mainCategory;
    var scrollTop = $('#hiddenScrollTop').val();
    if(scrollTop == 0){
        $(window).scrollTop($(window).scrollTop() - 53);
    }
    $('.divMainCategory').css('border-width', '1px');
    $('.divMainCategory').css('border-color', '#DDDDDD');
    $('.divMainCategory').css('border-right', 'none');
    $('.divMainCategory:last-child').css('border-right', '1px solid #DDDDDD');
    $('.divMainCategory:last-child').css('padding-right', '12px');
    $("#"+id).css('border', '2px solid #FF7419');
    $('#hiddenScrollTop').val('1');
}

function scrollTopDesc(){
    var scrollTop = $(window).scrollTop();
    $(window).scrollTop(scrollTop - 64);
}

$(function(){
    var scrollTop = $(window).scrollTop();
    if(scrollTop > 0){
        $('#topcontrol').click();
    }
});

function loadMoreMainSubCategory(id, number){
    var id = id;
    var time = parseInt($("#hiddenMainSubCategoryLoadMore"+number).val());
    var start = time*20;
    var dataString = "id="+id+"&start="+start+"&functionName="+"loadMoreMainSubCategory";
    $.ajax({
        type: "POST",
        url: "lib/functions.php",
        data: dataString,
        success: function(x){
            if(x == 0){
                alert("Đã xảy ra lỗi! \nXin vui lòng tải lại trang và thử lại.");
            }
            else{
                var result = x.split(";");
                for(var i = 0; i < result.length; i++){
                    if(i != result.length - 1){
                        var myArr = result[i].split(",");
                        if(myArr[2] == 0){
                            $('<div class="divMainLastCategoryName"><a href="'+myArr[0]+'.html">'+myArr[1]+'</a> </div>').insertBefore('#divMainSubCategoryName'+number+' input');
                        }
                        else{
                            $('<div class="divMainLastCategoryName"><a target="_blank" href="'+myArr[0]+'.html">'+myArr[1]+'</a> </div>').insertBefore('#divMainSubCategoryName'+number+' input');
                        }

                        var windowSize = $(window).width();
                        if($(window).width() < 992){
                            $('.divMainLastCategoryName').width((windowSize - 20)/2 - 10);
                        }
                        else{
                            $('.divMainLastCategoryName').width(($('.divMainSubCategoryName').width() - 35)/2);
                        }

                    }
                    else{
                        if(result[i] == 0){
                            $('#divMainSubCategoryLoadMore'+number).hide();
                        }
                    }
                }
                $("#hiddenMainSubCategoryLoadMore"+number).val(''+(time+1)+'');
            }
        }
    });
}

$(document).ready(function () {
    $('#fadeandscale').popup({
        pagecontainer: '.container',
        transition: 'all 0.3s'
    });
    $('#basic').popup();
});

$("#aSystemEdit").click(function(){
    setValueSystem();
    $("#popSystemBG").change();
    $("#popSystemFC").change();
});

function setValueSystem(){
    var id = $("#popSystemSelect").val() - 1;
    var name = JSON.parse($("#hiddenSystemName").val());
    var link = JSON.parse($("#hiddenSystemLink").val());
    var backGround = JSON.parse($("#hiddenSystemBackground").val());
    var color = JSON.parse($("#hiddenSystemColor").val());
    var display = JSON.parse($("#hiddenSystemDisplay").val());

    $("#popSystemID").val($("#popSystemSelect").val());
    $("#popSystemName").val(name[id]);
    $("#popSystemLink").val(link[id]);
    $("#popSystemBG").val(backGround[id]);
    $("#popSystemFC").val(color[id]);
    if(display[id] == 1){
        $("#popSystemDisplay").prop("checked", true);
    }
    else{
        $("#popSystemDisplay").prop("checked", false);
    }

    $("#popSystemBG").change();
    $("#popSystemFC").change();
}

$(function(){
    $("#popSystemForm").on('submit',function(e) {
        e.preventDefault();
    });

    $("#popSystemSubmit").click(function(){
        var id = $("#popSystemID").val();
        var name = $("#popSystemName").val();
        var link = $("#popSystemLink").val();
        var backGround = $("#popSystemBG").val();
        var color = $("#popSystemFC").val();
        var display = 1;
        if(!$("#popSystemDisplay").is(":checked")){
            display = 0;
        }
        var dataString = "id="+id+"&name="+name+"&link="+link+"&backGround="+backGround+"&color="+color+"&display="+display+"&functionName="+"updateSystemEdit";
        $.ajax({
            type: "POST",
            url: "lib/functions.php",
            data: dataString,
            success: function(x){
                if(x == 1){
                    alert("Chúc mừng! Bạn đã cập nhật thành công :-)");
                    $.ajax({
                        url: "module/system_edit.php",
                        success: function(y){
                            $("#popSystemContent").html(y);
                            $('#popSystemClose').click();
                        }
                    });
                }
                else{
                    alert("Đã xảy ra lỗi! \nXin vui lòng tải lại trang và thử lại.");
                }
            }
        });
    });
});

function addhttp(id, url) {
    var pattern = /^((http|https):\/\/)/;
    if(!pattern.test(url)) {
        url = "http://" + url.trim();
    }
    $('#'+id).val(url);
}

function openConfirmPopup(message){
    $('.pCloseConfirm').hide();
    $('#divConfirm').html('<img src="../imgs/load.gif"><p');
    $('#divConfirm').append(message);
    lightbox_open('lightConfirm', 'fadeConfirm');
}

function closeConfirmPopup(message){
    $('#divConfirm').html(message);
    $('.pCloseConfirm').show();
}

//------------------------ social functions ------------------------//
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    if (response.status === 'connected') {
        signInFacebook();
    } else if (response.status === 'not_authorized') {
        document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
        document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
}

function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId      : '1460618637571000',
        status     : true,
        cookie     : true,
        xfbml      : true,
        version    : 'v2.3'
    });
};

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=1460618637571000";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function signInFacebook() {
    FB.api('/me', function(response) {
        var name = response.name;
        var id = response.id;
        var email = response.email;
        var gender = 0;
        if(response.gender == "male"){
            gender = 1;
        }
        if(isValidEmailAddress(email) == false){
            email = id;
        }
        var image = "https://graph.facebook.com/"+id+"/picture?type=small";
        var dataString = "name="+name+"&image="+image+"&email="+email+"&gender="+gender+"&id="+id+"&functionName="+"checkLoginSocial";
        ajax(dataString);
    }, { scope: 'public_profile,email' });
}

!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');

function onSignIn(googleUser) {
    var isLogin = $('#hiddenSocialLogin').val();
    if(isLogin == 1){
        var profile = googleUser.getBasicProfile();
        var id = profile.getId();
        var name = profile.getName();
        var image = profile.getImageUrl();
        var email = profile.getEmail();
        var dataString = "name="+name+"&image="+image+"&email="+email+"&id="+id+"&functionName="+"checkLoginSocial";
        ajax(dataString);
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
        });
    }
}

function ajax(dataString){
    var dataString = dataString;
    $.ajax({
        type: "POST",
        url: "lib/functions.php",
        data: dataString,
        success: function(x){
            if(x == 1){
                var homeLink = $("#hiddenHomeLink").val();
                window.location.href = homeLink+"/dang-ky-gian-hang.html";
            }
            else{
                alert("Đã xảy ra lỗi! \nXin vui lòng tải lại trang và thử lại.");
            }
        }
    });
}

window.onload = function(){
    $(".abcRioButtonContents span").html("Log In");
}

function isValidEmailAddress(emailAddress) {
    var regex = /\S+@\S+\.\S+/;
    return regex.test(emailAddress);
}
