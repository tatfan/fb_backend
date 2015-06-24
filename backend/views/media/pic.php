<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_content'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>media">媒体管理</a></li>
							<li class="active">图库</li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								媒体管理<small><i class="icon-double-angle-right"></i> 图库</small>
							</h1>
						</div>
                    
						<div class="row">
							<div class="col-xs-12">
                                <div class="row-fluid">
									<ul class="ace-thumbnails">
										<?php foreach($files as $row){?>
                                        <li>
											<a href="<?php echo '/public/uploads/gallery/'.$row['name'] ?>" data-rel="colorbox" class="colorbox">
												<img src="<?php echo '/public/uploads/gallery/'.$row['name'] ?>" />
											</a>
											<div class="tools tools-top">
												<a href="<?php echo ADMINURL ?>media/file_related?type=pic&file=<?php echo urlencode($row['name']); ?>" title="相关文章" class="pic_relate"><i class="icon-link"></i></a>
												<a href="<?php echo ADMINURL ?>media/file_del?type=pic&file=<?php echo urlencode($row['name']); ?>" title="删除图片"><i class="icon-remove red"></i></a>
											</div>
										</li>
										<?php } ?>
									</ul>
								</div>
                            </div>
                        </div>
                        <div class="space"></div>
                        <div class="clearfix row">
							<div class="pull-left dataTables_paginate paging_bootstrap">
								<ul class="pagination">
                                    <li><a class="grey">共 <?php echo count($files) ?> 张图片</a></li>
								</ul>
							</div>
						</div>
                    </div>
                    
                </div>
<style>
.ace-thumbnails img{
    width: 150px;
    height: 150px;
}
</style>
<script type="text/javascript">
$(function(){
	$("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>