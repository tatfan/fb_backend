<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>user"><?php echo lang('nav_user'); ?></a></li>
							<li class="active">用户组</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
                            <h1>
								<?php echo lang('nav_user'); ?><small><i class="icon-double-angle-right"></i> 用户组</small>
                                <?php if(check_backend_module_perm('group-add', 'user', $user_info)){ ?>
                                <button class="btn btn-sm btn-primary" id="group-add" data=""><i class="icon-plus"></i> 新建用户组</button>
                                <?php } ?>
                                <?php if(check_backend_module_perm('group-repair', 'user', $user_info)){ ?>
                                <button class="btn btn-sm btn-success" id="group_repair"><i class="icon-refresh"></i> 更新用户数统计</button>
                                <?php } ?>
							</h1>
						</div>
                    
						<div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover center" id="group-table">
    								<thead class="thin-border-bottom center hander">
    									<tr>
    										<th width="80">ID</th>
    										<th>用户组名称</th>
                                            <th width="100">会员数</th>
                                            <th width="100"><?php echo lang('operation'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php foreach($item_list as $row){ ?>
    									<tr>
    										<td><?php echo $row['groupid'] ?></td>
    										<td><span style="color:<?php echo $row['color'] ?>;"><?php echo $row['name'] ?></span></td>
                                            <td><?php echo $row['user_count'] ?></td>
                                            <td>
                                                <div class="action-buttons">
    												<?php if(check_backend_module_perm('group-edit', 'user', $user_info)){ ?>
                                                    <a href="<?php echo ADMINURL ?>user/group_edit/<?php echo $row['groupid'] ?>" class="green group_edit" title="编辑" data="<?php echo $row['groupid'] ?>">
    													<i class="icon-pencil bigger-130"></i>
    												</a>
                                                    <?php } ?>
                                                    <?php if(check_backend_module_perm('group-del', 'user', $user_info)){ ?>
    												<a href="#" data="<?php echo $row['groupid'] ?>" data-title="<?php echo $row['name'] ?>" class="red delete_confirm" title="删除">
    													<i class="icon-trash bigger-130"></i>
    												</a>
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
			message: "<span class='bigger-110'>确认删除用户组：【"+$(obj).attr('data-title')+"】? 该操作不可恢复！</span>",
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
						$.getJSON("<?php echo ADMINURL ?>ajax/group_del/"+$(obj).attr('data'), function(result){
                            //alert("JSON Data: " + json.users[3].name);
                            ADMIN.show_message('成功删除用户组：'+$(obj).attr('data-title'),'success',3000)
                        });
                        $(obj).closest('tr').hide(1000);
					}
				}
				
			}
		});
        
        return false;
	});

	$(".group_edit, #group-add").on('click', function(e) {
		e.preventDefault();
        $("#dialog-message").empty();
        $.get("<?php echo ADMINURL ?>user/group_add/"+$(this).attr('data'),function(strHTML){
            $("#dialog-message").html(strHTML);
        });
        
		var dialog = $("#dialog-message").removeClass('hide').dialog({
            width:800,
            height:270,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'>编辑用户组</h4></div>",
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
                        ADMIN.ajax_post($('#group_form'));
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
    
    $("#group_repair").on('click', function() {
        $.gritter.add({
			title: '提示：',
			text: '<i class="icon-spinner icon-spin"></i>&nbsp;&nbsp; 用户组会员数统计中，请勿进行其他操作...',
			class_name: 'gritter-success gritter-center',
            sticky: true,
            time: ''
		});
        $.get("<?php echo ADMINURL ?>ajax/group_repair?time=<?php echo time() ?>", function(result){
            if(result==1){
                location.reload(true);
            }
        });
        return false;
	});
    
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>