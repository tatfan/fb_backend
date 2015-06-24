<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>setting"><?php echo lang('setting'); ?></a></li>
							<li class="active">站点访问</li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('setting'); ?><small><i class="icon-double-angle-right"></i> 站点访问</small>
							</h1>
						</div>
                    
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                <?php echo form_open('ajax/setting_save',array('id'=>'setting_form','class'=>'form-horizontal'));?>
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> <?php echo $setting_lang['site_close'] ?> </label>
										<div class="col-sm-9">
											<label>
												<input type="radio" class="ace" name="site_close" value="Y" <?php echo $setting['site_close']=='Y'?'checked':''; ?> />
												<span class="lbl"> 是</span>
											</label>&nbsp;
											<label>
												<input type="radio" class="ace" name="site_close" value="N" <?php echo $setting['site_close']=='N'?'checked':''; ?> />
												<span class="lbl"> 否</span>
											</label>
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> <?php echo $setting_lang['site_close_notice'] ?> </label>
										<div class="col-sm-9">
											<input type="text" placeholder="<?php echo $setting_lang['site_close_notice'] ?>" class="col-sm-5" name="site_close_notice" value="<?php echo $setting['site_close_notice'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> <?php echo $setting_lang['site_announce'] ?> </label>
										<div class="col-sm-9">
											<input type="text" placeholder="<?php echo $setting_lang['site_announce'] ?>" class="col-sm-5" name="site_announce" value="<?php echo $setting['site_announce'] ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-2 control-label no-padding-right"> <?php echo $setting_lang['ip_blacklist'] ?> </label>
										<div class="col-sm-9">
                                            <textarea name="ip_blacklist" placeholder="<?php echo $setting_lang['ip_blacklist'] ?>" class="col-sm-5" style="height: 150px;"><?php echo $setting['ip_blacklist'] ?></textarea>
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <input type="hidden" name="position" value="visit" />
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