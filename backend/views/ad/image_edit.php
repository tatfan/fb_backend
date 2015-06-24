<?php include_once VIEWSPATH.'inc/header.php' ?>
                <div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>ad">广告管理</a></li>
							<li class="active">编辑</li>
						</ul><!-- .breadcrumb -->

						<?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								广告管理<small><i class="icon-double-angle-right"></i> 编辑</small>
							</h1>
						</div>
                        
						<div class="row">
                            <div class="col-sm-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                <?php echo form_open('ajax/ad_save',array('id'=>'ad_add_form','class'=>'form-horizontal'));?>
                                    <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
                                    <input type="hidden" name="type" value="<?php echo $item['type']; ?>" />
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 标题 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="标题" class="col-sm-8" name="name" value="<?php echo $item['name']; ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 类型 </label>
                                        <label class="col-sm-9 grey"><?php echo $ad_type[$item['type']]; ?></label>
									</div>
									<div class="space-4"></div>
                                    <!--
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 开始时间 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="开始时间" class="col-sm-3 date-picker" name="startdate" value="<?php echo $item['startdate']?date('Y-m-d',$item['startdate']):''; ?>" data-date-format="yyyy-mm-dd" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 结束时间 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="结束时间" class="col-sm-3 date-picker" name="enddate" value="<?php echo $item['enddate']?date('Y-m-d',$item['enddate']):''; ?>" data-date-format="yyyy-mm-dd" />
										</div>
									</div>
									<div class="space-4"></div>
                                    -->
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> 链接 </label>
										<div class="col-sm-9">
											<input type="text" placeholder="http://" class="col-sm-6" name="url" value="<?php echo $item['url']; ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    <?php if($item['type']=='image'){ ?>
                                    <div class="form-group type_panel" id="image_panel">
										<label class="col-sm-1 control-label no-padding-right"> 图片 </label>
                                        <?php if($item['image']){ ?>
                                        <span class="col-sm-9" id="image_pic">
                                            <button class="btn btn-warning" type="button" id="reset_image">
												<i class="icon-undo"></i> 重新上传
											</button>
                                            <br />
                                            <img src="<?php echo '/public/uploads/ad/'.$item['image'] ?>" style="max-width: 100%; margin-top: 10px;" />
                                        </span>
                                        <?php } ?>
										<div class="col-sm-9" id="upload_image" <?php if($item['image']) echo 'style="display:none;"' ?>>
											<input id="image-file" type="file" name="image" />
										</div>
									</div>
                                    <?php }else if($item['type']=='text'){ ?>
                                    <div class="form-group type_panel" id="text_panel">
										<label class="col-sm-1 control-label no-padding-right"> 内容 </label>
										<div class="col-sm-9">
											<textarea name="text" class="form-control" placeholder="文字"><?php echo $item['text']; ?></textarea>
										</div>
									</div>
                                    <?php } ?>
									<div class="space-4"></div>
                                </form>
                                
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="clearfix form-actions">
								<div class="col-md-offset-1 col-md-9">
									<button class="btn btn-sm btn-primary" type="button" onclick="ADMIN.ajax_post($('#ad_add_form'));">
										<i class="icon-ok bigger-110"></i>
										<?php echo lang('btn_submit'); ?>
									</button>
								</div>
							</div>
                        </div>
                        
                        <div class="space"></div>
                    </div>
                    
                </div>
<script>
$(function(){
    $('#reset_image').click(function(){
        $('#upload_image').show();
        $('#image_pic').hide();
        return false;
    });
    
    $('.date-picker').datepicker({
        autoclose:true,
        changeMonth: true,
        changeYear: true,
        dateFormat:'yy-mm-dd',
        showMonthAfterYear: true,
        hideIfNoPrevNext: true,
        yearRange: "1900:2020",
        monthNames: ['一月','二月','三月','四月','五月','六月', '七月','八月','九月','十月','十一月','十二月'],
        monthNamesShort: ['1','2','3','4','5','6', '7','8','9','10','11','12'],
        minDate: 0
	});
    
    $('#image-file').ace_file_input({
		style:'well',
		btn_choose:'格式仅限 JPG 或 PNG，且小于1M',
		btn_change:null,
		no_icon:'icon-picture',
		droppable:true,
		thumbnail:'fit'//large | fit
		//,icon_remove:null//set null, to hide remove/reset button
		/**,before_change:function(files, dropped) {
			//Check an example below
			//or examples/file-upload.html
			return true;
		}*/
		/**,before_remove : function() {
			return true;
		}*/
		,
		preview_error : function(filename, error_code) {
			//name of the file that failed
			//error_code values
			//1 = 'FILE_LOAD_FAILED',
			//2 = 'IMAGE_LOAD_FAILED',
			//3 = 'THUMBNAIL_FAILED'
			console.log(error_code);
		}

	}).on('change', function(){
		console.log($(this).data('ace_input_files'));
	});
});
</script>
<?php include_once VIEWSPATH.'inc/footer.php' ?>