<?php include_once VIEWSPATH.'inc/header.php' ?>
<style>
.dd-list ol.dd-list {
    padding-left: 36px;
}
</style>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							<li><a href="<?php echo ADMINURL ?>user">用户</a></li>
							<li class="active">角色权限</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								角色权限<small><i class="icon-double-angle-right"></i> <?php echo $role['rolename']; ?></small>
							</h1>
						</div>
                        
                        <?php if($type == 'module'){ ?>
						<div class="row role_perm" id="module_perm">
                            <?php echo form_open('ajax/role_perm',array('id'=>'role_module_perm'));?>
                            <div class="col-sm-1">
                                <a class="btn btn-success">模块权限</a>
                                <div class="space"></div>
                                <a class="btn" href="<?php echo ADMINURL ?>user/role_perm/category/<?php echo $role['roleid'] ?>">栏目权限</a>
                            </div>
                            <div class="col-sm-6">
                                <div class="dd dd-draghandle">
									<ol class="dd-list">
										<?php foreach($admin_menu['left'] as $key => $value){ if($value['is_show']==0) continue; ?>
										<li class="dd-item dd2-item">
											<div class="dd-handle dd2-handle">
												<label>
                                                    <input class="ace" type="checkbox" name="perm[<?php echo $key ?>][]" value="init" <?php if($role_perm[$key]){if(in_array('init',$role_perm[$key])) echo 'checked';} ?> /><span class="lbl"></span>
                                                </label>
											</div>
											<div class="dd2-content"><?php echo $value['title'] ?></div>
                                            <?php if($children = $value['children']){ ?>
											<ol class="dd-list">
												<?php foreach($children as $k => $v){ if($v['is_show']==0) continue; ?>
                                                <li class="dd-item dd2-item">
													<div class="dd-handle dd2-handle">
														<label>
                                                            <input class="ace" type="checkbox" name="perm[<?php echo $key ?>][]" value="<?php echo $k ?>" <?php if($role_perm[$key]){if(in_array($k,$role_perm[$key])) echo 'checked';} ?> /><span class="lbl"></span>
                                                        </label>
													</div>
													<div class="dd2-content grey"><?php echo $v['title'] ?></div>
                                                    <?php if($operation = $v['operation']){ ?>
        											<ol class="dd-list">
        												<?php foreach($operation as $_k => $_v){ ?>
                                                        <li class="dd-item dd2-item">
        													<div class="dd-handle dd2-handle">
        														<label>
                                                                    <input class="ace" type="checkbox" name="perm[<?php echo $key ?>][]" value="<?php echo $k.'-'.$_k ?>" <?php if($role_perm[$key]){if(in_array($k.'-'.$_k,$role_perm[$key])) echo 'checked';} ?> /><span class="lbl"></span>
                                                                </label>
        													</div>
        													<div class="dd2-content grey normal"><?php echo $_v['title'] ?></div>
        												</li>
        												 <?php } ?>
        											</ol>
                                                    <?php } ?>
												</li>
												 <?php } ?>
											</ol>
                                            <?php } ?>
                                            <?php if($operation = $value['operation']){ ?>
											<ol class="dd-list">
												<?php foreach($operation as $_k => $_v){ ?>
                                                <li class="dd-item dd2-item">
													<div class="dd-handle dd2-handle">
														<label>
                                                            <input class="ace" type="checkbox" name="perm[<?php echo $key ?>][]" value="<?php echo $_k ?>" <?php if($role_perm[$key]){if(in_array($_k,$role_perm[$key])) echo 'checked';} ?> /><span class="lbl"></span>
                                                        </label>
													</div>
													<div class="dd2-content grey"><?php echo $_v['title'] ?></div>
												</li>
												 <?php } ?>
											</ol>
                                            <?php } ?>
										</li>
                                        <?php } ?>
									</ol>
								</div>
                                <input type="hidden" name="roleid" value="<?php echo $role['roleid'] ?>" />
                                <input type="hidden" name="type" value="module" />
                                <div class="clearfix form-actions">
    								<div class="col-md-offset-1 col-md-9">
    									<button class="btn btn-primary" type="button" onclick="ADMIN.ajax_post($('#role_module_perm'));">
    										<i class="icon-ok bigger-110"></i>
    										<?php echo lang('btn_save'); ?>
    									</button>
    								</div>
    							</div>
							</div>
                            
                            </form>
                        </div>
                        <?php }elseif($type == 'category'){ ?>
                        <div class="row role_perm" id="module_perm">
                            <?php echo form_open('ajax/role_perm',array('id'=>'role_category_perm'));?>
                            <div class="col-sm-1">
                                <a class="btn" href="<?php echo ADMINURL ?>user/role_perm/module/<?php echo $role['roleid'] ?>">模块权限</a>
                                <div class="space"></div>
                                <a class="btn btn-success">栏目权限</a>
                            </div>
                            <div class="col-sm-6">
                                <table class="table table-striped table-bordered table-hover center">
    								<thead class="thin-border-bottom center">
    									<tr>
                                            <th width="50"><input class="ace" type="checkbox" /><span class="lbl"></span></th>
    										<th width="60">ID</th>
                                            <th><?php echo lang('catname'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php echo $categorys ?>
    								</tbody>
    							</table>
                                <input type="hidden" name="roleid" value="<?php echo $role['roleid'] ?>" />
                                <input type="hidden" name="type" value="category" />
                                <div class="clearfix form-actions">
    								<div class="col-md-offset-1 col-md-9">
    									<button class="btn btn-primary" type="button" onclick="ADMIN.ajax_post($('#role_category_perm'));">
    										<i class="icon-ok bigger-110"></i>
    										<?php echo lang('btn_save'); ?>
    									</button>
    								</div>
    							</div>
							</div>
                            
                            </form>
                        </div>
                        <?php } ?>
                    </div>
                    
                </div>
<script>
$(function(){
    $('table th input:checkbox').on('click' , function(){
		var that = this;
		$(this).closest('table').find('tr > td:first-child input:checkbox')
		.each(function(){
			this.checked = that.checked;
			$(this).closest('tr').toggleClass('selected');
		});
	});
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>