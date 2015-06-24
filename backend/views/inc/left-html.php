                        <li<?php if($route_c=='index') echo ' class="active"'?>>
							<a href="<?php echo ADMINURL ?>">
								<i class="icon-dashboard"></i>
								<span class="menu-text"> <?php echo lang('nav_home'); ?> </span>
							</a>
						</li>
                        
                        <li<?php if($route_c=='setting') echo ' class="active open"'?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-cog"></i>
								<span class="menu-text"> <?php echo lang('setting'); ?> </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li<?php if($route_c=='setting'&&$route_a=='site') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>setting/site">
										<i class="icon-double-angle-right"></i>
										<?php echo lang('setting_site'); ?>
									</a>
								</li>
								<li<?php if($route_c=='setting'&&$route_a=='email') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>setting/email">
										<i class="icon-double-angle-right"></i>
										邮件设置
									</a>
								</li>
								<li<?php if($route_c=='setting'&&$route_a=='register') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>setting/register">
										<i class="icon-double-angle-right"></i>
										注册访问
									</a>
								</li>
								<li<?php if($route_c=='setting'&&$route_a=='interface') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>setting/interface">
										<i class="icon-double-angle-right"></i>
										界面设置
									</a>
								</li>
							</ul>
						</li>
                        
                        <li<?php if($route_c=='category') echo ' class="active"'?>>
							<a href="<?php echo ADMINURL ?>category">
								<i class="icon-list"></i>
								<span class="menu-text"> <?php echo lang('category'); ?>管理 </span>
							</a>
						</li>

						<li<?php if($route_c=='content') echo ' class="active open"'?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text"> <?php echo lang('nav_content'); ?>管理 </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li<?php if($route_c=='content'&&$route_a=='news_add') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>content/news_add" class="dropdown-toggle">
										<i class="icon-double-angle-right"></i>
										<?php echo lang('news_add'); ?>
									</a>
								</li>
                                <li<?php if($route_c=='content'&&$route_a=='news_list') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>content/news_list" class="dropdown-toggle">
										<i class="icon-double-angle-right"></i>
										<?php echo lang('news_list'); ?>
									</a>
								</li>
								<li<?php if($route_c=='content'&&$route_a=='page') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>content/page">
										<i class="icon-double-angle-right"></i>
										<?php echo lang('nav_page'); ?>
									</a>
								</li>
								<li<?php if($route_c=='content'&&$route_a=='place') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>content/place">
										<i class="icon-double-angle-right"></i>
										推荐位
									</a>
								</li>
								<li<?php if($route_c=='content'&&$route_a=='gather') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>content/gather">
										<i class="icon-double-angle-right"></i>
										采集
									</a>
								</li>
							</ul>
						</li>

						<li<?php if($route_c=='ad') echo ' class="active open"'?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-list-alt"></i>
								<span class="menu-text"> 广告管理 </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li<?php if($route_c=='user'&&$route_a=='ad_list') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>ad/ad_list">
										<i class="icon-double-angle-right"></i>
										广告列表
									</a>
								</li>
								<li<?php if($route_c=='user'&&$route_a=='add') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>ad/add">
										<i class="icon-double-angle-right"></i>
										发布广告
									</a>
								</li>
							</ul>
						</li>

						<li<?php if($route_c=='user') echo ' class="active open"'?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-user"></i>
								<span class="menu-text">
									用户管理
								</span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
                                <li<?php if($route_c=='user'&&$route_a=='user_list') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>user/user_list">
										<i class="icon-double-angle-right"></i>
										会员管理
									</a>
								</li>
								<li<?php if($route_c=='user'&&$route_a=='group') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>user/group">
										<i class="icon-double-angle-right"></i>
										用户组管理
									</a>
								</li>
                                <li<?php if($route_c=='user'&&$route_a=='admin_list') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>user/admin_list">
										<i class="icon-double-angle-right"></i>
										管理员管理
									</a>
								</li>
								<li<?php if($route_c=='user'&&$route_a=='role') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>user/role">
										<i class="icon-double-angle-right"></i>
										角色管理
									</a>
								</li>
							</ul>
						</li>
                        
                        <li<?php if($route_c=='gallery') echo ' class="active"'?>>
							<a href="<?php echo ADMINURL ?>gallery">
								<i class="icon-picture"></i>
								<span class="menu-text"> 图库管理 </span>
							</a>
						</li>
                        
                        <li<?php if($route_c=='weixin') echo ' class="active open"'?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-comments"></i>
								<span class="menu-text"> 微信管理 </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li<?php if($route_c=='weixin'&&$route_a=='index') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>weixin">
										<i class="icon-double-angle-right"></i>
										基本配置
									</a>
								</li>
								<li<?php if($route_c=='weixin'&&$route_a=='menu') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>weixin/menu">
										<i class="icon-double-angle-right"></i>
										自定义菜单
									</a>
								</li>
								<li<?php if($route_c=='weixin'&&$route_a=='users') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>weixin/users">
										<i class="icon-double-angle-right"></i>
										关注用户
									</a>
								</li>
                                <li<?php if($route_c=='weixin'&&$route_a=='group') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>weixin/group">
										<i class="icon-double-angle-right"></i>
										用户分组
									</a>
								</li>
								<li<?php if($route_c=='weixin'&&$route_a=='auto') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>weixin/auto">
										<i class="icon-double-angle-right"></i>
										自动回复
									</a>
								</li>
                                <li<?php if($route_c=='weixin'&&$route_a=='service' OR $route_c=='weixin'&&$route_a=='reply') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>weixin/service">
										<i class="icon-double-angle-right"></i>
										客服回复
									</a>
								</li>
                                <li<?php if($route_c=='weixin'&&$route_a=='mass') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>weixin/mass">
										<i class="icon-double-angle-right"></i>
										群发
									</a>
								</li>
                                <li<?php if($route_c=='weixin'&&$route_a=='logs') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>weixin/logs">
										<i class="icon-double-angle-right"></i>
										日志
									</a>
								</li>
							</ul>
						</li>
                        
                        <li<?php if($route_c=='tools') echo ' class="active open"'?>>
							<a href="#" class="dropdown-toggle">
								<i class="icon-wrench"></i>
								<span class="menu-text"> 系统维护 </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li<?php if($route_c=='tools'&&$route_a=='database') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>tools/database">
										<i class="icon-double-angle-right"></i>
										数据库工具
									</a>
								</li>
                                <li<?php if($route_c=='tools'&&$route_a=='database_backup') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>tools/database_backup">
										<i class="icon-double-angle-right"></i>
										数据库备份
									</a>
								</li>
								<li<?php if($route_c=='tools'&&$route_a=='cache') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>tools/cache">
										<i class="icon-double-angle-right"></i>
										缓存维护
									</a>
								</li>
                                <li<?php if($route_c=='tools'&&$route_a=='logs') echo ' class="active"'?>>
									<a href="<?php echo ADMINURL ?>tools/logs">
										<i class="icon-double-angle-right"></i>
										日志
									</a>
								</li>
							</ul>
						</li>