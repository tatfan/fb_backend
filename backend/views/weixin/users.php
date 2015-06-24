<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>weixin"><?php echo lang('weixin'); ?></a></li>
							<li class="active">关注用户列表</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('weixin'); ?><small><i class="icon-double-angle-right"></i> 关注用户列表</small>   
                                <div class="btn-group" id="btn-cate">
        							<button class="btn btn-sm btn-info"><i class="icon-list"></i> <?php echo lang('user_group_select'); ?></button>
        							<ul id="menu" class="dropdown-menu">
            							<li><a href="<?php echo ADMINURL ?>weixin/users">全部</a></li>
                                        <?php foreach($groups as $row){
                                            echo "<li><a href='".ADMINURL."weixin/users/$row[gid]'>$row[gname]</a></li>".PHP_EOL;
                                        } ?>
            						</ul>
        						</div><!-- /btn-group -->
                                <?php if(check_backend_module_perm('users-update', 'weixin', $user_info)){ ?>
                                <button class="btn btn-sm btn-success" id="update_users"><i class="icon-refresh"></i> 同步会员</button>
                                <?php } ?>
							</h1>
						</div>
                    
						<div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover center">
    								<thead class="thin-border-bottom center">
    									<tr>
                                            <th width="50">
    											<label>
    												<input type="checkbox" class="ace" />
    												<span class="lbl"></span>
    											</label>
    										</th>
                                            <th>头像</th>
                                            <th>用户</th>
                                            <th>openid</th>
    										<th width="100">用户组</th>
                                            <th width="50">性别</th>
    										<th width="200">所在地</th>
                                            <th width="80">备注</th>
                                            <th width="170">关注时间</th>
                                            <th width="60"><?php echo lang('operation'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php foreach($item_list as $row){ ?>
    									<tr>
                                            <td>
    											<label>
    												<input type="checkbox" class="ace" name="id[]" value="<?php echo $row['id'] ?>" />
    												<span class="lbl"></span>
    											</label>
    										</td>
                                            <td><img src="<?php echo $row['headimgurl'] ?>" class="wx-user-photo" /></td>
    										<td><?php echo $row['nickname'] ?></td>
                                            <td><?php echo $row['openid'] ?></td>
    										<td><?php echo $row['gname'] ?></td>
                                            <td><?php echo $row['sex']?($row['sex']==1?'男':'女'):'未知' ?></td>
    										<td><?php echo $row['country'].' - '.$row['province'].' - '.$row['city'] ?></td>
                                            <td><?php echo $row['remark'] ?> <i class="icon-edit green hander remark" title="设置备注" data="<?php echo $row['openid'] ?>" data-title="<?php echo $row['nickname'] ?>"></i></td>
                                            <td><?php echo date('Y-m-d H:i:s',$row['subscribe_time']) ?></td>
                                            <td>
                                                <div class="action-buttons">
    												<a href="<?php echo ADMINURL ?>user/user_edit/<?php echo $row['userid'] ?>" class="red" title="记录">
    													<i class="icon-exchange bigger-130"></i>
    												</a>
    											</div>
                                            </td>
    									</tr>
                                        <?php } ?>
    								</tbody>
    							</table>
                            </div>
                        </div>
                        
                        <div class="clearfix row">
                            <?php if(check_backend_module_perm('users-move', 'weixin', $user_info)){ ?>
							<div class="pull-left col-sm-4">
                                <button class="btn btn-sm btn-primary" id="uesrs_move" type="submit">批量移动到</button>
                                <select name="groupid">
                                <?php foreach($groups as $row){
                                    echo "<option value='$row[gid]'>$row[gname]</option>".PHP_EOL;
                                } ?>
                                </select>
                            </div>
                            <?php } ?>
							<div class="pull-right dataTables_paginate paging_bootstrap">
								<ul class="pagination">
                                    <li><a class="grey">共 <?php echo $total ?> 条</a></li>
									<?php echo $links ?>
								</ul>
							</div>
						</div>
                        
                    </div>
                    
                </div>
<script>
$(function(){
    $('table th input:checkbox').on('click' , function(){
		var that = this;
		$(this).closest('table').find('tr > td:first-child input:checkbox')
		.each(function(){
			this.checked = that.checked;
			$(this).closest('tr').toggleClass('selected');
		});
	});
    
    $("#menu").menu().hide();
    $('#btn-cate').hover(function(){
        $("#menu").show();
    },function(){
        $("#menu").hide();
    });
    
    $(".remark").on('click', function() {
        obj = this;
		bootbox.prompt("设置用户【"+$(obj).attr('data-title')+"】的备注名：", function(result) {
    		if(result){
                $.post("<?php echo ADMINURL ?>weixin/user_update_remark/",
                    {
                        csrf_wy_admin_token: $.cookie('csrf_wy_admin_cookie'),
                        remark: result,
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
    
    $("#update_users").on('click', function() {
        $.gritter.add({
			title: '提示：',
			text: '<i class="icon-spinner icon-spin"></i>&nbsp;&nbsp;用户同步中，请勿进行其他操作...',
			class_name: 'gritter-success gritter-center',
            sticky: true,
            time: ''
		});
        $.get("<?php echo ADMINURL ?>weixin/users_update?time=<?php echo time() ?>", function(result){
            if(result==1){
                location.reload(true);
            }
        });
        return false;
	});
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>