<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>weixin"><?php echo lang('weixin'); ?></a></li>
							<li class="active">自动回复</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('weixin'); ?><small><i class="icon-double-angle-right"></i> 自动回复</small>
                                <?php if(check_backend_module_perm('auto-add', 'weixin', $user_info)){ ?>
                                <button id="add_auto" class="btn btn-sm btn-primary"><i class="icon-plus"></i> 新建自动回复</button>
                                <?php } ?>
							</h1>
						</div>
                    
						<div class="row">
                            <div class="col-sm-12">
                                
                                <table class="table table-striped table-bordered table-hover center" id="auto-table">
    								<thead class="thin-border-bottom center hander">
    									<tr>
    										<th width="80">ID</th>
                                            <th>关键字</th>
                                            <th>内容</th>
                                            <th width="170">时间</th>
                                            <th width="100"><?php echo lang('operation'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php foreach($item_list as $row){ ?>
    									<tr>
    										<td><?php echo $row['id'] ?></td>
    										<td><?php echo $row['keyword'] ?></td>
                                            <td><?php echo $row['message'] ?></td>
                                            <td><?php echo $row['datetime'] ?></td>
                                            <td>
                                                <div class="action-buttons">
                                                    <?php if(check_backend_module_perm('auto-edit', 'weixin', $user_info)){ ?>
    												<a href="#" class="green auto_edit" title="编辑" data="<?php echo $row['id'] ?>">
    													<i class="icon-pencil bigger-130"></i>
    												</a>
                                                    <?php } ?>
                                                    <?php if(check_backend_module_perm('auto-del', 'weixin', $user_info)){ ?>
    												<a href="#" data="<?php echo $row['id'] ?>" data-title="<?php echo $row['keyword'] ?>" class="red delete_confirm" title="删除">
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
                                    <li><a class="grey">共 <?php echo count($item_list) ?> 条</a></li>
									<?php echo $links ?>
								</ul>
							</div>
						</div>-->
                        
                    </div>
                    
                </div>
<script>
$(function(){
    $('#auto-table').dataTable({
        "aoColumns": [
          null, null, null, null, { "bSortable": false }
        ]
    });
    
    $(".auto_edit,#add_auto").on('click', function(e) {
		e.preventDefault();
        $("#dialog-message").empty();
        $.get("<?php echo ADMINURL ?>weixin/auto_add/"+$(this).attr('data'),function(strHTML){
            $("#dialog-message").html(strHTML);
        });
        
		var dialog = $("#dialog-message").removeClass('hide').dialog({
            width:800,
            height:280,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'>编辑自动回复</h4></div>",
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
                        ADMIN.ajax_post($('#auto_form'));
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
    
    $(".delete_confirm").on('click', function() {
        obj = this;
		bootbox.dialog({
			message: "<span class='bigger-110'>确认删除自动回复：【"+$(obj).attr('data-title')+"】? 该操作不可恢复！</span>",
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
						$.getJSON("<?php echo ADMINURL ?>weixin/auto_del/"+$(obj).attr('data'), function(result){
                            //alert("JSON Data: " + json.users[3].name);
                            ADMIN.show_message('成功删除自动回复：'+$(obj).attr('data-title'),'success',3000)
                        });
                        $(obj).closest('tr').hide(1000);
					}
				}
				
			}
		});
        
        return false;
	});
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>