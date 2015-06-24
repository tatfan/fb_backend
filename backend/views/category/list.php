<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							<li><a href="<?php echo ADMINURL ?>category"><?php echo lang('category'); ?></a></li>
							<li class="active"><?php echo lang('category_list'); ?></li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('category'); ?><small><i class="icon-double-angle-right"></i> <?php echo lang('category_list'); ?></small>
                                <?php if(check_backend_module_perm('add', 'category', $user_info)){ ?>
                                <button class="btn btn-sm btn-primary" id="category-add" data="">
									<i class="icon-plus align-middle bigger-120"></i>
									<?php echo lang('category_add'); ?>
								</button>
                                <?php } ?>
                                <?php if(check_backend_module_perm('repair', 'category', $user_info)){ ?>
                                <a class="btn btn-sm btn-success" href="<?php echo ADMINURL ?>category/repair"><i class="icon-refresh"></i> 更新栏目缓存</a>
                                <?php } ?>
							</h1>
						</div>
                        
                        <?php if($this->input->get('q',ture)=='repair'){ ?>
                        <div class="alert alert-block alert-success">
							<button data-dismiss="alert" class="close" type="button">
								<i class="icon-remove"></i>
							</button>
							<i class="icon-ok green"></i>
							栏目缓存，<strong class="green">更新成功</strong>。
						</div>
                        <?php } ?>
                        
						<div class="row">
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover center" id="category-table">
    								<thead class="thin-border-bottom center">
    									<tr>
                                            <th width="50"></th>
    										<th width="60">ID</th>
                                            <th><?php echo lang('catname'); ?></th>
                                            <th><?php echo lang('is_show'); ?></th>
                                            <th width="100"><?php echo lang('operation'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php echo $categorys ?>
    								</tbody>
    							</table>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
<script>
$(function(){
    /*
    $('#category-table').dataTable({
        "aoColumns": [
          { "bSortable": false },{ "bSortable": false },{ "bSortable": false },{ "bSortable": false },{ "bSortable": false }
        ],
        "bPaginate":　false
    });
    */
    $(".delete_confirm").on('click', function() {
        obj = this;
		bootbox.dialog({
			message: "<span class='bigger-110'>确认删除栏目：【"+$(obj).attr('data-title')+"】? 该操作不可恢复！</span>",
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
						$.getJSON("<?php echo ADMINURL ?>ajax/category_delete/"+$(obj).attr('data'), function(result){
                            ADMIN.show_message('成功删除新闻：'+$(obj).attr('data-title'),'success',3000);
                        });
                        $(obj).closest('tr').hide(1000);
					}
				}
				
			}
		});
        
        return false;
	});

	$(".cate_edit, #category-add").on('click', function(e) {
		e.preventDefault();
        $("#dialog-message").empty();
        $.get("<?php echo ADMINURL ?>category/add/"+$(this).attr('data'),function(strHTML){
            $("#dialog-message").html(strHTML);
        });
        
		var dialog = $("#dialog-message").removeClass('hide').dialog({
            width:800,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'>编辑栏目</h4></div>",
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
                        ADMIN.ajax_post($('#category_form'));
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