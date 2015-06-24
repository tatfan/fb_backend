<div class="navbar-header pull-right" role="navigation">
	<ul class="nav ace-nav">
		<li class="purple">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="icon-bell-alt"></i>
				<span class="badge badge-important">8</span>
			</a>
			<ul class="pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
				<li class="dropdown-header">
					<i class="icon-warning-sign"></i>
					8条未审核文章
				</li>
				<li>
					<a href="<?php echo ADMINURL ?>content/check">
						查看所有未审核文章
						<i class="icon-arrow-right"></i>
					</a>
				</li>
			</ul>
		</li>
        <li class="light-blue">
			<a data-toggle="dropdown" href="#" class="dropdown-toggle">
				<img class="nav-user-photo" src="<?php echo $user_info['avatar'] ? 'avatars/'.$user_info['avatar']:'images/default.png' ?>" />
				<span class="user-info">
					<small>您好,</small>
                    <?php echo $user_info['nickname']; ?>
				</span>
				<i class="icon-caret-down"></i>
			</a>
			<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
				<li>
					<a href="<?php echo ADMINURL ?>index/profile">
						<i class="icon-user"></i>
						个人资料
					</a>
				</li>
                <li>
					<a href="<?php echo ADMINURL ?>index/pwd">
						<i class="icon-lock"></i>
						修改密码
					</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="<?php echo ADMINURL ?>index/logout">
						<i class="icon-off"></i>
						退出
					</a>
				</li>
			</ul>
		</li>
	</ul><!-- /.ace-nav -->
</div><!-- /.navbar-header -->