<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>ad">广告管理</a></li>
							<li class="active">轮播</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								广告管理<small><i class="icon-double-angle-right"></i> 轮播</small>
                                <?php if(check_backend_module_perm('rotation-add', 'ad', $user_info)){ ?>
                                <button id="add_rotation" class="btn btn-sm btn-primary" data=""><i class="icon-plus"></i> 新建轮播</button>
                                <?php } ?>
							</h1>
						</div>
                        
						<div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover center" id="ad-table">
    								<thead class="thin-border-bottom center">
    									<tr>
    										<th width="80">ID</th>
                                            <th>标题</th>
    										<th width="180">发布时间</th>
                                            <th width="100">状态</th>
                                            <th width="100"><?php echo lang('operation'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php if($item_list){ foreach($item_list as $row){ ?>
    									<tr>
    										<td><?php echo $row['id'] ?></td>
    										<td><?php echo $row['name'] ?></td>
    										<td><?php echo $row['addtime'] ?></td>
                                            <td><?php echo $row['disabled']==1?'<span class="label">失效</span>':'<span class="label label-success">正常</span>' ?></td>
                                            <td>
                                                <div class="action-buttons">
    												<?php if(check_backend_module_perm('rotation-item', 'ad', $user_info)){ ?>
                                                    <a href="<?php echo ADMINURL ?>ad/rotation_item/<?php echo $row['id'] ?>" data="<?php echo $row['id'] ?>" class="blue" title="轮播列表">
    													<i class="icon-plus bigger-130"></i>
    												</a>
                                                    <?php } ?>
                                                    <?php if(check_backend_module_perm('rotation-edit', 'ad', $user_info)){ ?>
                                                    <a href="#" data="<?php echo $row['id'] ?>" class="green rotation_edit" title="编辑">
    													<i class="icon-pencil bigger-130"></i>
    												</a>
                                                    <?php } ?>
                                                    <?php if(check_backend_module_perm('rotation-del', 'ad', $user_info)){ ?>
    												<a href="#" data="<?php echo $row['id'] ?>" data-title="<?php echo $row['name'] ?>" class="red delete_confirm" title="删除">
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
                    </div>
                    
                </div>
<script>
$(function(){
    var oTable = $('#ad-table').dataTable({
        "aoColumns": [
          null, null, null, null, { "bSortable": false }
        ]
    });
    
     $(".rotation_edit, #add_rotation").on('click', function(e) {
		e.preventDefault();
        $("#dialog-message").empty();
        $.get("<?php echo ADMINURL ?>ad/rotation_add/"+$(this).attr('data'),function(strHTML){
            $("#dialog-message").html(strHTML);
        });
        
		var dialog = $("#dialog-message").removeClass('hide').dialog({
            width:500,
            height:200,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'>编辑轮播</h4></div>",
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
                        ADMIN.ajax_post($('#rotation_form'));
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
			message: "<span class='bigger-110'>确认删除轮播：【"+$(obj).attr('data-title')+"】? 该操作不可恢复！</span>",
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
						$.getJSON("<?php echo ADMINURL ?>ajax/rotation_del/"+$(obj).attr('data'), function(result){
                            //alert("JSON Data: " + json.users[3].name);
                            ADMIN.show_message('成功删除轮播：'+$(obj).attr('data-title'),'success',3000)
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