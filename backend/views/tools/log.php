<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>tools">系统维护</a></li>
							<li class="active">错误日志</li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								系统维护<small><i class="icon-double-angle-right"></i> 错误日志</small>
							</h1>
						</div>
                    
						<div class="row">
							<div class="col-xs-12">
                                <pre><?php echo $page_data ? trim($page_data) : '无错误日志报告'; ?></pre>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
<?php include_once VIEWSPATH.'inc/footer.php' ?>