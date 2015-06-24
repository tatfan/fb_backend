<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>user"><?php echo lang('nav_user'); ?></a></li>
							<li class="active">角色列表</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
                            <h1>
								<?php echo lang('nav_user'); ?><small><i class="icon-double-angle-right"></i> 角色管理</small>
                                <?php if(check_backend_module_perm('role-add', 'user', $user_info)){ ?>
                                <button class="btn btn-sm btn-primary" id="role-add" data=""><i class="icon-plus"></i> 新建角色</button>
                                <?php } ?>
							</h1>
						</div>
                    
						<div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover center" id="role-table">
    								<thead class="thin-border-bottom center hander">
    									<tr>
    										<th width="80">ID</th>
    										<th>角色</th>
                                            <th>简介</th>
                                            <th width="150"><?php echo lang('operation'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php if($item_list){ foreach($item_list as $row){ ?>
    									<tr>
    										<td><?php echo $row['roleid'] ?></td>
    										<td><?php echo $row['rolename'] ?></td>
                                            <td><?php echo $row['description'] ?></td>
                                            <td>
                                                <?php if($row['roleid']>1){ ?>
                                                <div class="action-buttons">
    												<?php if(check_backend_module_perm('role-perm', 'user', $user_info)){ ?>
                                                    <a href="<?php echo ADMINURL ?>user/role_perm/module/<?php echo $row['roleid'] ?>" class="blue" title="角色权限">
    													<i class="icon-cog bigger-130"></i>
    												</a>
                                                    <?php } ?>
                                                    <?php if(check_backend_module_perm('role-edit', 'user', $user_info)){ ?>
                                                    <a href="<?php echo ADMINURL ?>user/role_edit/<?php echo $row['roleid'] ?>" class="green role_edit" title="编辑" data="<?php echo $row['roleid'] ?>">
    													<i class="icon-pencil bigger-130"></i>
    												</a>
                                                    <?php } ?>
                                                    <?php if(check_backend_module_perm('role-del', 'user', $user_info)){ ?>
    												<a href="#" data="<?php echo $row['roleid'] ?>" data-title="<?php echo $row['rolename'] ?>" class="red delete_confirm" title="删除">
    													<i class="icon-trash bigger-130"></i>
    												</a>
                                                    <?php } ?>
    											</div>
                                                <?php } ?>
                                            </td>
    									</tr>
                                        <?php } } ?>
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
    $('#role-table').dataTable({
        "aoColumns": [
          null, null, null, { "bSortable": false }
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
			message: "<span class='bigger-110'>确认删除角色：【"+$(obj).attr('data-title')+"】? 该操作不可恢复！</span>",
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
						$.getJSON("<?php echo ADMINURL ?>ajax/role_del/"+$(obj).attr('data'), function(result){
                            //alert("JSON Data: " + json.users[3].name);
                            ADMIN.show_message('成功删除角色：'+$(obj).attr('data-title'),'success',3000)
                        });
                        $(obj).closest('tr').hide(1000);
					}
				}
				
			}
		});
        
        return false;
	});

	$(".role_edit, #role-add").on('click', function(e) {
		e.preventDefault();
        $("#dialog-message").empty();
        $.get("<?php echo ADMINURL ?>user/role_add/"+$(this).attr('data'),function(strHTML){
            $("#dialog-message").html(strHTML);
        });
        
		var dialog = $("#dialog-message").removeClass('hide').dialog({
            width:800,
            height:270,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'>编辑角色</h4></div>",
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
                        ADMIN.ajax_post($('#role_form'));
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