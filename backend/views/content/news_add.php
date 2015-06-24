<?php include_once VIEWSPATH.'inc/header.php' ?>
				<div class="main-content">
					<div class="breadcrumbs" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="<?php echo ADMINURL ?>"><?php echo lang('nav_home'); ?></a>
							</li>
							<li><a href="<?php echo ADMINURL ?>content"><?php echo lang('nav_content'); ?></a></li>
							<li class="active"><?php echo lang('news_add'); ?></li>
						</ul><!-- .breadcrumb -->
                        
                        <?php include_once VIEWSPATH.'inc/nav_search.php' ?>
					</div>

					<div class="page-content">
                        <div class="page-header">
							<h1>
								<?php echo lang('nav_content'); ?><small><i class="icon-double-angle-right"></i> <?php echo lang('news_add'); ?></small>
							</h1>
						</div>
                    
						<div class="row">
							<div class="col-sm-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                                <?php echo form_open('ajax/news_save',array('id'=>'news_add_form','class'=>'form-horizontal'));?>
                                    <input type="hidden" name="id" value="<?php echo $news['id']; ?>" />
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> <?php echo lang('title'); ?> </label>
										<div class="col-sm-9">
											<input type="text" placeholder="Title" class="col-sm-8" name="title" value="<?php echo $news['title']; ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> <?php echo lang('category'); ?> </label>
										<?php if($news){ ?>
                                        <label class="col-sm-9 grey"><?php echo $news['catname']; ?></label>
                                        <?php }else{ ?>
                                        <div class="col-sm-9" id="categorys">
                                            <select class="col-sm-2" name="category[]">
                                                <option value="0">选择</option>
                                                <?php foreach($cates as $key => $value){ ?>
                                                <option value="<?php echo $key ?>"><?php echo $value['name'] ?></option>
                                                <?php } ?>
                                            </select>
										</div>
                                        <?php } ?>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> <?php echo lang('copyfrom'); ?> </label>
										<div class="col-sm-9">
											<input type="text" placeholder="Copyfrom" class="col-sm-3" name="copyfrom" value="<?php echo $news['copyfrom']; ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> <?php echo lang('author'); ?> </label>
										<div class="col-sm-9">
											<input type="text" placeholder="Author" class="col-sm-3" name="author" value="<?php echo $news['author']; ?>" />
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> <?php echo lang('url'); ?> </label>
										<div class="col-sm-9">
											<input type="text" placeholder="http://" class="col-sm-6" name="url" value="<?php echo $news['url']; ?>" />
                                            <span class="help-inline col-sm-3">
												<label class="middle">
													<input type="checkbox" id="id-url-check" class="ace" name="islink" value="1" <?php if($news['islink']) echo 'checked'; ?> />
													<span class="lbl"> 开启</span>
												</label>
											</span>
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> <?php echo lang('description'); ?> </label>
										<div class="col-sm-9">
											<textarea name="description" class="form-control" placeholder="Description"><?php echo $news['description']; ?></textarea>
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> <?php echo lang('content'); ?> </label>
										<div class="col-sm-9">
											<textarea id="editor" name="content" style="height: 500px;"><?php echo $news['content']; ?></textarea>
										</div>
									</div>
									<div class="space-4"></div>
                                    
                                    <div class="form-group">
										<label class="col-sm-1 control-label no-padding-right"> <?php echo lang('thumb'); ?> </label>
                                        <?php if($news['thumb']){ ?>
                                        <span class="col-sm-9" id="thumb_pic">
                                            <button class="btn btn-warning" type="button" id="reset_thumb">
												<i class="icon-undo"></i> 重新上传
											</button>
                                            <br />
                                            <img src="<?php echo '/public/uploads/thumb/'.$news['thumb'] ?>" style="max-width: 100%; margin-top: 10px;" />
                                        </span>
                                        <?php } ?>
										<div class="col-sm-9" id="upload_thumb" <?php if($news['thumb']) echo 'style="display:none;"' ?>>
											<input id="thumb-file" type="file" name="thumb" />
										</div>
									</div>
									<div class="space-4"></div>
                                </form>
                                
                            </div>
                            
                            <div class="col-sm-4">
                                <!--
                                <div class="widget-header header-color-blue2">
									<h4 class="lighter smaller"><?php echo lang('category'); ?> (可多选)</h4>
								</div>
								<div class="widget-body">
									<div class="widget-main padding-8">
										<div id="tree" class="tree"></div>
									</div>
								</div>
                                -->
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="clearfix form-actions">
								<div class="col-md-offset-1 col-md-9">
									<button class="btn btn-sm btn-primary" type="button" onclick="ADMIN.ajax_post($('#news_add_form'));">
										<i class="icon-ok bigger-110"></i>
										<?php echo lang('btn_submit'); ?>
									</button>
								</div>
							</div>
                        </div>
                        
                    </div>
                    
                </div>
<script src="js/fuelux/fuelux.tree.min.js"></script>
<script type="text/javascript" src="ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="ueditor/ueditor.all.js"></script>
<script type="text/javascript">
//var tree_data = <?php echo json_encode($cates); ?>;
//var treeDataSource = new DataSourceTree({data: tree_data});
$(function(){
    var ue = UE.getEditor('editor');
    
    $('#categorys').delegate('select','change',function(){
        $this = $(this);
        $this.nextAll().remove();
        if($this.val()>0){
            $.getJSON('<?php echo ADMINURL ?>api/category/'+$this.val(),function(data){
                if(data){
                    html = '<select class="col-sm-2 ml5" name="category[]"><option value="0">选择</option>\r';
                    $.each(data, function(i, val) {
                        html += '<option value="'+val.catid+'">'+val.catname+'</option>\r';
                    });
                    html += '</select>';
                    $('#categorys').append(html);
                }
            });
        }
        //console.log(html);
    });
    
    $('#reset_thumb').click(function(){
        $('#upload_thumb').show();
        $('#thumb_pic').hide();
        return false;
    });
    
    /*
    $('#tree').ace_tree({
    	dataSource: treeDataSource ,
    	multiSelect:true,
    	loadingHTML:'<div class="tree-loading"><i class="icon-refresh icon-spin blue"></i></div>',
    	'open-icon' : 'icon-minus',
    	'close-icon' : 'icon-plus',
    	'selectable' : true,
    	'selected-icon' : 'icon-ok',
    	'unselected-icon' : 'icon-remove'
    });
    */
    
    $('#thumb-file').ace_file_input({
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