<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>help">帮助</a></li>
							<li class="active"><?php echo $page_title ?></li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								帮助<small><i class="icon-double-angle-right"></i> <?php echo $page_title ?></small>
							</h1>
						</div>
                    
						<div class="row">
							<div class="col-xs-12">
                                <pre><?php echo trim($page_data); ?></pre>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
<?php include_once VIEWSPATH.'inc/footer.php' ?>