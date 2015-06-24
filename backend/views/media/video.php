<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_content'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>media">媒体管理</a></li>
							<li class="active">视频</li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								媒体管理<small><i class="icon-double-angle-right"></i> 视频</small>
							</h1>
						</div>
                    
						<div class="row">
							<div class="col-xs-12">
                                <table class="table table-striped table-bordered table-hover center" id="video-table">
                                    <thead class="thin-border-bottom center hander">
                                    <tr>
                                        <th>字件名</th>
                                        <th><i class="icon-time orange"></i> 上传时间</th>
                                        <th>文件大小</th>
                                        <th>路径</th>
                                        <th>相关文章</th>
                                        <th width="100">操作</th>
									</tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($files as $row){?>
    									<tr>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo date_friendly($row['date']) ?></td>
                                            <td><?php echo round($row['size']/(1024*1024),2)>0?round($row['size']/(1024*1024),2):'< 0.01' ?> M</td>
                                            <td><?php echo $row['relative_path'] ?></td>
                                            <td><?php echo $row['news']?'<a href="/news/'.$row['news']['id'].'" target="_blank">'.$row['news']['title'].'</a>':'-' ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <!--<a href="<?php echo ADMINURL ?>media/video_download/<?php echo $row['name'] ?>" target="_blank"><i class="icon-cloud-download bigger-130 green"></i></a>-->
                                                    <?php if(!$row['news']){ ?>
                                                    <a href="<?php echo ADMINURL ?>media/file_del?type=video&path=<?php echo urlencode($row['relative_path']); ?>&file=<?php echo urlencode($row['name']); ?>"><i class="icon-trash bigger-130 red"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </td>
    									</tr>
                                        <?php } ?>
                                    </tbody>
    							</table>
                            </div>
                        </div>
                        
                        <!--<div class="clearfix row">
							<div class="pull-left dataTables_paginate paging_bootstrap">
								<ul class="pagination">
                                    <li><a class="grey">共 <?php echo count($files) ?> 个视频</a></li>
								</ul>
							</div>
						</div>-->
                    </div>
                    
                </div>
<script>
$(function(){
    $('#video-table').dataTable({
        "aoColumns": [
          null, null, null, null, null, { "bSortable": false }
        ],
        "aaSorting": [[ 1, "desc" ]]
    });
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>