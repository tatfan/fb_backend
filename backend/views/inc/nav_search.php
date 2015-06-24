<div class="nav-search" id="nav-search">
	<?php echo form_open('index/search',array('id'=>'nav_search','class'=>'form-search'));?>
		<span class="input-icon">
			<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" name="q" />
            <input type="hidden" name="c" value="<?php echo $route_c; ?>" />
            <input type="hidden" name="a" value="<?php echo $route_a; ?>" />
			<i class="icon-search nav-search-icon"></i>
		</span>
	</form>
</div><!-- #nav-search -->