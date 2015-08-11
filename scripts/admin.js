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