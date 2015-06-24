<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>setting"><?php echo lang('setting'); ?></a></li>
							<li class="active">邮件设置</li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('setting'); ?><small><i class="icon-double-angle-right"></i> 邮件设置</small>
							</h1>
						</div>
                    
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                <?php echo form_open('ajax/setting_email_save',array('id'=>'setting_form','class'=>'form-horizontal'));?>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> SMTP 服务器 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="Example：smtp.qq.com" class="col-sm-5" name="server" value="<?php echo $email['server'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> 使用安全链接(SSL) </label>
										<div class="col-sm-9">
											<label>
												<input name="ssl" class="ace ace-switch ace-switch-7" type="checkbox" value="1" <?php echo $email['ssl']?'checked':''; ?> />
												<span class="lbl"></span>
											</label>
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> SMTP 端口 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="25" class="col-sm-1" name="port" value="<?php echo $email['port'] ?>" />
                                            <span class="col-sm-10 help-block">留空时默认服务器端口为 25，使用 SSL 协议默认端口为 465，详细参数请询问邮箱服务商</span>
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> 帐户 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="Example：admin@qq.com" class="col-sm-5" name="username" value="<?php echo $email['username'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> 密码 </label>
										<div class="col-sm-9">
											<input type="password" placeholder="SMTP 帐户密码" class="col-sm-5" name="password" value="<?php echo $email['password'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> 邮件显示名称 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="Example：Admin" class="col-sm-5" name="from" value="<?php echo $email['from'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="clearfix form-actions">
										<div class="col-md-offset-2 col-md-9">
											<button class="btn btn-primary" type="button" onclick="ADMIN.ajax_post($('#setting_form'));">
												<i class="icon-ok bigger-110"></i>
                                                <?php echo lang('btn_save'); ?>
											</button>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a class="btn btn-success" id="check_config">
												<i class="icon-envelope"></i>
												测试邮件设置
											</a>
										</div>
									</div>
                                
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
<script>
$(function(){
    $('#check_config').click(function(){
        bootbox.prompt("填写收件人地址：", function(result) {
			if(result){
                $.post("<?php echo ADMINURL ?>ajax/check_email_config/",
                    {
                        csrf_wy_admin_token: $.cookie('csrf_wy_admin_cookie'),
                        touser: result
                    },
                    function (result){
                        if(result==1){
                            ADMIN.show_message('邮件发送成功,请前往邮箱检查结果.', 'success', 2000);
                        }else{
                            ADMIN.show_message(result, 'error', 3000);
                        }
                    });
			}
		});
        return false;
    });
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>