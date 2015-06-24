<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>weixin"><?php echo lang('weixin'); ?></a></li>
							<li class="active">日志</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('weixin'); ?><small><i class="icon-double-angle-right"></i> 日志</small>
							</h1>
						</div>
                    
						<div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover center">
    								<thead class="thin-border-bottom center">
    									<tr>
                                            <th width="100">ID</th>
    										<th>MSG_ID</th>
                                            <th>MEDIA_ID</th>
                                            <th>用户组</th>
                                            <th width="170">时间</th>
                                            <th>XML解析</th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php foreach($item_list as $row){  $xml = simplexml_load_string($row['xml'], 'SimpleXMLElement', LIBXML_NOCDATA); ?>
    									<tr>
    										<td><?php echo $row['id'] ?></td>
    										<td><?php echo $row['msg_id'] ?></td>
    										<td><?php echo $row['media_id'] ?></td>
                                            <td><?php echo $row['gname'] ?></td>
                                            <td><?php echo $row['datetime'] ?></td>
                                            <td class="left">
                                                <dl class="dl-horizontal">
                                                    <?php 
                                                    foreach($xml as $key => $value){
                                                        echo "<dt>{$key}</dt><dd>{$value}</dd>".PHP_EOL;
                                                    }
                                                    ?>
    											</dl>
                                            </td>
    									</tr>
                                        <?php } ?>
    								</tbody>
    							</table>
                            </div>
                        </div>
                        
                        <div class="clearfix row">
							<div class="pull-left col-sm-4"></div>
							<div class="pull-right dataTables_paginate paging_bootstrap">
								<ul class="pagination">
                                    <li><a class="grey">共 <?php echo $total ?> 条</a></li>
									<?php echo $links ?>
								</ul>
							</div>
						</div>
                        
                    </div>
                    
                </div>
<?php include_once VIEWSPATH.'inc/footer.php' ?>