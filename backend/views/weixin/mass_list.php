<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>weixin"><?php echo lang('weixin'); ?></a></li>
							<li class="active">群发列表</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('weixin'); ?><small><i class="icon-double-angle-right"></i> 群发列表</small>
                                <a class="btn btn-sm btn-info" href="<?php echo ADMINURL ?>weixin/mass_log"><i class="icon-list"></i> 群发记录</a>
							</h1>
						</div>
                    
						<div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover center">
    								<thead class="thin-border-bottom center">
    									<tr>
                                            <th width="100">ID</th>
    										<th>标题</th>
                                            <th width="170">添加时间</th>
                                            <th width="100">操作</th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php foreach($item_list as $row){ ?>
    									<tr>
    										<td><?php echo $row['news_id'] ?></td>
    										<td><a href="/news/<?php echo $row['news_id'] ?>" target="_blank"><?php echo $row['title'] ?></a><?php if($row['thumb'] && $row['thumb_ext']=='.jpg'){ ?> <i class="icon-picture orange"></i><?php } ?></td>
                                            <td><?php echo $row['datetime'] ?></td>
                                            <td>
                                                <a href="<?php echo ADMINURL ?>content/news_add/<?php echo $row['news_id'] ?>" class="green" title="编辑">
													<i class="icon-pencil bigger-130"></i>
												</a>
                                                <a href="<?php echo ADMINURL ?>weixin/mass_del/<?php echo $row['id'] ?>" class="red" title="从群发列表移除">
													<i class="icon-remove bigger-130"></i>
												</a>
                                            </td>
    									</tr>
                                        <?php } ?>
    								</tbody>
    							</table>
                            </div>
                        </div>
                         <?php echo form_open('weixin/mass_send',array('id'=>'mass_form'));?>
                        <div class="clearfix row">
							<div class="pull-left col-sm-4">
                                选择用户组
                                <select name="groupid" id="groupid">
                                <?php foreach($groups as $row){
                                    echo "<option value='$row[gid]'>$row[gname]</option>".PHP_EOL;
                                } ?>
                                </select>
                                <button class="btn btn-sm btn-primary" type="button" id="mass_send">群发</button>
                            </div>
							<div class="pull-right dataTables_paginate paging_bootstrap">
								<ul class="pagination">
                                    <li><a class="grey">共 <?php echo count($item_list) ?> 条</a></li>
								</ul>
							</div>
						</div>
                        </form>
                    </div>
                    
                </div>
<script>
$(function(){
    $("#mass_send").on('click', function() {
        $this = $(this);
		bootbox.dialog({
			message: "<span class='bigger-110'>确认群发到用户组【"+$('#groupid option:selected').text()+"】? </span>",
			buttons: 			
			{
				"button" :
				{
					"label" : "取消",
					"className" : "btn-sm"
				},
				"danger" :
				{
					"label" : "确认群发",
					"className" : "btn-sm btn-success",
					"callback": function() {
                        $("#mass_send").text('发送中...').attr('disabled',true);
						ADMIN.ajax_post($('#mass_form'));
					}
				}
				
			}
		});
        
        return false;
	});
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>