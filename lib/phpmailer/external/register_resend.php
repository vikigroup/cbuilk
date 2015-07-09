<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
require("../../../config.php");
require("../../../common_start.php");
include("../../../lib/func.lib.php");

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once('../class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();
$mail->CharSet = "UTF-8";
$row_config   = getRecord('tbl_config', "id='2'");
$row_customer   = getRecord('tbl_customer', "email=".$_POST['email']);

$body = '<div class="container-fluid" style="background: #8DCAE9; padding: 5px; border-radius: 8px;">
            <div style="background-color: #ffffff; color: #355F77; padding: 20px; border-radius: 8px;">
                <div class="row" style="font-size: 24px; font-weight: bold; margin-bottom: 20px; text-transform: uppercase;">
                    <p class="btn btn-info"><b>Thông báo kích hoạt lại tài khoản</b></p>
                </div>
                <div class="row" style="margin: 5px;">
                    <img src="'.$root.'/imgs/layout/logo.png" alt="" width="190" height="80">
                    <p>Xin chào '.$row_customer['name'].',</p>
                </div>
                <p>Chúng tôi nhận được yêu cầu kích hoạt lại tài khoản đăng ký thành viên trên hệ thống '.strtoupper($subname).'</p>
                <p><b>Xin vui lòng <a href="'.$root.'/kich-hoat.html?key='.$row_customer['randomkey'].'">[nhấn vào đây]</a> để hoàn thành thủ tục này.</b></p>
                <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.</p>
                <p>Trân trọng,</p>
            </div>
            <p>--</p>
            <p>
                <span><b>'.$row_config['tenkh'].'</b></span><br/>
                <span>'.$row_config['dckh'].'</span><br/>
                <span>Điện thoại: '.$row_config['dtkh'].'</span><br/>
                <span>Trang chủ: '.$root.'</span><br/>
            </p>
        </div>';

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "ssl://smtp.googlemail.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
// 1 = errors and messages
// 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "ssl://smtp.googlemail.com"; // sets the SMTP server
$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
$mail->Username   = "vikigroup2015@gmail.com"; // SMTP account username
$mail->Password   = "Vk03062015";        // SMTP account password

$mail->SetFrom($row_config['cauhinh_mail_ten'], strtoupper($row_config['copyright']));

$mail->Subject    = "Yêu cầu kích hoạt tài khoản trên hệ thống ".$sub;

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$mail->AddAddress($_POST['email'], $row_customer['name']);

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

require("../../../common_end.php");

?>

