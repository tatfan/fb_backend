<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>weixin"><?php echo lang('weixin'); ?></a></li>
							<li class="active">用户分组</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('weixin'); ?><small><i class="icon-double-angle-right"></i> 用户分组</small>
                                <?php if(check_backend_module_perm('group-add', 'weixin', $user_info)){ ?>
                                <button class="btn btn-sm btn-primary" id="add_group"><i class="icon-plus"></i> 新建分组</button>
                                <?php } ?>
                                <?php if(check_backend_module_perm('group-update', 'weixin', $user_info)){ ?>
                                <button class="btn btn-sm btn-success" id="update_group"><i class="icon-refresh"></i> 同步用户分组</button>
                                <?php } ?>
							</h1>
						</div>
                    
						<div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover center" id="group-table">
    								<thead class="thin-border-bottom center hander">
    									<tr>
                                            <th width="100">ID</th>
    										<th>分组名称</th>
                                            <th width="100">用户数量</th>
                                            <th width="60"><?php echo lang('operation'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php foreach($item_list as $row){ ?>
    									<tr>
    										<td><?php echo $row['gid'] ?></td>
    										<td><?php echo $row['gname'] ?></td>
    										<td><?php echo $row['count'] ?></td>
                                            <td>
                                                <?php if($row['gid']){ ?>
                                                <div class="action-buttons">
    												<?php if(check_backend_module_perm('group-edit', 'weixin', $user_info)){ ?>
                                                    <a href="#" class="green edit_group" title="修改名称" data="<?php echo $row['gid'] ?>" data-title="<?php echo $row['gname'] ?>">
    													<i class="icon-pencil bigger-130"></i>
    												</a>
                                                    <?php } ?>
    											</div>
                                                <?php } ?>
                                            </td>
    									</tr>
                                        <?php } ?>
    								</tbody>
    							</table>
                            </div>
                        </div>
                        
                        <!--<div class="clearfix row">
							<div class="pull-left col-sm-4"></div>
							<div class="pull-right dataTables_paginate paging_bootstrap">
								<ul class="pagination">
                                    <li><a class="grey">共 <?php echo $total ?> 条</a></li>
									<?php echo $links ?>
								</ul>
							</div>
						</div>-->
                        
                    </div>
                    
                </div>
<script>
$(function(){
    $('#group-table').dataTable({
        "aoColumns": [
          null, null, null, { "bSortable": false }
        ]
    });
    
    $("#add_group").on('click', function() {
        obj = this;
		bootbox.prompt("新建用户分组", function(result) {
    		if(result){
                $.post("<?php echo ADMINURL ?>weixin/group_edit/",
                    {
                        csrf_wy_admin_token: $.cookie('csrf_wy_admin_cookie'),
                        name: result
                    },
                    function (result){
                        if(result==1){
                            location.reload(true);
                        }
                    });
			}
    	});
        
        return false;
	});
    
    $(".edit_group").on('click', function() {
        obj = this;
		bootbox.prompt("修改用户分组【"+$(obj).attr('data-title')+"】", function(result) {
    		if(result){
                $.post("<?php echo ADMINURL ?>weixin/group_edit/",
                    {
                        csrf_wy_admin_token: $.cookie('csrf_wy_admin_cookie'),
                        name: result,
                        id: $(obj).attr('data')
                    },
                    function (result){
                        if(result==1){
                            location.reload(true);
                        }
                    });
			}
    	});
        
        return false;
	});
    
    $("#update_group").on('click', function() {
        $.gritter.add({
			title: '提示：',
			text: '<i class="icon-spinner icon-spin"></i>&nbsp;&nbsp;用户分组同步中，请勿进行其他操作...',
			class_name: 'gritter-success gritter-center',
            sticky: true,
            time: ''
		});
        $.get("<?php echo ADMINURL ?>weixin/group_update?time=<?php echo time() ?>", function(result){
            if(result==1){
                location.reload(true);
            }
        });
        return false;
	});
    
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>