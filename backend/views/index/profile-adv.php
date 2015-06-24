<?php include_once VIEWSPATH.'inc/header.php' ?>
<style>
.input-group-addon {
    padding: 4px 6px;
    margin: 0 5px;
}
</style>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>">首页</a>
							</li>
							<li class="active">个人资料</li>
						</ul><!-- .breadcrumb -->
                        
						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>
                    
					<div class="page-content">
                        <div class="page-header">
							<h1>
								个人资料<small><i class="icon-double-angle-right"></i> 编辑</small>
							</h1>
						</div>
                        
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<?php echo form_open('ajax/profile_save',array('id'=>'profile_form','class'=>'form-horizontal'));?>
									<div id="user-profile-1" class="user-profile row">
										<div class="col-xs-12 col-sm-3 center">
											<div>
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="Alex's Avatar" src="avatars/profile-pic.jpg" />
												</span>

												<div class="space-4"></div>

												<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
													<div class="inline position-relative">
														<i class="icon-circle light-green middle"></i>
														&nbsp;
														<span class="white"><?php echo $user_info['nickname']; ?></span>
													</div>
												</div>
											</div>
                                            
										</div>

										<div class="col-xs-12 col-sm-9">
                                            <form>
											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> 真实姓名 </div>
													<div class="profile-info-value">
														<span class="editable" id="nickname"><?php echo $user_info['nickname']; ?></span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> 手机号码 </div>
													<div class="profile-info-value">
														<span class="editable" id="mobile"><?php echo $user_info['mobile']; ?></span>
													</div>
												</div>
                                                
												<div class="profile-info-row">
													<div class="profile-info-name"> 生日 </div>
													<div class="profile-info-value">
														<span class="editable" id="birth"></span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> 性别 </div>
													<div class="profile-info-value">
														<span class="editable" id="sex"></span>
													</div>
												</div>
                                                
												<div class="profile-info-row">
													<div class="profile-info-name"> 签名 </div>
													<div class="profile-info-value">
														<span class="editable" id="about"></span>
													</div>
												</div>
											</div>
                                            <input type="file" id="avatar_file" style="display: none;" />
										</div>
									</div>
                                    
                                    <div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button type="button" class="btn btn-info" onclick="ADMIN.ajax_post($('#profile_form'));">
												<i class="icon-ok bigger-110"></i>
												保存
											</button>
										</div>
									</div>
								</form>
                                
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div>
                        
                    </div>
                    
                </div>
<script src="js/x-editable/bootstrap-editable.min.js"></script>
<script src="js/x-editable/ace-editable.min.js"></script>
<script src="js/bootstrap-wysiwyg.min.js"></script>
<script src="js/select2.min.js"></script>
<script type="text/javascript">
$(function() {
	//editables on first profile page
	$.fn.editable.defaults.mode = 'inline';
	$.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>'+
                                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';    
	
	//editables 
    $('#nickname').editable({
		type: 'text',
		name: 'nickname'
    });
    
	$('#mobile').editable({
		type: 'text',
		name: 'mobile'
    });

	$('#birth').editable({
		type: 'date',
		format: 'yyyy-mm-dd',
		viewformat: 'yyyy-mm-dd',
		datepicker: {
			weekStart: 1
		}
	});
    
	$('#about').editable({
        type : 'textarea',
		name : 'about',
		success: function(response, newValue) {
		}
	});
    
    $("#sex").editable({
        type : 'select',
        name : 'sex',
        source: [
            {value: 1, text: '男'},
            {value: 2, text: '女'}
        ],
        showbuttons: false
    });
	
	// *** editable avatar *** //
	try {
        //ie8 throws some harmless exception, so let's catch it
		//it seems that editable plugin calls appendChild, and as Image doesn't have it, it causes errors on IE at unpredicted points
		//so let's have a fake appendChild for it!
        
		if( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ) Image.prototype.appendChild = function(el){}

		var last_gritter
		$('#avatar').editable({
			type: 'image',
			name: 'avatar',
			value: null,
			image: {
				//specify ace file input plugin's options here
				btn_choose: '上传头像',
				droppable: true,
				/**
				//this will override the default before_change that only accepts image files
				before_change: function(files, dropped) {
					return true;
				},
				*/

				//and a few extra ones here
				name: 'avatar',//put the field name here as well, will be used inside the custom plugin
				max_size: 110000,//~100Kb
				on_error : function(code) {//on_error function will be called when the selected file has a problem
					if(last_gritter) $.gritter.remove(last_gritter);
					if(code == 1) {//file format error
						last_gritter = $.gritter.add({
							title: '文件不是图片!',
							text: '头像只能是 jpg|gif|png 图片!',
							class_name: 'gritter-error gritter-center'
						});
					} else if(code == 2) {//file size rror
						last_gritter = $.gritter.add({
							title: '图片太大!',
							text: '图片不要超过 100K!',
							class_name: 'gritter-error gritter-center'
						});
					}
					else {//other error
					}
				},
				on_success : function() {
					$.gritter.removeAll();
				}
			},
		    url: function(params) {
				// ***UPDATE AVATAR HERE*** //
				//You can replace the contents of this function with examples/profile-avatar-update.js for actual upload

				var deferred = new $.Deferred

				//if value is empty, means no valid files were selected
				//but it may still be submitted by the plugin, because "" (empty string) is different from previous non-empty value whatever it was
				//so we return just here to prevent problems
				var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
				if(!value || value.length == 0) {
					deferred.resolve();
					return deferred.promise();
				}
                
                //alert();
                //$('#avatar_file').val($('#avatar').next().find('input[type=file]:eq(0)').val());
                
				//dummy upload
				setTimeout(function(){
					if("FileReader" in window) {
						//for browsers that have a thumbnail of selected image
						var thumb = $('#avatar').next().find('img').data('thumb');
						if(thumb) $('#avatar').get(0).src = thumb;
					}
					
					deferred.resolve({'status':'OK'});

					if(last_gritter) $.gritter.remove(last_gritter);
					last_gritter = $.gritter.add({
						title: '下一步，点击保存!',
						text: '图片上传成功，请点击保存，修改缓存。',
						class_name: 'gritter-info gritter-center'
					});
					
				 } , parseInt(Math.random() * 800 + 800))

				return deferred.promise();
			},
			
			success: function(response, newValue) {
			}
		})
	}catch(e) {}
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>