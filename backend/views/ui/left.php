                <div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<ul class="nav nav-list">
						<li class="active">
							<a href="<?php echo ADMINURL ?>">
								<i class="icon-dashboard"></i>
								<span class="menu-text"> 控制台 </span>
							</a>
						</li>

						<li>
							<a href="<?php echo ADMINURL ?>ui/typography">
								<i class="icon-text-width"></i>
								<span class="menu-text"> 文字排版 </span>
							</a>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text"> UI 组件 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="<?php echo ADMINURL ?>ui/elements">
										<i class="icon-double-angle-right"></i>
										组件
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/buttons">
										<i class="icon-double-angle-right"></i>
										按钮 &amp; 图表
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/treeview">
										<i class="icon-double-angle-right"></i>
										树菜单
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/jquery">
										<i class="icon-double-angle-right"></i>
										jQuery UI
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/nestable">
										<i class="icon-double-angle-right"></i>
										可拖拽列表
									</a>
								</li>

								<li>
									<a href="#" class="dropdown-toggle">
										<i class="icon-double-angle-right"></i>

										三级菜单
										<b class="arrow icon-angle-down"></b>
									</a>

									<ul class="submenu">
										<li>
											<a href="#">
												<i class="icon-leaf"></i>
												第一级
											</a>
										</li>

										<li>
											<a href="#" class="dropdown-toggle">
												<i class="icon-pencil"></i>

												第四级
												<b class="arrow icon-angle-down"></b>
											</a>

											<ul class="submenu">
												<li>
													<a href="#">
														<i class="icon-plus"></i>
														添加产品
													</a>
												</li>

												<li>
													<a href="#">
														<i class="icon-eye-open"></i>
														查看商品
													</a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-list"></i>
								<span class="menu-text"> 表格 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="<?php echo ADMINURL ?>ui/tables">
										<i class="icon-double-angle-right"></i>
										简单 &amp; 动态
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/jqgrid">
										<i class="icon-double-angle-right"></i>
										jqGrid plugin
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-edit"></i>
								<span class="menu-text"> 表单 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="<?php echo ADMINURL ?>ui/table_elements">
										<i class="icon-double-angle-right"></i>
										表单组件
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/wizard">
										<i class="icon-double-angle-right"></i>
										向导提示 &amp; 验证
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/wysiwyg">
										<i class="icon-double-angle-right"></i>
										编辑器
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/dropzone">
										<i class="icon-double-angle-right"></i>
										文件上传
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="<?php echo ADMINURL ?>ui/widgets">
								<i class="icon-list-alt"></i>
								<span class="menu-text"> 插件 </span>
							</a>
						</li>

						<li>
							<a href="<?php echo ADMINURL ?>ui/calendar">
								<i class="icon-calendar"></i>

								<span class="menu-text">
									日历
									<span class="badge badge-transparent tooltip-error" title="2&nbsp;Important&nbsp;Events">
										<i class="icon-warning-sign red bigger-130"></i>
									</span>
								</span>
							</a>
						</li>

						<li>
							<a href="<?php echo ADMINURL ?>ui/gallery">
								<i class="icon-picture"></i>
								<span class="menu-text"> 相册 </span>
							</a>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-tag"></i>
								<span class="menu-text"> 更多页面 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="<?php echo ADMINURL ?>ui/profile">
										<i class="icon-double-angle-right"></i>
										用户信息
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/inbox">
										<i class="icon-double-angle-right"></i>
										收件箱
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/pricing">
										<i class="icon-double-angle-right"></i>
										售价单
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/invoice">
										<i class="icon-double-angle-right"></i>
										购物车
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/timeline">
										<i class="icon-double-angle-right"></i>
										时间轴
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/login">
										<i class="icon-double-angle-right"></i>
										登录 &amp; 注册
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-file-alt"></i>

								<span class="menu-text">
									其他页面
									<span class="badge badge-primary ">5</span>
								</span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="<?php echo ADMINURL ?>ui/faq">
										<i class="icon-double-angle-right"></i>
										帮助
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/error_404">
										<i class="icon-double-angle-right"></i>
										404错误页面
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/error_500">
										<i class="icon-double-angle-right"></i>
										500错误页面
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/grid">
										<i class="icon-double-angle-right"></i>
										网格
									</a>
								</li>

								<li>
									<a href="<?php echo ADMINURL ?>ui/blank">
										<i class="icon-double-angle-right"></i>
										空白页面
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>