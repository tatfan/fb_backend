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
                                
                                <?php echo form_open('ajax/pwd_save',array('id'=>'pwd_form','class'=>'form-horizontal'));?>
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 新密码 </label>
										<div class="col-sm-9">
											<input type="password" placeholder="新密码" class="col-sm-5" name="pwd" value="" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 确认密码 </label>
										<div class="col-sm-9">
											<input type="password" placeholder="确认密码" class="col-sm-5" name="confirm" value="" />
										</div>
									</div>
									<div class="space-4"></div>
                                     
                                    <div class="clearfix form-actions">
										<div class="col-md-offset-1 col-md-9">
											<button class="btn btn-primary" type="button" onclick="ADMIN.ajax_post($('#pwd_form'));">
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

<?php include_once VIEWSPATH.'inc/footer.php' ?>