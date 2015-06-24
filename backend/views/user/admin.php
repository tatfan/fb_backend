<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>user">用户</a></li>
							<li class="active">管理员列表</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('nav_user'); ?><small><i class="icon-double-angle-right"></i> 管理员列表</small>
                                <div class="btn-group" id="btn-cate">
        							<button class="btn btn-sm btn-info"><i class="icon-list"></i> 选择角色</button>
        							<ul id="menu" class="dropdown-menu">
            							<li><a href="<?php echo ADMINURL ?>user/admin_list">全部</a></li>
                                        <?php foreach($roles as $row){
                                            echo "<li><a href='".ADMINURL."user/admin_list/$row[roleid]'>$row[rolename]</a></li>".PHP_EOL;
                                        } ?>
            						</ul>
        						</div><!-- /btn-group -->
                                <?php if(check_backend_module_perm('admin-add', 'user', $user_info)){ ?>
                                <button id="add_admin" class="btn btn-sm btn-primary"><i class="icon-plus"></i> 添加管理员</button>
                                <?php } ?>
							</h1>
						</div>
                        
                        <?php echo form_open('user/admin_move',array('id'=>'move_users'));?>
						<div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover center" id="admin-table">
    								<thead class="thin-border-bottom center">
    									<tr>
                                            <th width="50">
    											<label>
    												<input type="checkbox" class="ace" />
    												<span class="lbl"></span>
    											</label>
    										</th>
    										<th width="80">ID</th>
                                            <th>用户名</th>
                                            <th width="200">真实姓名</th>
    										<th width="120">角色</th>
                                            <th>邮箱</th>
                                            <th width="150">电话</th>
    										<th width="170">最后登录时间</th>
                                            <th width="150">最后登录IP</th>
                                            <th width="100"><?php echo lang('operation'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php if($item_list){ foreach($item_list as $row){ ?>
    									<tr>
                                            <td>
    											<label>
    												<input type="checkbox" class="ace" name="id[]" value="<?php echo $row['id'] ?>" />
    												<span class="lbl"></span>
    											</label>
    										</td>
    										<td><?php echo $row['id'] ?></td>
    										<td><?php echo $row['username'] ?></td>
                                            <td><?php echo $row['nickname']?$row['nickname']:'-'; ?></td>
    										<td><?php echo $row['rolename'] ?></td>
                                            <td><?php echo $row['email']?$row['email']:'-'; ?></td>
                                            <td><?php echo $row['tel']?$row['tel']:'-'; ?></td>
                                            <td><?php echo $row['lastdate']?$row['lastdate']:'-'; ?></td>
                                            <td><?php echo $row['lastip']?$row['lastip']:'-'; ?></td>
                                            <td>
                                                <div class="action-buttons">
    												<?php if(check_backend_module_perm('admin-edit', 'user', $user_info)){ ?>
                                                    <a href="<?php echo ADMINURL ?>user/admin_edit/<?php echo $row['id'] ?>" class="green admin_edit" title="编辑" data="<?php echo $row['id'] ?>">
    													<i class="icon-pencil bigger-130"></i>
    												</a>
                                                    <?php } ?>
                                                    <?php if(check_backend_module_perm('admin-del', 'user', $user_info)){ ?>
    												<a href="#" data="<?php echo $row['id'] ?>" data-title="<?php echo $row['username'] ?>" class="red delete_confirm" title="删除">
    													<i class="icon-trash bigger-130"></i>
    												</a>
                                                    <?php } ?>
    											</div>
                                            </td>
    									</tr>
                                        <?php } } ?>
    								</tbody>
    							</table>
                            </div>
                        </div>
                        
                        <div class="space"></div>
                        
                        <div class="clearfix row">
                            <?php if(check_backend_module_perm('admin-move', 'user', $user_info)){ ?>
							<div class="pull-left col-sm-4">
                                <button class="btn btn-sm btn-primary" id="uesrs_move" type="submit">批量移动到</button>
                                <select name="roleid">
                                <?php foreach($roles as $row){
                                    echo "<option value='$row[roleid]'>$row[rolename]</option>".PHP_EOL;
                                } ?>
                                </select>
                            </div>
                            <?php } ?>
							<!--<div class="pull-right dataTables_paginate paging_bootstrap">
								<ul class="pagination">
                                    <li><a class="grey">共 <?php echo $total ?> 条</a></li>
									<?php echo $links ?>
								</ul>
							</div>-->
						</div>
                        </form>
                    </div>
                    
                </div>
<script>
$(function(){
    $('#admin-table').dataTable({
        "aoColumns": [
          { "bSortable": false }, null, null, null, null, null, null, null, null, { "bSortable": false }
        ]
    });
    
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
    
    $(".delete_confirm").on('click', function() {
        obj = this;
		bootbox.dialog({
			message: "<span class='bigger-110'>确认删除管理员：【"+$(obj).attr('data-title')+"】? 该操作不可恢复！</span>",
			buttons: 			
			{
				"button" :
				{
					"label" : "取消",
					"className" : "btn-sm"
				},
				"danger" :
				{
					"label" : "确认删除",
					"className" : "btn-sm btn-danger",
					"callback": function() {
						$.getJSON("<?php echo ADMINURL ?>ajax/admin_del/"+$(obj).attr('data'), function(result){
                            //alert("JSON Data: " + json.users[3].name);
                            ADMIN.show_message('成功删除管理员：'+$(obj).attr('data-title'),'success',3000)
                        });
                        $(obj).closest('tr').hide(1000);
					}
				}
				
			}
		});
        
        return false;
	});
    
    $(".admin_edit, #add_admin").on('click', function(e) {
		e.preventDefault();
        $("#dialog-message").empty();
        $.get("<?php echo ADMINURL ?>user/admin_add/"+$(this).attr('data'),function(strHTML){
            $("#dialog-message").html(strHTML);
        });
        
		var dialog = $("#dialog-message").removeClass('hide').dialog({
            width:800,
            height:430,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'>编辑管理员</h4></div>",
			title_html: true,
			buttons: [
				{
					text: "<?php echo lang('btn_cancel'); ?>",
					"class" : "btn",
					click: function() {
						$(this).dialog("close");
					}
				},
				{
					text: "<?php echo lang('btn_submit'); ?>",
					"class" : "btn btn-primary",
					click: function() {
						//$(this).dialog("submit");
                        ADMIN.ajax_post($('#admin_form'));
					} 
				}
			]
		});

		/**
		dialog.data( "uiDialog" )._title = function(title) {
			title.html( this.options.title );
		};
		**/
	});
    
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>