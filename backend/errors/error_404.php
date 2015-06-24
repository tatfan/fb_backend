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
							<li class="active">Error 404</li>
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
												<i class="icon-sitemap"></i>
												404
											</span>
											Page Not Found
										</h1>

										<hr />
										<h3 class="lighter smaller">We looked everywhere but we couldn't find it!</h3>

										<div>
											<?php echo form_open('index/search',array('id'=>'error_search','class'=>'form-search'));?>
												<span class="input-icon align-middle">
													<i class="icon-search"></i>
													<input type="text" class="search-query" placeholder="Give it a search..." />
                                                    <input type="hidden" name="c" value="error" />
                                                    <input type="hidden" name="a" value="404" />
												</span>
												<button class="btn btn-sm" onclick="return false;">Go!</button>
											</form>

											<div class="space"></div>
											<h4 class="smaller">Try one of the following:</h4>

											<ul class="list-unstyled spaced inline bigger-110 margin-15">
												<li>
													<i class="icon-hand-right blue"></i>
													Re-check the url for typos
												</li>

												<li>
													<i class="icon-hand-right blue"></i>
													Read the faq
												</li>

												<li>
													<i class="icon-hand-right blue"></i>
													Tell us about it
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
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div><!-- /.main-content -->

<?php include_once VIEWSPATH.'inc/footer.php' ?>