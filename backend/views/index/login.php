<!DOCTYPE HTML>
<html>

<head>
<meta charset="utf-8" />
<base href="/public/admin/" />
<meta name="renderer" content="webkit" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="blank" />
<meta name="format-detection" content="telephone=no" />
<title>ADMIN后台管理系统</title>

<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />
<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="css/login.css" />

<script src="js/jquery-2.0.3.min.js"></script>
<script src="js/jquery.form.js"></script>
</head>

<body>
<div class="aw-login">
    <div class="mod center-block">
        <h1><img alt="" src="images/logo.png" /></h1>
        <?php echo form_open('ajax/login',array('id'=>'login_form'));?>

            <div class="alert alert-danger hide error_message" id="error_message"></div>

            <div class="form-group">
                <label>账户</label>
                <input type="text" class="form-control" placeholder="账户" value="" name="user" />
                <i class="icon icon-user"></i>
            </div>
            <div class="form-group">
                <label>密码</label>
                <input type="password" class="form-control" placeholder="密码" type="password" name="password" />
                <i class="icon icon-lock"></i>
            </div>
            <div class="form-group">
                <label>验证码</label>
                <input type="text" class="form-control" placeholder="验证码" value="" style="width: 50%;" maxlength="5" name="captcha" />
                <i class="icon icon-exclamation-sign"></i>
                <img id="captcha" class="captcha" src="<?php echo ADMINURL ?>index/captcha" />
            </div>
            <button type="button" class="btn btn-primary" id="login_submit">登录</button>
        </form>

        <h2 class="text-center text-color-999">CMS Admin Control</h2>
    </div>
</div>
<script>
$(function(){
    $('#login_submit').click(function(){
       $('#login_form').ajaxSubmit({
            dataType: 'json',
            success: function (result)
            {
                if(result.status=='success'){
                    location.href = '<?php echo ADMINURL ?>';
                }else if(result.status=='error'){
                    $('#error_message').html(result.msg).removeClass('hide');
                }
            },
            error: function (error)
            {
                if ($.trim(error.responseText) != '')
                {
                    //alert(error.responseText);
                    console.log(error.responseText);
                }
            }
        });
        return false; 
    });
});
</script>