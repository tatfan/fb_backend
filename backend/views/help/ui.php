<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_content'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>help">帮助</a></li>
							<li class="active">UI icons</li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								帮助<small><i class="icon-double-angle-right"></i> UI icons</small>
							</h1>
						</div>
                    
						<div class="row">
							<div class="col-xs-12">
                                <?php $total=0; foreach($css as $key => $row){
                                    if(strpos($row,'content')){
                                        $str = substr($row,0,strpos($row,':'));
                                        //echo '<li><i class="icon-'.$str.'"></i> icon-'.$str.'</li>';
                                        echo '<a class="btn btn-app btn-light btn-xs radius-4" style="margin-top: 10px" title="'.$str.'"><i class="icon-'.$str.'"></i></a>'.PHP_EOL;
                                        $total++;
                                    }
                                } ?>
                            </div>
                        </div>
                        <div class="space"></div>
                        <div class="clearfix row">
							<div class="pull-left dataTables_paginate paging_bootstrap">
								<ul class="pagination">
                                    <li><a class="grey">共 <?php echo $total ?> 个 Icon图标</a></li>
									<?php echo $links ?>
								</ul>
							</div>
						</div>
                    </div>
                    
                </div>
<style>
a.btn{
    margin-top: 10px;
}
</style>
<script>
$(function(){
    $('.btn-app').hover(function(){
        $(this).addClass('btn-yellow');
    },function(){
        $(this).removeClass('btn-yellow');
    });
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>