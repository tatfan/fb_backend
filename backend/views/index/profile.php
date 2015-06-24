<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li class="active">个人资料</li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('nav_home'); ?><small><i class="icon-double-angle-right"></i> 个人资料</small>
							</h1>
						</div>
                    
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                <?php echo form_open('ajax/profile_save',array('id'=>'profile_form','class'=>'form-horizontal'));?>
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 用户名 </label>
                                        <label class="col-sm-10 grey"><?php echo $admin['username'] ?></label>
									</div>
                                    <div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 真实姓名 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="真实姓名" class="col-sm-5" name="nickname" value="<?php echo $admin['nickname'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 邮箱 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="邮箱" class="col-sm-5" name="email" value="<?php echo $admin['email'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 联系电话 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="联系电话" class="col-sm-5" name="tel" value="<?php echo $admin['tel'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 头像 </label>
										<div class="col-sm-9 avatar_list">
											<?php foreach($avatars as $row){ $class = $admin['avatar']==$row['name']?'active':'';
											 echo '<img src="avatars/'.$row['name'].'" class="'.$class.'" data="'.$row['name'].'" />';
											} ?>
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <input type="hidden" id="user_avatar" name="avatar" value="<?php echo $admin['avatar'] ?>" />
                                    <div class="clearfix form-actions">
										<div class="col-md-offset-1 col-md-9">
											<button class="btn btn-primary" type="button" onclick="ADMIN.ajax_post($('#profile_form'));">
												<i class="icon-ok bigger-110"></i>
												<?php echo lang('btn_submit'); ?>
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
    $('.avatar_list img').click(function(){
        $(this).addClass('active');
        $(this).siblings('img').removeClass('active');
        $('#user_avatar').val($(this).attr('data'));
    });
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>