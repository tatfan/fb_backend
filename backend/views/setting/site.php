<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>setting"><?php echo lang('setting'); ?></a></li>
							<li class="active"><?php echo lang('setting_site'); ?></li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('setting'); ?><small><i class="icon-double-angle-right"></i> <?php echo lang('setting_site'); ?></small>
							</h1>
						</div>
                    
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                <?php echo form_open('ajax/setting_save',array('id'=>'setting_form','class'=>'form-horizontal'));?>
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> <?php echo $setting_lang['site_name'] ?> </label>
										<div class="col-sm-9">
											<input type="text" placeholder="<?php echo $setting_lang['site_name'] ?>" class="col-sm-5" name="site_name" value="<?php echo $setting['site_name'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> <?php echo $setting_lang['description'] ?> </label>
										<div class="col-sm-9">
											<input type="text" placeholder="<?php echo $setting_lang['description'] ?>" class="col-sm-5" name="description" value="<?php echo $setting['description'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> <?php echo $setting_lang['keywords'] ?> </label>
										<div class="col-sm-9">
											<input type="text" placeholder="<?php echo $setting_lang['keywords'] ?>" class="col-sm-5" name="keywords" value="<?php echo $setting['keywords'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> <?php echo $setting_lang['icp_beian'] ?> </label>
										<div class="col-sm-9">
											<input type="text" placeholder="<?php echo $setting_lang['icp_beian'] ?>" class="col-sm-5" name="icp_beian" value="<?php echo $setting['icp_beian'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <input type="hidden" name="position" value="site" />
                                    <div class="clearfix form-actions">
										<div class="col-md-offset-2 col-md-9">
											<button class="btn btn-primary" type="button" onclick="ADMIN.ajax_post($('#setting_form'));">
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

<?php include_once VIEWSPATH.'inc/footer.php' ?>