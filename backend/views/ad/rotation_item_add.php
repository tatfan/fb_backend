<div class="page-content">
    <div class="row">
        <?php echo form_open('ajax/rotation_item_save',array('id'=>'rotation_form','class'=>'form-horizontal'));?>
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 标题 </label>
			<div class="col-sm-9">
				<input type="text" placeholder="标题" class="col-sm-10" name="title" value="<?php echo $item['title']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
        
        <div class="form-group">
			<label class="col-sm-2 control-label no-padding-right"> 链接 </label>
			<div class="col-sm-9">
				<input type="text" placeholder="http://" class="col-sm-10" name="url" value="<?php echo $item['url']; ?>" />
			</div>
		</div>
		<div class="space-4"></div>
        
        <div class="form-group type_panel" id="image_panel">
			<label class="col-sm-2 control-label no-padding-right"> 图片 </label>
			<?php if($item['image']){ ?>
            <span class="col-sm-9" id="image_pic">
                <button class="btn btn-sm btn-warning" type="button" id="reset_image">
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
        <div class="space-4"></div>
        
        <input type="hidden" name="id" value="<?php echo $item['id']; ?>" />
        <input type="hidden" name="ad_id" value="<?php echo $ad['id']; ?>" />
        </form>
    </div>
</div>
<script>
$(function(){
    $('#reset_image').click(function(){
        $('#upload_image').show();
        $('#image_pic').hide();
        return false;
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