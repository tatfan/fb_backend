<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>tools"><?php echo lang('tools'); ?></a></li>
							<li class="active">数据库备份</li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('tools'); ?><small><i class="icon-double-angle-right"></i> 数据库备份</small>
							</h1>
						</div>
                        <div class="space"></div>
						<div class="row">
                            <div class="col-sm-12">
                                
                                <?php echo form_open('tools/file_backup',array('id'=>'backup_form','class'=>'form-horizontal'));?>
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                        <div class="form-group">
                                			<div class="table-header"> 选择要备份的表 </div>
                                            <div class="space"></div>
                                            <div class="col-sm-12">
                                                <label>
													<input type="checkbox" class="ace ace-checkbox-2" id="check_all" />
													<span class="lbl"> 全部 (不包括logs表)</span>
												</label>
                                			</div>
                                            <div class="col-sm-12">
                                                <?php foreach($items as $row){ ?>
												<label>
													<input type="checkbox" class="ace ace-checkbox-2" name="tables[]" value="<?php echo $row ?>" <?php if(in_array($row,$ignore_tabls)) echo 'disabled' ?> />
													<span class="lbl"> <?php echo $row ?></span>
												</label>
                                                <?php } ?>
                                			</div>
                                		</div>
                                		<div class="space"></div>
                                    
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="clearfix form-actions">
        								<div class="col-md-offset-1 col-md-9">
        									<button class="btn btn-primary" type="button" id="backup">
        										<i class="icon-cloud-upload bigger-110"></i>
        										提交备份
        									</button>
        								</div>
        							</div>
                                </div>
                                </form>
                            </div>
                            
                            <div class="space"></div>
                            
                            <div class="col-sm-12">
                                <div class="table-header"> 备份记录 </div>
                                <table class="table table-striped table-bordered table-hover center" id="backup-table">
                                    <thead class="thin-border-bottom center hander">
                                    <tr>
                                        <th>字件名</th>
                                        <th><i class="icon-time"></i> 备份时间</th>
                                        <th>文件大小</th>
                                        <th>操作</th>
									</tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($files as $row){?>
    									<tr>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo date_friendly($row['date']) ?></td>
                                            <td><?php echo round($row['size']/(1024*1024),2)>0?round($row['size']/(1024*1024),2):'< 0.01' ?> M</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="<?php echo ADMINURL ?>db_backup/<?php echo $row['name'] ?>" target="_blank"><i class="icon-cloud-download bigger-130 green"></i></a>
                                                    <a href="<?php echo ADMINURL ?>tools/file_del/<?php echo str_replace('.zip','',$row['name']) ?>"><i class="icon-trash bigger-130 red"></i></a>
                                                </div>
                                            </td>
    									</tr>
                                        <?php } ?>
                                    </tbody>
    							</table>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
<style>
.form-group label{
    width: 15%;
}
</style>
<script>
$(function(){
    $('#backup-table').dataTable({
        "aoColumns": [
          null, null, null, { "bSortable": false }
        ]
    });
    
    $('#check_all').on('click' , function(){
		var that = this;
		$(this).closest('.form-group').find('input:checkbox')
		.each(function(){
			this.checked = that.checked;
		});
	});
    
    $('#backup').click(function(){
        $(this).text('备份中...').attr('disabled',true);
        $('#backup_form').submit();
        return false;
    });
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>