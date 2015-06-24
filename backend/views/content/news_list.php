<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>content"><?php echo lang('nav_content'); ?></a></li>
							<li class="active"><?php echo lang('news'); ?>列表</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo $category?$category['catname']:lang('nav_content'); ?><small><i class="icon-double-angle-right"></i> <?php echo lang('news'); ?>列表</small>
                                <div class="btn-group btn-cate">
        							<button class="btn btn-sm btn-info"><i class="icon-list"></i> <?php echo lang('category_select'); ?></button>
        							<ul id="menu" class="dropdown-menu">
            							<li><a href="<?php echo ADMINURL ?>content/news">全部</a></li>
                                        <?php echo $menu ?>
            						</ul>
        						</div><!-- /btn-group -->
                                <?php if(check_backend_module_perm('news-add', 'content', $user_info)){ ?>
                                <a class="btn btn-sm btn-primary" href="<?php echo ADMINURL ?>content/news_add"><i class="icon-plus"></i> 发布文章</a>
                                <?php } ?>
							</h1>
						</div>
                        <?php echo form_open('content/news_move',array('id'=>'move_news'));?>
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
    										<th width="60">ID</th>
                                            <th><?php echo lang('title'); ?></th>
                                            <th><?php echo lang('category'); ?></th>
    										<th width="60">点击量</th>
    										<th width="170">更新时间</th>
                                            <th width="100"><?php echo lang('operation'); ?></th>
    									</tr>
    								</thead>
    								<tbody>
                                        <?php foreach($item_list as $row){ ?>
    									<tr>
                                            <td>
    											<label>
    												<input type="checkbox" class="ace" name="newsid[]" value="<?php echo $row['id'] ?>" />
    												<span class="lbl"></span>
    											</label>
    										</td>
    										<td><?php echo $row['id'] ?></td>
    										<td class="left"><a target="_blank" href="/news/<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a><?php if($row['thumb']){ ?> <i class="icon-picture orange"></i><?php } ?></td>
                                            <td><?php echo $row['catname'] ?></td>
    										<td><?php echo $row['hits'] ?></td>
                                            <td><?php echo date('Y-m-d H:i:s',$row['updatetime']) ?></td>
                                            <td>
                                                <div class="action-buttons">
    												<!--<a href="#" data="<?php echo $row['id'] ?>" class="blue" title="推送">
    													<i class="icon-zoom-in bigger-130"></i>
    												</a>-->
                                                    <?php if(check_backend_module_perm('news-weixin_mass', 'content', $user_info)){ ?>
                                                    <a href="#" data="<?php echo $row['id'] ?>" data-title="<?php echo $row['title'] ?>" class="blue weixin_mass" title="微信群发">
    													<i class="icon-comments bigger-130"></i>
    												</a>
                                                    <?php } ?>
                                                    <?php if(check_backend_module_perm('news-edit', 'content', $user_info)){ ?>
    												<a href="<?php echo ADMINURL ?>content/news_add/<?php echo $row['id'] ?>" class="green" title="编辑">
    													<i class="icon-pencil bigger-130"></i>
    												</a>
                                                    <?php } ?>
                                                    <?php if(check_backend_module_perm('news-del', 'content', $user_info)){ ?>
    												<a href="#" data="<?php echo $row['id'] ?>" data-title="<?php echo $row['title'] ?>" class="red delete_confirm" title="删除">
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
							<?php if(check_backend_module_perm('news-move', 'content', $user_info)){ ?>
                            <div class="pull-left col-sm-4">
                                <div class="btn-group btn-cate dropup">
        							<button class="btn btn-sm btn-danger" onclick="javascript:;" type="button" id="cat_target">选择目标栏目</button>
        							<ul id="move_menu" class="dropdown-menu">
                                        <?php echo $menu ?>
            						</ul>
        						</div><!-- /btn-group -->
                                <button class="btn btn-sm btn-primary" id="news_move" type="submit">批量移动文章</button>
                            </div>
                            <?php } ?>
							<div class="pull-right dataTables_paginate paging_bootstrap">
								<ul class="pagination">
									<li><a class="grey">共 <?php echo $total ?> 条</a></li>
                                    <?php echo $links ?>
								</ul>
							</div>
						</div>
                        <input type="hidden" id="cate_move_id" name="catid" value="" />
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
    
    $("#menu, #move_menu").menu().hide();
    $('.btn-cate').hover(function(){
        $(this).find('.dropdown-menu').show();
    },function(){
        $(this).find('.dropdown-menu').hide();
    });
    
    $('#move_menu a').on('click',function(){
        $('#cat_target').text('移动到栏目 >> '+$(this).text());
        $('#cate_move_id').val($(this).attr('catid'));
        return false;
    });
    
    $(".delete_confirm").on('click', function() {
        obj = this;
		bootbox.dialog({
			message: "<span class='bigger-110'>确认删除新闻：【"+$(obj).attr('data-title')+"】? 该操作不可恢复！</span>",
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
						$.getJSON("<?php echo ADMINURL ?>ajax/new_delete/"+$(obj).attr('data'), function(result){
                            //alert("JSON Data: " + json.users[3].name);
                            ADMIN.show_message('成功删除新闻：'+$(obj).attr('data-title'),'success',3000);
                        });
                        $(obj).closest('tr').hide(1000);
					}
				}
				
			}
		});
        
        return false;
	});
    
    $(".weixin_mass").on('click', function() {
        $this = $(this);
		bootbox.dialog({
			message: "<span class='bigger-110'>添加新闻：【"+$this.attr('data-title')+"】到微信群发列表中吗? </span>",
			buttons: 			
			{
				"button" :
				{
					"label" : "取消",
					"className" : "btn-sm"
				},
				"danger" :
				{
					"label" : "确认",
					"className" : "btn-sm btn-success",
					"callback": function() {
						$.post("<?php echo ADMINURL ?>ajax/news_weixin_mass/", 
                        {
                            id : $this.attr('data'),
                            title : $this.attr('data-title'),
                            csrf_wy_admin_token : $.cookie('csrf_wy_admin_cookie')
                          
                        }, function(result){
                            //alert("JSON Data: " + json.users[3].name);
                            ADMIN.show_message('成功添加新闻到微信群发列表：'+$this.attr('data-title'),'success',3000);
                        });
					}
				}
				
			}
		});
        
        return false;
	});
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>