<?php include_once VIEWSPATH.'inc/header.php' ?>
<script>
$(function(){
    $.get('<?php echo ADMINURL ?>api/ip?ip=<?php echo $user_info['lastip']; ?>',function(data){
        $('#lastip').append(' ['+data+']');
    });
});
</script>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="#">首页</a>
							</li>
							<li class="active">控制台</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								控制台<small><i class="icon-double-angle-right"></i> 查看</small>
							</h1>
						</div><!-- /.page-header -->
                        
						<div class="row" id="dashboard">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-xs-12">
										<div class="widget-box">
											<div class="widget-header widget-header-flat">
												<h4 class="smaller">用户信息</h4>
											</div>
                                            
											<div class="widget-body">
												<div class="widget-main">
													<dl id="dt-list-1" class="dl-horizontal">
														<dt>用户</dt>
														<dd><?php echo $user_info['nickname']; ?></dd>
                                                        <dt>所属角色</dt>
														<dd><?php echo $user_info['rolename']; ?></dd>
														<dt>上次登录时间</dt>
														<dd><?php echo $user_info['lastdate']; ?></dd>
														<dt>上次登录IP</dt>
														<dd id="lastip"><?php echo $user_info['lastip']; ?></dd>
													</dl>
												</div>
											</div>
										</div>
									</div>
                                </div>
                                    
                                <div class="space-6"></div>
                                
                                <div class="row">
                                    <div class="col-xs-12">
										<div class="widget-box">
											<div class="widget-header widget-header-flat">
												<h4 class="smaller">系统基本信息</h4>
											</div>
                                            
											<div class="widget-body">
												<div class="widget-main">
													<dl id="dt-list-1" class="dl-horizontal">
														<dt>操作系统</dt>
														<dd><?php echo PHP_OS; ?></dd>
                                                        <dt>运行环境</dt>
														<dd><?php echo isset($_SERVER['SERVER_SOFTWARE'])?$_SERVER['SERVER_SOFTWARE']:''; ?></dd>
														<dt>PHP运行方式</dt>
														<dd><?php echo php_sapi_name(); ?></dd>
														<dt>PHP版本</dt>
														<dd><?php echo PHP_VERSION; ?></dd>
                                                        <dt>上传附件限制</dt>
														<dd><?php echo ini_get("post_max_size"); ?></dd>
                                                        <dt>服务器IP</dt>
														<dd><?php echo isset($_SERVER['SERVER_NAME'])?gethostbyname($_SERVER["SERVER_NAME"]):''; ?></dd>
                                                        <dt>服务器域名</dt>
                                                        <dd><?php echo isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:''; ?></dd>
													</dl>
												</div>
											</div>
										</div>
									</div>
                                    
                                </div>
                                    
                                <div class="space-6"></div>
                                
                                <div class="row">
                                    
                                    <div class="col-xs-12">
										<div class="widget-box">
											<div class="widget-header widget-header-flat">
												<h4 class="smaller">后台信息</h4>
											</div>
                                            
											<div class="widget-body">
												<div class="widget-main">
													<dl id="dt-list-1" class="dl-horizontal">
														<dt>系统环境的基本信息路径</dt>
														<dd><?php echo FCPATH; ?></dd>
                                                        <dt>开发者的邮箱地址</dt>
														<dd>admin@admin.com</dd>
													</dl>
												</div>
											</div>
										</div>
									</div>
								</div><!-- /row -->

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->
                
                <?php include_once VIEWSPATH.'inc/footer.php' ?>