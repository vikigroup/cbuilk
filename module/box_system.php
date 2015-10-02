<div class="mini-bar">
    <?php if($_SESSION['kt_login_level'] == 3 || $_SESSION['kt_login_level'] == -1){ ?>
        <div class="mini-shopping">
            <a id="aSystemEdit" href="#basic" class="initialism basic_open pure-button-primary pure-button" title="Chỉnh sửa hệ thống">
                <p><i class="fa fa-pencil"></i></p>
            </a>
        </div>
    <?php } ?>
    <div class="mini-shopping">
        <a href="#" onclick="alert('Chức năng hiện đang được hoàn thiện...');">
            <p><i class="fa fa-shopping-cart fa-lg"></i></p>
            <p>Giỏ hàng</p>
        </a>
    </div>
</div>

<?php if($_SESSION['kt_login_level'] == 3 || $_SESSION['kt_login_level'] == -1){ ?>
    <div id="basic" class="well">
        <h4>Chỉnh sửa hệ thống</h4>
        <form class="pure-form pure-form-aligned" id="popSystemForm">
            <fieldset>
                <div class="pure-control-group" id="popSystemContent">
                    <?php include("system_edit.php"); ?>
                </div>
                <input type="hidden" id="popSystemID">
                <div class="pure-control-group">
                    <label for="popSystemName" class="button-secondary">Tên thay thế</label>
                    <input id="popSystemName" type="text" required>
                </div>
                <div class="pure-control-group">
                    <label for="popSystemLink" class="button-secondary">Đường dẫn</label>
                    <input id="popSystemLink" type="text" required onchange="addhttp(this.id, this.value);">
                </div>
                <div class="pure-control-group">
                    <label for="popSystemBG" class="button-secondary">Màu nền</label>
                    <input type="text" id="popSystemBG" onchange="$('#popSystemColorBG').val($('#popSystemBG').val());"/>
                    <input type="color" id="popSystemColorBG" onchange="$('#popSystemBG').val(this.value);">
                </div>
                <div class="pure-control-group">
                    <label for="popSystemFC" class="button-secondary">Màu chữ</label>
                    <input type="text" id="popSystemFC" onchange="$('#popSystemColorFC').val($('#popSystemFC').val());"/>
                    <input type="color" id="popSystemColorFC" onchange="$('#popSystemFC').val(this.value);">
                </div>
                <div class="pure-control-group">
                    <label for="popSystemDisplay" class="button-secondary btn-float-left">Hiển thị</label>
                    <div class="container">
                        <label class="switch switch-green">
                            <input id="popSystemDisplay" type="checkbox" class="switch-input">
                            <span class="switch-label" data-on="On" data-off="Off"></span>
                            <span class="switch-handle"></span>
                        </label>
                    </div>
                </div>
            </fieldset>
            <button type="submit" class="button-success pure-button" id="popSystemSubmit">Hoàn tất</button>
            <button class="basic_close button-error pure-button" id="popSystemClose">Đóng</button>
        </form>
    </div>
<?php } ?>

<div class="light" id="lightConfirm">
    <div class="lightTitle">
        <p class="pTitle">THÔNG BÁO</p>
        <div id="divConfirm"></div>
    </div>
    <p class="pCloseConfirm" onclick='lightbox_close("lightConfirm", "fadeConfirm");'>Đóng cửa sổ</p>
</div>
<div class="fade" id="fadeConfirm"></div>
<div class="clear"></div>

<div id="fb-root"></div>
<div id="closed"></div>
<input type="hidden" id="hiddenHomeLink" value="<?php echo $root; ?>">

