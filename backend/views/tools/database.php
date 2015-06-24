<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>tools"><?php echo lang('tools'); ?></a></li>
							<li class="active">数据库工具</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('tools'); ?><small><i class="icon-double-angle-right"></i> 数据库工具</small>
                                <button class="btn btn-sm btn-primary" id="create_table">
									<i class="icon-plus align-middle bigger-120"></i>
									新建表
								</button>
                                <button class="btn btn-sm btn-warning" id="add_field">
									<i class="icon-plus-sign align-middle bigger-120"></i>
									新建字段
								</button>
							</h1>
						</div>
                    
						<div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-success">
                                    MySQL Version：<?php echo $db_version ?>，Total：<?php echo $total ?> 个表<br />
                                    此功能比较简单，复杂操作，请使用phpMyAdmin。<br />
                                    请注意，操作数据库，可能会损坏数据，非开发人员请勿随意操作。
    							</div>
                                
                                <div id="accordion" class="accordion-style1 panel-group">
                                    <?php foreach($items as $key => $row){ ?>
									<div class="panel panel-default">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $key ?>">
													<i class="icon-angle-right bigger-110" data-icon-hide="icon-angle-down" data-icon-show="icon-angle-right"></i>
													&nbsp;<?php echo $row['name'] ?>&nbsp;&nbsp;<i class="icon-double-angle-right green"></i>&nbsp;&nbsp;<?php echo $row['total'] ?> 条数据
												</a>
											</h4>
										</div>

										<div class="panel-collapse collapse" id="collapse<?php echo $key ?>">
											<div class="panel-body">
                                                <div class="col-sm-12">
                                                    <table class="table table-striped table-bordered table-hover center" style="margin-bottom: 0;">
                                                        <thead class="thin-border-bottom center">
                                                        <tr>
                    										<th width="60">#</th>
                                                            <th>字段名</th>
                                                            <th>类型</th>
                                                            <th>默认值</th>
                                                            <th>最大长度</th>
                    									</tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach($row['fields'] as $k => $v){?>
                        									<tr>
                        										<td><?php echo ($k+1) ?></td>
                                                                <td><?php echo $v->name ?><?php echo $v->primary_key==1?' &nbsp;<i class="icon-lock orange" title="主键"></i>':''; ?></td>
                                                                <td><?php echo $v->type ?></td>
                                                                <td><?php echo $v->default?$v->default:'null' ?></td>
                                                                <td><?php echo $v->max_length?$v->max_length:0 ?></td>
                        									</tr>
                                                            <?php } ?>
                                                        </tbody>
                        							</table>
                                                </div>
                                            </div>
										</div>
									</div>
                                    <?php } ?>
								</div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
                <div id="add-fields" class="hide">
                    <div class="page-content">
                        <div class="row">
                            <?php echo form_open('ajax/database_add_fields',array('id'=>'table_form','class'=>'form-horizontal'));?>
                            <div class="form-group">
                    			<label class="col-sm-2 control-label no-padding-right"> 表 </label>
                    			<div class="col-sm-9">
                    				<select name="table" class="col-sm-5">
                                        <?php foreach($items as $key => $row){ ?>
                                        <option value="<?php echo str_replace('wy_','',$row['name']) ?>"><?php echo $row['name'] ?></option>
                                        <?php } ?>
                                    </select>
                    			</div>
                    		</div>
                    		<div class="space-4"></div>
                            
                            <div class="form-group">
                    			<label class="col-sm-2 control-label no-padding-right"> 名称 </label>
                    			<div class="col-sm-9">
                    				<input type="text" class="col-sm-5" name="name" value="" />
                    			</div>
                    		</div>
                    		<div class="space-4"></div>
                            
                            <div class="form-group">
                    			<label class="col-sm-2 control-label no-padding-right"> 类型 </label>
                    			<div class="col-sm-9">
                    				<select name="type" class="col-sm-5">
                                    	<option>INT</option>
                                    	<option>VARCHAR</option>
                                    	<option>TEXT</option>
                                        <option>LONGTEXT</option>
                                        <option>BLOB</option>
                                    	<option>LONGBLOB</option>
                                    	<option>DATETIME</option>
                                    	<option>TIMESTAMP</option>
                                    </select>
                    			</div>
                    		</div>
                    		<div class="space-4"></div>
                            
                            <div class="form-group">
                    			<label class="col-sm-2 control-label no-padding-right"> 长度 </label>
                    			<div class="col-sm-9">
                    				<input type="text" class="col-sm-5" name="constraint" value="" />
                    			</div>
                    		</div>
                    		<div class="space-4"></div>
                            
                            <div class="form-group">
                    			<label class="col-sm-2 control-label no-padding-right"> 缺省值 </label>
                    			<div class="col-sm-9">
                    				<input type="text" class="col-sm-5" name="default" value="NULL" />
                    			</div>
                    		</div>
                    		<div class="space-4"></div>
                            
                            </form>
                        </div>
                    </div>
                </div>
<script>
$(function(){
    $('#create_table').click(function(){
        bootbox.prompt("新建表，系统自动添加前缀 <i class='icon-quote-left orange'></i> fb_ <i class='icon-quote-right orange'></i> ，请勿重复", function(result) {
			if(result){
                $.post("<?php echo ADMINURL ?>ajax/database_create_table/",
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
    
    $("#add_field").on('click', function(e) {
		e.preventDefault();
        
		var dialog = $("#add-fields").removeClass('hide').dialog({
            width:800,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'>新建字段</h4></div>",
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
                        ADMIN.ajax_post($('#table_form'));
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