<?php include_once VIEWSPATH.'inc/header.php' ?>

                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li class="active">Database Error</li>
						</ul><!-- .breadcrumb -->
					</div>

					<div class="page-content">
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

								<div class="error-container">
									<div class="well">
										<h1 class="grey">
											<span class="blue bigger-125">
												<i class="icon-random"></i>
												<?php echo $status_code; ?>
											</span>
											<?php echo $heading; ?>
										</h1>
                                        <hr />
                                        
                                        <h3 class="lighter smaller">
											But we are working
											<i class="icon-wrench icon-animated-wrench bigger-125"></i>
											on it!
										</h3>
                                        <hr />
                                        
                                        <h4 class="lighter smaller">
											<?php echo $message; ?>
										</h4>

										<div class="space"></div>
                                        
                                        <div>
											<h4 class="lighter smaller">Meanwhile, try one of the following:</h4>
											<ul class="list-unstyled spaced inline bigger-110 margin-15">
												<li>
													<i class="icon-hand-right blue"></i>
													Read the faq
												</li>

												<li>
													<i class="icon-hand-right blue"></i>
													Give us more info on how this specific error occurred!
												</li>
											</ul>
										</div>

										<hr />
										<div class="space"></div>

										<div class="center">
											<a href="javascript:window.history.back();" class="btn btn-grey">
												<i class="icon-arrow-left"></i>
												<?php echo lang('btn_back'); ?>
											</a>

											<a href="<?php echo ADMINURL ?>" class="btn btn-primary">
												<i class="icon-dashboard"></i>
												<?php echo lang('nav_home'); ?>
											</a>
										</div>
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>

<?php include_once VIEWSPATH.'inc/footer.php' ?>