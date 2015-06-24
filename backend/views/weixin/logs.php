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
                                <div class="alert alert-info">
                                    具体参数说明，参考微信公众平台开发者文档，
                                    <a href="http://mp.weixin.qq.com/wiki/10/79502792eef98d6e0c6e1739da387346.html" target="_blank">接收普通消息</a>
                                    和 <a href="http://mp.weixin.qq.com/wiki/2/5baf56ce4947d35003b86a9805634b1e.html" target="_blank">接收事件推送</a> 部分
    							</div>
                                <table class="table table-striped table-bordered table-hover center">
    								<thead class="thin-border-bottom center">
    									<tr>
                                            <th width="100">ID</th>
    										<th width="100">类型</th>
                                            <th>用户</th>
                                            <th width="170">时间</th>
                                            <th>XML解析</th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php foreach($item_list as $row){ $postObj = simplexml_load_string($row['poststr'], 'SimpleXMLElement', LIBXML_NOCDATA); ?>
    									<tr>
    										<td><?php echo $row['id'] ?></td>
    										<td><?php echo $row['type'] ?></td>
    										<td><?php echo $row['nickname']?$row['nickname']:$row['openid'] ?></td>
                                            <td><?php echo date('Y-m-d H:i:s',$row['datetime']) ?></td>
                                            <td class="left">
                                                <dl class="dl-horizontal">
                                                    <?php 
                                                    foreach($postObj as $key => $value){
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