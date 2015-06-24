<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>weixin"><?php echo lang('weixin'); ?></a></li>
							<li class="active"><?php echo lang('setting'); ?></li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('weixin'); ?><small><i class="icon-double-angle-right"></i> <?php echo lang('setting'); ?></small>
							</h1>
						</div>
                        
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                <?php echo form_open('weixin/settings_save',array('id'=>'weixin_settings_form','class'=>'form-horizontal'));?>
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> App ID </label>
										<div class="col-sm-9">
											<input type="text" placeholder="App ID" class="col-sm-5" name="data[appid]" value="<?php echo $data['appid'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> App Secret </label>
										<div class="col-sm-9">
											<input type="text" placeholder="App Secret" class="col-sm-5" name="data[appsecret]" value="<?php echo $data['appsecret'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> Token </label>
										<div class="col-sm-9">
											<input type="text" placeholder="Token" class="col-sm-5" name="data[token]" value="<?php echo $data['token'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> 关注欢迎语 </label>
										<div class="col-sm-9">
                                            <textarea id="form-field-8" class="col-sm-5" placeholder="关注欢迎语"><?php echo $data['welcome'] ?></textarea>
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> 无结果时提示语 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="无结果时提示语" class="col-sm-5" name="data[noresult]" value="<?php echo $data['noresult'] ?>" autocomplete="off" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> 图文消息默认缩略图 </label>
										<?php if($data['thumb']){ ?>
                                        <span class="col-sm-9" id="thumb_pic">
                                            <button class="btn btn-sm btn-warning" type="button" id="reset_thumb">
												<i class="icon-undo"></i> 重新上传
											</button>
                                            <br />
                                            <img src="<?php echo "/public/uploads/weixin/{$data['thumb']}?".time(); ?>" style="max-width: 100%; margin-top: 10px" />
                                        </span>
                                        <?php } ?>
										<div class="col-sm-4" id="upload_thumb" <?php if($data['thumb']) echo 'style="display:none;"' ?>>
											<input id="id-input-file" type="file" name="thumb" />
                                            <span class="help-block">格式仅限 JPG 文件，文件小于2M</span>
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> Access_Token </label>
                                        <label class="col-sm-10 grey"><?php echo $data['access_token'] ?></label>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="clearfix form-actions">
										<div class="col-md-offset-2 col-md-9">
											<button class="btn btn-primary" type="button" onclick="ADMIN.ajax_post($('#weixin_settings_form'));">
												<i class="icon-ok bigger-110"></i>
												<?php echo lang('btn_save'); ?>
											</button>
										</div>
									</div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
<script>
$(function(){
    $('#id-input-file').ace_file_input({
		no_file:'No File ...',
		btn_choose:'Choose',
		btn_change:'Choose',
		droppable:false,
		onchange:null,
		thumbnail:true, //| true | large
		whitelist:'jpg',
		blacklist:'exe|php'
		//onchange:''
		//
	});
    
    $('#reset_thumb').click(function(){
        $('#upload_thumb').show();
        $('#thumb_pic').hide();
        return false;
    });
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>