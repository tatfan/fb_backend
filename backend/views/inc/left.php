<div class="sidebar" id="sidebar">
	<div class="sidebar-shortcuts" id="sidebar-shortcuts">
		<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
			<?php if($admin_menu['top']){ foreach($admin_menu['top'] as $key => $value){ ?>
            <a class="btn btn-<?php echo $key ?>" title="<?php echo $value['title'] ?>" href="<?php echo $value['url'] ?>">
				<i class="<?php echo $value['icon'] ?>"></i>
			</a>
            <?php } } ?>
		</div>
	</div><!-- #sidebar-shortcuts -->
    
	<ul class="nav nav-list">
        <li<?php if($route_c=='index') echo ' class="active"'?> >
    		<a class="dropdown-toggle" href="<?php echo ADMINURL ?>">
    			<i class="icon-dashboard"></i>
    			<span class="menu-text"> <?php echo lang('nav_home'); ?> </span>
    		</a>
        </li>
        <?php
        if($admin_menu_left = $admin_menu['left']){
            foreach($admin_menu_left as $key => $value){
                if(!check_backend_module_perm('init', $key, $user_info)) continue;
                $class = $value['children'] ? 'active open' : 'active';
        ?>
        <li<?php if($route_c==$key) echo ' class="'.$class.'"'?>>
			<a href="<?php echo $value['url'] ?>" class="dropdown-toggle">
				<i class="<?php echo $value['icon'] ?>"></i>
				<span class="menu-text"> <?php echo $value['title'] ?> </span>
				<?php if($value['url']=='#'){ ?><b class="arrow icon-angle-down"></b><?php } ?>
			</a>
            <?php if($children = $value['children']){ ?>
            <ul class="submenu">
                <?php
                foreach($children as $k => $v){
                    if(!check_backend_module_perm($k, $key, $user_info)) continue;
                ?>
                <li<?php if($route_c==$key && $route_a==$k) echo ' class="active"'; ?>>
					<a href="<?php echo $v['url'] ?>">
						<i class="icon-double-angle-right"></i>
						<?php echo $v['title'] ?>
					</a>
				</li>
            <?php } ?>
            </ul>
            <?php } ?>
        </li>
        <?php } } ?>
	</ul><!-- /.nav-list -->
    
	<!--<div class="sidebar-collapse" id="sidebar-collapse">
		<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
	</div>-->
</div>