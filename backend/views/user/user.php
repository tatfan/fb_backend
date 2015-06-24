<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>user"><?php echo lang('nav_user'); ?></a></li>
							<li class="active"><?php echo lang('user'); ?>列表</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('nav_user'); ?><small><i class="icon-double-angle-right"></i> <?php echo lang('user'); ?>列表</small>   
                                <div class="btn-group" id="btn-cate">
        							<button class="btn btn-sm btn-info"><i class="icon-list"></i> <?php echo lang('user_group_select'); ?></button>
        							<ul id="menu" class="dropdown-menu">
            							<li><a href="<?php echo ADMINURL ?>user/user_list">全部</a></li>
                                        <?php foreach($groups as $row){
                                            echo "<li><a href='".ADMINURL."user/user_list/$row[groupid]'>$row[name]</a></li>".PHP_EOL;
                                        } ?>
            						</ul>
        						</div><!-- /btn-group -->
                                <?php if(check_backend_module_perm('user-add', 'user', $user_info)){ ?>
                                <button id="add_user" class="btn btn-sm btn-primary"><i class="icon-plus"></i> 添加用户</button>
                                <?php } ?>
							</h1>
						</div>
                        
                        <?php echo form_open('user/user_move',array('id'=>'move_users'));?>
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
    										<th width="80">ID</th>
                                            <th>用户名</th>
                                            <th>昵称</th>
    										<th width="100">用户组</th>
                                            <th>邮箱</th>
                                            <th width="100">电话</th>
    										<th width="100">最后登录时间</th>
                                            <th width="120">最后登录IP</th>
                                            <th width="100"><?php echo lang('operation'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php foreach($item_list as $row){ ?>
    									<tr>
                                            <td>
    											<label>
    												<input type="checkbox" class="ace" name="userid[]" value="<?php echo $row['userid'] ?>" />
    												<span class="lbl"></span>
    											</label>
    										</td>
    										<td><?php echo $row['userid'] ?></td>
    										<td><?php echo $row['username'] ?></td>
                                            <td><?php echo $row['nickname'] ?></td>
    										<td><span style="color:<?php echo $row['color'] ?>;"><?php echo $row['gname'] ?></span></td>
                                            <td><?php echo $row['email']?$row['email']:'-'; ?></td>
                                            <td><?php echo $row['tel']?$row['tel']:'-'; ?></td>
                                            <td><?php echo $row['lastdate']?date('Y-m-d',$row['lastdate']):'-'; ?></td>
                                            <td><?php echo $row['lastip']?$row['lastip']:'-'; ?></td>
                                            <td>
                                                <div class="action-buttons">
    												<?php if(check_backend_module_perm('user-edit', 'user', $user_info)){ ?>
                                                    <a href="<?php echo ADMINURL ?>user/user_edit/<?php echo $row['userid'] ?>" class="green user_edit" title="编辑" data="<?php echo $row['userid'] ?>">
    													<i class="icon-pencil bigger-130"></i>
    												</a>
                                                    <?php } ?>
                                                    <?php if(check_backend_module_perm('user-del', 'user', $user_info)){ ?>
    												<a href="#" data="<?php echo $row['userid'] ?>" data-title="<?php echo $row['username'] ?>" class="red delete_confirm" title="删除">
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
                        
                        <div class="clearfix row">
                            <?php if(check_backend_module_perm('user-move', 'user', $user_info)){ ?>
							<div class="pull-left col-sm-4">
                                <button class="btn btn-sm btn-primary" id="uesrs_move" type="submit">批量移动到</button>
                                <select name="groupid">
                                <?php foreach($groups as $row){
                                    echo "<option value='$row[groupid]'>$row[name]</option>".PHP_EOL;
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
                        </form>
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
    
    $(".delete_confirm").on('click', function() {
        obj = this;
		bootbox.dialog({
			message: "<span class='bigger-110'>确认删除会员：【"+$(obj).attr('data-title')+"】? 该操作不可恢复！</span>",
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
						$.getJSON("<?php echo ADMINURL ?>ajax/user_del/"+$(obj).attr('data'), function(result){
                            //alert("JSON Data: " + json.users[3].name);
                            ADMIN.show_message('成功删除会员：'+$(obj).attr('data-title'),'success',3000)
                        });
                        $(obj).closest('tr').hide(1000);
					}
				}
				
			}
		});
        
        return false;
	});
    
    $(".user_edit, #add_user").on('click', function(e) {
		e.preventDefault();
        $("#dialog-message").empty();
        $.get("<?php echo ADMINURL ?>user/user_add/"+$(this).attr('data'),function(strHTML){
            $("#dialog-message").html(strHTML);
        });
        
		var dialog = $("#dialog-message").removeClass('hide').dialog({
            width:800,
            height:430,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'>编辑会员</h4></div>",
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
                        ADMIN.ajax_post($('#user_form'));
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